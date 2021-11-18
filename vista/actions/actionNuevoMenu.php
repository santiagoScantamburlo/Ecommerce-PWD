<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmMenu = new abmmenu();
$datosBusqueda['menombre'] = $datos['menombre'];

$lista = $abmMenu->buscar($datosBusqueda);

if (!isset($lista[0])) {
    $exito = false;
    $datosBusqueda = $datos;
    $exitoAltaMenu = $abmMenu->alta($datosBusqueda);
    if ($exitoAltaMenu) {
        $lista = $abmMenu->buscar($datosBusqueda);
        $datos['idmenu'] = $lista[0]->getIdmenu();
        $abmMenuRol = new abmmenurol();
        $datos['idrol'] = $datos['idpadre'];
        $exito = $abmMenuRol->alta($datos);
    }
    $exito ? header('Location: ../admin/administrarMenus.php?messageOk=' . urlencode("Menu cargado correctamente")) : header('Location: ../admin/administrarMenus.php?messageErr=' . urlencode("Error en la carga"));
    exit;
} else {
    $message = "El nombre de menu ya existe";
    header('Location: ../admin/cargarMenu.php?messageErr=' . urlencode($message));
    exit;
}
