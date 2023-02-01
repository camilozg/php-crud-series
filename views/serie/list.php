<?php
include '../header.php';
require_once(__DIR__ . '/../../controllers/SerieController.php'); ?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-9">
            <h1>Series</h1>
        </div>
        <div class="col-sm-auto">
            <a href="create.php" class="btn btn-dark">Crear serie</a>
        </div>
        <div class="col-sm-auto">
            <a href="../../index.php" class="btn btn-dark">Home</a>
        </div>
        <div>
            <?php
            $serieList = listSeries();
            if (count($serieList) > 0) {
            ?>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                            <th>Id</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                            <th>Plataformas</th>
                            <th>Directores</th>
                            <th>Actores</th>
                            <th>Audio</th>
                            <th>Subtítulos</th>
                            <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($serieList as $serie) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $serie->getId(); ?></th>
                                <td><?php echo $serie->getTitle(); ?></td>
                                <td><?php echo $serie->getSynopsis(); ?></td>
                                <td>
                                    <ul style="list-style-type: circle">
                                        <?php
                                        foreach ($serie->getPlatforms() as $platform) {
                                        ?>
                                            <li><?php echo $platform->getName(); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul style="list-style-type: circle">
                                        <?php
                                        foreach ($serie->getDirectors() as $director) {
                                        ?>
                                            <li><?php echo $director->getName() . ' ' . $director->getLastname(); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul style="list-style-type: circle">
                                        <?php
                                        foreach ($serie->getActors() as $actor) {
                                        ?>
                                            <li><?php echo $actor->getName() . ' ' . $actor->getLastname(); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul style="list-style-type: circle">
                                        <?php
                                        foreach ($serie->getAudioLanguajes() as $audioLang) {
                                        ?>
                                            <li><?php echo $audioLang->getName(); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul style="list-style-type: circle">
                                        <?php
                                        foreach ($serie->getCaptionLanguajes() as $captionLang) {
                                        ?>
                                            <li><?php echo $captionLang->getName(); ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <a href="create.php?update&id=<?php echo $serie->getId(); ?>" class="btn btn-primary">Editar</a>
                                    <form action="delete.php" method="POST" class="mt-2">
                                        <input type="hidden" name="id" value="<?php echo $serie->getId(); ?>">
                                        <input type="submit" class="btn btn-danger" value="Borrar" onclick="return confirm('¿Desea borrar el registro?')"></input>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="alert alert-primary">
                    Aún no existen series
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>