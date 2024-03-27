<?php

include_once 'DAL/models/record.php';
class Item extends Record
{
    public $ItemId;
    public $Nom;
    public $Quantite;
    public $Prix;
    public $Type;
    public $Photo;
    public $FlagDispo;

   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Nom="";
        $this->Quantite=0;
        $this->Prix =0;
        $this->Type="";
        $this->FlagDispo="";
        $this->Photo ="";
        $this->setCompareKey('ItemId');
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
    public function setTypeItem($type)
    {
        $this->Type = $type;
    }
    public function setFlagDispo($FlagDispo)
    {
        $this->FlagDispo = $FlagDispo;
    }
    public function setQuantite($quantite)
    {
        $this->Quantite = (int) $quantite;
    }
    public function setNom($nom)
    {
        $this->Nom=$nom;
    }
    public function setPrix($prix)
    {
        $this->Prix=$prix;
    }

    public function setPhoto($photo)
    {
        $this->Photo = $photo;
    }
}