<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
include_once 'DAL/EnigmesTable.php';

$viewName = "enigma";
$viewTitle = "Enigma";
$style=<<<HTML
    <style>
        .Reponse {
            width: 90%; 
            height:auto;
            margin: auto; 
            padding:10%;
            font-size:30px;
            border-radius:7px;
            color: white;
            background-color: rgba(72, 6, 148, 0.7);
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
            color: white;
            background-color:rgba(72, 6, 148, 0.8);
        }
    </style>
HTML;

$question = EnigmesTable()->getEnigme("");
$reponse = $question;
$question = $question. EnigmesTable()->getDifficulte($question);
$viewContent=$style;
$viewContent .= "<div class='Enigme'>";
$viewContent .= <<<HTML
    <div><b>$question</b> </div>
HTML;
$viewContent .= "</div><br>";
$reponses = EnigmesTable()->getReponses($reponse);
$viewContent .= "<div class='Reponse'>";
$viewContent .= <<<HTML
    <div><b>$reponses</b> </div>
HTML;
$viewContent .= "</div>";

$viewScript = <<<HTML
    <script defer>
        function verifierReponse(Difficile) {
            var reponse = document.querySelector("input[type='radio'][name=reponse]:checked").value;
            if (reponse) {
                alert($reponse);
            } else {
                alert("Veuillez sélectionner une réponse.");
            }
        }
    </script>
HTML;

include "views/master.php";
?>
