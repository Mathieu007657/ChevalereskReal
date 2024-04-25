<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);

$panierItem = PanierTable()->findItemInPanier($_SESSION["currentUserId"], $id);
if (isset($panierItem)) {
    $panierItem->QuantiteAchat++;
    PanierTable()->updatePanier($panierItem);
} else {
    $panierItem = new Panier();
    $panierItem->setIdItem($id);
    $idpp=$_SESSION["currentUserId"];
    $panierItem->setJoueurId($idpp);
    $panierItem->setQuantiteAchat(1);
    PanierTable()->insertPanier($panierItem);
}
redirect("Paniers.php");
