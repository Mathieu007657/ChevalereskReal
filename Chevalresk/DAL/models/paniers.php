<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
    public $IdItem;
    public $idJoueurs;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->IdItem = 0;
        $this->idJoueurs = 0;
        $this->QuantiteAchat = 0;
        parent::__construct($recordData);
    }
    //SET Item ID
    public function setIdItem($ItemId){
        $this->IdItem = (int) $ItemId;
    }
    //GET Item ID
    public function getIdItem(){
        return $this->IdItem;
    }
    //SET User ID
    public function setJoueurId($JoueurId){
        $this->idJoueurs = (int) $JoueurId;
    }
    //GET User ID
    public function getJoueurId(){
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