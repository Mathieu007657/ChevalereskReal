<?php

include_once 'DAL/models/record.php';
class Potion extends Record
{
    public $ItemId;
    public $Duree;
    public $Effet;
    public $TypePotion;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Duree = 0;
        $this->Effet = '';
        $this->TypePotion = '';
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
    public function setDuree($duree)
    {
        $this->Duree = (int) $duree;
    }
    public function setEffet($effet)
    {
        $this->Effet = $effet;
    }
    public function setGenre($typePotion)
    {
        $this->TypePotion = $typePotion;
    }
}