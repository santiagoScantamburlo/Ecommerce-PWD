<?php
include_once '../../configuracion.php';

$sesion = new session();

$sesion->cerrarSession();
header('Location: ../home/index.php?message=' . urlencode("Sesión cerrada"));
