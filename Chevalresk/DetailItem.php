<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);
$photo = $item->Photo;
$nom = $item->Nom;
$prix = $item->Prix;
$type = ItemTable()->findType($id);
$infoPrix = "Prix: $prix";
$lienEcu = "images/ecu.png";
$lienPhoto = "data/images/photoItem/" . "$photo";
$estAlch = ItemTable()->findAlch($_SESSION['currentUserId']);
$ajout = '<a href="addItemPanier.php?id=$id"><button class="button-34" role="button">Ajouter au panier</button></a>';



if($type == 'Armes')
{
    $query = ItemTable()->findInfosArmes($type,$id);
}
else if($type == 'Armures')
{
    $query = ItemTable()->findInfosArmures($type,$id);
}
else if($type == 'Potions')
{
    $query = ItemTable()->findInfosPotions($type,$id);
    if($estAlch == 1)
    {
        $ajout = '<a href="addItemPanier.php?id=$id"><button class="button-34" role="button">Ajouter au panier</button></a>';  
    }
    else
    {
        $ajout = '<br> <br> Vous ne pouvez acheter cet item tant que vous n\'êtes pas alchimiste';
    }
}
else if($type == 'Elements')
{
    $query = ItemTable()->findInfosElements($type,$id);
    if($estAlch == 1)
    {
        $ajout = '<a href="addItemPanier.php?id=$id"><button class="button-34" role="button">Ajouter au panier</button></a>';  
    }
    else
    {
        $ajout = '<br> <br> Vous ne pouvez acheter cet item tant que vous n\'êtes pas alchimiste';
    }
}




$html = <<<HTML
<style>
.grid-container{
        display:grid;
        grid-template-columns: 35% auto;
        column-gap: 5%;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
}
.section2-container{
    display:grid;
    
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
.photo{
    height:800px;
    width: 600px;
}
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* CSS */
.button-34 {
  background: #5E5DF0;
  border-radius: 999px;
  box-shadow: #5E5DF0 0 10px 20px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family: Inter,Helvetica,"Apple Color Emoji","Segoe UI Emoji",NotoColorEmoji,"Noto Color Emoji","Segoe UI Symbol","Android Emoji",EmojiSymbols,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans",sans-serif;
  font-size: 16px;
  font-weight: 700;
  line-height: 24px;
  opacity: 1;
  outline: 0 solid transparent;
  padding: 8px 18px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: fit-content;
  word-break: break-word;
  border: 0;
}
</style>
HTML;

$html .= <<<HTML
<div class="grid-container">
    <div class="grid-item"><img src="$lienPhoto"  class="photo"/></div>
    <div class="grid-item">
        <div>
            $nom
        </div>
        <br>
        <div>                
            $infoPrix <img src="$lienEcu" style="width:40px; height: 40px;">
        </div>
        <br>
        <div>                
            $query
        </div>
        <br>
        <div>
            <a href="itemsList.php"><button class="button-34" role="button">Retour à la liste</button></a>
            <span style="color: red;">$ajout</span>
        </div>
    </div>
</div>
HTML;

echo $html;
?>
