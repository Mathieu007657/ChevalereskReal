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
    public function update($user)
    {
        $userToUpdate = $this->get($user->Id);
        if ($user->motdepasse == "")
            $user->motdepasse = $userToUpdate->motdepasse;
        if ($userToUpdate != null) {
            $user->setAvatar(saveImage(avatarsPath, $user->Avatar, $userToUpdate->Avatar));
            parent::update($user);
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

?>