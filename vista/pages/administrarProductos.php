<?php
$titulo = "Administrar Productos";
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <?php
    $abmProducto = new abmproducto();
    $lista = $abmProducto->buscar(null);
    if (count($lista) > 0) {
    ?>

        <h1 class="text-center">Productos en la Base de Datos</h1>
        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>ID</th>
                    <th scope='col' class='text-center'>Nombre</th>
                    <th scope='col' class='text-center'>Detalle</th>
                    <th scope='col' class='text-center'>Precio</th>
                    <th scope='col' class='text-center'>Ventas</th>
                    <th scope='col' class='text-center'>Stock</th>
                    <th scope='col' class='text-center'>% Descuento</th>
                    <th scope='col' class="text-center">Deshabilitado</th>
                    <th scope='col' class="text-center">Modificar</th>
                    <th scope='col' class='text-center'>Alta / Baja</th>
                </tr>
            </thead>

            <?php
            foreach ($lista as $producto) {
                $id = $producto->getIdproducto();
            ?>

                <tr>
                    <td class='text-center'><?php echo $id ?></td>
                    <td class='text-center'><?php echo $producto->getPronombre() ?></td>
                    <td class='text-center'><?php echo $producto->getProdetalle() ?></td>
                    <td class='text-center'><?php echo $producto->getProprecio() ?></td>
                    <td class='text-center'><?php echo $producto->getProcantventas() ?></td>
                    <td class='text-center'><?php echo $producto->getProcantstock() ?></td>
                    <td class='text-center'><?php echo $producto->getProdescuento() ?></td>
                    <td class='text-center'><?php echo $producto->getProdeshabilitado() ?></td>
                    <form method='post' action='../actions/actionModificarProducto.php'>
                        <td class='text-center'>
                            <input name='idproducto' id='idproducto' type='hidden' value=<?php echo $id ?>><button class='btn btn-warning btn-sm' type='submit'><i class='fas fa-user-edit'></i></button>
                        </td>
                    </form>
                    <form method='post' action='../actions/actionEliminarProducto.php'>
                        <td class='text-center'>
                            <input name='idproducto' id='idproducto' type='hidden' value=<?php echo $id ?>><button class='btn btn-danger btn-sm' type='submit'><i class='bi bi-trash'></i></button>
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

        <h1 class='text-center'>No hay productos cargados en la base de datos</h1>

    <?php
    }
    ?>

</div>

<?php
include_once '../estructuras/pie.php';
?>