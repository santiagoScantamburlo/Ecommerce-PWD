<?php
$titulo = "Login";
include_once '../estructuras/cabecera.php';
$datos = data_submitted();
?>

<div class="container mt-3">

    <?php
    if (count($datos) > 0) {
        if (isset($datos['messageOk']) || isset($datos['messageErr'])) {
            if (isset($datos['messageOk'])) {
                $message = $datos['messageOk'];
                $alert = "success";
            } else {
                $message = $datos['messageErr'];
                $alert = "danger";
            }
    ?>

            <div class='alert alert-<?php echo $alert ?> d-flex align-items-center text-center col-md-4 offset-md-4' role='alert'>
                <i class="bi bi-exclamation-triangle-fill text-center">&nbsp;<?php echo $message ?></i>
            </div>

    <?php

        }
    } ?>

    <form class="form-signin" id="datosUsuario" name="login" action="../actions/actionLogin.php" method="post">
        <div class="login container col-md-3">
            <h1 class="h3 mb-3 text-center">Entrar al sitio</h1>
            <div class="form-group">
                <div class="input-group mt-3">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                    <input type="text" id="usnombre" name="usnombre" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mt-3">
                    <span class="input-group-text"> <i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" placeholder="********" name="uspass" id="uspass" aria-label="password" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="d-grid mb-5 mt-3">
                <button class="btn" type="submit" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">Iniciar Sesión</button>
            </div>
        </div>
    </form>
    <div class="text-center">
        <p class="mb-0 text-muted">¿No tenés cuenta? <a href="signin.php">¡Registrate!</a></p>
    </div>
</div>

<?php
include_once '../estructuras/pie.php';
