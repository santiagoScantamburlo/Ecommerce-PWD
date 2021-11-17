<?php
include_once '../../configuracion.php';
$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}

$datos = data_submitted();

$abmProducto = new abmproducto();
$lista = $abmProducto->buscar($datos);

if (isset($lista)) {
    include_once '../estructuras/cabecera.php';
    $producto = $lista[0];
?>

    <div class="container mt-3">
        <h1 class="text-center">Modificar Producto</h1>
        <form class="col-md-11 mt-4" method="post" action="../actions/actionModificarProducto.php">
            <input type="hidden" name="idproducto" value="<?php echo $producto->getIdproducto() ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="procantventas" name="procantventas" type="text" placeholder="Vendidos" value=<?php echo $producto->getProcantventas() ?>>
                        <label for="procantventas">Vendidos</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="proprecio" name="proprecio" type="text" placeholder="Precio" value=<?php echo $producto->getProprecio() ?>>
                        <label for="proprecio">Precio</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="pronombre" name="pronombre" type="text" placeholder="Nombre" value="<?php echo $producto->getPronombre() ?>">
                            <label for="pronombre">Nombre</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="prodetalle" name="prodetalle" type="text" placeholder="Detalle" value="<?php echo $producto->getProdetalle() ?>">
                            <label for="prodetalle">Detalle</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="procantstock" name="procantstock" type="text" placeholder="Stock" value=<?php echo $producto->getProcantstock() ?>>
                            <label for="procantstock">Stock</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="prodescuento" name="prodescuento" type="text" placeholder="Descuento" value=<?php echo $producto->getProdescuento() ?>>
                            <label for="prodescuento">Descuento</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="d-grid offset-md-4 col-md-4">
                    <button class="btn" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);" type="submit">Modificar</button>
                </div>
            </div>
        </form>
    </div>

<?php
    include_once '../estructuras/pie.php';
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../pages/administrarProductos.php?message=' . urlencode($message));
    exit;
}
?>