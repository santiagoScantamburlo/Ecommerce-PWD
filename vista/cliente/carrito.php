<?php
include_once '../../configuracion.php';
$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../login/login.php?messageErr=' . urlencode("Usted no ha iniciado sesión"));
    exit;
}

$titulo = "Carrito de Compras";
include_once '../estructuras/cabecera.php';

$controlCarrito = new control_carrito_cliente();
$compra = $controlCarrito->verificarCarrito($sesion->getIdusuario());

if (is_null($compra)) {
?>

    <h1 class="text-center mt-3">Aún no hay productos agregados en el carrito</h1>

<?php
} else {

    $abmCompraItem = new abmcompraitem();
    $listaCompraItem = $abmCompraItem->buscar(['idcompra' => $compra->getIdcompra()]);
?>

    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <h5 class="mb-3 col-lg-7"><a href="../cliente/listaProductos.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continuar comprando</a></h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-7">
                                    <?php
                                    $subtotalCompra = 0;
                                    $totalFinalCompra = 0;
                                    $productosEnCarrito = 0;
                                    if (count($listaCompraItem)) {
                                        foreach ($listaCompraItem as $item) {
                                            $productosEnCarrito++;
                                            $objProducto = $item->getObjProducto();
                                            $idProducto = $objProducto->getIdproducto();
                                            $precioProducto = $objProducto->getProprecio();
                                            $descuentoProducto = $objProducto->getProdescuento();
                                            $cantidad = $item->getCicantidad();
                                            $subTotalProducto = ($precioProducto * $cantidad) - ((($precioProducto * $cantidad) * $descuentoProducto) / 100);
                                            $subtotalCompra += $subTotalProducto;
                                    ?>

                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center" style="width: 45%">
                                                            <div>
                                                                <img src='../../archivos/images/<?php echo md5($idProducto) . ".jpeg"; ?>' class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h5><?php echo $objProducto->getPronombre() ?></h5>
                                                                <p class="small mb-0"><?php echo $objProducto->getProdetalle() ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row align-items-center" style="width: 15%">
                                                            <form method="post" action="../actions/actionRestarCantidad.php">
                                                                <input id="idcompraitem" min="0" name="idcompraitem" value=<?php echo $item->getIdcompraitem(); ?> type="hidden" style="width: 55px" class="form-control form-control-sm" />
                                                                <button class="btn btn-link px-2" type="submit">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </form>
                                                            <input id="cicantidad" min="0" name="quantity" value=<?php echo $cantidad ?> type="number" style="width: 55px" class="form-control form-control-sm" disabled />
                                                            <form method="post" action="../actions/actionSumarCantidad.php">
                                                                <input id="cicantidad" min="0" name="idcompraitem" value=<?php echo $item->getIdcompraitem(); ?> type="hidden" style="width: 55px" class="form-control form-control-sm" />
                                                                <button class="btn btn-link px-2" type="submit">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center" style="width: 5%">
                                                            <h5 class="mb-0"><?php echo $subTotalProducto ?></h5>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <form method="post" action="../actions/actionEliminarDelCarrito.php">
                                                                <input type="hidden" name="idcompraitem" value="<?php echo $item->getIdcompraitem() ?>">
                                                                <button type="submit"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        <?php
                                        }
                                        ?>

                                </div>

                            <?php
                                    }
                            ?>

                            <div class="col-lg-5">

                                <div class="text-white rounded-3" style="background:rgba(139,0,142,1)">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Detalles de tarjeta</h5>
                                        </div>

                                        <p class="small mb-2">Tipo de tarjetas</p>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                        <form class="mt-4">
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Nombre y Apellido" />
                                                <label class="form-label" for="typeName">Nombre y Apellido</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3456" minlength="19" maxlength="19" />
                                                <label class="form-label" for="typeText">Número de tarjeta</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/AAAA" size="7" id="exp" minlength="7" maxlength="7" />
                                                        <label class="form-label" for="typeExp">Vencimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                        <label class="form-label" for="typeText">Código de seguridad</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Sub Total: $<?php echo round($subtotalCompra, 2) ?></p>
                                            <p class="mb-2">Total: $<?php echo $subtotalCompra * 1.21 ?></p>
                                        </div>

                                        <div class="mt-4">
                                            <div class="d-grid offset-md-4 col-md-3">
                                                <form metehod="post" action="../actions/actionAceptarCompra.php">
                                                    <input type="hidden" name="idcompra" value="<?php echo $compra->getIdcompra() ?>">
                                                    <button class="btn" style="color: white;background: rgba(252, 51, 255)" type="submit">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Pagar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

<?php
}
include_once '../estructuras/pie.php';
