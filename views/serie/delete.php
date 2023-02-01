<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/SerieController.php');

$serieDeleted = deleteSerie($_POST['id']);


if ($serieDeleted) {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-success mt-5">
            Serie borrada correctamente<br><a href="list.php">Volver al listado de series.</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-danger mt-5">
            La serie no se ha borrado correctamente<br><a href="list.php">Volver al listado de series.</a>
        </div>
    </div>
<?php
}
?>