<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "itemList";
$viewTitle = "Items";
$viewContent = "<div class='photosLayout'>";
//$isAdmin = (bool) $_SESSION["isAdmin"];
$sortType ="";
$list = ItemTable()->get();

// Récupérer les paramètres de requête GET
$filter = $_GET['filter'] ?? null;
$sort = $_GET['sort'] ?? null;

// Construire la requête SQL de base
$sql = "SELECT * FROM dbchevalersk8.Items WHERE";

// Appliquer le filtre si spécifié
if ($filter) {
    switch ($filter) {
        case 'arme':
            $sql .= " type = 'A'";
            break;
        case 'armure':
            $sql .= " type = 'R'";
            break;
        case 'potion':
            $sql .= " type = 'P'";
            break;
        case 'element':
            $sql .= " type = 'E'";
            break;
        case 'dispo':
            $sql .= " flagDispo = 1";
            break;
    }
}

// Trier la liste si un type de tri est spécifié
if ($sort) {
    // Définition de la fonction de tri en fonction du type de tri sélectionné
    switch ($sort) {
        case 'nom':
            usort($list, function ($a, $b) {
                return strcmp($a->Nom, $b->Nom);
            });
            break;
        case 'type':
            usort($list, function ($a, $b) {
                return strcmp($a->Type, $b->Type);
            });
            break;
        case 'asc':
            usort($list, function ($a, $b) {
                return $a->Prix <=> $b->Prix;
            });
            break;
        case 'desc':
            usort($list, function ($a, $b) {
                return $b->Prix <=> $a->Prix;
            });
            break;
    }
}

// Afficher la liste filtrée/trieée des articles
foreach($list as $item){
    $id = $item->IdItem;
    $name = $item->Nom;
    $quantite = $item->Quantite;
    $prix = $item->Prix;
    $type = $item->Type;
    $Dispo = $item->FlagDispo;
    $photo = $item->Photo;
    $lienEcu="images/ecu.png";
    $lienPhoto="data/images/photoItem/"."$photo";
    
    $photoHTML = <<<HTML
        <div class="photoLayout" photo_id="$id">
            <div class="photoTitleContainer">
                <div class="photoTitle ellipsis">$name</div>
            </div>
            <a href="addItemPanier.php?id=$id">
                <div class="photoImage" style="background-image:url('$lienPhoto')"></div>
                <div>
                    <div>
                        Prix: $prix écus <img src="$lienEcu" class="appLogo">
                    </div>
                </div>
            </a>
        </div>           
    HTML;
    $viewContent .= $photoHTML;
}

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