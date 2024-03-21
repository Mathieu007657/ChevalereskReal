<?php

include_once 'DAL/models/record.php';
class Item extends Record
{
    public $UserId; 
    public $ItemId;
   
    public function __construct($recordData = null)
    {
        $this->UserId = 0;
        $this->ItemId = 0;
        parent::__construct($recordData);
    }
    public function setUserId($userId)
    {
        $this->UserId = (int) $userId;
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
}