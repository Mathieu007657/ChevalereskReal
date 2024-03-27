<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';


if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);
PanierTable()->insert($item);