<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "enigma";
$viewTitle = "Enigma";
$viewContent = "<div class='photosLayout'>";

//Faire dans un carré les aspects suivants:
//Écrire la question avec entre parenthèse la difficulté de la question (la question est piochée aléatoirement de la table Enigmes parmis celles qui non pas été piochées)

//Dans un autre carré, mettre avec des checkbox chaque choix (soit 4 pour chaque question)
//bouton de soumission

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
