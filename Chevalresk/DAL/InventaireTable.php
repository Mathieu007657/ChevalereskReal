<?php
include_once 'DAL/models/inventaire.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class InventaireTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Inventaire());
    }

    //À faire
    public function ItemInvenExist($item){
        $itemID = $item->getIdItem();
        $UserID = $item->getUserId();
        $user = $this->selectWhere("idItem = $itemID AND idJoueurs = $UserID");
        return isset($user[0]);
    }
    public function FindInvListPlayer($idPlayer){
        $user = $this->selectWhere("idJoueurs = $idPlayer");
        return $user;
    }

    public function insertInv($data){
        $sql = "INSERT INTO Inventaires (idJoueurs,idItem,QuantiteAchat) VALUES ($data->idJoueurs,$data->IdItem,$data->QuantiteAchat)";
        return $this->_DB->nonQuerySqlCmd($sql);
    }

    public function updateInv($data){
        $idJoueur = $_SESSION["currentUserId"];
        $sql = "UPDATE Inventaires SET QuantiteAchat = $data->QuantiteAchat WHERE idItem = $data->IdItem AND idJoueurs = $idJoueur";
        return $this->_DB->nonQuerySqlCmd($sql);
    }

    //Delete 1 item d'un joueur dans le paniers
    public function deleteInv($id1,$id2){
        return parent::delete2($id1,$id2);
    }
    //Delete tout les items d'un joueur
    public function deleteAllInv($idJoueur){
        parent::deleteWhere("idJoueurs = $idJoueur");
    }

}