<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
//if (!isset($_GET["id"]))
//redirect("illegalAction.php");

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);
$photo = $item->Photo;
$nom = $item->Nom;
$prix = $item->Prix;
$type = $item->Type;
$infoPrix;
$infoPrix = "Prix: $prix écus";
$lienEcu = "images/ecu.png";
$lienPhoto = "data/images/photoItem/" . "$photo";
$html = <<<HTML
<style>
.grid-container{
        display:grid;
        grid-template-columns: 35% auto;
        column-gap: 5%;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
}
.section2-container{
    display:grid;
    
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
.photo{
    height:800px;
    width: 600px;
}
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
</style>
HTML;

$html .= <<<HTML
    <div class="grid-container">
        <div class="grid-item"><img src="$lienPhoto"  class="photo"/></div>
        <div class="grid-item">
            <div>
                $nom
            </div>
            <div>                
                    $infoPrix <img src="$lienEcu" style="width:40px; heigth: 40px;">
            </div>
        </div>
    </div>
HTML;
echo $html;