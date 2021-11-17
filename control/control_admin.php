<?php
include_once '../../configuracion.php';

class control_admin
{
    public function verificarAdmin($pagina)
    {
        $sesion = new session();
        if (!$sesion->activa()) {
            header('Location: ../login/login.php?message=' . urlencode("Sesion no iniciada"));
            exit;
        }

        if ($sesion->getRoles()[0] != 3) {
            header('Location: ../home/index.php?message=' . urlencode("El usuario no es administrador"));
            exit;
        } else {
            header('Location: ../admin/' . $pagina . '.php?valido=1');
            exit;
        }
    }
}
