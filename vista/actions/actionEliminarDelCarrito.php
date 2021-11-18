<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmCompraItem = new abmcompraitem();

$abmCompraItem->baja(['idcompraitem' => $datos['idcompraitem']]);

header('Location: ../cliente/carrito.php');
exit;