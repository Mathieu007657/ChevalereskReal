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

$viewContent .= <<<HTML
    <style>
        /* Styles pour la table du panier */
        .panier-table {
            width: 75%; 
            margin: auto; 
            border-collapse: collapse;
            text-align: center;
        }

        .panier-table tr {
            border-bottom: 1px solid #ddd;
            vertical-align: middle; 
        }

        .panier-table td {
            padding: 5px;
        }

        .itemTableImg {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px; 
        }

        .quantity {
            width: 50px;
            margin-top: 20px; 
            vertical-align: middle;
        }

        .delete-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .pay-button {
            background-color: green;
            color: white;
            width: 75%;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .return-button {
            background-color: red;
            color: white;
            width: 75%;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .totalPan {
            width: 50%;
            font-size: 30px;
        }
    </style>
HTML;

$viewContent .= "<table class='panier-table'>";
$infoPan = <<<HTML
            <tr style="font-size: 20px;">
                <td></td>
                <td>Nom de l'item</td>
                <td>Prix</td>
                <td></td>
                <td>Quantite</td>
                <td></td>
                <td>Prix total de l'item</td>
                <td></td>
                <td></td>
            </tr>
HTML;
$viewContent .= $infoPan;
$totalPrice = 0;
foreach ($list as $item) {
    $idItemPan = $item->IdItem;
    $quantity = $item->QuantiteAchat;
    $ItemSelect = ItemTable()->findById($idItemPan);
    $nom = $ItemSelect->Nom;
    $prix = $ItemSelect->Prix;
    $photo = $ItemSelect->Photo;
    $lienEcu = "images/ecu.png";
    $lienPhoto = "data/images/photoItem/" . "$photo";
    $maxItem = $ItemSelect->Quantite;
    $prixTotalItem = $prix * $quantity;
    $totalPrice += $prixTotalItem; 

    $ItemPanier = <<<HTML
                    <tr style="font-size: 40px;">
                        <td>
                            <img class="itemTableImg" src="$lienPhoto" alt="$nom"/>
                        </td>
                        <td>
                            $nom
                        </td>
                        <td id="prix-$idItemPan">
                            $prix
                        </td>
                        <td>
                            X
                        </td>
                        <td>
                            <input class="quantity" id="id-form-$idItemPan-quantity" min="0" max="$maxItem" name="form-0-quantity" value="$quantity" type="number" onchange="updateTotalPrice(this)">
                        </td>
                        <td>
                            =
                        </td>
                        <td id="prix-total-$idItemPan">
                            $prixTotalItem <img src='$lienEcu' class='appLogo'>
                        </td>
                        <td>
                            <button class="delete-button" onclick="deleteItem($idItemPan)"><i class="fa-solid fa-xmark"></i></button>
                        </td>
                    </tr>
    HTML;
    $viewContent .= $ItemPanier;
}
$viewContent .= "</table>";

$totalPan= <<<HTML
             <table class='panier-table' style="margin-top: 10%;">
                <tr>
                    <td class="totalPan" id="totalPan"><b>Total: $totalPrice</b> <img src='$lienEcu' class='appLogo'></td>
                    <td><button class="pay-button" onclick="pay($idPlayer)">Payer</button></td>
                    <td><button class="return-button" onclick="returnToShop()">Retour</button></td>
                </tr>
            </table>
HTML;
$viewContent .= $totalPan;
$viewContent .= "</div>";
$viewScript = <<<HTML
    <script defer>
        $("#setPhotoOwnerSearchIdCmd").on("click", function() {
            window.location = "itemsList.php?id=" + $("#userSelector").val();
        });
        $("#setSearchKeywordsCmd").on("click", function() {
            window.location = "itemsList.php?keywords=" + $("#keywords").val();
        });

function updateTotalPrice(input) {
    var quantity = parseInt(input.value);
    console.log(quantity);

    var match = input.id.match(/id-form-(\d+)-quantity/);
    if (match) {
        var idItem = match[1];

        var prixUnitaireElement = document.getElementById('prix-' + idItem);
        if (prixUnitaireElement) {
            var prixUnitaireText = prixUnitaireElement.innerText;
            var prixUnitaire = parseFloat(prixUnitaireText);
            var prixTotal = quantity * prixUnitaire;
            document.getElementById('prix-total-' + idItem).innerHTML = prixTotal + " <img src='$lienEcu' class='appLogo'>";

            // Recalculer le prix total global
            var totalPanElement = document.getElementById('totalPan');
            var totalPrice = 0;
            var prixTotals = document.querySelectorAll("[id^='prix-total-']"); 
            prixTotals.forEach(function(element) {
                totalPrice += parseFloat(element.innerText);
            });
            totalPanElement.innerHTML = "<b>Total: " + totalPrice + "</b> <img src='$lienEcu' class='appLogo'>";
        } else {
            //console.error("L'élément prix unitaire est null.");
        }
    } else {
        //console.error("Impossible de trouver l'ID de l'item.");
    }
}



function deleteItem(itemId) {
    window.location = "deleteItemPanier.php?id=" + itemId;
}

function pay(idPlayer) {
    window.location = "payerPanier.php?id=" + idPlayer;
}

function returnToShop() {
    window.location = "itemsList.php"; 
}
    </script>
HTML;

include "views/master.php";
?>
