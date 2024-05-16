<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
include_once 'DAL/CommentaireTable.php';

$style = <<<HTML
    <style>
.grid-container {
  display: grid;
  grid-template-columns: auto 1fr auto;
  grid-template-rows: auto auto auto;
  grid-template-areas:
    "avatar name delete"
    "avatar comment delete"
    "avatar stars delete";
  padding: 10px;
  gap: 10px;
}
.item1 {
  grid-area: name;
  font-size: 20px;
}
.item2 {
  grid-area: avatar;
  display: flex;
  align-items: center;
  justify-content: center;
}
.item3 {
  grid-area: comment;
  font-size: 16px;
}
.item5 {
  grid-area: stars;
  font-size: 16px;
}
.item4 {
  grid-area: delete;
  display: flex;
  align-items: center;
  justify-content: center;
}
.grid-container > div {
  padding: 10px 0;
}
.UserAvatar {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
    </style>
HTML;
echo $style;

$idItem = 1;
$CommentaireTable = new CommentaireTable();
$Commentaires = $CommentaireTable->getCommentairesForItem($idItem);
$idPlayer = $_SESSION["currentUserId"];
$J = JoueursTable()->get($idPlayer);
foreach ($Commentaires as $CommentaireItem) {
    $idCommentaire= $CommentaireItem[0];
    $idComPlayer = $CommentaireItem[2];
    $nbEtoiles = $CommentaireItem[3];
    $leCommentaire = $CommentaireItem[4];
    
    $Joueur = JoueursTable()->get($idComPlayer);
    $name = $Joueur->prenom;
    $avatar = $Joueur->Avatar;
    if ($avatar == "") {
        $avatar = '<img class="UserAvatar" src="images/ChevalreskLogo.png">';
    } 
    else {
        $avatar = '<img class="UserAvatar" src="' . $avatar . '">';
    }
    $supprimerCom = "";
    if ($J->estAdmin) {
        $supprimerCom = <<<HTML
        <div class="item4">
            <a href="DeleteCommentaire.php?id=$idCommentaire" title="Supprimer le commentaire">
                <i class="fa-solid fa-user-pen logoModif"></i> Admin Delete
            </a>
        </div>
HTML;
    } else if ($idComPlayer == $_SESSION["currentUserId"]) {
        $supprimerCom = <<<HTML
        <div class="item4">
            <a href="DeleteCommentaire.php?id=$idCommentaire" title="Supprimer le commentaire">
                <i class="fa-solid fa-user-pen logoModif"></i> User Delete
            </a>
        </div>
HTML;
    }

    $com = <<<HTML
    <div class="grid-container">
        <div class="item2 avatar">$avatar</div>
        <div class="item1">$name</div>
        <div class="item4">$supprimerCom</div>
        <div class="item3">$leCommentaire</div>
        <div class="item5">$nbEtoiles</div>
    </div>
HTML;
    echo $com;
}