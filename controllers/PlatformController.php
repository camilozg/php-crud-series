<?php
require_once(__DIR__ . '/../models/Platform.php');

function listPlatforms()
{
    $model = new Platform();
    $platformList = $model->getAll();

    return $platformList;
}

function storePlatform($platformName)
{
    $platformCreated = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_string($platformName)){
        $newPlatform = new Platform(null, $platformName);
        $platformCreated = $newPlatform->store();
    }

    return $platformCreated;
}

function updatePlatform($platformId, $platformName)
{
    $platformEdited = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($platformId) && is_string($platformName)){
        $platform = new Platform($platformId, $platformName);
        $platformEdited = $platform->update();
    }

    return $platformEdited;
}

function getPlatformData($platformId)
{
    $platform = new Platform($platformId);
    $platformObject = $platform->getItem();

    return $platformObject;
}

function deletePlatform($platformId)
{
    $platformDeleted = false;
    // Revisa si los parametros recibidos son del tipo de dato correcto
    if(is_numeric($platformId)){
        $platform = new Platform($platformId);
        $platformDeleted = $platform->delete();
    }

    return $platformDeleted;
}
