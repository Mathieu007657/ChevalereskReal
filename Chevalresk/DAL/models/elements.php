<?php

include_once 'DAL/models/record.php';
class Element extends Record
{
    public $idItem;
    public $Rarete;
    public $dangerosite;
   
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->Rarete = '';
        $this->dangerosite = '';
        parent::__construct($recordData);
    }
    public function setidItem($itemId)
    {
        $this->idItem = (int) $itemId;
    }
    public function setRarete($Rarete)
    {
        $this->Rarete = (int) $Rarete;
    }
    public function setdangerosite($dangerosite)
    {
        $this->dangerosite = (int) $dangerosite;
    }
}