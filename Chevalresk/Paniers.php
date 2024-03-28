<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "itemList";
userAccess();
$viewTitle = "Panier";
$viewContent = "<div class='photosLayout'>";
$isAdmin = (bool) $_SESSION["isAdmin"];
$idPlayer = $GLOBALS["id"];
$list = PanierTable()->get($idPlayer);

foreach ($list as $item) {
    $idItemPan = $item->idItem;
    $quantity = $item->quantiteAchat;
    $ItemSelect = ItemTable()->get($idItemPan);
    $id = $ItemSelect->idItem;
    $nom = $ItemSelect->nom;
    $prix = $ItemSelect->prix;
    $photo = $ItemSelect->photo;
    $lienEcu="images/ecu.png";
    $lienPhoto="data/images/photoItem/"."$photo";

    $ItemPanier = <<<HTML
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
    $viewContent = $viewContent . $photoHTML;
    
}
$viewContent = $viewContent . "</div>";
$viewScript = <<<HTML
    <script defer>
        $("#setPhotoOwnerSearchIdCmd").on("click", function() {
            window.location = "itemsList.php?id=" + $("#userSelector").val();
        });
        $("#setSearchKeywordsCmd").on("click", function() {
            window.location = "itemsList.php?keywords=" + $("#keywords").val();
        });
    </script>
HTML;
include "views/master.php";
