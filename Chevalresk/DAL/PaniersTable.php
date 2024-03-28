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
        $itemID = $item->getItemId();
        $UserID = $item->getUserId();
        $user = $this->selectWhere("idItem = $itemID AND idJoueurs = $UserID");
        return isset($user[0]);
    }

    public function insert($item){
        parent::insert($item);
    }

    public function update($itemPanier){
        $ItemToUpdate = $this->get2($itemPanier->idItem,$itemPanier->idJoueurs);
        if ($ItemToUpdate != null) {
            parent::update($itemPanier);
        }
    }
    public function deletePanier($id1,$id2){
        $userToRemove = $this->get2($id1,$id2);

        if ($userToRemove != null) {
            $userId = $userToRemove->Id;
            unlink($userToRemove->Avatar);
            return parent::delete2($id1,$id2);
        }
        return false;
    }

    public function findByidPanierPlayer($id){
        return $this->selectWhere("idJoueurs = $id");       
    }
}