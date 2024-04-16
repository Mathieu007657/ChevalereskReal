<?php
include_once 'DAL/models/enigmes.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class EnigmesTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Enigme());
    }

    //À faire
    public function getEnigme(){

    }
    //À faire
    public function updateEnigme($data){
        $sql = "UPDATE  SET  = $data->";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
}