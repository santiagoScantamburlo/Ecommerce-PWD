<?php
include_once '../../configuracion.php';

class control_deposito
{
    public function verificarDeposito($pagina)
    {
        $valido = false;
        $sesion = new session();

        if (!$sesion->activa()) {
            header('Location: ../login/login.php?message=' . urlencode("Sesion no iniciada"));
            exit;
        }

        $roles = $sesion->getRoles();
        $rolTemporal = 0;
        if (count($roles) > 1) {
            $rolTemporal = $roles[1];
        }

        $abmUsuarioRol = new abmusuariorol();
        $listaUsRol = $abmUsuarioRol->buscar(['idusuario' => $sesion->getIdusuario()]);
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['medescripcion' => $pagina]);
        $objUsRol = $listaUsRol[0];
        $objMenu = $listaMenu[0];

        if ($objMenu->getIdpadre() == $objUsRol->getObjRol()->getIdrol() || $objMenu->getIdpadre() == $rolTemporal) {
            $valido = true;
        }
        return $valido;
    }
}
