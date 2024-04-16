<?php

include_once 'DAL/models/record.php';
class Enigme extends Record
{
    public $IdEnigme;
    public $Enonce;
    public $Difficulte;
    public $Recompense;
    public $estPigee;

   
    public function __construct($recordData = null)
    {
        $this->IdEnigme=0;
        $this->Enonce = '';
        $this->Difficulte='';
        $this->Recompense=0;
        $this->estPigee='';
        parent::__construct($recordData);
    }
    public function setDifficulte($Difficulte){
        $this->Difficulte=$Difficulte;
    }
    public function setRecompense($Recompense){
        $this->Recompense=(int) $Recompense;
    }
    public function setestPigee($estPigee){
        $this->estPigee=$estPigee;
    }
    public function setIdEnigme($IdEnigme)
    {
        $this->IdEnigme = (int) $IdEnigme;
    }
    public function setEnonce($enonce)
    {
        $this->Enonce = $enonce;
    }
}