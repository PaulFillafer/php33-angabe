<?php

require_once "DatabaseObject.php";

class Zimmer implements DatabaseObject
{
    private $zimmerId = 0;
    private $nr = 0;
    private $name = '';
    private $person = 0;
    private $preis = 0.00;
    private $balkon = 'falsch';

    private $errors = [];

    public function __construct()
    {

    }

    public function validate(){
        return $this->validateHelper('nr', 'nr', $this->nr, 32) &
            $this->validateHelper('name', 'name', $this->name, 128) &
            $this->validateHelper('person', 'person', $this->person, 128) &
            $this->validateHelper('preis', 'preis', $this->preis, 128) &
            $this->validateHelper('balkon', 'balkon', $this->balkon, 64);
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

            if($this->zimmerId =! null && $this->zimmerId > 0){
                $this->update();
            } else {
                $this->zimmerId = $this->create();
            }


            return true;
        }

        return false;
    }


    public function getzimmerId()
    {
        return $this->zimmerId;
    }

    public function setzimmerId($zimmerId)
    {
        $this->zimmerId = $zimmerId;
    }

    public function getNr()
    {
        return $this->nr;
    }

    public function setNr($nr)
    {
        $this->nr = $nr;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function setPerson($person)
    {
        $this->person = $person;
    }

    public function getPreis()
    {
        return $this->preis;
    }

    public function setPreis($preis)
    {
        $this->preis = $preis;
    }

    public function getBalkon()
    {
        return $this->balkon;
    }

    public function setBalkon($balkon)
    {
        $this->balkon = $balkon;
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
        $sql = "INSERT INTO zimmer (nr, name, person, preis, balkon) Values (?, ?, ?, ?, ?)";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->nr, $this->name, $this->person, $this->preis, $this->balkon, $this->balkon));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public function update()
    {
        $sql = "UPDATE zimmer SET `nr`=?,`name`=?,`person`=?, `preis`=?, `balkon`=? WHERE zimmerId=?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->nr, $this->name, $this->person, $this->preis, $this->balkon, $this->zimmerId));
        $lastID = $db->lastInsertId();
        Database::disconnect();
        return $lastID;
    }

    public static function get($zimmerId)
    {
        $sql = "SELECT * FROM zimmer WHERE zimmerId = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($zimmerId));
        $item = $stmt->fetchObject('Zimmer');
        Database::disconnect();
        return $item !== false ? $item : null;
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM zimmer ORDER BY nr ASC, name ASC";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Zimmer');
        Database::disconnect();
        return $items;
    }

    public static function delete($zimmerId)
    {
        $sql = "DELETE FROM zimmer WHERE zimmerId = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($zimmerId));
        Database::disconnect();
    }
}