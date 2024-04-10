<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "Liste Inventaire";
$viewTitle = "Inventaires";
$viewContent = "<div class='photosLayout'>";
$listPanier = InventaireTable()->selectByIdPanier($_SESSION['currentUserId']);

// Afficher la liste de la table du joueur
foreach($listPanier as $item){
    //GET id et quantite de l'item dans l'inventaire du joueur
    $idItemPanier = $item->idItem;
    $quantiteitem = $item->QuantiteInventaire;
    //GET Chaque item du panier/chercher l'item dans la table items
    $Item = ItemTable()->get($idItemPanier);
    $id = $Item->IdItem;
    $name = $Item->Nom;
    $quantite = $Item->Quantite;
    $prix = $Item->Prix;
    $type = $Item->Type;
    $Dispo = $Item->FlagDispo;
    $photo = $Item->Photo;

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
