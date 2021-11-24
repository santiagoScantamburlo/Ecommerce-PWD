<?php
include_once '../../configuracion.php';

$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php');
    exit;
}

$datos = data_submitted();

include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <?php
    $abmCompra = new abmcompra();
    $listaCompra = $abmCompra->buscar(['idcompra' => $datos['idcompra']]);
    $abmCompraItem = new abmcompraitem();
    $listaCI = $abmCompraItem->buscar(['idcompra']);
    if (count($listaCI) > 0) {
    ?>

        <h1 class="text-center">Productos Comprados</h1>
        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>Nombre</th>
                    <th scope='col' class='text-center'>Detalle</th>
                    <th scope='col' class='text-center'>Precio</th>
                    <th scope='col' class='text-center'>% Descuento</th>
                    <th scope='col' class='text-center'>Cantidad</th>
                </tr>
            </thead>

            <?php
            foreach ($listaCI as $item) {
            ?>

                <tr>
                    <td class='text-center'><?php echo $item->getObjProducto()->getPronombre() ?></td>
                    <td class='text-center'><?php echo $item->getObjProducto()->getProdetalle() ?></td>
                    <td class='text-center'><?php echo $item->getObjProducto()->getProprecio() ?></td>
                    <td class='text-center'><?php echo $item->getObjProducto()->getProdescuento() ?></td>
                    <td class='text-center'><?php echo $item->getCicantidad() ?></td>
                </tr>

            <?php
            }
            ?>

        </table>

    <?php
    } else {
    ?>

        <h1 class='text-center'>No hay productos registrados en la compra</h1>

    <?php
    }
    ?>

</div>

<?php
include_once '../estructuras/pie.php';
?>