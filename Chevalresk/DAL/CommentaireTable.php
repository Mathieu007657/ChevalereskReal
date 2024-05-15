<?php
include_once 'DAL/models/paniers.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';
include_once 'DAL/models/commentaire.php';

final class CommentaireTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Commentaire());
    }
    public function addCommentaire($idItem, $idJoueur, $commentaire, $nbEtoile){
        $sql = "INSERT into dbchevalersk8.Commentaires (idItem, idJoueur, nbEtoile, commentaire) 
                VALUES ($idItem, $idJoueur, $nbEtoile, '$commentaire');";
        $this->_DB->querySqlCmd($sql);
    }
    public function getCommentaire($id){
        $sql = "SELECT * from dbchevalersk8.Commentaires where idCommentaires=$id;";
        $data = $this->_DB->querySqlCmd($sql);
        return $data[0];
    }
    public function getCommentairesForItem($idItem){
        $sql = "SELECT * from dbchevalersk8.Commentaires where idItem=$idItem;";
        $data = $this->_DB->querySqlCmd($sql);
        return $data;
    }
    public function deleteCommentaire($id){
        $sql = "DELETE FROM dbchevalersk8.Commentaires WHERE idCommentaires=$id";
        $this->_DB->nonQuerySqlCmd($sql);
    }
}
