<?php

include_once 'DAL/models/record.php';
class Statistique extends Record
{
    public $EnigmeId;
    public $UserId;
    public $EstReussie;
   
    public function __construct($recordData = null)
    {
        $this->EnigmeId = 0;
        $this->UserId = 0;
        $this->EstReussie = '';
        parent::__construct($recordData);
    }
    public function setEnigmeId($itemId)
    {
        $this->EnigmeId = (int) $itemId;
    }
    public function setUserId($userId)
    {
        $this->UserId = (int) $userId;
    }
    public function setEstReussie($estReussie)
    {
        $this->EstReussie = $estReussie;
    }
}