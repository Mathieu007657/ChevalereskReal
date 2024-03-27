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
$idPlayer = $_SESSION['currentUserId'];
$list = PanierTable()->get($idPlayer);

foreach ($list as $item) {
    $idItemPan = $item->idItem;
    $quantity = $item->quantiteAchat;
    $ItemSelect = ItemTable()->get($idItemPan);

    $nom = $ItemSelect->nom;
    $prix = $ItemSelect->prix;
    $photo = $ItemSelect->photo;
    
    
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
