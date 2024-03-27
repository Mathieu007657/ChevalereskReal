<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';


if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);

//implémenter que ça va chercher le id
$user = JoueursTable()->get(0);
PanierTable()->insert($item);
redirect('Paniers.php');