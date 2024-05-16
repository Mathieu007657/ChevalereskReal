<?php
include_once 'DAL/models/joueur.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

const avatarsPath = "data/images/avatars/";

final class JoueursTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Joueur());
    }
    public function emailExist($email)
    {
        $user = $this->selectWhere("courriel = '$email'");
        return isset($user[0]);
    }
    public function GetAlchi($id){
        $sql = "SELECT estAlch FROM Joueurs WHERE JoueurId = $id";
        return $this->_DB->QuerySqlCmd($sql)[0][0];
    }
    public function findByEmail($email)
    {
        $user = $this->selectWhere("courriel = '$email'");
        if (isset($user[0]))
            return $user[0];
        return null;
    }
    public function userValid($email, $motdepasse)
    {
        $user = $this->selectWhere("courriel = '$email'");
        if (isset($user[0])) {
            if($motdepasse == $user[0]->Password)
            {
                return true;
            }
        }
        return false;
    }
    public function insert($user)
    {
        $user->setAvatar(saveImage(avatarsPath, $user->Avatar));
        parent::insert($user);
    }
    public function ajouterJoueur($Joueur)
    {
        parent::insertJoueur($Joueur);
    }
    public function updateJoueur($id,$Alias,$password,$Avatar,$Courriel)
    {
        if($Avatar=="")
        {
            $Avatar="images/no-avatar.png";
        }
        $sql = "UPDATE dbchevalersk8.Joueurs SET Courriel = '$Courriel', Alias = '$Alias', Password = '$password', Avatar = '$Avatar' WHERE JoueurId = $id;";
        echo $sql;
        $this->_DB->nonQuerySqlCmd($sql);
    }
    public function updateJoueusr($user){
        
    }
    public function updateBuy($user)
    {        
        parent::updateJoueurPayer($user);
                
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