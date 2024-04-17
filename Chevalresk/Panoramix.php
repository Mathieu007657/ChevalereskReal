<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
$viewTitle = "Panoramix";
$ListPotionitem = ItemTable()->selectWhere("type = 'P'");

foreach ($ListPotionitem as $Potion) {
    $idPotion = $Potion->IdItem;
    $NamePotion = $Potion->Nom;
    $lienPhoto = $lienPhoto="data/images/photoItem/"."$Potion->Photo";
    $viewContent =  "<div class='ZonePotion'>";
    $viewContent .= <<<HTML
        <div class="ZoneOnePotion">
            <div class="PotionRow">
                <div class="PanoramixPotionImage" style="background-image:url('$lienPhoto')" title="$NamePotion"></div>
                <h2 class="NamePotion">$NamePotion</h2>
            </div>
            <div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>
        </div>
    HTML;
    $ElementDePotion = ConcocterTable()->selectWhere("Potions_idItem = $idPotion");
    $viewContent .= "<div class='ElementRow'>";
    foreach ($ElementDePotion as $elem) {
        $photoElem = $elem->Photo;
        $viewContent .= <<<HTML
        <div class="photoImage" style="background-image:url('$photoElem')"></div>
    HTML;
    }
    $viewContent .= "</div></div>";
}
include "views/master.php";
