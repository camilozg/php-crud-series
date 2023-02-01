<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/LanguajeController.php');

$directorDeleted = deleteLanguaje($_POST['id']);


if ($directorDeleted) {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-success mt-5">
            Idioma borrado correctamente<br><a href="list.php">Volver al listado de idiomas.</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-danger mt-5">
            El idioma no se ha borrado correctamente<br><a href="list.php">Volver al listado de idiomas.</a>
        </div>
    </div>
<?php
}
?>