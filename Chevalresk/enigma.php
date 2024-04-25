<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
include_once 'DAL/EnigmesTable.php';

$viewName = "enigma";
$viewTitle = "Enigma";

$style = <<<HTML
    <style>
        .Reponse {
            width: 90%;
            height: auto;
            margin: auto;
            padding: 10%;
            font-size: 30px;
            border-radius: 7px;
            color: white;
            background-color: rgba(72, 6, 148, 0.7);
        }

        .Reponse tr {
            vertical-align: middle;
        }

        .Reponse td {
            padding: 5px;
        }

        .Enigme {
            width: 90%;
            height: 30%;
            margin: auto;
            font-size: 50px;
            padding: 3%;
            border-radius: 7px;
            color: white;
            background-color: rgba(72, 6, 148, 0.8);
        }
    </style>
HTML;

$viewScript = <<<HTML
    <script defer>
    function verifierReponse(Difficile) {
    var reponseChecked = document.querySelector("input[type='radio'][name=reponse]:checked");
    
    if (reponseChecked) {
        var estBonne = reponseChecked.getAttribute('data-estbonne');
        var enigmeId = $('.Enigme').attr('data-idEnigme');
        
        if (estBonne === 'O') {
            alert("bonne réponse");
            window.location.href = 'UpdateEnigme.php?id=' + enigmeId + '&estReussi=true';
        } else {
            alert("mauvaise réponse");
            window.location.href = 'UpdateEnigme.php?id=' + enigmeId + '&estReussi=false';
        }
    } else {
        alert("Veuillez sélectionner une réponse.");
    }
}
    </script>
HTML;

$typeEnigme = isset($_GET['type']) ? $_GET['type'] : '';
$enigmesTable = new EnigmesTable();
$question = $enigmesTable->getEnigme("", $typeEnigme);
$reponse = $question;
$questionText = $question . $enigmesTable->getDifficulte($question);
$IdEnigme = $enigmesTable->getId($question);

$viewContent = $style;
$viewContent .= "<div class='Enigme' data-idEnigme='$IdEnigme'>";
$viewContent .= "<b>$questionText</b>";
$viewContent .= "</div><br>";
$reponses = $enigmesTable->getReponses($reponse);
$viewContent .= "<div class='Reponse'>";
$viewContent .= "<b>$reponses</b>";
$viewContent .= "</div>";

include "views/master.php";
?>