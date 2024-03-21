<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

adminAccess();

if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$user = JoueursTable()->get($id);
if (!$user)
    redirect("illegalAction.php");

    JoueursTable()->delete($id);
redirect('manageUsers.php');