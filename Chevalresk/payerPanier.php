<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
if (!isset($_GET["id"]))
    redirect("illegalAction.php");

$id = (int) $_GET["id"];
$totalPrice = 0;
$panierItems = PanierTable()->findByidPanierPlayer($_SESSION["currentUserId"]);
$Joueur = JoueursTable()->get($id);
$solde = $Joueur->Solde;
foreach ($panierItems as $panierItem) {
    $item = ItemTable()->findById($panierItem->IdItem);
    $totalPrice += $item->Prix;
}
if($solde>=$totalPrice){
    foreach ($panierItems as $panierItem) {

    }
    //redirect("Paniers.php?Payer=true");
}
else if($solde < $totalPrice){
    //redirect("Paniers.php?Cher=true");
}
echo "Prix total du panier : " . $totalPrice . " solde joueur" . $solde;
?>