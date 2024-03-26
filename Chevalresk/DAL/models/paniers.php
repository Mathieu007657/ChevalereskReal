<?php

include_once 'DAL/models/record.php';
class Panier extends Record
{
    public $ItemId;
    public $UserId;
    public $QuantiteAchat;
   
    public function __construct($recordData = null){
        $this->ItemId = 0;
        $this->UserId = 0;
        $this->QuantiteAchat = 0;
        parent::__construct($recordData);
    }
    //SET Item ID
    public function setItemId($itemId){
        $this->ItemId = (int) $itemId;
    }
    //GET Item ID
    public function getItemId(){
        return $this->ItemId;
    }
    //SET User ID
    public function setUserId($userId){
        $this->UserId = (int) $userId;
    }
    //GET User ID
    public function getUserId(){
        return $this->UserId;
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