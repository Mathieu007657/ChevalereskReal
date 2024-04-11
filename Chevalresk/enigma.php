<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "enigma";
$viewTitle = "Enigma";
$style=<<<HTML
    <style>
        .Reponse {
            width: 90%; 
            margin: auto; 
            padding:10%;
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
            background-color:hsl(0, 100%, 30%,0.5);
        }
    </style>
HTML;
$viewContent=$style;
$viewContent .= "<div class='Enigme'>";
$viewContent .= <<<HTML
    <div><b>QUESTION</b> </div>
HTML;
$viewContent .= "</div>";
//Faire dans un carré les aspects suivants:
//Écrire la question

//Dans un autre carré, mettre avec des checkbox chaque choix


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
