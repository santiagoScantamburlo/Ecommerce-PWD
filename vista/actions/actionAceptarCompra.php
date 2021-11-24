<?php
include_once '../../configuracion.php';

$sesion = new session();
$datos = data_submitted();

$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompra' => $datos['idcompra']]);

$datos['idcompraestado'] = $listaCE[0]->getIdcompraestado();
$datos['cefechaini'] = $listaCE[0]->getCefechaini();
$datos['idcompraestadotipo'] = 2;
$datos['cefechafin'] = date('Y-m-d H:i:s');

$abmCompraEstado->modificacion($datos);

header('Location: ../home/index.php?messageOk=' . urlencode("Compra aceptada"));
exit;
