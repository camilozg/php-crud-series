<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/ActorController.php');

$actorDeleted = deleteActor($_POST['id']);


if ($actorDeleted) {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-success mt-5">
            Actor borrado correctamente<br><a href="list.php">Volver al listado de actores.</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 alert alert-danger mt-5">
            El actor no se ha borrado correctamente<br><a href="list.php">Volver al listado de actores.</a>
        </div>
    </div>
<?php
}
?>