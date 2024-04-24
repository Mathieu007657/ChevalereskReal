<?php

include_once 'DAL/models/record.php';
class Concocter extends Record
{
    public $Potions_idItem;
    public $Elements_idItem;
    public $Quantite;
   
    public function __construct($recordData = null)
    {
        $this->Potions_idItem = 0;
        $this->Elements_idItem = 0;
        $this->Quantite = '';
        parent::__construct($recordData);
    }
    public function setPotions_idItem($potions_idItem)
    {
        $this->Potions_idItem = (int) $potions_idItem;
    }
    public function setElements_idItem($elements_idItem)
    {
        $this->Elements_idItem = (int) $elements_idItem;
    }
    public function setQuantite($quantite)
    {
        $this->Quantite = (int) $quantite;
    }
}