<?php
include_once 'DAL/models/paniers.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';
include_once 'DAL/models/commentaire.php';

final class CommentaireTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Concocter());
    }
    public function addCommentaire($idItem, $idJoueur,$commentaire,$nbEtoile){
        $sql = "INSERT into Commentaires Values ($idItem,$idJoueur,$nbEtoile,$commentaire);";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
    public function deleteCommentaire($idItem,$idJoueur){
        return parent::delete2($idItem,$idJoueur);
    }
}