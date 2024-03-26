<?php

include_once 'DAL/models/record.php';
class Item extends Record
{
    public $ItemId;
    public $Name;
    public $QuantiteStock;
    public $Prix;
    public $TypeItem;
    public $Photo;
    public $FlagDispo;

   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Name="";
        $this->QuantiteStock=0;
        $this->Prix =0;
        $this->TypeItem="";
        $this->FlagDispo="";
        $this->Photo ="";
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
}