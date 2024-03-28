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

foreach($list as $item){
    $id = $item->ItemId;
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
