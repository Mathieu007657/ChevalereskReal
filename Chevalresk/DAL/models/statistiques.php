<?php

include_once 'DAL/models/record.php';
class Statistique extends Record
{
    public $EnigmeId;
    public $UserId;
    public $EstReussie;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->UserId = 0;
        $this->EstReussie = '';
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
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