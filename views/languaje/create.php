<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/LanguajeController.php');

$createView = true;
$result = false;
$sendData = false;

if (isset($_GET['update'])) {
    $createView = false;
    $languajeObject = getLanguajeData($_GET['id']);
}
if (isset($_POST['name'], $_POST['isoCode'])) {
    $sendData = true;
    if (isset($_POST['name'], $_POST['isoCode'])) {
        if ($createView) {
            $result = storeLanguaje($_POST['name'], $_POST['isoCode']);
        } else {
            $result = updateLanguaje($languajeObject->getId(), $_POST['name'], $_POST['isoCode']);
            if ($result) {
                $languajeObject = getLanguajeData($_GET['id']);
            }
        }
    }
}
?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-auto">
            <h1><?php echo ($createView) ? 'Crear idioma' : 'Editar idioma'; ?></h1>
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
                        Idioma <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de idiomas.</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger">
                        El idioma no se ha <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de idiomas.</a>
                    </div>
            <?php
                }
            }
            ?>

        </div>
        <div>
            <form name="create_languaje" action="" method="POST">
                <div>
                    <div class="form-group mb-2">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="Ingresa el nombre" value="<?php if (isset($languajeObject)) echo $languajeObject->getName(); ?>" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="isoCode">Iso Code</label>
                        <input id="isoCode" class="form-control" name="isoCode" type="text" placeholder="Ingresa el iso code" value="<?php if (isset($languajeObject)) echo $languajeObject->getIsoCode(); ?>" required>
                    </div>
                    <input type="submit" value="<?php echo ($createView) ? 'Crear' : 'Guardar'; ?>" class="btn btn-primary" name="createBtn">
                </div>
            </form>
        </div>
    </div>
</div>