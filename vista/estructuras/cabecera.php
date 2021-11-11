<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/boostrapValidator.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Cabecera redirect index php htdocs -->
    <title><?php echo $titulo; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(255,69,207);background: linear-gradient(90deg, rgba(255,69,207,1) 0%, rgba(185,32,230,1) 100%, rgba(244,119,255,1) 100%);">
        <div class="container px-4 px-lg-5">
            <a href="../home/index.php"><img src="../../assets/images/LogoFeme.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div style="font-size:20px;" class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="../home/index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/informacion.php">Información</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../pages/listaProductos.php">Todos los productos</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../pages/productosDestacados.php">Productos destacados</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/aros.php">Aros</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/cadenitas.php">Cadenitas</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/pulseras.php">Pulseras</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/relojes.php">Relojes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrar productos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../pages/administrarProductos.php">Administrar</a></li>
                            <li><a class="dropdown-item" href="../pages/cargarProducto.php">Cargar Nuevo Producto</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/administrarUsuarios.php">Administrar Usuarios</a></li>
                </ul>

                <ul class="navbar-nav d-flex">
                    <!-- Icon carrito -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/carrito.php" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i> <span class="d-lg-none">Carrito</span><span class="badge bg-white text-black ms-1 rounded-pill">0</span>
                        </a>
                    </li>
                    <!-- Icon visitante -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown-Visitante" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sign-in-alt"></i><span class="d-lg-none">Usuario</span></a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Visitante">
                            <a class="dropdown-item" href="../pages/login.php"><span class="fas fa-sign-in-alt fa-fw" aria-hidden="true" title="Log in"></span>Entrar</a>
                            <a class="dropdown-item" href="../pages/registrar.php"><span class="fas fa-pencil-alt fa-fw" aria-hidden="true" title="Sign up"></span>Registrarse</a>
                        </div>
                    </li>
                    <!-- Icon usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <span class="d-lg-none">Usuario</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">
                            <a class="dropdown-item" href="../pages/perfil.php"><span class="fas fa-user fa-fw" aria-hidden="true" title="Perfil"></span>&nbsp;Perfil</a>
                            <a class="dropdown-item" href="../pages/configuracion.php"><span class="fas fa-cog fa-fw " aria-hidden="true" title="Configuración"></span>&nbsp;Configuración</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item logout" href="#"><span class="fas fa-sign-out-alt fa-fw" aria-hidden="true" title="Cerrar sesión"></span>&nbsp;Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include_once '../../configuracion.php';
    ?>