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
    public function findByEmail($email)
    {
        $user = $this->selectWhere("courriel = '$email'");
        if (isset($user[0]))
            return $user[0];
        return null;
    }
    public function userValid($email, $password)
    {
        $user = $this->selectWhere("courriel = '$email'");
        if (isset($user[0])) {
            return password_verify($password, $user[0]->motdepasse);
        }
        return false;
    }
    public function insert($user)
    {
        $user->setAvatar(saveImage(avatarsPath, $user->Avatar));
        parent::insert($user);
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