<?php

include_once 'DAL/models/record.php';
class Arme extends Record
{
    public $ItemId;
    public $Description;
    public $Efficacite;
    public $Genre;
   
    public function __construct($recordData = null)
    {
        $this->ItemId = 0;
        $this->Description = '';
        $this->Efficacite = '';
        $this->Genre = '';
        $this->setCompareKey('CreationDate');
        parent::__construct($recordData);
    }
    public function setUserId($userId)
    {
        $this->UserId = (int) $userId;
    }
    public function setItemId($photoId)
    {
        $this->ItemId = (int) $photoId;
    }
}