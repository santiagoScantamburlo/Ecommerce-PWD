<?php
$titulo = "Cadenitas";
include_once '../estructuras/cabecera.php';
$abmProducto = new abmproducto();
$datosBusqueda['habilitado'] = true;
$datosBusqueda['tipoproducto'] = "cadenitas";
$listaProductos = $abmProducto->buscar($datosBusqueda);
?>

<header style="background: rgb(0,212,255);
background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(246,73,215,1) 0%, rgba(175,0,179,1) 100%);">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">CADENITAS</h1>
            <p class="lead fw-normal text-white-50 mb-0">
            <div class="bi bi-heart-fill"></div>
            </p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            if (count($listaProductos) > 0) {
                $cont_prod = 0;
                for ($cont_prod = 0; $cont_prod <= 7 && $cont_prod < count($listaProductos); $cont_prod++) {
                    $producto = $listaProductos[$cont_prod];
            ?>

                    <div class='col mb-5'>
                        <div class='card h-100'>

                            <?php
                            if ($producto->getProdescuento() > 0) {
                            ?>
                                <div class='badge text-white position-absolute' style='background: rgb(32,99,230);background: linear-gradient(90deg, rgba(32,99,230,1) 0%, rgba(0,212,255,1) 100%, rgba(0,174,179,1) 100%);top: 0.5rem; right: 0.5rem'>Oferta<span>&nbsp; <?php echo $producto->getProdescuento() ?>%</span></div>
                            <?php
                            }
                            ?>

                            <img class='card-img-top' src='https://dummyimage.com/450x300/dee2e6/6c757d.jpg' alt='...' />
                            <div class='card-body p-4'>
                                <div class='text-center'>
                                    <h5 class='fw-bolder'> <?php echo $producto->getPronombre() ?> </h5>
                                    <p> <?php $producto->getProdetalle() ?> </p>

                                    <?php
                                    if ($producto->getProdescuento() > 0) {
                                        $precio = $producto->getProprecio();
                                        $precioDescuento = $precio - (($precio * $producto->getProdescuento()) / 100);
                                    ?>

                                        <span class='text-muted text-decoration-line-through'> <?php echo "$" . $precio ?> </span> <?php echo "$" . $precioDescuento; ?>

                                    <?php
                                    } else {
                                        echo "$" . $producto->getProprecio();
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>

                                <?php
                                if ($producto->getProdeshabilitado() != "") {
                                ?>

                                    <div class='text-center'>Sin stock</div>

                                <?php
                                } else {
                                ?>

                                    <form method="post" action="../actions/actionCargarItemCarrito.php">
                                        <input type="hidden" name="idproducto" value="<?php echo $producto->getIdproducto() ?>">
                                        <div class='text-center'><button class='btn btn-outline-light mt-auto' type="submit" style="background: rgb(255,69,207);background: linear-gradient(90deg, rgba(255,69,207,1) 0%, rgba(246,145,255,1) 0%, rgba(185,32,230,1) 100%);">Agregar al carrito</button></div>
                                    </form>
                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include_once '../estructuras/pie.php';
