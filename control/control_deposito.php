<?php
include_once '../../configuracion.php';

class control_deposito
{
    public function verificarDeposito($pagina)
    {
        $sesion = new session();
        if (!$sesion->activa()) {
            header('Location: ../login/login.php?messageErr=' . urlencode("Sesion no iniciada"));
            exit;
        }

        $roles = $sesion->getRoles();

        if (count($roles) == 2) {
            if ($roles[0] == 2 || $roles[1] == 2) {
                header('Location: ../deposito/' . $pagina . '.php?valido=1');
                exit;
            }
        } else {
            if ($roles[0] == 2) {
                header('Location: ../deposito/' . $pagina . '.php?valido=1');
                exit;
            } else {
                header('Location: ../home/index.php?messageErr=' . urlencode("No tiene permisos de deposito"));
                exit;
            }
        }
    }
}
