<?php
include_once 'DAL/models/paniers.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class PaniersTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Panier());
    }
    public function ItemPanierExist($item){
        $itemID = $item->getIdItem();
        $UserID = $item->getUserId();
        $user = $this->selectWhere("idItem = $itemID AND idJoueurs = $UserID");
        return isset($user[0]);
    } 

    public function insertPanier($data){
        $sql = "INSERT INTO Paniers (idItem,idJoueurs,quantiteAchat) VALUES ($data->IdItem,$data->idJoueurs,$data->QuantiteAchat)";
        return $this->_DB->nonQuerySqlCmd($sql);
    }

    public function updatePanier($data){
        $idJoueur = $_SESSION["currentUserId"];
        $sql = "UPDATE Paniers SET QuantiteAchat = $data->QuantiteAchat WHERE idItem = $data->IdItem AND idJoueurs = $idJoueur";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
    //Delete 1 item d'un joueur dans le paniers
    public function deletePanier($id1,$id2){
        return parent::delete2($id1,$id2);
    }
    //Delete tout les items d'un joueur
    public function deleteAllPanier($idJoueur){
        parent::deleteWhere("idJoueurs = $idJoueur");
    }

    public function findByidPanierPlayer($id){
        return $this->selectByIdPanier($id);       
    }
    public function findItemInPanier($userId, $itemId){
        $item = $this->selectWhere("idItem = $itemId AND idJoueurs = $userId");
        return isset($item[0]) ? $item[0] : null;
    }
}