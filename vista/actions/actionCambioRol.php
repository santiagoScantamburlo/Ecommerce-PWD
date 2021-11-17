<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../home/index.php?message=' . urlencode('Sesion no iniciada'));
    exit;
} else {
    $datos = data_submitted();
    if (count($datos) == 0) {
        header('Location: ../home/index.php');
        exit;
    }
    $roles = $sesion->getRoles();
    $rolesSesion = array($roles[0]);
    switch ($datos['rol']) {
        case md5(1):
            if ($rolesSesion[0] != 1) {
                $rolesSesion[1] = 1;
                $sesion->setRoles($rolesSesion);
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setRoles($rolesSesion);
            }
            break;
        case md5(2):
            if ($rolesSesion[0] != 2) {
                $rolesSesion[1] = 2;
                $sesion->setRoles($rolesSesion);
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setRoles($rolesSesion);
            }
            break;
        case md5(3):
            if ($rolesSesion[0] != 3) {
                $rolesSesion[1] = 3;
                $sesion->setRoles($rolesSesion);
            } else {
                $rolesSesion = array($roles[0]);
                $sesion->setRoles($rolesSesion);
            }
            break;
    }

    header('Location: ../home/index.php?message=' . urlencode("Nuevo rol " . $nuevoRol));
    exit;
}
