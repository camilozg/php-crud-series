<?php
require_once(__DIR__ . '/../models/Director.php');

function listDirectors()
{
    $model = new Director();
    $directorList = $model->getAll();

    return $directorList;
}

function storeDirector($name, $lastname, $birthDate, $nationality)
{
    $directorCreated = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_string($name) && is_string($lastname) && strtotime($birthDate) && is_string($nationality)){
        $newDirector = new Director(null, $name, $lastname, $birthDate, $nationality);
        $directorCreated = $newDirector->store();
    }

    return $directorCreated;
}

function updateDirector($id, $name, $lastname, $birthDate, $nationality)
{
    $directorEdited = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id) && is_string($name) && is_string($lastname) && strtotime($birthDate) && is_string($nationality)){
        $director = new Director($id, $name, $lastname, $birthDate, $nationality);
        $directorEdited = $director->update();
    }

    return $directorEdited;
}

function getDirectorData($id)
{
    $director = new Director($id);
    $directorObject = $director->getItem();

    return $directorObject;
}

function deleteDirector($id)
{
    $directorDeleted = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id)){
        $director = new Director($id);
        $directorDeleted = $director->delete();
    }

    return $directorDeleted;
}
