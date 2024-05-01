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
    public function findInfosArmures($table,$id)
    {
        $sql = "SELECT * FROM dbchevalersk8.$table WHERE idItem = $id;";
        $data = $this->_DB->querySqlCmd($sql);
        $infos = 'Taille: ';
        $infos .= $data[0]['taille'];
        $infos .= '<br><br>';
        $infos .= 'Matière: ';
        $infos .= $data[0]['matiere'];
        $infos .= '<br><br>';
        return $infos;
    }
    public function findInfosArmes($table,$id)
    {
        $sql = "SELECT * FROM dbchevalersk8.$table WHERE idItem = $id;";
        $data = $this->_DB->querySqlCmd($sql);
        $infos = 'Genre: ';
        $infos .= $data[0]['genre'];
        $infos .= '<br><br>';
        $infos .= 'Efficacité: ';
        $infos .= $data[0]['efficacite'];
        $infos .= '<br><br>';
        $infos .= 'Description: ';
        $infos .= $data[0]['description'];
        return $infos;
    }
    public function findInfosPotions($table,$id)
    {
        $sql = "SELECT * FROM dbchevalersk8.$table WHERE idItem = $id;";
        $data = $this->_DB->querySqlCmd($sql);
        $infos = 'Durée: ';
        $infos .= $data[0]['duree'];
        $infos .= ' secondes';
        $infos .= '<br><br>';
        $infos .= 'Effet: ';
        $infos .= $data[0]['effet'];
        $infos .= '<br><br>';
        $infos .= 'Type: ';
        $infos .= $data[0]['TypePotion'];
        return $infos;
    }
    public function findInfosElements($table,$id)
    {
        $sql = "SELECT * FROM dbchevalersk8.$table WHERE idItem = $id;";
        $data = $this->_DB->querySqlCmd($sql);
        $infos = 'Rareté de l\'élément: ';
        $infos .= $data[0]['Rarete'];
        $infos .= '<br><br>';
        $infos .= 'Dangerosité de l\'élément: ';
        $infos .= $data[0]['dangerosite'];
        $infos .= '<br><br>';
        return $infos;
    }
    public function findType($id)
{
    $tableName = 'Items';
    $sql = "SELECT type FROM dbchevalersk8.$tableName WHERE idItem = $id;";
    $data = $this->_DB->querySqlCmd($sql);
    
    if ($data) {
        $type = $data[0]['type']; // Assuming $data is a mysqli_result object
        switch ($type) {
            case 'A':
                return 'Armes';
            case 'R':
                return 'Armures';
            case 'P':
                return 'Potions';
            case 'E':
                return 'Elements';
            default:
                return '';
        }
    } else {
        // Handle database query failure
        return ''; // or throw an exception
    }
}
public function findAlch($id)
{
    $tableName = 'Joueurs';
    $sql = "SELECT estAlch FROM dbchevalersk8.$tableName WHERE JoueurId = $id;";
    $data = $this->_DB->querySqlCmd($sql);
    if($data[0]['estAlch'] == 1)
    {
        $data = 1;
    }
    else
    {
        $data = 0;
    }
    return $data;
}


    public function insert($item)
    {
        $item->setPhoto(saveImage(PhotoPath, $item->Photo));
        parent::insert($item);
    }
    public function update($item)
    {
        $itemToUpdate = $this->get($item->IdItem);
        if ($itemToUpdate != null) {
            $item->setAvatar(saveImage(PhotoPath, $item->Photo, $itemToUpdate->Photo));
            parent::update($item);
        }
    }
    public function delete($itemId)
    {
        $itemToRemove = $this->get($itemId);
        if ($itemToRemove != null) {
            $itemId = $itemToRemove->IdItem;
            unlink($itemToRemove->Photo);
            return parent::delete($itemId);
        }
        return false;
    }
}
