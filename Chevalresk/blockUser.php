<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
adminAccess();

$user = UsersTable()->get((int) $_GET["id"]);
$user->setBlocked($user->isBlocked() ? 0 : 1);
UsersTable()->update($user);

redirect('manageUsers.php');