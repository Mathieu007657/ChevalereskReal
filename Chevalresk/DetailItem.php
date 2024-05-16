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

$id = (int) $_GET["id"];
$item = ItemTable()->findById($id);
$photo = $item->Photo;
$nom = $item->Nom;
$prix = $item->Prix;
$type = ItemTable()->findType($id);
$infoPrix = "Prix: $prix";
$lienEcu = "images/ecu.png";
$lienPhoto = "data/images/photoItem/" . "$photo";
$lienEtoile = "images/Etoile.webp";
$lienEtoileHalf = "images/EtoileHalf.png";
$estAlch = ItemTable()->findAlch($_SESSION['currentUserId']);
$ajout = '<a href="addItemPanier.php?id='. $id . '"><button class="button-34" role="button">Ajouter au panier</button></a>';

if ($type == 'Armes') {
    $query = ItemTable()->findInfosArmes($type, $id);
} else if ($type == 'Armures') {
    $query = ItemTable()->findInfosArmures($type, $id);
} else if ($type == 'Potions') {
    $query = ItemTable()->findInfosPotions($type, $id);
    if ($estAlch == 1) {
        $ajout = '<a href="addItemPanier.php?id=$id"><button class="button-34" role="button">Ajouter au panier</button></a>';
    } else {
        $ajout = '<br> <br> Vous ne pouvez acheter cet item tant que vous n\'êtes pas alchimiste';
    }
} else if ($type == 'Elements') {
    $query = ItemTable()->findInfosElements($type, $id);
    if ($estAlch == 1) {
        $ajout = '<a href="addItemPanier.php?id=$id"><button class="button-34" role="button">Ajouter au panier</button></a>';
    } else {
        $ajout = '<br> <br> Vous ne pouvez acheter cet item tant que vous n\'êtes pas alchimiste';
    }
}

$LaisseCommentaire = "";
if (InventaireTable()->ItemInvenExist($_SESSION['currentUserId'],$id) || true){
    $LaisseCommentaire = <<<HTML
    <form action="SaveComment.php" method="POST">
        <div class="container">
	        <div class="star-group">
		        <input type="radio" class="star" id="one" name="star_rating">
		        <input type="radio" class="star" id="two" name="star_rating">
		        <input type="radio" class="star" id="three" name="star_rating">
		        <input type="radio" class="star" id="four" name="star_rating">
		        <input type="radio" class="star" id="five" name="star_rating" checked>
	        </div>
        </div>
        <textarea id="CommentSection" rows="4" cols="50" maxlength="100" name="Comment"></textarea>
        <br><br>
        <input type="submit" title="Envoyer le commentaire"/>
        <input type="hidden" name="item_id" value="$id"/>
    </form>
HTML;
}

$idItem = $id;
$CommentaireTable = new CommentaireTable();
$Commentaires = $CommentaireTable->getCommentairesForItem($idItem);
$idPlayer = $_SESSION["currentUserId"];
$J = JoueursTable()->get($idPlayer);

$commentsHtml = "";
foreach ($Commentaires as $CommentaireItem) {
    $idCommentaire = $CommentaireItem[0];
    $idComPlayer = $CommentaireItem[2];
    $nbEtoiles = $CommentaireItem[3];
    $leCommentaire = $CommentaireItem[4];
    
    $Joueur = JoueursTable()->get($idComPlayer);
    $name = $Joueur->prenom;
    $avatar = $Joueur->Avatar;
    if ($avatar == "") {
        $avatar = '<img class="UserAvatar" src="images/ChevalreskLogo.png">';
    } else {
        $avatar = '<img class="UserAvatar" src="' . $avatar . '">';
    }

    $supprimerCom = "";
    if ($J->estAdmin) {
        $supprimerCom = <<<HTML
        <div class="item4">
            <a href="DeleteCommentaire.php?id=$idCommentaire" title="Supprimer le commentaire" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?');">
                <i class="fa-solid fa-user-pen logoModif"></i> Admin Delete
            </a>
        </div>
HTML;
    } else if ($idComPlayer == $_SESSION["currentUserId"]) {
        $supprimerCom = <<<HTML
        <div class="item4">
            <a href="DeleteCommentaire.php?id=$idCommentaire" title="Supprimer le commentaire" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?');">
                <i class="fa-solid fa-user-pen logoModif"></i> User Delete
            </a>
        </div>
HTML;
    }

    $commentsHtml .= <<<HTML
    <div class="grid-container">
        <div class="item2 avatar">$avatar</div>
        <div class="item1">$name</div>
        <div class="item4">$supprimerCom</div>
        <div class="item3">$leCommentaire</div>
        <div class="item5">$nbEtoiles</div>
    </div>
HTML;
}

$html = <<<HTML
<style>
.grid-container {
    display: grid;
    grid-template-columns: 35% auto;
    column-gap: 5%;
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}
.section2-container {
    display: grid;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
.photo {
    height: 800px;
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
.etoileContainer {
  background-color: #000000;
  border-radius: 999px;
  height: 57.75px;
  width: 40%;
  margin: 0 auto;
  padding-top: 5px;
  padding-bottom: 5px;
}
.button-34 {
  background: #5E5DF0;
  border-radius: 999px;
  box-shadow: #5E5DF0 0 10px 20px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family: Inter, Helvetica, "Apple Color Emoji", "Segoe UI Emoji", NotoColorEmoji, "Noto Color Emoji", "Segoe UI Symbol", "Android Emoji", EmojiSymbols, -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", sans-serif;
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
.side {
  float: left;
  width: 15%;
  margin-top: 10px;
}
.middle {
  margin
  -top: 10px;
  float: left;
  width: 70%;
}
.right {
  text-align: right;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}
.bar {
  width: 4%;
  height: 18px;
  background-color: #ff9800;
  padding: 0;
}
</style>
HTML;
$html .= <<<HTML
<div class="grid-container">
    <div class="grid-item"><img src="$lienPhoto" class="photo" /></div>
    <div class="grid-item">
        <div>$nom</div>
        <br>
        <div>$infoPrix <img src="$lienEcu" style="width:40px; height: 40px;"></div>
        <br>
        <div>$query</div>
        <br>
        <div>
            <div style="margin: 0 auto; padding: 20px;">
                <div class="etoileContainer">
                    <img src="$lienEtoile" style="height:57.75px"/>
                    <img src="$lienEtoile" style="height:57.75px"/>
                    <img src="$lienEtoile" style="height:57.75px"/>
                    <img src="$lienEtoile" style="height:57.75px"/>
                    <img src="$lienEtoileHalf" style="width:30px"/>
                </div>
                <p>4.1/5 basé sur 254 évaluations.</p>
                <hr style="border:3px solid #f1f1f1">
                <div class="row">
                    <div class="side"><div>5 étoiles</div></div>
                    <div class="middle"><div class="bar-container"><div class="bar" style="width: 15%"></div></div></div>
                    <div class="side right"><div>150%</div></div>
                    <div class="side"><div>4 étoiles</div></div>
                    <div class="middle"><div class="bar-container"><div class="bar" style="width: 15%"></div></div></div>
                    <div class="side right"><div>63%</div></div>
                    <div class="side"><div>3 étoiles</div></div>
                    <div class="middle"><div class="bar-container"><div class="bar" style="width: 15%"></div></div></div>
                    <div class="side right"><div>15%</div></div>
                    <div class="side"><div>2 étoiles</div></div>
                    <div class="middle"><div class="bar-container"><div class="bar" style="width: 15%"></div></div></div>
                    <div class="side right"><div>6%</div></div>
                    <div class="side"><div>1 étoile</div></div>
                    <div class="middle"><div class="bar-container"><div class="bar" style="width: 15%"></div></div></div>
                    <div class="side right"><div>20%</div></div>
                </div>
                <br><br>
                <a href="itemsList.php"><button class="button-34" role="button">Retour à la liste</button></a>
                <span style="color: red;">$ajout</span>
            </div>
            <hr>
            <div>
                <button class="button-34">Laisser un Commentaire</button>
                <br><br>
                $LaisseCommentaire
            </div>
            <div>
                $commentsHtml
            </div>
        </div>
    </div>
</div>
HTML;
echo $html;
