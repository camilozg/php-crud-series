<?php
require_once(__DIR__ . '/../models/Actor.php');

function listActors()
{
    $model = new Actor();
    $actorList = $model->getAll();

    return $actorList;
}

function storeActor($name, $lastname, $birthDate, $nationality)
{
    $actorCreated = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_string($name) && is_string($lastname) && strtotime($birthDate) && is_string($nationality)){
        $newActor = new Actor(null, $name, $lastname, $birthDate, $nationality);
        $actorCreated = $newActor->store();
    }

    return $actorCreated;
}

function updateActor($id, $name, $lastname, $birthDate, $nationality)
{
    $actorEdited = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id) && is_string($name) && is_string($lastname) && strtotime($birthDate) && is_string($nationality)){
        $actor = new Actor($id, $name, $lastname, $birthDate, $nationality);
        $actorEdited = $actor->update();
    }

    return $actorEdited;
}

function getActorData($id)
{
    $actor = new Actor($id);
    $actorObject = $actor->getItem();

    return $actorObject;
}

function deleteActor($id)
{
    $actorDeleted = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id)){
        $actor = new Actor($id);
        $actorDeleted = $actor->delete();
    }

    return $actorDeleted;
}