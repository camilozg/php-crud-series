<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/PlatformController.php');

$createView = true;
$result = false;
$sendData = false;

if (isset($_GET['update'])) {
    $createView = false;
    $platformObject = getPlatformData($_GET['id']);
}
if (isset($_POST['createBtn'])) {
    $sendData = true;
    if (isset($_POST['platformName'])) {
        if ($createView) {
            $result = storePlatform($_POST['platformName']);
        } else {
            $result = updatePlatform($platformObject->getId(), $_POST['platformName']);
            if ($result) {
                $platformObject = getPlatformData($_GET['id']);
            }
        }
    }
}
?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-auto">
            <h1><?php echo ($createView) ? 'Crear plataforma' : 'Editar plataforma'; ?></h1>
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
                        Plataforma <?php echo $createView ? 'creada' : 'actualizada'; ?> correctamente
                        <a href="list.php">Volver al listado de plataformas.</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger">
                        La plataforma no se ha <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de plataformas.</a>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div>
            <form name="create_platform" action="" method="POST">
                <div class="form-group mb-2">
                    <label for="platformName">Nombre</label>
                    <input id="platformName" class="form-control" name="platformName" type="text" placeholder="Nombre de la plataforma" value="<?php if (isset($platformObject)) echo $platformObject->getName(); ?>" required>
                </div>
                <input type="submit" value="<?php echo ($createView) ? 'Crear' : 'Guardar'; ?>" class="btn btn-primary" name="createBtn">
            </form>
        </div>
    </div>
</div>