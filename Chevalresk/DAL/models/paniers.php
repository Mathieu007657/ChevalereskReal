<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
    public $ItemId;
    public $JoueurId;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->ItemId = 0;
        $this->JoueurId = 0;
        $this->QuantiteAchat = 0;
        parent::__construct($recordData);
    }
    //SET Item ID
    public function setItemId($ItemId){
        $this->ItemId = (int) $ItemId;
    }
    //GET Item ID
    public function getItemId(){
        return $this->ItemId;
    }
    //SET User ID
    public function setJoueurId($JoueurId){
        $this->JoueurId = (int) $JoueurId;
    }
    //GET User ID
    public function getJoueurId(){
        return $this->JoueurId;
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