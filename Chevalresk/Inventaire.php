<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "Liste Inventaire";
$viewTitle = "Inventaire";
$viewContent = "<div class='photosLayout'>";
$listPanier = InventaireTable()->FindInvListPlayer($_SESSION['currentUserId']);
// Afficher la liste de la table du joueur
foreach($listPanier as $invent){
    //GET id et quantite de l'item dans l'inventaire du joueur
    $idItemPanier = $invent->idItem;
    $quantiteitem = $invent->QuantiteAchat;
    //GET Chaque item du panier/chercher l'item dans la table items
    $Item = ItemTable()->findById($idItemPanier);
    $id = $Item->IdItem;
    $name = $Item->Nom;
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
            <a href="DetailItem.php?id=$id">
                <div class="photoImage" style="background-image:url('$lienPhoto')"></div>
                <div>
                    <div>
                        Qtn: $quantiteitem
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
