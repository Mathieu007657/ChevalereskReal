<?php

include_once 'DAL/models/record.php';
class Armure extends Record
{
    public $ItemId;
    public $Taille;
    public $Matiere;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Taille = '';
        $this->Matiere = '';
        parent::__construct($recordData);
    }
    public function setItemId($photoId)
    {
        $this->ItemId = (int) $photoId;
    }
    public function setTaille($taille)
    {
        $this->Taille = (int) $taille;
    }
}