<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/SerieController.php');
require_once(__DIR__ . '/../../controllers/PlatformController.php');
require_once(__DIR__ . '/../../controllers/DirectorController.php');
require_once(__DIR__ . '/../../controllers/ActorController.php');
require_once(__DIR__ . '/../../controllers/LanguajeController.php');

$createView = true;
$result = false;
$sendData = false;

$platforms = listPlatforms();
$directors = listDirectors();
$actors = listActors();
$languajes = listLanguajes();

$newPlatforms = [];
$newDirectors = [];
$newActors = [];
$newAudioLangs = [];
$newCaptionLangs = [];

if (isset($_GET['update'])) {
    $createView = false;
    $serieObject = getSerieData($_GET['id']);
}
if (isset($_POST['createBtn'])) {
    $sendData = true;
    if (isset($_POST['title'], $_POST['synopsis'])) {
        if (isset($_POST['platforms'])) $newPlatforms = $_POST['platforms'];
        if (isset($_POST['directors'])) $newDirectors = $_POST['directors'];
        if (isset($_POST['actors'])) $newActors = $_POST['actors'];
        if (isset($_POST['audioLanguajes'])) $newAudioLangs = $_POST['audioLanguajes'];
        if (isset($_POST['captionLanguajes'])) $newCaptionLangs = $_POST['captionLanguajes'];

        if ($createView) {
            $result = storeSerie($_POST['title'], $_POST['synopsis'], $newPlatforms, $newDirectors, $newActors, $newAudioLangs, $newCaptionLangs);
        } else {
            $result = updateSerie($serieObject->getId(), $_POST['title'], $_POST['synopsis'], $newPlatforms, $newDirectors, $newActors, $newAudioLangs, $newCaptionLangs);

            if ($result) {
                $serieObject = getSerieData($_GET['id']);
            }
        }
    }
}
?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-auto">
            <h1><?php echo ($createView) ? 'Crear serie' : 'Editar serie'; ?></h1>
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
                        Serie <?php echo $createView ? 'creada' : 'actualizada'; ?> correctamente
                        <a href="list.php">Volver al listado de series.</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger">
                        La serie no se ha <?php echo $createView ? 'creado' : 'actualizado'; ?> correctamente
                        <a href="list.php">Volver al listado de series.</a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <div>
        <form name="create_serie" action="" method="POST">
            <div class="form-group mb-2">
                <label for="name">Nombre</label>
                <input id="name" class="form-control" name="title" type="text" placeholder="Ingresa el título" value="<?php if (isset($serieObject)) echo $serieObject->getTitle(); ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="synopsis">Sinopsis</label>
                <textarea id="synopsis" class="form-control" name="synopsis" placeholder="Ingresa la sinopsis" required><?php if (isset($serieObject)) echo $serieObject->getSynopsis(); ?></textarea>
            </div>
            <div class="row mb-2">
                <div class="col-sm-2">
                    Plataformas
                    <div class="m-2">
                        <?php
                        foreach ($platforms as $item) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="platforms[]" id="<?php echo 'platform_' . $item->getId(); ?>" value="<?php echo $item->getId(); ?>" <?php if ((isset($serieObject)) && in_array($item->getId(), $serieObject->getPlatformIds())) echo 'checked'; ?>>
                                <label class="form-check-label" for="<?php echo 'platform_' . $item->getId(); ?>"><?php echo $item->getName(); ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    Directores
                    <div class="m-2">
                        <?php
                        foreach ($directors as $item) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="directors[]" id="<?php echo 'director_' . $item->getId(); ?>" value="<?php echo $item->getId(); ?>" <?php if ((isset($serieObject)) && in_array($item->getId(), $serieObject->getDirectorIds())) echo 'checked'; ?>>
                                <label class="form-check-label" for="<?php echo 'director_' . $item->getId(); ?>"><?php echo $item->getName() . ' ' . $item->getLastname(); ?></label><br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    Actores
                    <div class="m-2">
                        <?php
                        foreach ($actors as $item) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="actors[]" id="<?php echo 'actor_' . $item->getId(); ?>" value="<?php echo $item->getId(); ?>" <?php if ((isset($serieObject)) && in_array($item->getId(), $serieObject->getActorIds())) echo 'checked'; ?>>
                                <label class="form-check-label" for="<?php echo 'actor_' . $item->getId(); ?>"><?php echo $item->getName() . ' ' . $item->getLastname(); ?></label><br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    Idiomas de audio
                    <div class="m-2">
                        <?php
                        foreach ($languajes as $item) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="audioLanguajes[]" id="<?php echo 'languaje_' . $item->getId(); ?>" value="<?php echo $item->getId(); ?>" <?php if ((isset($serieObject)) && in_array($item->getId(), $serieObject->getAudioLangIds())) echo 'checked'; ?>>
                                <label class="form-check-label" for="<?php echo 'languaje_' . $item->getId(); ?>"><?php echo $item->getName(); ?></label><br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    Idiomas de subtitulos
                    <div class="m-2">
                        <?php
                        foreach ($languajes as $item) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="captionLanguajes[]" id="<?php echo 'languaje_' . $item->getId(); ?>" value="<?php echo $item->getId(); ?>" <?php if ((isset($serieObject)) && in_array($item->getId(), $serieObject->getCaptionLangIds())) echo 'checked'; ?>>
                                <label class="form-check-label" for="<?php echo 'languaje_' . $item->getId(); ?>"><?php echo $item->getName(); ?></label><br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <input type="submit" value="<?php echo ($createView) ? 'Crear' : 'Guardar'; ?>" class="btn btn-primary" name="createBtn">
        </form>
    </div>
</div>