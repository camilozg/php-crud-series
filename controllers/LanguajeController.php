<?php
require_once(__DIR__ . '/../models/Languaje.php');

function listLanguajes()
{
    $model = new Languaje();
    $languajeList = $model->getAll();

    return $languajeList;
}

function storeLanguaje($name, $isoCode)
{
    $languajeCreated = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_string($name) && is_string($isoCode)){
        $newLanguaje = new Languaje(null, $name, $isoCode);
        $languajeCreated = $newLanguaje->store();
    }

    return $languajeCreated;
}

function updateLanguaje($id, $name, $isoCode)
{
    $languajeEdited = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id) && is_string($name) && is_string($isoCode)){
        $languaje = new Languaje($id, $name, $isoCode);
        $languajeEdited = $languaje->update();
    }

    return $languajeEdited;
}

function getLanguajeData($id)
{
    $languaje = new Languaje($id);
    $languajeObject = $languaje->getItem();

    return $languajeObject;
}

function deleteLanguaje($id)
{
    $languajeDeleted = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id)){
        $languaje = new Languaje($id);
        $languajeDeleted = $languaje->delete();
    }

    return $languajeDeleted;
}
