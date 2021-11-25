<?php
include_once '../../configuracion.php';

class control_admin
{
    public function verificarAdmin($pagina)
    {
        $valido = true;
        $sesion = new session();
        if (!$sesion->activa()) {
            header('Location: ../login/login.php?message=' . urlencode("Sesion no iniciada"));
            exit;
        }

        $abmUsuarioRol = new abmusuariorol();
        $listaUsRol = $abmUsuarioRol->buscar(['idusuario' => $sesion->getIdusuario()]);
        $abmMenu = new abmmenu();
        $listaMenu = $abmMenu->buscar(['medescripcion' => $pagina]);
        $objUsRol = $listaUsRol[0];
        $objMenu = $listaMenu[0];

        if ($objMenu->getIdpadre() != $objUsRol->getObjRol()->getIdrol()) {
            $valido = false;
        }
        return $valido;
    }
}
