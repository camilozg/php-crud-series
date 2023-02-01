<?php 
include '../header.php';
require_once(__DIR__ . '/../../controllers/PlatformController.php'); ?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-5">
            <h1>Plataformas</h1>
        </div>
        <div class="col-sm-auto">
            <a href="create.php" class="btn btn-dark">Crear plataforma</a>
        </div>
        <div class="col-sm-auto">
            <a href="../../index.php" class="btn btn-dark">Home</a>
        </div>
        <div>
            <?php
            $platformList = listPlatforms();
            if (count($platformList) > 0) {
            ?>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($platformList as $platform) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $platform->getId(); ?></th>
                                <td><?php echo $platform->getName(); ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="create.php?update&id=<?php echo $platform->getId(); ?>" class="btn btn-primary">Editar</a>

                                        </div>
                                        <div class="col-sm-2">
                                            <form action="delete.php" method="POST">
                                                <input type="hidden" name="platformId" value="<?php echo $platform->getId(); ?>">
                                                <input type="submit" class="btn btn-danger" value="Borrar" onclick="return confirm('¿Desea borrar el registro?')"></input>
                                            </form>
                                        </div>
                                    </div>
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
                    Aún no existen plataformas
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>