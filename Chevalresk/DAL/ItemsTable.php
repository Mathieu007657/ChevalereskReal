<?php
include_once 'DAL/models/items.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class ItemTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Item());
    }
    public function itemExist($id)
    {
        $item = $this->selectWhere("ItemId = '$id'");
        return isset($item[0]);
    }
    public function findById($id)
    {
        $item = $this->selectWhere("ItemId = '$id'");
        if (isset($item[0]))
            return $item[0];
        return null;
    }
    public function insert($item)
    {
        $item->setAvatar(saveImage(avatarsPath, $item->Avatar));
        parent::insert($item);
    }
    public function update($item)
    {

    }
    public function delete($id)
    {
        $itemToRemove = $this->get($id);
        if ($itemToRemove != null) {
            $itemId = $itemToRemove->Id;
            unlink($itemToRemove->Avatar);
            return parent::delete($id);
        }
        return false;
    }
}

?>