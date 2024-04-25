<?php
require 'DAL/MySQLDataBase.php';
require 'DAL/ChevalereskDB.php';
include 'php/sessionManager.php';
include 'php/date.php';


//Insérer potion inventaire joueur
$idItem = $_GET["id"]; //idItem de la potion à ajouter
ConcocterTable()->AjoutdePotionDansInventaire($_SESSION['currentUserId'],$idItem);//Ajout de potion dans l'inventaire

//chercher les matériaux et quantite de chaque
$listElement = ConcocterTable()->selectWhere("Potions_idItem = $idItem"); //Liste des elements de la potion
foreach ($listElement as $elem) {
    $Quantity = $elem->Quantite; //Quantité d'élément utilisée 
    $idElem = $elem->Elements_idItem; //id de l'élément

    $QuantitéAcheter = InventaireTable()->FindSpecificItem($_SESSION['currentUserId'],$idElem)[0]->QuantiteAchat; //Get quantité d'élément dans l'inventaire du joueur

    if ($QuantitéAcheter > $Quantity){
        InventaireTable()->UpdateInvWithStr($QuantitéAcheter - $Quantity,$idElem); //Update L'inventaire
    }
    else{
        InventaireTable()->deleteInv($idElem,$_SESSION['currentUserId']);
    }
}
redirect('Panoramix.php');