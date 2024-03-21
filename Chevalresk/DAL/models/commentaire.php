<?php

include_once 'DAL/models/record.php';
class Commentaire extends Record
{
    public $ItemId;
    public $UserId;
    public $Commentaire;
    public $NbEtoiles;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->UserId = 0;
        $this->Commentaire = '';
        $this->NbEtoiles = 0;
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
    public function setUserId($userId)
    {
        $this->UserId = (int) $userId;
    }
    public function setCommentaire($commentaire)
    {
        $this->Commentaire = (int) $commentaire;
    }
    public function setNbEtoiles($nbEtoiles)
    {
        $this->NbEtoiles = (int) $nbEtoiles;
    }
}