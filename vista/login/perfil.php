<?php
include_once '../../configuracion.php';
$sesion = new session();

if(!$sesion->activa()) {
    header('Location: login.php?messageErr=' . urlencode("Usted no ha iniciado sesión"));
    exit;
}