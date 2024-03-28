<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
require 'DAL/ChevalereskDB.php';


$id = 0;
$password = null;
$avatar = "images/no-avatar.png";
$userName = "";
$isAdmin = 0;
function EmailExist($email){
    if (isset($email)) {
        $user = JoueursTable()->findByEmail($email);
        if ($user == null)
            return false;
        $GLOBALS["id"] = $user->Id;
        $GLOBALS["userName"] = $user->Name;
        $GLOBALS["avatar"] = $user->Avatar;
        $GLOBALS["password"] = $user->Password;
        $GLOBALS["isAdmin"] = $user->isAdmin();
        return true;
    }
    return false;
}
function passwordOk($password){
   return JoueursTable()->userValid($_POST['Email'], $password);
}

if (isset($_POST['submit'])) {
    $validUser = true;
    $_SESSION['Email'] = sanitizeString($_POST['Email']);
    if (!EmailExist($_SESSION['Email'])) {
        $validUser = false;
        $_SESSION['EmailError'] = 'Ce courriel n\'existe pas';
    }
    if ($isBlocked) {
        $validUser = false;
        $_SESSION['EmailError'] = 'Votre compte a été blocké par le modérateur';
    }
    if (!passwordOk(sanitizeString($_POST['Password']))) {
        $validUser = false;
        $_SESSION['passwordError'] = 'Mot de passe incorrect';
    }
    if ($validUser) {
        $User = JoueursTable()->findByEmail($_SESSION['Email']);

        $_SESSION['validUser'] = true;
        $_SESSION['isAdmin'] = $User->isAdmin();
        $_SESSION['currentUserId'] = $User->UserId;
        $_SESSION['userName'] = $User->Name;
        $_SESSION['avatar'] = $User->Avatar;
        $_SESSION["photoSortType"] = "date";
        redirect('itemsList.php');
    }
}

redirect('loginForm.php');
