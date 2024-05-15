<?php

include_once 'DAL/models/record.php';
class Commentaire extends Record
{
    public $idItem;
    public $idJoueur;
    public $lecommentaire;
    public $nbEtoiles;
   
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->idJoueur = 0;
        $this->nbEtoiles = 0;
        $this->lecommentaire = '';
        parent::__construct($recordData);
    }
    public function setidItem($itemId)
    {
        $this->idItem = (int) $itemId;
    }
    public function setidJoueur($JoueurId)
    {
        $this->idJoueur = (int) $JoueurId;
    }
    public function setlecommentaire($commentaire)
    {
        $this->lecommentaire = (int) $commentaire;
    }
    public function setnbEtoiles($nbEtoiles)
    {
        $this->nbEtoiles = (int) $nbEtoiles;
    }
}