<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../login/login.php?messageErr=' . urlencode("Usted no ha iniciado sesión"));
    exit;
}

$titulo = "Compras Realizadas";
include_once '../estructuras/cabecera.php';

$abmCompra = new abmcompra();
$listaCompra = $abmCompra->buscar(['idusuario' => $sesion->getIdusuario()]);

$abmCompraEstado = new abmcompraestado();
$lista = $abmCompraEstado->buscar(['idcompra'])
?>

<div class="container mt-3">

    <?php
    if (count($listaCompra) == 0) {
    ?>

        <h1 class="text-center">Usted aún no ha realizado compras</h1>

    <?php
    } else {
    ?>
        <h1 class="text-center">Mis compras</h1>
        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>ID</th>
                    <th scope='col' class='text-center'>Fecha Inicio</th>
                    <th scope='col' class='text-center'>Fecha Fin</th>
                    <th scope='col' class='text-center'>Estado Compra</th>
                    <th scope='col' class='text-center'>Items</th>
                    <th scope='col' class='text-center'>Cancelar</th>
                </tr>
            </thead>

            <?php
            foreach ($lista as $compraEstado) {
                $idCompraEstado = $compraEstado->getIdcompraestado();
                $idCompra = $compraEstado->getObjCompra()->getIdcompra();
                $abmCompra = new abmcompra();
                $listaCompra = $abmCompra->buscar(['idcompra' => $idCompra]);
                $abmCET = new abmcompraestadotipo();
                $idCET = $compraEstado->getObjCompraEstadoTipo()->getIdcompraestadotipo();
                if ($idCET != 1) {
                    $listaCET = $abmCET->buscar(['idcompraestadotipo' => $idCET]);
            ?>

                    <tr>
                        <td class='text-center'><?php echo $idCompra ?></td>
                        <td class='text-center'><?php echo $compraEstado->getCefechaini() ?></td>
                        <td class='text-center'><?php echo $compraEstado->getCefechafin() ?></td>
                        <td class='text-center'><?php echo $listaCET[0]->getCetdescripcion() ?></td>
                        <form method='post' action='../actions/actionMostrarItems.php'>
                            <td class='text-center'>
                                <input name='idcompra' id='idcomra' type='hidden' value=<?php echo $idCompra ?>><button class='btn btn-warning btn-sm' type='submit'><i class="bi bi-list-ul"></i></button>
                            </td>
                        </form>
                        <form method='post' action='../actions/actionCancelarCompra.php'>
                            <td class='text-center'>
                                <input name='idcompra' id='idcompra' type='hidden' value=<?php echo $idCompra ?>>
                                <input name='idcompraestado' id='idcompraestado' type='hidden' value=<?php echo $idCompraEstado ?>>

                                <?php
                                if ($idCET < 2) {
                                ?>

                                    <button class='btn btn-danger btn-sm' type='submit'><i class="bi bi-cart-x-fill"></i></button>

                                <?php
                                }
                                ?>

                            </td>
                        </form>
                    </tr>

            <?php
                }
            }
            ?>

        </table>

    <?php
    }
    ?>

</div>

<?php
include_once '../estructuras/pie.php';
?>