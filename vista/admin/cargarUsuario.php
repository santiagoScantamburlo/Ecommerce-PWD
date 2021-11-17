<?php
include_once '../../configuracion.php';
$datos = data_submitted();
$controlAdmin = new control_admin();
if (count($datos) == 0) {
    $controlAdmin->verificarAdmin("cargarUsuario");
}
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <h1 class="text-center">Nuevo Usuario</h1>
    <form class="col-md-11 mt-4" method="post" action="../actions/actionNuevoUsuario.php">
        <div class="row">
            <div class="col-md-6">                   
                <div class="form-floating">
                    <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre">
                    <label for="idproducto">Nombre</label>
                </div>           
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Mail">
                    <label for="usmail">Mail</label>
                </div>            
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="uspass" name="uspass" type="password" placeholder="Contraseña">
                        <label for="uspass">Contraseña</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4">
                    <div class="form-floating">
                        <input class="form-control" id="uspass2" name="uspass2" type="password" placeholder="Confirmar contraseña">
                        <label for="uspass2">Confirmar contraseña</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-4">
                    <input class="form-check-input" id="cliente" name="idrol" type="radio" value="1">
                    <label for="cliente">Cliente</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-4">
                    <input class="form-check-input" id="deposito" name="idrol" type="radio" value="2">
                    <label for="deposito">Depósito</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-4">
                    <input class="form-check-input" id="admin" name="idrol" type="radio" value="3">
                    <label for="admin">Administrador</label>
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