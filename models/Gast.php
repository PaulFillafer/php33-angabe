<?php

require_once "DatabaseObject.php";

class Gast implements DatabaseObject
{
    private $gastId = 0;
    private $gastName = '';
    private $email = '';
    private $adresse = '';

    private $errors = [];

    public function __construct()
    {

    }

    public function valgastIdate(){
        return $this->valgastIdateHelper('gastName', 'gastName', $this->gastName, 32) &
            $this->valgastIdateHelper('Domäne', 'email', $this->email, 128) &
            $this->valgastIdateHelper('CMS-BenutzergastName', 'adresse', $this->adresse, 64);
    }

    public function valgastIdateHelper($label, $key, $value, $maxLength){
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
        if ($this->valgastIdate()) {

            if($this->gastId =! null && $this->gastId > 0){
                $this->update();
            } else {
                $this->gastId = $this->create();
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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getgastId()
    {
        return $this->gastId;
    }

    /**
     * @param int $gastId
     */
    public function setgastId($gastId)
    {
        $this->gastId = $gastId;
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
        $sql = "UPDATE gast SET gastName = ?, email = ?, adresse = ? WHERE gastId = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->gastName, $this->email, $this->adresse, $this->gastId));
        $lastgastId = $db->lastInsertgastId();
        Database::disconnect();
        return $lastgastId;
    }

    public static function get($gastId)
    {
        $sql = "SELECT * FROM gast WHERE gastId = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($gastId));
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

    public static function delete($gastId)
    {
        $sql = "DELETE FROM gast WHERE gastId = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($gastId));
        Database::disconnect();
    }
}