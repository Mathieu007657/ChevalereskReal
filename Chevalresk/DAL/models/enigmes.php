<?php

include_once 'DAL/models/record.php';
class Enigme extends Record
{
    public $EnigmeId;
    public $Enonce;
    public $TypeEnigme;
    public $Choix;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Enonce = '';
        $this->TypeEnigme = '';
        $this->Choix = '';
        parent::__construct($recordData);
    }
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
    public function setEnonce($enonce)
    {
        $this->Enonce = $enonce;
    }
    public function setTypeEnigme($typeEnigme)
    {
        $this->TypeEnigme =$typeEnigme;
    }
    public function setChoix($choix)
    {
        $this->Choix = $choix;
    }
}