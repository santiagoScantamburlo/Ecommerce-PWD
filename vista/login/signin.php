<?php
include_once '../../configuracion.php';
$sesion = new session();
if ($sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("Ya hay una sesion activa"));
    exit;
}
$titulo = "Registro";
include_once '../estructuras/cabecera.php';
?>
<div class="container mt-3">
    <div class="offset-md-4">
        <form action="../actions/actionSignin.php" method="post" class="col-md-6 mt-3 " id="usuarioNuevo" name="usuarioNuevo">
            <h1 class="h3 mb-3 text-center">Registrarse</h1>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre de usuario" required>
                    <label for="usnombre">Nombre de usuario </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Mail" required>
                    <label for="usmail">Mail </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="uspass" name="uspass" type="text" placeholder="Contraseña" required>
                    <label for="uspass">Contraseña </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="uspass" name="uspass" type="text" placeholder="Confirmar contraseña" required>
                    <label for="uspass">Confirmar contraseña </label>
                </div>
            </div>
            <div class=" mb-3">
                <div class="d-grid">
                    <button  class="btn" type="submit" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">Registrarme</button>
                </div>
            </div>
        </form>
    </div>

</div>

<?php
include_once '../estructuras/pie.php';

?>