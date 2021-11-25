<?php
include_once '../../configuracion.php';
$controlAdmin = new control_admin();

$datos = data_submitted();
$valido = false;
if (!$valido) {
    $controlAdmin = new control_admin();
    $valido = $controlAdmin->verificarAdmin("administrarUsuarios");
    if (!$valido) {
        header('Location: ../home/index.php?messageErr=' . urlencode("No tiene los permisos para acceder"));
        exit;
    }
}

$titulo = "Administrar Usuarios";
include_once '../estructuras/cabecera.php';
?>

<div class="container mt-3">
    <?php
    $abmUsuario = new abmusuario();
    $lista = $abmUsuario->buscar(null);
    if (count($lista) > 0) {
    ?>

        <h1 class="text-center">Usuarios en la Base de Datos</h1>

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

                <div class='alert alert-<?php echo $alert ?> d-flex align-items-center text-center col-md-4 offset-md-4' role='alert'>
                    <i class="bi bi-exclamation-triangle-fill text-center">&nbsp;<?php echo $message ?></i>
                </div>

        <?php

            }
        } ?>

        <table class='table mt-3'>
            <thead style="color:white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">
                <tr>
                    <th scope='col' class='text-center'>ID</th>
                    <th scope='col' class='text-center'>Rol</th>
                    <th scope='col' class='text-center'>Nombre</th>
                    <th scope='col' class='text-center'>Contraseña</th>
                    <th scope='col' class='text-center'>Mail</th>
                    <th scope='col' class='text-center'>Deshabilitado</th>
                    <th scope='col' class='text-center'>Modificar</th>
                    <th scope='col' class='text-center'>Deshabilitar</th>
                    <th scope='col' class='text-center'>Eliminar</th>
                </tr>
            </thead>

            <?php
            foreach ($lista as $usuario) {
                $id = $usuario->getIdusuario();
                $abmUsuarioRol = new abmusuariorol();
                $datos['idusuario'] = $id;
                $listaUsuarioRol = $abmUsuarioRol->buscar($datos);
                $rol = $listaUsuarioRol[0]->getObjRol()->getRodescripcion();
            ?>

                <tr>
                    <td class='text-center'><?php echo $id ?></td>
                    <td class='text-center'><?php echo strtoupper($rol) ?></td>
                    <td class='text-center'><?php echo $usuario->getUsnombre() ?></td>
                    <td class='text-center'><?php echo md5($usuario->getUspass()) ?></td>
                    <td class='text-center'><?php echo $usuario->getUsmail() ?></td>
                    <td class='text-center'><?php echo $usuario->getUsdeshabilitado() ?></td>
                    <form method='post' action='formularioModificacionUsuario.php'>
                        <td class='text-center'>
                            <input name='idusuario' id='idusuario' type='hidden' value=<?php echo $id ?>><button class='btn btn-warning btn-sm' type='submit'><i class='fas fa-user-edit'></i></button>
                        </td>
                    </form>
                    <form method='post' action='../actions/actionDeshabilitarUsuario.php'>
                        <td class='text-center'>
                            <input name='idusuario' id='idusuario' type='hidden' value=<?php echo $id ?>><button class='btn btn-warning btn-sm' type='submit'>

                                <?php
                                if ($usuario->getUsdeshabilitado() == '0000-00-00 00:00:00') {
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
                    <form method='post' action='../actions/actionEliminarUsuario.php'>
                        <td class='text-center'>
                            <input name='idusuario' id='idusuario' type='hidden' value=<?php echo $id ?>><button class='btn btn-danger btn-sm' type='submit'><i class='bi bi-trash'></i></button>
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

        <h1 class='text-center'>No hay usuarios cargados en la base de datos</h1>

    <?php
    }
    ?>

</div>

<?php
include_once '../estructuras/pie.php';
?>