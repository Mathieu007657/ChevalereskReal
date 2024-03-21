<?php

include_once 'DAL/models/record.php';
class Concocter extends Record
{
    public $Potions_ItemId;
    public $Elements_ItemId;
    public $Quantite;
   
    public function __construct($recordData = null)
    {
        $this->Potions_ItemId = 0;
        $this->Elements_ItemId = 0;
        $this->Quantite = '';
        parent::__construct($recordData);
    }
    public function setPotions_ItemId($potions_ItemId)
    {
        $this->Potions_ItemId = (int) $potions_ItemId;
    }
    public function setElements_ItemId($elements_ItemId)
    {
        $this->Elements_ItemId = (int) $elements_ItemId;
    }
    public function setQuantite($quantite)
    {
        $this->Quantite = (int) $quantite;
    }
}