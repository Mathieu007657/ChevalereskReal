<?php
$pageTitle = "Chevaleresk";
if (!isset($viewTitle))
    $viewTitle = "";
if (!isset($viewHeadCustom))
    $viewHeadCustom = "";
if (!isset($viewName))
    $viewName = "";

$loggedUserMenu = "";
$connectedUserAvatar = "";
$menuIcon="";

if (isset($_SESSION["validUser"])) {

    $avatar = $_SESSION["avatar"];
    $userName = $_SESSION["userName"];
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
    HTML;
    $connectedUserAvatar = <<<HTML
        <div class="UserAvatarSmall" style="background-image:url('/data/avatars/$avatar')" title="$userName"></div>
    HTML;
} else {
    $loggedUserMenu = <<<HTML
        <a href="loginForm.php" class="dropdown-item" id="loginCmd">
            <i class="menuIcon fa fa-sign-in mx-2"></i> Connexion
        </a> 
        <a href="itemsList.php" class="dropdown-item">
            <i class="menuIcon fa-solid fa-store"></i> Magasin
        </a>
    HTML;
    $connectedUserAvatar = <<<HTML
        <div>&nbsp;</div>
    HTML;
}



$viewMenu = "";
if (strcmp($viewName, "itemList") == 0) {
    if ($sortType == "keywords") {
        $viewHeadCustom = <<<HTML
           <div class="searchContainer">
                <input type="search" class="form-control" placeholder="Recherche par mots-clés" id="keywords" />
                <i class="cmdIcon fa fa-search" id="setSearchKeywordsCmd"></i>
            </div>
        HTML;
    }
}

$viewHead = <<<HTML
        <a href="itemsList.php" title="Liste des Items"><img src="images/PhotoCloudLogo.png" class="appLogo"></a>
        <span class="viewTitle">
            $viewTitle 
        </span>
        
        <div class="headerMenusContainer">
            <span class="viewTitle">Chevaleresk</span> <!--filler-->
            <a href="editProfilForm.php" title="Modifier votre profil"> $connectedUserAvatar </a>         
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

