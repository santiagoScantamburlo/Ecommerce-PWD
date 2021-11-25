<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmMenu = new abmmenu();

$arrayBusqueda = ["idmenu" => $datos['idmenu']];

$listaMenu = $abmMenu->buscar($arrayBusqueda);

$menuDeshabilitado = $abmMenu->deshabilitarMenu($arrayBusqueda);

if ($menuDeshabilitado) {
    if ($listaMenu[0]->getMedeshabilitado() == '0000-00-00 00:00:00') {
        $message = "Menú deshabilitado exitosamente";
        header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode($message));
        exit;
    } else {
        $message = "Menú habilitado exitosamente";
        header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode($message));
        exit;
    }
} else {
    $message = "Error al deshabilitar el menu";
    header('Location: ../admin/administrarMenus.php?messageErr=' . urlencode($message));
    exit;
}
