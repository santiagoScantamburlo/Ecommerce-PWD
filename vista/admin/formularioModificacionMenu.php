<?php
//include_once '../../configuracion.php';

$titulo = 'Modificar Menú';

include_once '../estructuras/cabecera.php';

$datos = data_submitted();
$abmMenu = new abmmenu();

$arrayBusqueda = ["idmenu" => $datos['idmenu']];

$listaMenus = $abmMenu->buscar($arrayBusqueda);
$objMenu = $listaMenus[0];

?>

<div class="container mt-3">
    <h4 class="text-center">Modificar Menú</h4>
    <div class="col-md-4"></div>
    <div class="offset-md-4">
        <form id="datosMenu" action="../actions/actionModificarMenu.php" method="post" class="col-md-6 mt-3 " id="modificarMenu" name="modificarMenu">
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="idmenu" name="idmenu" type="text" placeholder="ID menú" value="<?php echo $objMenu->getIdmenu() ?>" hidden>
                    <label for="idmenu">ID menú</label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="menombre" name="menombre" type="text" placeholder="Nombre del menú" value="<?php echo $objMenu->getMenombre() ?>" required>
                    <label for="menombre">Nombre del menú</label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="medescripcion" name="medescripcion" type="text" placeholder="Descripción del menú" value="<?php echo $objMenu->getMedescripcion() ?>" required>
                    <label for="medescripcion">Descripción del menú</label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="form-control" id="idpadre" name="idpadre" type="text" placeholder="ID Padre" value="<?php echo $objMenu->getIdpadre() ?>" required>
                    <label for="idpadre">ID Padre</label>
                </div>
            </div>
            <div class="mt-4">
                <div class="d-grid offset-md-4 col-md-4">
                    <button class="btn" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);" type="submit">Modificar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once '../estructuras/pie.php';

?>