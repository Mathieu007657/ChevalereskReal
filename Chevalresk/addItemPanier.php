<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

adminAccess();

if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];

//implémenter que le get id fonctionne
$user = JoueursTable()->get(0);
if (!$user)
    redirect("illegalAction.php");

    JoueursTable()->delete($id);
redirect('Paniers.php');