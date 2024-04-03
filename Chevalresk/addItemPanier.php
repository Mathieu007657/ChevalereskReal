<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);

$panierItem = PanierTable()->findItemInPanier($_SESSION["currentUserId"], $id);

if ($panierItem) {
    $panierItem->QuantiteAchat++;
    PanierTable()->update($panierItem);
} else {
    $panierItem = new Panier();
    $panierItem->setIdItem($id);
    $panierItem->setJoueurId($_SESSION["currentUserId"]);
    $panierItem->setQuantiteAchat(1);
    PanierTable()->insert($panierItem);
}

redirect("Paniers.php");
?>
