<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
adminAccess();

$user = JoueursTable()->get((int) $_GET["id"]);
$user->setAccessType($user->isAdmin() ? 0 : 1);
JoueursTable()->update($user);

redirect('manageUsers.php');