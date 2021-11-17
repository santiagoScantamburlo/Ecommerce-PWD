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
    <div class="container mt-3 offset-md-2">
        <div class="col-md-11">
            <h1 class="text-center">Registrarse</h1>
        </div>
        <div>
            <div class=""></div>
            <form class="col-md-11" method="post" action="../actions/actionSignin.php">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-4">
                            <div class="form-floating">
                                <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre">
                                <label for="idproducto">Nombre</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-4">
                            <div class="form-floating">
                                <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Mail">
                                <label for="usmail">Mail</label>
                            </div>
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
                <div class="mt-5">
                    <div class="d-grid offset-md-4 col-md-4 mb-3">
                        <button class="btn" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);" type="submit">Registrarse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
include_once '../estructuras/pie.php';

?>