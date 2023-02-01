<?php
require_once(__DIR__ . '/DbConnection.php');

class Languaje
{
    private $id;
    private $name;
    private $isoCode;

    public function __construct($id = null, $name = null, $isoCode = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isoCode = $isoCode;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getIsoCode()
    {
        return $this->isoCode;
    }

    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
    }

    //---------------------------------------------------------------------------------------------------
    // Métodos CRUD
    //---------------------------------------------------------------------------------------------------

    public function getAll()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM languaje ORDER BY id");
        $listData = [];

        foreach ($query as $item) {
            $itemObject = new Languaje($item['id'], $item['name'], $item['iso_code']);
            array_push($listData, $itemObject);
        }

        $mysqli->close();

        return $listData;
    }

    public function store()
    {
        $languajeCreated = false;
        $mysqli = initConnectionDb();

        // Comprobar que no existe otro lenguaje con el mismo nombre e iso code
        $query = $mysqli->query("SELECT * FROM languaje WHERE name = '$this->name' AND iso_code = '$this->isoCode'");
        // Comprobar que el iso code sea de 2 caracteres
        if ($query->num_rows == 0 && strlen($this->isoCode) == 2) {
            $query = $mysqli->query("INSERT INTO languaje (name, iso_code) VALUES ('$this->name', '$this->isoCode')");

            if ($query) {
                $languajeCreated = true;
            }
        }

        $mysqli->close();

        return $languajeCreated;
    }

    public function update()
    {
        $languajeEdited = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de actualizar
        $query = $mysqli->query("SELECT * FROM languaje WHERE id = '$this->id'");
        // Comprobar que el iso code sea de 2 caracteres
        if ($query->num_rows > 0 && strlen($this->isoCode) == 2) {
            $query = $mysqli->query("UPDATE languaje SET name = '$this->name', iso_code = '$this->isoCode' WHERE id = '$this->id'");
            if ($query) {
                $languajeEdited = true;
            }
        }

        $mysqli->close();

        return $languajeEdited;
    }

    public function getItem()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM languaje WHERE id = '$this->id'");

        foreach ($query as $item) {
            $itemObject = new Languaje($item['id'], $item['name'], $item['iso_code']);
        }

        $mysqli->close();

        return $itemObject;
    }

    public function delete()
    {
        $languajeDeleted = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de borrar
        $query = $mysqli->query("SELECT * FROM languaje WHERE id = '$this->id'");

        // A nivel de base de datos se han definido todas las relaciones con la regla "ON DELETE CASCADE"
        // por lo que no encontramos necesario hacer una revisión manual de claves foráneas al momento de borrar
        if ($query->num_rows > 0) {
            $query = $mysqli->query("DELETE FROM languaje WHERE id = '$this->id'");

            if ($query) {
                $languajeDeleted = true;
            }
        }

        $mysqli->close();

        return $languajeDeleted;
    }
}
