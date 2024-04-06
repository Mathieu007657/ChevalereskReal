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
$QuantiteVendu = [];
$InsertionPourInv = [];
foreach ($panierItems as $panierItem) {
    $item = ItemTable()->findById($panierItem->IdItem);
    $totalPrice += (int)$item->Prix * $panierItem->QuantiteAchat; 
    array_push($QuantiteVendu,[$item->IdItem,$panierItem->QuantiteAchat]);
    array_push($InsertionPourInv,$item);
}

if($solde>=$totalPrice){
    //Update le solde de l'usager
    $Joueur->setSolde($Joueur->Solde - $totalPrice);
    JoueursTable()->updateBuy($Joueur);

    //Rajouter à son inventaire
    foreach($InsertionPourInv as $caseInv){
        InventaireTable()->insertInv($caseInv);   
    }

    //Vider son paniers et changer la quantité dans la table items
    foreach($QuantiteVendu as $tabitem){
        // $tabitem[0] = idItem dans le paniers du user | $tabitem[1] = la quantité que l'on va vendre
        $ItemsAssocier =  ItemTable()->get($tabitem[0]);
        $ItemsAssocier->setQuantite($ItemsAssocier->Quantite - $tabitem[1]);
    }
    PanierTable()->deleteAllPanier($Joueur->JoueurId);
    redirect("Paniers.php?Payer=true");
}
else if($solde < $totalPrice){
    redirect("Paniers.php?Cher=true");
}
