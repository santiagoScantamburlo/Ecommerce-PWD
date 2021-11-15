<?php
include_once '../../configuracion.php';

$sesion = new session();

$sesion->cerrarSession();
header('Location: ../home/index.php?message=' . urlencode("Sesión cerrada"));
?>






<?php
echo "Ingrese la cantidad de numeros a comparar";
$cantNums = trim(fgets(STDIN));
echo "Ingrese un numero";
$min = trim(fgets(STDIN)); //Asumo que el primer numero ingresado es el menor de la secuencia


for ($i = 0; $i < $cantNums - 1; $i++) {
    echo "Ingrese un numero";
    $num = trim(fgets(STDIN));
    if ($num <= $min & $num != $min) {
        $min = $num;
    }
}

echo "El menor numero ingresado es: $min";
