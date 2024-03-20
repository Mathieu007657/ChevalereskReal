<?php
include 'php/sessionManager.php';

anonymousAccess(200);

$viewTitle = "À propos...";
$viewContent = <<<HTML
     <div class="aboutContainer">
        <h2>Photos Cloud</h2>
        <hr>
        <p>
            Chevalresk Projet dirigé
        </p>
        <p>
            Auteur: Nicolas Chourot
        </p>
        <p>
            Modificateurs: Thierry Becker et Mathieu Lavallée
        </p>
        <p>
            Collège Lionel-Groulx, Hiver 2024
        </p>
    </div>
HTML;
$viewScript = <<<HTML
   <script defer>
        $("#addPhotoCmd").hide();
    </script>
HTML;
include "views/master.php";
