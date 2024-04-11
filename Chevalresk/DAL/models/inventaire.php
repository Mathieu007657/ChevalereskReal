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
    public function setidItem($itemId)
    {
        $this->idItem = (int) $itemId;
    }
    public function setidJoueurs($userId)
    {
        $this->idJoueurs = (int) $userId;
    }
    public function setQuantiteAchat($quantiteInventaire)
    {
        $this->QuantiteAchat = (int) $quantiteInventaire;
    }
}