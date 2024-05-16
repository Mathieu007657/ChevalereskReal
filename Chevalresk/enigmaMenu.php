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
        .grid{
            display:grid;
            grid-template-columns: 30% 30% 30%;
        }
.text {
    text-align:center;
    justify-content:center;
}
/* CSS */
.button-78 {
  align-items: center;
  appearance: none;
  background-clip: padding-box;
  background-color: initial;
  background-image: none;
  border-style: none;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  flex-direction: row;
  flex-shrink: 0;
  font-family: Eina01,sans-serif;
  font-size: 16px;
  font-weight: 800;
  justify-content: center;
  line-height: 24px;
  margin: 0;
  min-height: 64px;
  outline: none;
  overflow: visible;
  padding: 19px 26px;
  pointer-events: auto;
  position: relative;
  text-align: center;
  text-decoration: none;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  width: auto;
  word-break: keep-all;
  z-index: 0;
}

@media (min-width: 768px) {
  .button-78 {
    padding: 19px 32px;
  }
}

.button-78:before,
.button-78:after {
  border-radius: 80px;
}

.button-78:before {
  background-image: linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
  content: "";
  display: block;
  height: 100%;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: -2;
}

.button-78:after {
  background-color: initial;
  background-image: linear-gradient(#541a0f 0, #0c0d0d 100%);
  bottom: 4px;
  content: "";
  display: block;
  left: 4px;
  overflow: hidden;
  position: absolute;
  right: 4px;
  top: 4px;
  transition: all 100ms ease-out;
  z-index: -1;
}

.button-78:hover:not(:disabled):before {
  background: linear-gradient(92.83deg, rgb(255, 116, 38) 0%, rgb(249, 58, 19) 100%);
}

.button-78:hover:not(:disabled):after {
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  transition-timing-function: ease-in;
  opacity: 0;
}

.button-78:active:not(:disabled) {
  color: #ccc;
}

.button-78:active:not(:disabled):before {
  background-image: linear-gradient(0deg, rgba(0, 0, 0, .2), rgba(0, 0, 0, .2)), linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
}

.button-78:active:not(:disabled):after {
  background-image: linear-gradient(#541a0f 0, #0c0d0d 100%);
  bottom: 4px;
  left: 4px;
  right: 4px;
  top: 4px;
}

.button-78:disabled {
  cursor: default;
  opacity: .24;
}
    </style>
HTML;

$id = $_SESSION["currentUserId"];
$stats = EnigmesTable() -> getStats($id);
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
    <div class="text">Choix de l'enigme</div>
    <div class="grid text">
        <div><button class="button-78" type='button' onclick="AfficherEnigme('P')">Type Potion</button></div>
        <div><button class="button-78" type='button' onclick="AfficherEnigme('E')">Type Élément</button></div>
        <div><button class="button-78" type='button' onclick="AfficherEnigme('')">Aléatoire</button></div>
        
    </div>
    <div class="grid text">
        <br>
        <div class="text">
            <br>
            <button class="button-78" type='button' onclick="alert('$stats')">Afficher les Statistiques</button>
        </div>
    </div>
</div>
HTML;
$idpp = $_SESSION["currentUserId"];
$Joueur = JoueursTable()->get($idpp);
$solde = $Joueur->Solde;
include "views/master.php";
if (isset($_GET["devAlch"])) {
    $DevienAlch = (bool) $_GET["devAlch"];
    echo '<script>alert("Vous êtes maintenant un alchimiste! Bravo nous sommes fière de vous.")</script>';
}
