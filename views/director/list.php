<?php 
include '../header.php';
require_once(__DIR__ . '/../../controllers/DirectorController.php'); ?>

<div class="container" style="margin-top:2%">
    <div class="row">
        <div class="col-sm-8">
            <h1>Directores</h1>
        </div>
        <div class="col-sm-auto">
            <a href="create.php" class="btn btn-dark">Crear director</a>
        </div>
        <div class="col-sm-auto">
            <a href="../../index.php" class="btn btn-dark">Home</a>
        </div>
        <div>
            <?php
            $directorList = listDirectors();
            if (count($directorList) > 0) {
            ?>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de nacimiento</th>
                        <th>Nacionalidad</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($directorList as $director) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $director->getId(); ?></th>
                                <td><?php echo $director->getName(); ?></td>
                                <td><?php echo $director->getLastname(); ?></td>
                                <td><?php echo $director->getBirthDate(); ?></td>
                                <td><?php echo $director->getNationality(); ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="create.php?update&id=<?php echo $director->getId(); ?>" class="btn btn-primary">Editar</a>

                                        </div>
                                        <div class="col-sm-4">
                                            <form action="delete.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $director->getId(); ?>">
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
                    Aún no existen directores
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>