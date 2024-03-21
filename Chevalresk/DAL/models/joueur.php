<?php

include_once 'DAL/models/record.php';

class Joueur extends Record
{
    public $Name;
    public $Prename;
    public $Alias;
    public $Email;
    public $Password;
    public $Avatar;
    public $AccessType = 0; // user => 0 , admin => 1
    public function __construct($recordData = null)
    {
        $this->Name = "";
        $this->Prename = "";
        $this->Alias = "";
        $this->courriel = "";
        $this->motdepasse = "";
        $this->Avatar = "";
        $this->AccessType = 0;
        $this->setCompareKey('Name');
        $this->setUniqueKey('Email');
        parent::__construct($recordData);
    }
    public function setName($name)
    {
        $this->Name = $name;
    }
    public function setPrename($prename)
    {
        $this->Prename = $prename;
    }
    public function setAlias($alias)
    {
        $this->Alias = $alias;
    }
    public function setCourriel($email)
    {
        $this->Courriel = $email;
    }
    public function setmotdepasse($password)
    {
        $this->motdepasse = $password;
    }
    public function setAvatar($avatar)
    {
        $this->Avatar = $avatar;
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