<?php
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$viewName = "itemList";
userAccess();
$viewTitle = "Panier";
$viewContent = "<div class='table'>";
$isAdmin = (bool) $_SESSION["isAdmin"];
$idPlayer = $_SESSION["currentUserId"];
$list = PanierTable()->findByidPanierPlayer($idPlayer);

foreach ($list as $item) {
    $idItemPan = $item->IdItem + 1;
    echo "<script>console.log('Debug Objects: " . $idItemPan . "' );</script>";
    $quantity = $item->QuantiteAchat;
    $ItemSelect = ItemTable()->findById($idItemPan);
    $id = $ItemSelect->IdItem;
    $nom = $ItemSelect->Nom;
    $prix = $ItemSelect->Prix;
    $photo = $ItemSelect->Photo;
    $lienEcu="images/ecu.png";
    $lienPhoto="data/images/photoItem/"."$photo";
    $maxItem = $ItemSelect->Quantite;

    $ItemPanier = <<<HTML
                    <table>
                        <tr>
                            <td>
                                <img class="itemTableImg" src="$lienPhoto"/>
                            </td>
                            <td>
                                $nom
                            </td>
                            <td>
                                <input class="quantity" id="id_form-0-quantity" min="0" max="$maxItem" name="form-0-quantity" value="1" type="number">
                            </td>
                            <td>
                                X
                            </td>
                            <td>
                                $prix
                            </td>
                        </tr>
                    </table>
                </div>
    HTML;
    $viewContent = $viewContent . $ItemPanier;
    
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
