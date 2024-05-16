<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewTitle = "Panoramix";
$ListViewPanoramix = ConcocterTable()->AfficherPotionElem();
$listElementAcheter = ConcocterTable()->GetelementlistAcheter($_SESSION['currentUserId']);
$viewContent =  "<div class='ZonePotion'>";
for ($i=0; $i < sizeof($ListViewPanoramix); $i++) { 
    $NamePotion = $ListViewPanoramix[$i][0]; // [0] = Potion Name
    $lienPhoto = $lienPhoto="data/images/photoItem/". $ListViewPanoramix[$i][1]; // [1] = Potion Photo link
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
    $viewContent .= "<div class='ElementRow'>";
    $ElementListName = preg_split ("/\,/", $ListViewPanoramix[$i][2]); //[2] = list Element name
    $ElementListPicture = preg_split("/\,/", $ListViewPanoramix[$i][3]); // [3] = list Element Photo
    $ElementListQuantity = preg_split("/\,/", $ListViewPanoramix[$i][4]); // [4] = list Element quantité
    $NumberOfGold = 0;
    for ($y=0; $y < sizeof($ElementListName); $y++) { 
        $ElementAcheter = 0;
        $NameElement = $ElementListName[$y];
        foreach ($listElementAcheter as $listElement) {
            if ($listElement[1] == $NameElement){
                $ElementAcheter = $listElement[0];
                break;
            }
        }
        $PicElement = "data/images/photoItem/". $ElementListPicture[$y];
        $QuantityElem = $ElementListQuantity[$y];
        $viewContent .= <<<HTML
        <div>
            <img src="$PicElement" title="$NameElement" alt="$NameElement" class="PanoramixElementImage"/>
        HTML;

        if($ElementAcheter >= $QuantityElem){
            $NumberOfGold++;
            $viewContent .= <<<HTML
                <div class="NumQutElemGold">
                    <h3>$ElementAcheter/$QuantityElem</h3>
                </div>
            </div>
            HTML;
        }
        else{
            $viewContent .= <<<HTML
                <div class="NumQutElem">
                    <h3> $ElementAcheter/$QuantityElem</h3>
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