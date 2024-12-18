<?php

require_once "DatabaseObject.php";

class Gast implements DatabaseObject
{
    private $id = 0;
    private $gastName = '';
    private $email = '';
    private $adresse = '';

    private $errors = [];

    public function __construct()
    {

    }

    public function validate(){
        return $this->validateHelper('gastName', 'gastName', $this->gastName, 32) &
            $this->validateHelper('Domäne', 'email', $this->email, 128) &
            $this->validateHelper('CMS-BenutzergastName', 'adresse', $this->adresse, 64);
    }

    public function validateHelper($label, $key, $value, $maxLength){
        if(strlen($value) == 0){
            $this->errors[$key] = "$label darf nicht leer sein";
            return false;
        } else if (strlen($value) > $maxLength){
            $this->errors[$key] = "$label zu lang (max . $maxLength Zeichen)";
            return false;
        } else {
            return true;
        }
    }

    public function save(){
        if ($this->validate()) {

            if($this->id =! null && $this->id > 0){
                $this->update();
            } else {
                $this->id = $this->create();
            }


            return true;
        }

        return false;
    }



    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setemail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getgastName()
    {
        return $this->gastName;
    }

    /**
     * @param string $gastName
     */
    public function setgastName($gastName)
    {
        $this->gastName = $gastName;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }


    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }




    public function create()
    {
        $sql = "INSERT INTO gast (gastName, email, adresse) Values (?, ?, ?)";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->gastName, $this->email, $this->adresse,));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public function update()
    {
        $sql = "UPDATE gast SET gastName = ?, email = ?, adresse = ? WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->gastName, $this->email, $this->adresse, $this->id));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public static function get($id)
    {
        $sql = "SELECT * FROM gast WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('Gast');
        Database::disconnect();
        return $item !== false ? $item : null;
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM gast ORDER BY gastName ASC, email ASC";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Gast');
        Database::disconnect();
        return $items;
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM gast WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }
}