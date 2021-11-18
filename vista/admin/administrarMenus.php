<?php
include_once '../../configuracion.php';
$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}
$titulo = "Administrar Usuarios";
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <?php
    $abmMenu = new abmmenu();
    $lista = $abmMenu->buscar(null);
    if (count($lista) > 0) {
    ?>

        <h1 class="text-center">Menúes en la Base de Datos</h1>
        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>ID</th>
                    <th scope='col' class='text-center'>Nombre</th>
                    <th scope='col' class='text-center'>Descripción</th>
                    <th scope='col' class='text-center'>ID Padre</th>
                    <th scope='col' class='text-center'>Deshabilitado</th>
                    <th scope='col' class='text-center'>Modificar</th>
                    <th scope='col' class='text-center'>Deshabilitar</th>
                    <!-- <th scope='col' class='text-center'>Eliminar</th> -->
                </tr>
            </thead>

            <?php
            foreach ($lista as $menu) {
                $id = $menu->getIdmenu();
                $idPadre = $menu->getIdpadre();
                if (!isset($idPadre)) {
                    $idPadre = "-";
                }
            ?>

                <tr>
                    <td class='text-center'><?php echo $id ?></td>
                    <td class='text-center'><?php echo $menu->getMenombre() ?></td>
                    <td class='text-center'><?php echo $menu->getMedescripcion() ?></td>
                    <td class='text-center'><?php echo $idPadre ?></td>
                    <td class='text-center'><?php echo $menu->getMedeshabilitado() ?></td>
                    <form method='post' action='formularioModificarMenu.php'>
                        <td class='text-center'>
                            <input name='idmenu' id='idmenu' type='hidden' value=<?php echo $id ?>><button class='btn btn-warning btn-sm' type='submit'><i class="fas fa-edit"></i></button>
                        </td>
                    </form>
                    <form method='post' action='../actions/actionDeshabilitarMenu.php'>
                        <td class='text-center'>
                            <input name='idmenu' id='idmenu' type='hidden' value=<?php echo $id ?>><button class='btn btn-warning btn-sm' type='submit'>

                                <?php
                                if ($menu->getMedeshabilitado() == '0000-00-00 00:00:00') {
                                ?>

                                    <i class="bi bi-toggle-off"></i>

                                <?php
                                } else {
                                ?>

                                    <i class="bi bi-toggle-on"></i>

                                <?php
                                }
                                ?>

                            </button>
                        </td>
                    </form>
                    <!-- <form method='post' action='eliminarMenu.php'>
                        <td class='text-center'>
                            <input name='idmenu' id='idmenu' type='hidden' value=<?php echo $id ?>><button class='btn btn-danger btn-sm' type='submit'><i class='bi bi-trash'></i></button>
                        </td>
                    </form> -->
                </tr>

            <?php
            }
            ?>

        </table>

    <?php
    } else {
    ?>

        <h1 class='text-center'>No hay menúes cargados en la base de datos</h1>

    <?php
    }
    ?>

</div>

<?php
include_once '../estructuras/pie.php';
?>