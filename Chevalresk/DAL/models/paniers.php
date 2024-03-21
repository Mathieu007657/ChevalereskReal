<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
    public $ItemId;
    public $UserId;
    public $QuantiteAchat;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->UserId = 0;
        $this->QuantiteAchat = 0;
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
    public function setQuantiteAchat($quantiteAchat)
    {
        $this->QuantiteAchat = (int) $quantiteAchat;
    }
}