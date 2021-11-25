<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$abmMenu = new abmmenu();

$modificado = $abmMenu->modificacion($datos);

if ($modificado) {
    $message = "Menu modificado";
    header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode($message));
    exit;
} else {
    $message = "Error al modificar menu";
    header('Location: ../admin/administrarMenus.php?messageErr=' . urlencode($message));
    exit;
}