<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"])){
    redirect("illegalAction.php");
}

$id = (int) $_GET["id"];
$totalPrice = 0;
$panierItems = PanierTable()->findByidPanierPlayer($_SESSION["currentUserId"]);
$Joueur = JoueursTable()->get($id);
$solde = $Joueur->Solde;
foreach ($panierItems as $panierItem) {
    $item = ItemTable()->findById($panierItem->IdItem);
    $totalPrice += (int)$item->Prix * $panierItem->QuantiteAchat; 
}
echo "$totalPrice";
if($solde>=$totalPrice){
    $Joueur->setSolde($Joueur->Solde - $totalPrice);
    JoueursTable()->updateBuy($Joueur);
    redirect("Paniers.php?Payer=true");
}
else if($solde < $totalPrice){
    redirect("Paniers.php?Cher=true");
}
