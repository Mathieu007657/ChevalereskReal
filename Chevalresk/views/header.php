<?php
include_once "DAL/MySQLDataBase.php";
$pageTitle = "Chevaleresk";
if (!isset($viewTitle))
    $viewTitle = "";
if (!isset($viewHeadCustom))
    $viewHeadCustom = "";
if (!isset($viewName))
    $viewName = "";

$loggedUserMenu = "";
$connectedUserAvatar = "";
$menuIcon = "";
$solde = 1000;
$lienEcu="images/ecu.png";

if (isset($_SESSION["validUser"])) {
    $idpp=$_SESSION["currentUserId"];
    $Joueur = JoueursTable()->get($idpp);
    $solde=$Joueur->Solde;
    $JoueurNom = $Joueur->Alias;
    $avatar = $_SESSION["avatar"];
    $userName = $_SESSION["userName"];

    //$avatar = $Joueur->Avatar;
    $loggedUserMenu = "";
    if (isset($_SESSION["isAdmin"]) && (bool) $_SESSION["isAdmin"]) {
        $loggedUserMenu = <<<HTML
            <a href="manageUsers.php" class="dropdown-item">
                <i class="menuIcon fas fa-user-cog mx-2"></i> Gestion des Joueurs
            </a>
            <div class="dropdown-divider"></div>
        HTML;
    }

    $loggedUserMenu .= <<<HTML
        <a href="logout.php" class="dropdown-item">
            <i class="menuIcon fa fa-sign-out mx-2"></i> Déconnexion
        </a>
        <a href="editProfilForm.php" class="dropdown-item">
            <i class="menuIcon fa fa-user-edit mx-2"></i> Modifier votre profil
        </a>
        <div class="dropdown-divider"></div>
        <a href="itemsList.php" class="dropdown-item">
            <i class="menuIcon fa-solid fa-store mx-2"></i> Magasin
        </a>
        <a href="Paniers.php" class="dropdown-item">
            <i class="menuIcon fa fas fa-shopping-basket mx-2"></i> Paniers
        </a>
        <a href="Inventaire.php" class="dropdown-item">
            <i class="menuIcon fa fa-solid fa-cube mx-2"></i> Inventaire
        </a>
        <a href="enigma.php" class="dropdown-item">
            <i class="menuIcon fa fa-solid fa-circle-question mx-2"></i> Enigma
        </a>
    HTML;
    if (JoueursTable()->GetAlchi($idpp) == 1) {
        $loggedUserMenu .= <<<HTML
        <a href="Panoramix.php" class="dropdown-item">
            <i class="menuIcon fa-solid fa-prescription-bottle-medical mx-2"></i> Panoramix
        </a>
        HTML;
    }
    
    $connectedUserAvatar = <<<HTML
        
        <div class="UserAvatarSmall" style="background-image:url('images/ChevalreskLogo.png')" title="$userName"></div>
        <div>$JoueurNom</div>
        <div style="display:flex;">$solde<img src='$lienEcu' title="Ecu" class='appLogo'></div>
        
    HTML;
} else {
    $loggedUserMenu = <<<HTML
        <a href="loginForm.php" class="dropdown-item" id="loginCmd">
            <i class="menuIcon fa fa-sign-in mx-2"></i> Connexion
        </a> 
        <a href="itemsList.php" class="dropdown-item">
            <i class="menuIcon fa fa-solid fa-store mx-2"></i> Magasin
        </a>
    HTML;
    $connectedUserAvatar = <<<HTML
        <div>&nbsp;</div>
    HTML;
}


$viewMenu = "";
if (strcmp($viewName, "Paniers") !== 0 && strcmp($viewName, "itemList") == 0) {
    $viewHeadCustom = <<<HTML
    <div style="display: flex; justify-content: space-between; width: 100%;">
        <label style="color: white;">
            <a href="itemsList.php?sort=nom">Nom</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?filter=arme">Arme</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?filter=armure">Armure</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?filter=potion">Potion</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?filter=element">Element</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?sort=asc">Prix (croissant)</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?sort=desc">Prix (décroissant)</a>
        </label>
        <label style="color: white;">
            <a href="itemsList.php?filter=dispo">Disponibilité</a>
        </label>
    </div>
HTML;

}

$viewHead = <<<HTML
        <a href="itemsList.php" title="Liste des Items"><img src="images/logoChevalier.png" class="appLogo"></a>
        <span class="viewTitle">
            $viewTitle
        </span>
        
        <div class="headerMenusContainer">
            <span class="viewTitle">Les Chevaleresk aux rotules enflées</span> <!--filler-->
            <a href="editProfilForm.php" title="Modifier votre profil"> $connectedUserAvatar</a>
            <div class="dropdown ms-auto dropdownLayout">
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="cmdIcon fa fa-ellipsis-vertical"></i>
                </div>
                <div class="dropdown-menu noselect">
                    $loggedUserMenu
                    $viewMenu
                    <div class="dropdown-divider"></div>
                    <a href="about.php" class="dropdown-item" id="aboutCmd">
                        <i class="menuIcon fa fa-info-circle mx-2"></i> À propos...
                    </a>
                </div>
            </div>

        </div>
    HTML;

