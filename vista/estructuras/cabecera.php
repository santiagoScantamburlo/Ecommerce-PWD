<!DOCTYPE html>
<html lang="es">

<?php
include_once '../../configuracion.php';
$cantidad = [];
$sesion = new session();
$activa = $sesion->activa();

if ($activa) {
    $roles = $sesion->getRoles();
    $controlCarritoCliente = new control_carrito_cliente();
    $compra = $controlCarritoCliente->verificarCarrito($sesion->getIdusuario());

    if (!is_null($compra)) {
        $datosBusqueda['idcompra'] = $compra->getIdcompra();
        $abmCompraItem = new abmcompraitem();
        $cantidad = $abmCompraItem->contar($datosBusqueda);
    }
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/carrusel.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/boostrapValidator.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Rubik:ital,wght@1,300&display=swap" rel="stylesheet">
    <!-- Fontawesone -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Cabecera redirect index php htdocs -->
    <title><?php echo $titulo; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(255,69,207);background: linear-gradient(90deg, rgba(255,69,207,1) 0%, rgba(185,32,230,1) 100%, rgba(244,119,255,1) 100%);">
        <div class="container px-4 px-lg-5">
            <a href="../home/index.php"><img src="../../archivos/images/LogoFeme.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div style="font-size:20px;" class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="../home/index.php">Inicio</a></li>

                    <?php
                    $mostrar = false;
                    if (!$activa) {
                        $mostrar = true;
                    }
                    if ($activa) {
                        if ($roles[0] == 1) {
                            $mostrar = true;
                        }
                        if ($roles[0] > 1) {
                            if (count($roles) > 1) {
                                if ($roles[1] == 1) {
                                    $mostrar = true;
                                }
                            }
                        }
                    }

                    if ($mostrar) {
                    ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../cliente/listaProductos.php">Todos los productos</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../cliente/productosDestacados.php">Productos destacados</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../cliente/aros.php">Aros</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../cliente/cadenitas.php">Cadenitas</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../cliente/pulseras.php">Pulseras</a></li>
                            </ul>
                        </li>

                        <?php
                    }
                    if ($activa) {
                        foreach ($roles as $idRol) {
                            $abmMenuRol = new abmmenurol();
                            $listaMenuRol = $abmMenuRol->buscar(['idrol' => $idRol]);
                            if (count($listaMenuRol) > 0) {
                                $abmMenu = new abmmenu();
                                $idMenu = $listaMenuRol[0]->getObjMenu()->getIdmenu();
                                $listaMenu = $abmMenu->buscar(['idmenu' => $idMenu]);
                                if (count($listaMenu) > 0) {
                                    $idPadre = $listaMenu[0]->getIdmenu();
                                    $listaSubMenu = $abmMenu->buscar(['idpadre' => $idPadre]);
                                }
                            }
                            foreach ($listaMenu as $menu) {
                                if ($menu->getMedeshabilitado() == '0000-00-00 00:00:00') {
                        ?>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $menu->getMenombre() ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                                            <?php
                                            foreach ($listaSubMenu as $subMenu) {
                                                if ($subMenu->getMedeshabilitado() == '0000-00-00 00:00:00') {
                                                    switch ($idRol) {
                                                        case '3':
                                                            $enlace = "../admin/";
                                                            break;
                                                        case '2':
                                                            $enlace = "../deposito/";
                                                            break;
                                                        case '1':
                                                            $enlace = "../cliente/";
                                                            break;
                                                    }
                                            ?>

                                                    <li><a class="dropdown-item" href="<?php echo $enlace . $subMenu->getMedescripcion() . ".php"; ?>"><?php echo $subMenu->getMenombre() ?></a></li>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </ul>
                                    </li>

                    <?php
                                }
                            }
                        }
                    }
                    ?>

                </ul>
                <ul class="navbar-nav d-flex">

                    <?php
                    if ($activa) {
                        if ($roles[0] > 1) {
                            if (count($roles) > 1) {
                                if ($roles[0] == 1 || $roles[1] == 1) {
                    ?>

                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="../cliente/carrito.php" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-shopping-cart"></i> <span class="d-lg-none">Carrito</span><span class="badge bg-white text-black ms-1 rounded-pill">
                                                <?php
                                                if (count($cantidad) > 0) {
                                                    echo $cantidad[0];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </span>
                                        </a>
                                    </li>

                            <?php
                                }
                            }
                        } else {
                            ?>

                            <!-- Icon carrito -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="../cliente/carrito.php" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-shopping-cart"></i> <span class="d-lg-none">Carrito</span><span class="badge bg-white text-black ms-1 rounded-pill">0</span>
                                </a>
                            </li>

                        <?php
                        }
                    }
                    if (!$activa) {
                        ?>

                        <!-- Icon visitante -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown-Visitante" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sign-in-alt"></i><span class="d-lg-none">Usuario</span></a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Visitante">
                                <a class="dropdown-item" href="../login/login.php"><span class="fas fa-sign-in-alt fa-fw" aria-hidden="true" title="Log in"></span>Entrar</a>
                                <a class="dropdown-item" href="../login/signin.php"><span class="fas fa-pencil-alt fa-fw" aria-hidden="true" title="Sign in"></span>Registrarse</a>
                            </div>
                        </li>

                    <?php
                    } else {
                    ?>

                        <!-- Icon usuario -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>&nbsp;Usuario
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="fas fa-user fa-fw" aria-hidden="true" title="Perfil"></span>&nbsp;<?php echo $sesion->getUsnombre() ?>
                                <a class="dropdown-item" href="../login/configuracion.php"><span class="fas fa-cog fa-fw " aria-hidden="true" title="Configuración"></span>&nbsp;Configuración</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout" href="../actions/actionLogout.php"><span class="fas fa-sign-out-alt fa-fw" aria-hidden="true" title="Cerrar sesión"></span>&nbsp;Cerrar sesión</a>
                            </div>
                        </li>

                        <?php
                        $rolUsuario = $sesion->getRoles()[0];
                        if ($rolUsuario > 1) {
                        ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-cog"></i>&nbsp;Roles
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">

                                    <?php
                                    for ($i = 1; $i <= $rolUsuario; $i++) {
                                        $idRolAction = md5($i);
                                        switch ($i) {
                                            case 1:
                                                $rol = "<span class='fas fa-users'></span>&nbsp;Cliente";
                                                break;
                                            case 2:
                                                $rol = "<span class='fas fa-dolly'></span>&nbsp;Depósito";
                                                break;
                                            case 3:
                                                $rol = "<span class='fas fa-user-shield'></span>&nbsp;Administrador";
                                                break;
                                        }
                                    ?>

                                        <a class="dropdown-item" href="../actions/actionCambioRol.php?rol=<?php echo $idRolAction ?>"><?php echo $rol ?></a>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </li>

                        <?php
                        }
                        ?>

                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>