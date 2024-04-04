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

    public function insert($item){
        parent::insert($item);
    }

    public function update($itemPanier){
        $ItemToUpdate = $this->get2($itemPanier->IdItem,$itemPanier->idJoueurs);
        if ($ItemToUpdate != null) {
            parent::update($itemPanier);
        }
    }
    public function deletePanier($id1,$id2){
        return parent::delete2($id1,$id2);
    }
    

    public function findByidPanierPlayer($id){
        return $this->selectById($id);       
    }
    public function findItemInPanier($userId, $itemId){
        $item = $this->selectWhere("idItem = $itemId AND idJoueurs = $userId");
        return isset($item[0]) ? $item[0] : null;
    }
}