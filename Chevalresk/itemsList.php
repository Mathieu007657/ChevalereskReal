<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "itemList";
$viewTitle = "Items";
$viewContent = "<div class='photosLayout'>";
//$isAdmin = (bool) $_SESSION["isAdmin"];
$list = ItemTable()->get();

foreach($list as $item){
    $id = $item->ItemId;
    $name = $item->Name;
    $quantite = $item->QuantiteStock;
    $prix = $item->Prix;
    $type = $item->TypeItem;
    $Dispo = $item->FlagDispo;
    $photo = $item->Photo;
    $lienPhoto="data/images/photoItem/"."$photo";

    $photoHTML = <<<HTML
                <div class="photoLayout" photo_id="$id">
                    <div class="photoTitleContainer">
                        <div class="photoTitle ellipsis">$name</div>
                    </div>
                    <a href="addItemPanier.php?id=$id">
                        <div class="photoImage" style="background-image:url('$lienPhoto')"></div>
                    </a>
                </div>           
            HTML;
            $viewContent = $viewContent . $photoHTML;
}

$viewContent = $viewContent . "</div>";
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
