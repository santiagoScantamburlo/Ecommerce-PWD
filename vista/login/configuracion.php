<?php
include_once '../../configuracion.php';
$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}

$abmUsuario = new abmusuario();

$lista = $abmUsuario->buscar(['idusuario' => $sesion->getIdusuario()]);

if (isset($lista)) {
    include_once '../estructuras/cabecera.php';
?>

    <div class="container mt-3">
        <h1 class="text-center">Modificar Datos</h1>
        <form id="datosUsuario" class="col-md-11 mt-4" method="post" action="../actions/actionConfiguracion.php">
            <input type="hidden" name="idusuario" value=<?php echo $sesion->getIdusuario() ?>>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Nombre" value="<?php echo $lista[0]->getUsnombre() ?>">
                        <label for="idproducto">Nombre</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="usmail" name="usmail" type="text" placeholder="Mail" value="<?php echo $lista[0]->getUsmail() ?>">
                        <label for="usmail">Mail</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="uspass" name="uspass" type="password" placeholder="Contraseña" value="<?php echo $lista[0]->getUspass() ?>">
                            <label for="uspass">Contraseña</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-4">
                        <div class="form-floating">
                            <input class="form-control" id="uspass2" name="uspass2" type="password" placeholder="Confirmar contraseña" value="<?php echo $lista[0]->getUspass() ?>">
                            <label for="uspass2">Confirmar contraseña</label>
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
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../pages/administrarUsuarios.php?message=' . urlencode($message));
    exit;
}

?>