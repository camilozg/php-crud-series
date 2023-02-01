<?php
require_once(__DIR__ . '/../models/Serie.php');

function listSeries()
{
    $model = new Serie();
    $serieList = $model->getAll();

    return $serieList;
}

function storeSerie($title, $synopsis, $platforms, $directors, $actors, $audioLanguajes, $captionLanguajes)
{
    $serieCreated = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if (is_string($title) && is_string($synopsis) && is_array($platforms) && is_array($directors) && is_array($actors) && is_array($audioLanguajes) && is_array($captionLanguajes)) {
        $newSerie = new Serie(null, $title, $synopsis);
        $serieCreated = $newSerie->store($platforms, $directors, $actors, $audioLanguajes, $captionLanguajes);
    }

    return $serieCreated;
}

function updateSerie($id, $title, $synopsis, $platforms, $directors, $actors, $audioLanguajes, $captionLanguajes)
{
    $serieEdited = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if (is_numeric($id) && is_string($title) && is_string($synopsis) && is_array($platforms) && is_array($directors) && is_array($actors) && is_array($audioLanguajes) && is_array($captionLanguajes)) {
        $serie = new Serie($id, $title, $synopsis);
        $serieEdited = $serie->update($platforms, $directors, $actors, $audioLanguajes, $captionLanguajes);
    }
    return $serieEdited;
}

function getSerieData($id)
{
    $serie = new Serie($id);
    $serieObject = $serie->getItem();

    return $serieObject;
}

function deleteSerie($id)
{
    $serieDeleted = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($id)){
        $serie = new Serie($id);
        $serieDeleted = $serie->delete();
    }

    return $serieDeleted;
}
