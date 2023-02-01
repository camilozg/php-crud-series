<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/DirectorController.php');

$directorDeleted = deleteDirector($_POST['id']);

if ($directorDeleted) {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-success mt-5">
            Director borrado correctamente<br><a href="list.php">Volver al listado de directores.</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-danger mt-5">
            El director no se ha borrado correctamente<br><a href="list.php">Volver al listado de directores.</a>
        </div>
    </div>
<?php
}
?>