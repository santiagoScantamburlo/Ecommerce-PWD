<?php
include_once '../../configuracion.php';
$controlDeposito = new control_deposito();

$datos = data_submitted();
if (count($datos) == 0) {
    $controlDeposito->verificarDeposito("administrarCompras");
}

$titulo = "Administrar Compras";
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <?php
$abmCompraEstado = new abmcompraestado();
$lista = $abmCompraEstado->buscar(null);
if (count($lista) > 0) {
    ?>

        <h1 class="text-center">Compras Registradas</h1>

        <?php
if (count($datos) > 0) {
        if (isset($datos['messageOk']) || isset($datos['messageErr'])) {
            if (isset($datos['messageOk'])) {
                $message = $datos['messageOk'];
                $alert = "success";
            } else {
                $message = $datos['messageErr'];
                $alert = "danger";
            }
            ?>

            <div class='alert alert-<?php echo $alert ?> d-flex align-items-center text-center' role='alert'>
                <i class="bi bi-exclamation-triangle-fill text-center">&nbsp;<?php echo $message ?></i>
            </div>

        <?php
        }
    }?>

        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>ID</th>
                    <th scope='col' class='text-center'>Fecha Inicio</th>
                    <th scope='col' class='text-center'>Fecha Fin</th>
                    <th scope='col' class='text-center'>Estado Compra</th>
                    <th scope='col' class='text-center'>ID Usuario</th>
                    <th scope='col' class='text-center'>Items</th>
                    <th scope='col' class='text-center'>Cambiar Estado</th>
                    <th scope='col' class='text-center'>Cancelar</th>
                </tr>
            </thead>

            <?php
foreach ($lista as $compraEstado) {
        $idCompra = $compraEstado->getIdcompra()->getIdcompra();
        $abmCompra = new abmcompra();
        $listaCompra = $abmCompra->buscar(['idcompra' => $idCompra]);
        $abmCET = new abmcompraestadotipo();
        $listaCET = $abmCET->buscar(['idcompraestadotipo' => $compraEstado->getIdcompraestadotipo()]);
        ?>

                <tr>
                    <td class='text-center'><?php echo $idCompra ?></td>
                    <td class='text-center'><?php echo $compraEstado->getCefechaini() ?></td>
                    <td class='text-center'><?php echo $compraEstado->getCefechafin() ?></td>
                    <td class='text-center'><?php echo $listaCET[0]->getCetdescripcion() ?></td>
                    <td class='text-center'><?php echo $listaCompra[0]->getIdusuario() ?></td>
                    <form method='post' action='../actions/actionMostrarItems.php'>
                        <td class='text-center'>
                            <input name='idcompra' id='idcomra' type='hidden' value=<?php echo $idCompra ?>><button class='btn btn-warning btn-sm' type='submit'><i class="bi bi-list-ul"></i></button>
                        </td>
                    </form>
                    <form method='post' action='../actions/actionCambiarEstadoCompra.php'>
                        <td class='text-center'>
                            <input name='idcompra' id='idcompra' type='hidden' value=<?php echo $idCompra ?>>
                            <input name='idcompraestadotipo' id='idcompraestadotipo' type='hidden' value=<?php echo $compraEstado->getIdcompraestadotipo() ?>>
                            <button class='btn btn-warning btn-sm' type='submit'></button>
                        </td>
                    </form>
                    <form method='post' action='../actions/actionCancelarCompra.php'>
                        <td class='text-center'>
                            <input name='idusuario' id='idusuario' type='hidden' value=<?php echo $idCompra ?>>
                            <input name='idcompraestadotipo' id='idcompraestadotipo' type='hidden' value=<?php echo $compraEstado->getIdcompraestadotipo() ?>>
                            <button class='btn btn-danger btn-sm' type='submit'><i class="bi bi-cart-x-fill"></i></button>
                        </td>
                    </form>
                </tr>

            <?php
}
    ?>

        </table>

    <?php
} else {
    ?>

        <h1 class='text-center'>No hay compras registradas en la base de datos</h1>

    <?php
}
?>

</div>

<?php
include_once '../estructuras/pie.php';
?>