<?php
require_once(__DIR__ . '/DbConnection.php');

class Platform
{
    private $id;
    private $name;

    public function __construct($idPlatform = null, $namePlatform = null)
    {
        $this->id = $idPlatform;
        $this->name = $namePlatform;
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

    //---------------------------------------------------------------------------------------------------
    // Métodos CRUD
    //---------------------------------------------------------------------------------------------------

    public function getAll()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM platform ORDER BY id");
        $listData = [];

        foreach ($query as $item) {
            $itemObject = new Platform($item['id'], $item['name']);
            array_push($listData, $itemObject);
        }

        $mysqli->close();

        return $listData;
    }

    public function store()
    {
        $platformCreated = false;
        $mysqli = initConnectionDb();

        // Comprobar que no existe otra plataforma con el mismo nombre antes de crear
        $query = $mysqli->query("SELECT * FROM platform WHERE name = '$this->name'");

        if ($query->num_rows == 0) {
            $query = $mysqli->query("INSERT INTO platform (name) VALUES ('$this->name')");
            if ($query) {
                $platformCreated = true;
            }
        }

        $mysqli->close();
        
        return $platformCreated;
    }

    public function update()
    {
        $platformEdited = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de actualizar
        $query = $mysqli->query("SELECT * FROM platform WHERE id = '$this->id'");

        if ($query->num_rows > 0) {
            $query = $mysqli->query("UPDATE platform SET name = '$this->name' WHERE id = '$this->id'");
            if ($query) {
                $platformEdited = true;
            }
        }

        $mysqli->close();

        return $platformEdited;
    }

    public function getItem()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM platform WHERE id = '$this->id'");

        foreach ($query as $item) {
            $itemObject = new Platform($item['id'], $item['name']);
        }

        $mysqli->close();

        return $itemObject;
    }

    public function delete()
    {
        $platformDeleted = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de borrar
        $query = $mysqli->query("SELECT * FROM platform WHERE id = '$this->id'");

        // A nivel de base de datos se han definido todas las relaciones con la regla "ON DELETE CASCADE"
        // por lo que no encontramos necesario hacer una revisión manual de claves foráneas al momento de borrar
        if ($query->num_rows > 0) {
            $query = $mysqli->query("DELETE FROM platform WHERE id = '$this->id'");

            if ($query) {
                $platformDeleted = true;
            }
        }

        $mysqli->close();

        return $platformDeleted;
    }
}
