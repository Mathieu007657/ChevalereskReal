<?php

include_once 'DAL/models/record.php';
class Armure extends Record
{
    public $idItem;
    public $taille;
    public $matiere;
   
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->taille = '';
        $this->matiere = '';
        parent::__construct($recordData);
    }
    public function setidItem($photoId)
    {
        $this->idItem = (int) $photoId;
    }
    public function settaille($taille)
    {
        $this->taille = (int) $taille;
    }
    public function setmatiere($Matiere){
        $this->matiere = $Matiere;
    }
}