<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/PlatformController.php');

$platformDeleted = deletePlatform($_POST['platformId']);


if ($platformDeleted) {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-success mt-5">
            Plataforma borrada correctamente <a href="list.php">Volver al listado de plataformas.</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-danger mt-5">
            La plataforma no se ha borrado correctament <a href="list.php">Volver al listado de plataformas.</a>
        </div>
    </div>
<?php
}
?>