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
        function verifierReponse(difficulte) {
            var idEnigme = document.getElementById("idEnigme").value;
            var reponse = document.querySelector('input[name="reponse"]:checked');
            if (reponse) {
                var reponseUtilisateur = reponse.value;
                // Appel AJAX pour vérifier la réponse
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "EnigmesTable.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        // Actualiser la page ou effectuer d'autres actions en fonction de la réponse du serveur
                    }
                };
                xhr.send("idEnigme=" + idEnigme + "&reponse=" + reponseUtilisateur + "&difficulte=" + difficulte);
            } else {
                alert("Veuillez sélectionner une réponse.");
            }
        }
    </script>
HTML;

include "views/master.php";
?>
