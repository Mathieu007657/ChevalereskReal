<?php

include_once 'DAL/models/record.php';

class Joueur extends Record
{
    public $JoueurId;
    public $Name;
    public $Prename;
    public $Alias;
    public $Email;
    public $Password;
    public $Avatar;
    public $Solde;
    public $AccessType = 0; // user => 0 , admin => 1
    public function __construct($recordData = null)
    {
        $this->JoueurId = 0;
        $this->Name = "";
        $this->Prename = "";
        $this->Alias = "";
        $this->Email = "";
        $this->Password = "";
        $this->Solde=0;
        $this->Avatar = "";
        $this->AccessType = 0;
        $this->setUniqueKey('JoueurId');
        //$this->setUniqueKey('Email');
        //$this->setUniqueKey('Alias');
        parent::__construct($recordData);
    }
    public function setJoueurId($JoueurId)
    {
        $this->JoueurId = (int) $JoueurId;
    }
    public function setName($name)
    {
        $this->Name = $name;
    }
    public function setSolde($solde)
    {
        $this->Solde=$solde;
    }
    public function setPrename($prename)
    {
        $this->Prename = $prename;
    }
    public function setAlias($alias)
    {
        $this->Alias = $alias;
    }
    public function setEmail($email)
    {
        $this->Email = $email;
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
    public function setAccessType($accessType)
    {
        $this->AccessType = (int) $accessType;
    }
    public function isAdmin()
    {
        return $this->AccessType == 1;
    }
}