<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
require 'DAL/EnigmesTable.php';

$viewName = "enigma";
$viewTitle = "Enigma";
$style=<<<HTML
    <style>
        .Reponse {
            width: 90%; 
            margin: auto; 
            padding:10%;
            border-radius:7px;
            background-color:hsl(0, 100%, 30%,0.5);
        }
        .Reponse tr {
            vertical-align: middle; 
        }
        .Reponse td {
            padding: 5px;
        }
        .Enigme{
            width: 90%; 
            height:25%;
            margin: auto;
            font-size:50px;
            padding :3%;
            border-radius:7px;
            background-color:hsl(0, 100%, 30%,0.8);
        }
    </style>
HTML;
$question = EnigmesTable()->getEnigme("");
$choix1 = 1;
$choix2 = 2;
$choix3 = 3;
$choix4 = 4;
$viewContent=$style;
$viewContent .= "<div class='Enigme'>";
$viewContent .= <<<HTML
    <div><b>$question</b> </div>
HTML;
$viewContent .= "<div class='Enigme'>";
$viewContent .= <<<HTML
    <div><b>$question</b> </div>
HTML;
$viewContent .= EnigmesTable()->getReponses($question);
$viewContent .= "</div>";
$viewContent .= "</div>";



$viewScript = <<<HTML
    <script defer>
        //on utilise pas
        $("#setPhotoOwnerSearchIdCmd").on("click", function() {
            window.location = "itemsList.php?id=" + $("#userSelector").val();
        });
        //a utiliser mais changer
        $("#setSearchKeywordsCmd").on("click", function() {
            window.location = "itemsList.php?keywords=" + $("#keywords").val();
        });
    </script>
HTML;

include "views/master.php";
?>
