<?php
$titulo = "Registro";
include_once '../estructuras/cabecera.php';
?>
<div class="container mt-3">
    <div class="offset-md-4">
        <form action="../actions/actionNuevoMenu.php" method="post" class="col-md-6 mt-3 " id="menuNuevo" name="menuNuevo">
            <h1 class="h3 mb-3 text-center">Cargar Menú</h1>
            <div class="">
                <div class="form-floating mt-3">
                    <input class="form-control" id="menombre" name="menombre" type="text" placeholder="Nombre" required>
                    <label for="menombre">Nombre </label>
                </div>
            </div>
            <div class="">
                <div class="form-floating mt-3">
                    <input class="form-control" id="medescripcion" name="medescripcion" type="text" placeholder="Descripción" required>
                    <label for="medescripcion">Descripción </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-4">
                        <input class="form-check-input" id="cliente" name="idpadre" type="radio" value="1">
                        <label for="cliente">Cliente</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-4">
                        <input class="form-check-input" id="deposito" name="idpadre" type="radio" value="2">
                        <label for="deposito">Depósito</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-4">
                        <input class="form-check-input" id="admin" name="idpadre" type="radio" value="3">
                        <label for="admin">Administrador</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 mb-3">
                <div class="d-grid">
                    <button  class="btn" type="submit" style="color: white;background: rgb(0,212,255);background: linear-gradient(90deg, rgba(0,212,255,1) 0%, rgba(194,2,160,1) 0%, rgba(139,0,142,1) 100%);">Cargar</button>
                </div>
            </div>
        </form>
    </div>

</div>

<?php
include_once '../estructuras/pie.php';

?>