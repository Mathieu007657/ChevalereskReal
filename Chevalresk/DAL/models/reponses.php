<?php

include_once 'DAL/models/record.php';
class Reponse extends Record
{
    public $ReponseId;
    public $LaReponse;
    public $EstBonne;
    public $EnigmeId;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->LaReponse = '';
        $this->EstBonne = '';
        $this->EnigmeId = 0;
        parent::__construct($recordData);
    }
    public function setReponseId($reponseId)
    {
        $this->ReponseId = (int) $reponseId;
    }
    public function setLaReponse($LaReponse)
    {
        $this->LaReponse = $LaReponse;
    }
    public function setEstBonne($EstBonne)
    {
        $this->EstBonne = $EstBonne;
    }
    public function setEnigmeId($EnigmeId)
    {
        $this->EnigmeId = (int) $EnigmeId;
    }
}