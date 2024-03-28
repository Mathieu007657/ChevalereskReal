<?php
include_once 'DAL/models/items.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

const PhotoPath= "data/images/photoItem/";
final class ItemTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Item());
    }
    public function itemExist($id)
    {
        $item = $this->selectWhere("idItem = '$id'");
        return isset($item[0]);
    }
    public function findById($id)
    {
        $item = $this->selectWhere("idItem = $id");
        if (isset($item[0]))
            return $item[0];
        return null;
    }
    public function insert($item)
    {
        $item->setPhoto(saveImage(PhotoPath, $item->Photo));
        parent::insert($item);
    }
    public function update($item)
    {
        $itemToUpdate = $this->get($item->Id);
        if ($itemToUpdate != null) {
            $item->setAvatar(saveImage(PhotoPath, $item->Photo, $itemToUpdate->Photo));
            parent::update($item);
        }
    }
    public function delete($itemId)
    {
        $itemToRemove = $this->get($itemId);
        if ($itemToRemove != null) {
            $itemId = $itemToRemove->ItemId;
            unlink($itemToRemove->Photo);
            return parent::delete($itemId);
        }
        return false;
    }
}

?>