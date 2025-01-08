<?php

require_once "DatabaseObject.php";

class Reservierung implements DatabaseObject
{
    private $id = 0;
    private $zimmerId = '';
    private $gastId = '';
    private $start = 0;
    private $ende = 0.00;

    private $errors = [];

    public function __construct()
    {

    }

    public function validate(){
        return $this->validateHelper('zimmerId', 'zimmerId', $this->zimmerId, 32) &
            $this->validateHelper('gastId', 'gastId', $this->gastId, 128) &
            $this->validateHelper('start', 'start', $this->start, 128) &
            $this->validateHelper('ende', 'ende', $this->ende, 128) ;
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


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getZimmerId()
    {
        return $this->zimmerId;
    }

    public function setZimmerId($zimmerId)
    {
        $this->zimmerId = $zimmerId;
    }

    /**
     * @return string
     */
    public function getGastId()
    {
        return $this->gastId;
    }

    /**
     * @param string $gastId
     */
    public function setGastId($gastId)
    {
        $this->gastId = $gastId;
    }

    /**
     * @return float
     */
    public function getEnde()
    {
        return $this->ende;
    }

    /**
     * @param float $ende
     */
    public function setEnde($ende)
    {
        $this->ende = $ende;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param int $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }



    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }




    public function create()
    {
        $sql = "INSERT INTO reservierung (zimmerId, gastId, start, ende) Values (?, ?, ?, ?)";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->zimmerId, $this->gastId, $this->start, $this->ende));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public function update()
    {
        $sql = "UPDATE reservierung SET `zimmerId`=?,`gastId`=?,`start`=?, `ende`=? WHERE id=?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->zimmerId, $this->gastId, $this->start, $this->ende, $this->id));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public static function get($id)
    {
        $sql = "SELECT gast.gastName as 'gastId', zimmer.name as 'zimmerId', start, ende, id FROM `reservierung` INNER JOIN gast ON reservierung.gastId=gast.gastId INNER JOIN zimmer ON reservierung.zimmerId = zimmer.zimmerId WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('Reservierung');
        Database::disconnect();
        return $item !== false ? $item : null;
    }

    public static function getAll()
    {
        $sql = "SELECT id, gast.gastName as 'gastId', zimmer.name as 'zimmerId', start, ende FROM `reservierung` INNER JOIN gast ON reservierung.gastId=gast.gastId INNER JOIN zimmer ON reservierung.zimmerId = zimmer.zimmerId;";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Reservierung');
        Database::disconnect();
        return $items;
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM reservierung WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }
}