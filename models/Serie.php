<?php
require_once(__DIR__ . '/DbConnection.php');
require_once(__DIR__ . '/Platform.php');
require_once(__DIR__ . '/Director.php');
require_once(__DIR__ . '/Actor.php');
require_once(__DIR__ . '/Languaje.php');

class Serie
{
    private $id;
    private $title;
    private $synopsis;
    private $platforms = [];
    private $directors = [];
    private $actors = [];
    private $audioLanguajes = [];
    private $captionLanguajes = [];

    public function __construct($id = null, $title = null, $synopsis = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->synopsis = $synopsis;
    }

    //---------------------------------------------------------------------------------------------------
    // getters y setters
    //---------------------------------------------------------------------------------------------------

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    public function getPlatforms()
    {
        return $this->platforms;
    }

    public function setPlatforms($platforms)
    {
        $this->platforms = $platforms;
    }

    public function getDirectors()
    {
        return $this->directors;
    }

    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    public function getActors()
    {
        return $this->actors;
    }

    public function setActors($actors)
    {
        $this->actors = $actors;
    }

    public function getAudioLanguajes()
    {
        return $this->audioLanguajes;
    }

    public function setAudioLanguajes($audioLanguajes)
    {
        $this->audioLanguajes = $audioLanguajes;
    }

    public function getCaptionLanguajes()
    {
        return $this->captionLanguajes;
    }

    public function setCaptionLanguajes($captionLanguajes)
    {
        $this->captionLanguajes = $captionLanguajes;
    }

    //---------------------------------------------------------------------------------------------------
    // Métodos para recorrer el listado de objetos de las entidades asociadas a la serie y retornar
    // los identificadores de cada tipo de entidad
    //---------------------------------------------------------------------------------------------------

    public function getPlatformIds()
    {
        $idList = [];
        foreach ($this->getPlatforms() as $item) {
            array_push($idList, $item->getId());
        }

        return $idList;
    }

    public function getDirectorIds()
    {
        $idList = [];
        foreach ($this->getDirectors() as $item) {
            array_push($idList, $item->getId());
        }

        return $idList;
    }

    public function getActorIds()
    {
        $idList = [];
        foreach ($this->getActors() as $item) {
            array_push($idList, $item->getId());
        }

        return $idList;
    }

    public function getAudioLangIds()
    {
        $idList = [];
        foreach ($this->getAudioLanguajes() as $item) {
            array_push($idList, $item->getId());
        }

        return $idList;
    }

    public function getCaptionLangIds()
    {
        $idList = [];
        foreach ($this->getCaptionLanguajes() as $item) {
            array_push($idList, $item->getId());
        }

        return $idList;
    }

    //---------------------------------------------------------------------------------------------------
    // Método estático para crear los objetos de las entidades asociadas a la serie recibida por parámetro
    //---------------------------------------------------------------------------------------------------

    private static function setRelatedObjects($serieObject)
    {
        $mysqli = initConnectionDb();

        $platforms = [];
        $directors = [];
        $actors = [];
        $audioLangs = [];
        $captionLangs = [];

        // Crea los objetos Plataforma asociados y los asigna a la serie
        $query = $mysqli->query("SELECT platform.id FROM platform INNER JOIN serie_platform WHERE platform.id = serie_platform.platform_id and serie_platform.serie_id = " . $serieObject->id);
        foreach ($query as $item) {
            $platform = new Platform($item['id']);
            $platformObject = $platform->getItem();
            array_push($platforms, $platformObject);
        }
        $serieObject->setPlatforms($platforms);

        // Crea los objetos Director asociados y los asigna a la serie
        $query = $mysqli->query("SELECT director.id FROM director INNER JOIN serie_director WHERE director.id = serie_director.director_id and serie_director.serie_id = " . $serieObject->id);
        foreach ($query as $item) {
            $director = new Director($item['id']);
            $directorObject = $director->getItem();
            array_push($directors, $directorObject);
        }
        $serieObject->setDirectors($directors);

        // Crea los objetos Actor asociados y los asigna a la serie
        $query = $mysqli->query("SELECT actor.id FROM actor INNER JOIN serie_actor WHERE actor.id = serie_actor.actor_id and serie_actor.serie_id = " . $serieObject->id);
        foreach ($query as $item) {
            $actor = new Actor($item['id']);
            $actorObject = $actor->getItem();
            array_push($actors, $actorObject);
        }
        $serieObject->setActors($actors);

        // Crea los objetos Lenguaje (audio) asociados y los asigna a la serie
        $query = $mysqli->query("SELECT languaje.id FROM languaje INNER JOIN serie_audio_lang WHERE languaje.id = serie_audio_lang.languaje_id and serie_audio_lang.serie_id = " . $serieObject->id);
        foreach ($query as $item) {
            $audioLang = new Languaje($item['id']);
            $audioLangObject = $audioLang->getItem();
            array_push($audioLangs, $audioLangObject);
        }
        $serieObject->setAudioLanguajes($audioLangs);

        // Crea los objetos Lenguaje (caption) asociados y los asigna a la serie
        $query = $mysqli->query("SELECT languaje.id FROM languaje INNER JOIN serie_caption_lang WHERE languaje.id = serie_caption_lang.languaje_id and serie_caption_lang.serie_id = " . $serieObject->id);
        foreach ($query as $item) {
            $captionLang = new Languaje($item['id']);
            $captionLangObject = $captionLang->getItem();
            array_push($captionLangs, $captionLangObject);
        }
        $serieObject->setCaptionLanguajes($captionLangs);

        $mysqli->close();

        return $serieObject;
    }

    //---------------------------------------------------------------------------------------------------
    // Métodos CRUD
    //---------------------------------------------------------------------------------------------------

    public function getAll()
    {
        $mysqli = initConnectionDb();
        $listSeries = [];

        $seriesQuery = $mysqli->query("SELECT * FROM serie ORDER BY id");

        foreach ($seriesQuery as $item) {
            $serieObject = new Serie($item['id'], $item['title'], $item['synopsis']);
            // Agrega a la serie los objetos relacionados de otras entidades
            $serieObject = Serie::setRelatedObjects($serieObject);

            array_push($listSeries, $serieObject);
        }

        $mysqli->close();

        return $listSeries;
    }

    public function store($platforms, $directors, $actors, $audioLanguajes, $captionLanguajes)
    {
        $serieCreated = false;
        $mysqli = initConnectionDb();

        // Comprobar que no existe otra serie con el mismo nombre antes de crear la serie
        $query = $mysqli->query("SELECT * FROM serie WHERE title = '$this->title'");
        if ($query->num_rows == 0) {
            $query = $mysqli->query("INSERT INTO serie (title, synopsis) VALUES ('$this->title', '$this->synopsis')");

            if ($query) {
                $serieCreated = true;
            }
        }

        // Buscar el id de la serie que se acaba de crear
        $serieIdQuery = $mysqli->query("SELECT MAX(id) as id FROM serie");
        $serieId = $serieIdQuery->fetch_assoc()['id'];

        // Insertar en las tablas intermedias la relación de serie con las otras entidades
        if ($serieCreated) {
            foreach ($platforms as $itemId) {
                // Comprobar que existe la plataforma antes de insertar la relación serie_platform
                $existsQuery = $mysqli->query("SELECT * FROM platform WHERE id = '$itemId'");
                if ($existsQuery->num_rows > 0) {
                    $mysqli->query("INSERT INTO serie_platform (serie_id, platform_id) VALUES ('$serieId', '$itemId')");
                }
            }

            foreach ($directors as $itemId) {
                // Comprobar que existe el director antes de insertar la relación serie_director
                $existsQuery = $mysqli->query("SELECT * FROM director WHERE id = '$itemId'");
                if ($existsQuery->num_rows > 0) {
                    $mysqli->query("INSERT INTO serie_director (serie_id, director_id) VALUES ('$serieId', '$itemId')");
                }
            }

            foreach ($actors as $itemId) {
                // Comprobar que existe el actor antes de insertar la relación serie_actor
                $existsQuery = $mysqli->query("SELECT * FROM actor WHERE id = '$itemId'");
                if ($existsQuery->num_rows > 0) {
                    $mysqli->query("INSERT INTO serie_actor (serie_id, actor_id) VALUES ('$serieId', '$itemId')");
                }
            }

            foreach ($audioLanguajes as $itemId) {
                // Comprobar que existe el idioma antes de insertar la relación serie_audio_lang
                $existsQuery = $mysqli->query("SELECT * FROM languaje WHERE id = '$itemId'");
                if ($existsQuery->num_rows > 0) {
                    $mysqli->query("INSERT INTO serie_audio_lang (serie_id, languaje_id) VALUES ('$serieId', '$itemId')");
                }
            }

            foreach ($captionLanguajes as $itemId) {
                // Comprobar que existe el idioma antes de insertar la relación serie_caption_lang
                $existsQuery = $mysqli->query("SELECT * FROM languaje WHERE id = '$itemId'");
                if ($existsQuery->num_rows > 0) {
                    $mysqli->query("INSERT INTO serie_caption_lang (serie_id, languaje_id) VALUES ('$serieId', '$itemId')");
                }
            }
        }

        $mysqli->close();

        return $serieCreated;
    }

    public function update($platforms, $directors, $actors, $audioLanguajes, $captionLanguajes)
    {
        $serieEdited = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe la serie antes de actualizar
        $serieExistsQuery = $mysqli->query("SELECT * FROM serie WHERE id = '$this->id'");

        if ($serieExistsQuery->num_rows > 0) {

            // Actualizar la tabla serie
            $updateQuery = $mysqli->query("UPDATE serie SET title = '$this->title', synopsis = '$this->synopsis' WHERE id = '$this->id'");

            if ($updateQuery) {
                $serieEdited = true;
            }

            $serieObject = new Serie($this->id);
            $serieObject = $serieObject->getItem();

            // Borrar plataformas requeridas
            foreach (array_diff($serieObject->getPlatformIds(), $platforms) as $item) {
                $mysqli->query("DELETE FROM serie_platform WHERE serie_id = '$this->id' AND platform_id = '$item'");
            }
            // Agregar plataformas requeridas
            foreach (array_diff($platforms, $serieObject->getPlatformIds()) as $item) {
                $mysqli->query("INSERT INTO serie_platform (serie_id, platform_id) VALUES ('$this->id', '$item')");
            }

            // Borrar directores requeridos
            foreach (array_diff($serieObject->getDirectorIds(), $directors) as $item) {
                $mysqli->query("DELETE FROM serie_director WHERE serie_id = '$this->id' AND director_id = '$item'");
            }
            // Agregar directores requeridos
            foreach (array_diff($directors, $serieObject->getDirectorIds()) as $item) {
                $mysqli->query("INSERT INTO serie_director (serie_id, director_id) VALUES ('$this->id', '$item')");
            }

            // Borrar actores requeridos
            foreach (array_diff($serieObject->getActorIds(), $actors) as $item) {
                $mysqli->query("DELETE FROM serie_actor WHERE serie_id = '$this->id' AND actor_id = '$item'");
            }
            // Agregar actores requeridos
            foreach (array_diff($actors, $serieObject->getActorIds()) as $item) {
                $mysqli->query("INSERT INTO serie_actor (serie_id, actor_id) VALUES ('$this->id', '$item')");
            }

            // Borrar idiomas de audio requeridos
            foreach (array_diff($serieObject->getAudioLangIds(), $audioLanguajes) as $item) {
                $mysqli->query("DELETE FROM serie_audio_lang WHERE serie_id = '$this->id' AND languaje_id = '$item'");
            }
            // Agregar idiomas de audio requeridos
            foreach (array_diff($audioLanguajes, $serieObject->getAudioLangIds()) as $item) {
                $mysqli->query("INSERT INTO serie_audio_lang (serie_id, languaje_id) VALUES ('$this->id', '$item')");
            }

            // Borrar idiomas de subtitulos requeridos
            foreach (array_diff($serieObject->getCaptionLangIds(), $captionLanguajes) as $item) {
                $mysqli->query("DELETE FROM serie_caption_lang WHERE serie_id = '$this->id' AND languaje_id = '$item'");
            }
            // Agregar idiomas de subtitulos requeridos
            foreach (array_diff($captionLanguajes, $serieObject->getCaptionLangIds()) as $item) {
                $mysqli->query("INSERT INTO serie_caption_lang (serie_id, languaje_id) VALUES ('$this->id', '$item')");
            }
        }

        $mysqli->close();

        return $serieEdited;
    }

    public function getItem()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM serie WHERE id = '$this->id'");

        foreach ($query as $item) {
            $serieObject = new Serie($item['id'], $item['title'], $item['synopsis']);
        }

        // Agrega a la serie los objetos relacionados de otras entidades
        $serieObject = Serie::setRelatedObjects($serieObject);

        $mysqli->close();

        return $serieObject;
    }

    public function delete()
    {
        $serieDeleted = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe la serie antes de borrar
        $query = $mysqli->query("SELECT * FROM serie WHERE id = '$this->id'");

        // A nivel de base de datos se han definido todas las relaciones con la regla "ON DELETE CASCADE"
        // por lo que no encontramos necesario hacer una revisión manual de claves foráneas al momento de borrar
        if ($query->num_rows > 0) {
            $query = $mysqli->query("DELETE FROM serie WHERE id = '$this->id'");

            if ($query) {
                $serieDeleted = true;
            }
        }

        $mysqli->close();

        return $serieDeleted;
    }
}
