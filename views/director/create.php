<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/DirectorController.php');

$createView = true;
$result = false;
$sendData = false;

if (isset($_GET['update'])) {
    $createView = false;
    $directorObject = getDirectorData($_GET['id']);
}
if (isset($_POST['createBtn'])) {
    $sendData = true;
    if (isset($_POST['name'], $_POST['lastname'], $_POST['birthDate'], $_POST['nationality'])) {
        if ($createView) {
            $result = storeDirector($_POST['name'], $_POST['lastname'], $_POST['birthDate'], $_POST['nationality']);
        } else {
            $result = updateDirector($directorObject->getId(), $_POST['name'], $_POST['lastname'], $_POST['birthDate'], $_POST['nationality']);
            if ($result) {
                $directorObject = getDirectorData($_GET['id']);
            }
        }
    }
}
?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-auto">
            <h1><?php echo ($createView) ? 'Crear director' : 'Editar director'; ?></h1>
        </div>
        <div class="col-sm-auto">
            <a href="list.php" class="btn btn-dark">Volver</a>
        </div>
        <div class="col-sm-auto">
            <a href="../../index.php" class="btn btn-dark">Home</a>
        </div>
        <div>
            <?php
            if ($sendData) {
                if ($result) {
            ?>
                    <div class="alert alert-success">
                        Director <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de directores.</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger">
                        El director no se ha <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de directores.</a>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div>
            <form name="create_director" action="" method="POST">
                <div class="form-group mb-2">
                    <label for="name">Nombre</label>
                    <input id="name" class="form-control" name="name" type="text" placeholder="Ingresa el nombre" value="<?php if (isset($directorObject)) echo $directorObject->getName(); ?>" required>
                </div>
                <div class="form-group mb-2">
                    <label for="lastname">Apellido</label>
                    <input id="lastname" class="form-control" name="lastname" type="text" placeholder="Ingresa el apellido" value="<?php if (isset($directorObject)) echo $directorObject->getLastname(); ?>" required>
                </div>
                <div class="form-group mb-2">
                    <label for="birthDate">Fecha de nacimiento</label>
                    <input id="birthDate" class="form-control" name="birthDate" type="date" value="<?php if (isset($directorObject)) echo $directorObject->getBirthDate(); ?>" required>
                </div>
                <div class="form-group mb-2">
                    <label for="nationality">Nacionalidad</label>
                    <input id="nationality" class="form-control" name="nationality" type="text" placeholder="Ingresa la nacionalidad" value="<?php if (isset($directorObject)) echo $directorObject->getNationality(); ?>" required>
                </div>
                <input type="submit" value="<?php echo ($createView) ? 'Crear' : 'Guardar'; ?>" class="btn btn-primary" name="createBtn">
            </form>
        </div>
    </div>
</div>