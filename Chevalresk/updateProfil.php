<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
userAccess();
JoueursTable()->update(new Joueur($_POST));
$user = JoueursTable()->get($_SESSION['currentUserId']);
$_SESSION["name"] = $user->Name;
$_SESSION["avatar"] = $user->Avatar;
$_SESSION['Email'] = $user->Email;
redirect('photosList.php');