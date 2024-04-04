<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"])) {
    redirect("illegalAction.php");
}

$itemId = (int) $_GET["id"];
$userId = $_SESSION["currentUserId"];
PanierTable()->deletePanier($itemId, $userId);
redirect("Paniers.php");

