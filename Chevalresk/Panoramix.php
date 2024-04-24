<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
$viewTitle = "Panoramix";
$ListPotionitem = ItemTable()->selectWhere("type = 'P'");
$viewContent =  "<div class='ZonePotion'>";
foreach ($ListPotionitem as $Potion) {
    $idPotion = $Potion->IdItem;
    $NamePotion = $Potion->Nom;
    $lienPhoto = $lienPhoto="data/images/photoItem/"."$Potion->Photo";
    $viewContent .= <<<HTML
        <div class="ZoneOnePotion">
            <div class="PotionRow">
                <div class="PanoramixPotionImage" style="background-image:url('$lienPhoto')" title="$NamePotion"></div>
                <h2 class="NamePotion">$NamePotion</h2>
            </div>
            <div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>
        
    HTML;
    $ElementDePotion = ConcocterTable()->selectWhere("Potions_idItem = $idPotion");
    $viewContent .= "<div class='ElementRow'>";
    foreach ($ElementDePotion as $elem) {
        $idElement = $elem->Elements_idItem;
        $quantity = $elem->Quantite;
        $User =  $_SESSION['currentUserId'];
        $element = InventaireTable()->FindSpecificItem($User,$idElement);
        $itemElem = ItemTable()->findById($idElement);
        $photoElem = $lienPhoto="data/images/photoItem/". $itemElem->Photo;
        $Name = $itemElem->Nom;
        $quantityelemPlayer = $element->QuantiteAchat;
        $viewContent .= <<<HTML
            <img src="$photoElem" title="$Name" alt="$Name" class="PanoramixElementImage"/>
        HTML;
        if($quantityelemPlayer >= $quantity){
            $viewContent .= <<<HTML
                <div class="NumQutElemGold">
                    <h3>$quantityelemPlayer/$quantity</h3>
                </div>
            HTML;
        }
        else{
            $viewContent .= <<<HTML
            <div class="NumQutElem">
                <h3>$quantityelemPlayer/$quantity</h3>
            </div>
        HTML;
        }
    }

    $viewContent .= "</div><button type='button' class='btnCraft'>Craft</button></div>";
}
$viewContent .= "</div>";
include "views/master.php";
