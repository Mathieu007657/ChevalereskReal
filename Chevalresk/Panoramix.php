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
                <div class="PanoramixPotionImage" style="background-image:url('$lienPhoto')" title="$NamePotion / $idPotion"></div>
                <h2 class="NamePotion">$NamePotion</h2>
            </div>
            <div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>
        
    HTML;
    $ElementDePotion = ConcocterTable()->selectWhere("Potions_idItem = $idPotion");
    $viewContent .= "<div class='ElementRow'>";
    $NumberOfGold = 0;
    foreach ($ElementDePotion as $elem) {
        $idElement = $elem->Elements_idItem;
        $quantity = $elem->Quantite;
        $User =  $_SESSION['currentUserId'];
        $element = InventaireTable()->FindSpecificItem($User,$idElement);
        $itemElem = ItemTable()->findById($idElement);
        $photoElem = $lienPhoto="data/images/photoItem/". $itemElem->Photo;
        $Name = $itemElem->Nom;
        if (isset($element[0])){
            $quantityelemPlayer = $element[0]->QuantiteAchat;
        }
        else{
            $quantityelemPlayer = 0;
        }
        $viewContent .= <<<HTML
            <div>
            <img src="$photoElem" title="$Name" alt="$Name" class="PanoramixElementImage"/>
        HTML;
        if($quantityelemPlayer >= $quantity){
            $NumberOfGold++;
            $viewContent .= <<<HTML
                <div class="NumQutElemGold">
                    <h3>$quantityelemPlayer/$quantity</h3>
                </div>
                </div>
            HTML;
        }
        else{
            $viewContent .= <<<HTML
            <div class="NumQutElem">
                <h3>$quantityelemPlayer/$quantity</h3>
            </div>
            </div>
        HTML;
        }
    }
    if ($NumberOfGold == 3){
        $viewContent .= "
            </div>
            <a class='btnCraft' href='CreatePotion.php?id=$idPotion'>Craft</a>
            </div>";
    }
    else{
        $viewContent .= "</div><h3>Vous n'avez pas assez de matériaux pour le fabriquer</h3></div>";
    }
}
$viewContent .= "</div>";
include "views/master.php";
