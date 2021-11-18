<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmMenu = new abmmenu();

$arrayBusqueda = ["idmenu" => $datos['idmenu']];

$menuDeshabilitado = $abmMenu->deshabilitarMenu($arrayBusqueda);

if ($menuDeshabilitado) {
    $message = "Menú deshabilitado exitosamente";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
} else {
    $message = "Error al deshabilitar el menu";
    header('Location: ../admin/administrarMenus.php?Message=' . urlencode($message));
}


include_once '../estructuras/pie.php';

?>