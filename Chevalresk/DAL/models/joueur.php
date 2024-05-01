<?php

include_once 'DAL/models/record.php';

class Joueur extends Record
{
    public $JoueurId;
    public $nom;
    public $prenom;
    public $Alias;
    public $Courriel;
    public $Password;
    public $Niveau; 

    public $Avatar;
    public $Solde;
    public $estAdmin = 0; // user => 0 , admin => 1
    public $estAlch = 0; // n'est pas alchimiste => 0 , est alchimiste => 1
    public $QuestRep;
    public $PotionMade; 
    public function construct($recordData = null)
    {
        $this->JoueurId=0;
        $this->nom = "";
        $this->prenom = "";
        $this->Alias = "";
        $this->Courriel = "";
        $this->Password = "";
        $this->Solde=1000;
        $this->Avatar = "";
        $this->estAdmin = 0;
        $this->estAlch = 0;
        $this->QuestRep = 0;
        $this->PotionMade = 0;
        $this->Niveau = "";
        $this->setUniqueKey('JoueurId');
        //$this->setUniqueKey('Email');
        //$this->setUniqueKey('Alias');
        parent::__construct($recordData);
    }
    public function setQuestRep($QuestRep){
        $this->QuestRep=$QuestRep;
    }
    public function setJoueurId($id){
        $this->JoueurId=$id;
    }
    public function setnom($name)
    {
        $this->nom = $name;
    }
    public function setSolde($solde)
    {
        $this->Solde=$solde;
    }
    public function setprenom($prename)
    {
        $this->prenom = $prename;
    }
    public function setAlias($alias)
    {
        $this->Alias = $alias;
    }
    public function setCourriel($email)
    {
        $this->Courriel = $email;
    }
    public function setNiveau($niveau){
        $this->Niveau = (string) $niveau;
    }
    public function setPassword($password)
    {
        $this->Password = $password;
    }
    public function setAvatar($avatar)
    {
        $this->Avatar = $avatar;
    }
    public function getAvatar(){
        return $this->Avatar;
    }
    public function setestAlch($val){
        $this->estAlch=$val;
    }
    public function setAccessType($accessType)
    {
        $this->estAdmin = (int) $accessType;
    }
    public function setPotionMade($val){
        $this->PotionMade = (int) $val;
    }
    public function isAdmin(){
        return $this->estAdmin == 1;
    }
    public function isAlchi(){
        return $this->estAlch == 1;
    }
}