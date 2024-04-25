<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';
include_once 'DAL/EnigmesTable.php';

$viewName = "enigmamenu";
$viewTitle = "EnigmaMenu";

$viewContent = <<<HTML
    <style>
        .Enigme {
            width: 90%;
            height: 100%;
            margin: auto;
            font-size: 50px;
            padding: 3%;
            border-radius: 7px;
            color: white;
            background-color: rgba(72, 6, 148, 0.8);
        }

        .button-64 {
            align-items: center;
            background-image: linear-gradient(144deg, #AF40FF, #5B42F3 50%, #00DDEB);
            border: 0;
            border-radius: 8px;
            box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
            box-sizing: border-box;
            color: #FFFFFF;
            display: flex;
            font-family: Phantomsans, sans-serif;
            font-size: 20px;
            justify-content: center;
            line-height: 1em;
            max-width: 100%;
            min-width: 140px;
            padding: 3px;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            cursor: pointer;
        }

        .button-64:active,
        .button-64:hover {
            outline: 0;
        }

        .button-64 span {
            background-color: rgb(5, 6, 45);
            padding: 16px 24px;
            border-radius: 6px;
            width: 100%;
            height: 100%;
            transition: 300ms;
        }

        .button-64:hover span {
            background: none;
        }

        @media (min-width: 768px) {
            .button-64 {
                font-size: 24px;
                min-width: 196px;
            }
        }
    </style>
HTML;

$viewScript = <<<HTML
    <script defer>
        function AfficherEnigme(type){
            switch (type) {
                case 'P':
                    window.location = "enigma.php?type=P";
                    break;
                case 'E':
                    window.location = "enigma.php?type=E";
                    break;
                case '':
                    window.location = "enigma.php?type=";
                    break;
                default:
                    break;
            }
        }
    </script>
HTML;

$viewContent .= <<<HTML
<div class="Enigme">
    <div>Choix de l'enigme</div>
    <div>
        <button class="button-64" type='button' onclick="AfficherEnigme('P')">Type Potion</button>
        <button class="button-64" type='button' onclick="AfficherEnigme('E')">Type Élément</button>
        <br>
        <button class="button-64" type='button' onclick="AfficherEnigme('')">Aléatoire</button>
    </div>
</div>
HTML;
include "views/master.php";

?>
