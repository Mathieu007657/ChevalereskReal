<?php

include_once 'DAL/models/record.php';
class Inventaire extends Record
{
    public $idItem;
    public $idJoueurs;
    public $QuantiteAchat;
   
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->idJoueurs = 0;
        $this->QuantiteAchat = 0;
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->idItem = (int) $itemId;
    }
    public function setUserId($userId)
    {
        $this->idJoueurs = (int) $userId;
    }
    public function setQuantiteInventaire($quantiteInventaire)
    {
        $this->QuantiteAchat = (int) $quantiteInventaire;
    }
}