<?php 
include '../header.php';
require_once(__DIR__ . '/../../controllers/LanguajeController.php'); ?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-6">
            <h1>Idiomas</h1>
        </div>
        <div class="col-sm-auto">
            <a href="create.php" class="btn btn-dark">Crear idioma</a>
        </div>
        <div class="col-sm-auto">
            <a href="../../index.php" class="btn btn-dark">Home</a>
        </div>
        <div>
            <?php
            $languajeList = listLanguajes();
            if (count($languajeList) > 0) {
            ?>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Iso Code</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($languajeList as $languaje) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $languaje->getId(); ?></th>
                                <td><?php echo $languaje->getName(); ?></td>
                                <td><?php echo $languaje->getIsoCode(); ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="create.php?update&id=<?php echo $languaje->getId(); ?>" class="btn btn-primary">Editar</a>

                                        </div>
                                        <div class="col-sm-2">
                                            <form action="delete.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $languaje->getId(); ?>">
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
                    Aún no existen idiomas
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>