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
    public function setItemId($itemId)
    {
        $this->ItemId = (int) $itemId;
    }
    public function setDescription($description)
    {
        $this->Description = (int) $description;
    }
    public function setEfficacite($efficacite)
    {
        $this->Efficacite = (int) $efficacite;
    }
    public function setGenre($genre)
    {
        $this->Genre = (int) $genre;
    }
}