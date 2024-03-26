<?php

include_once 'DAL/models/record.php';
class Item extends Record
{
    public $ItemId;
    public $Image;

   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Image ="";
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
}