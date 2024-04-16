<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$ListPotionitem = ItemTable()->selectWhere("type = 'P'");
foreach ($ListPotionitem as $Potion) {
    $idPotion = $Potion->IdItem;
    $NamePotion = $Potion->Nom;
    $lienPhoto = $Potion->Photo;
    echo "<div class='ZonePotion'>";
    $ZoneHTML = <<<HTML
        <div class="photoImage" style="background-image:url('$lienPhoto')"></div>
        <h2>$NamePotion</h2>
        <i class="fa-solid fa-arrow-right-long"></i>
    HTML;
    $ElementDePotion = ConcocterTable()->selectWhere("Potions_idItem = $idPotion");
    echo "<div>";
    foreach ($ElementDePotion as $elem) {
        $photoElem = $elem->Photo;
        $ZoneHTML .= <<<HTML
        <div class="photoImage" style="background-image:url('$photoElem')"></div>
    HTML;
    }
        echo "<div>";
    echo "</div>";
}
