<?php

include_once 'DAL/models/record.php';
class Enigme extends Record
{
    public $idEnigme;
    public $Enonce;
    public $Difficulte;
    public $recompense;
    public $estPigee;
    public $TypeEnigme;

   
    public function __construct($recordData = null)
    {
        $this->idEnigme=0;
        $this->Enonce = '';
        $this->Difficulte='';
        $this->recompense=0;
        $this->estPigee='';
        $this->TypeEnigme='';
        parent::__construct($recordData);
    }
    public function setDifficulte($Difficulte){
        $this->Difficulte=$Difficulte;
    }
    public function setTypeEnigme($TypeEnigme){
        $this->TypeEnigme=$TypeEnigme;
    }
    public function setrecompense($Recompense){
        $this->recompense=(int) $Recompense;
    }
    public function setestPigee($estPigee){
        $this->estPigee=$estPigee;
    }
    public function setidEnigme($IdEnigme)
    {
        $this->idEnigme = (int) $IdEnigme;
    }
    public function setEnonce($enonce)
    {
        $this->Enonce = $enonce;
    }
}