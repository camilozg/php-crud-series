<?php
require_once(__DIR__ . '/DbConnection.php');

class Director
{
    private $id;
    private $name;
    private $lastname;
    private $birthDate;
    private $nationality;

    public function __construct($id = null, $name = null, $lastname = null, $birthDate = null, $nationality = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->birthDate = $birthDate;
        $this->nationality = $nationality;
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

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        $this->$nationality = $nationality;
    }

    //---------------------------------------------------------------------------------------------------
    // Métodos CRUD
    //---------------------------------------------------------------------------------------------------

    public function getAll()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM director ORDER BY id");
        $listData = [];

        foreach ($query as $item) {
            $formatedDate = date("d/m/Y", strtotime($item['birth_date']));
            $itemObject = new Director($item['id'], $item['name'], $item['lastname'], $formatedDate, $item['nationality']);
            array_push($listData, $itemObject);
        }

        $mysqli->close();

        return $listData;
    }

    public function store()
    {
        $directorCreated = false;
        $mysqli = initConnectionDb();

        // Comprobar que no existe otro director con el mismo nombre y apellido antes de crear
        $query = $mysqli->query("SELECT * FROM director WHERE name = '$this->name' AND lastname = '$this->lastname'");

        if ($query->num_rows == 0) {
            $query = $mysqli->query("INSERT INTO director (name, lastname, birth_date, nationality) VALUES ('$this->name', '$this->lastname', '$this->birthDate', '$this->nationality')");

            if ($query) {
                $directorCreated = true;
            }
        }

        $mysqli->close();

        return $directorCreated;
    }

    public function update()
    {
        $directorEdited = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de actualizar
        $query = $mysqli->query("SELECT * FROM director WHERE id = '$this->id'");

        if ($query->num_rows > 0) {
            $query = $mysqli->query("UPDATE director SET name = '$this->name', lastname = '$this->lastname', birth_date = '$this->birthDate', nationality = '$this->nationality' WHERE id = '$this->id'");
            if ($query) {
                $directorEdited = true;
            }
        }

        $mysqli->close();

        return $directorEdited;
    }

    public function getItem()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM director WHERE id = '$this->id'");

        foreach ($query as $item) {
            $itemObject = new Director($item['id'], $item['name'], $item['lastname'], $item['birth_date'], $item['nationality']);
        }

        $mysqli->close();

        return $itemObject;
    }

    public function delete()
    {
        $directorDeleted = false;
        $mysqli = initConnectionDb();

        // Comprobar que existe antes de borrar
        $query = $mysqli->query("SELECT * FROM director WHERE id = '$this->id'");

        
        // A nivel de base de datos se han definido todas las relaciones con la regla "ON DELETE CASCADE"
        // por lo que no encontramos necesario hacer una revisión manual de claves foráneas al momento de borrar
        if ($query->num_rows > 0) {
            $query = $mysqli->query("DELETE FROM director WHERE id = '$this->id'");

            if ($query) {
                $directorDeleted = true;
            }
        }

        $mysqli->close();

        return $directorDeleted;
    }
}
