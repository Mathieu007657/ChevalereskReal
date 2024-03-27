<?php
include_once 'DAL/models/paniers.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class JoueursTable extends MySQLTable
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

    public function insert($item)
    {
        parent::insert($item);
    }

    public function update($itemPanier)
    {
        $ItemToUpdate = $this->get2($itemPanier->idItem,$itemPanier->idJoueurs);
        if ($ItemToUpdate != null) {
            parent::update($itemPanier);
        }
    }
    public function delete($id)
    {
        $userToRemove = $this->get($id);

        if ($userToRemove != null) {
            $userId = $userToRemove->Id;
            unlink($userToRemove->Avatar);
            return parent::delete($id);
        }
        return false;
    }
}