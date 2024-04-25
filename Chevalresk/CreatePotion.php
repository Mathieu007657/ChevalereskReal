<?php
require 'DAL/MySQLDataBase.php';
require 'DAL/ChevalereskDB.php';
include 'DAL/models/inventaire.php';


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
        $inv = new Inventaire(); //Créer nouvelle object Inventaire
        $inv->setidItem($idElem); // Set l'id item à celle de l'élément
        $inv->setQuantiteAchat($QuantitéAcheter - $Quantity); // Set la quantité a l'ancien - la quantité de la potion
        InventaireTable()->updateInv($inv); //Update L'inventaire
    }
    else{
        InventaireTable()->deleteInv($idElem,$_SESSION['currentUserId']);
    }
}
redirect('Panoramix.php');