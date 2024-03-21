<?php

include_once 'DAL/models/record.php';
class Inventaire extends Record
{
    public $ItemId;
    public $UserId;
    public $QuantiteInventaire;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->UserId = 0;
        $this->QuantiteInventaire = 0;
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
    public function setQuantiteInventaire($quantiteInventaire)
    {
        $this->QuantiteInventaire = (int) $quantiteInventaire;
    }
}