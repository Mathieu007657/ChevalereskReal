<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
<<<<<<< HEAD
    public $ItemId;
    public $JoueurId;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->ItemId = 0;
        $this->JoueurId = 0;
=======
    public $idItem;
    public $idJoueurs;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->idItem = 0;
        $this->idJoueurs = 0;
>>>>>>> b731078cfd03f22e41dbed25680b65da62c953fc
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
<<<<<<< HEAD
    public function setJoueurId($JoueurId){
        $this->JoueurId = (int) $JoueurId;
    }
    //GET User ID
    public function getJoueurId(){
        return $this->JoueurId;
=======
    public function setidJoueurs($userId){
        $this->idJoueurs = (int) $userId;
    }
    //GET User ID
    public function getidJoueurs(){
        return $this->idJoueurs;
>>>>>>> b731078cfd03f22e41dbed25680b65da62c953fc
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