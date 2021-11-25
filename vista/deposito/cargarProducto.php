<?php
include_once '../../configuracion.php';
$sesion = new session();
$datos = data_submitted();
$controlAdmin = new control_deposito();
$valido = $controlAdmin->verificarDeposito("cargarProducto");
if (!$valido) {
    header('Location: ../home/index.php?messageErr=' . urlencode("No tiene los permisos para acceder"));
    exit;
}
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}
$titulo = "Cargar Producto";
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <h1 class="text-center">Nuevo Producto</h1>
    <form id="datosProducto" class="col-md-11 mt-4" method="post" enctype="multipart/form-data" action="../actions/actionNuevoProducto.php">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="idproducto" name="idproducto" type="text" placeholder="ID">
                    <label for="idproducto">ID</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="proprecio" name="proprecio" type="text" placeholder="Precio">
                    <label for="proprecio">Precio</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="pronombre" name="pronombre" type="text" placeholder="Nombre">
                        <label for="pronombre">Nombre</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="prodetalle" name="prodetalle" type="text" placeholder="Detalle">
                        <label for="prodetalle">Detalle</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="procantstock" name="procantstock" type="text" placeholder="Stock">
                        <label for="procantstock">Stock</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="prodescuento" name="prodescuento" type="text" placeholder="Descuento">
                        <label for="prodescuento">Descuento</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4">
                    <label class="mb-3" for="imagen">Seleccione una imagen de producto</label>
                    <input type="file" name="imagen" id="imagen">
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="d-grid offset-md-4 col-md-4">
                <button class="btn" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);" type="submit">Cargar</button>
            </div>
        </div>
    </form>
</div>

<?php
include_once '../estructuras/pie.php';
?>