<?php
include_once 'DAL/models/paniers.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';
include_once 'DAL/models/concocter.php';

final class concocterTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Concocter());
    }
    
    public function AjoutdePotionDansInventaire($idPlayer,$idItem){
        $sql = "INSERT INTO Inventaires (idJoueurs,idItem,QuantiteAchat) VALUES ($idPlayer,$idItem,1)";
        return $this->_DB->nonQuerySqlCmd($sql);
    }

}