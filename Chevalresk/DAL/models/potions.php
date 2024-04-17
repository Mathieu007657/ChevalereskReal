<?php

include_once 'DAL/models/record.php';
class Potion extends Record
{
    public $itemId;
    public $duree;
    public $effet;
    public $TypePotion;
   
    public function __construct($recordData = null)
    {
        $this->itemId = 0;
        $this->duree = 0;
        $this->effet = '';
        $this->TypePotion = '';
        parent::__construct($recordData);
    }
    public function setitemId($itemId)
    {
        $this->itemId = (int) $itemId;
    }
    public function setduree($duree)
    {
        $this->duree = (int) $duree;
    }
    public function seteffet($effet)
    {
        $this->effet = $effet;
    }
    public function setTypePotion($TypePotion){
        $this->TypePotion = $TypePotion;
    }
}