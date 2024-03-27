<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
    public $idItem;
    public $idJoueurs;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->idItem = 0;
        $this->idJoueurs = 0;
        $this->QuantiteAchat = 0;
        parent::__construct($recordData);
    }
    //SET Item ID
    public function setItemId($itemId){
        $this->idItem = (int) $itemId;
    }
    //GET Item ID
    public function getItemId(){
        return $this->idItem;
    }
    //SET User ID
    public function setidJoueurs($userId){
        $this->idJoueurs = (int) $userId;
    }
    //GET User ID
    public function getidJoueurs(){
        return $this->idJoueurs;
    }
    //SET Quantité Achat
    public function setQuantiteAchat($quantiteAchat){
        $this->QuantiteAchat = (int) $quantiteAchat;
    }
    //GET Quantité Achat
    public function getQuantiteAchat(){
        return $this->QuantiteAchat;
    }
}