<?php

include_once 'DAL/models/record.php';
class Arme extends Record
{
    public $idItem;
    public $description;
    public $efficacite;
    public $genre;
   
    public function __construct($recordData = null)
    {
        $this->idItem = 0;
        $this->description = '';
        $this->efficacite = '';
        $this->genre = '';
        parent::__construct($recordData);
    }
    public function setidItem($itemId)
    {
        $this->idItem = (int) $itemId;
    }
    public function setdescription($description)
    {
        $this->description = (int) $description;
    }
    public function setefficacite($efficacite)
    {
        $this->efficacite = (int) $efficacite;
    }
    public function setgenre($genre)
    {
        $this->genre = (int) $genre;
    }
}