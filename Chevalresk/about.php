<?php
include 'php/sessionManager.php';

anonymousAccess(200);

$viewTitle = "À propos...";
$viewContent = <<<HTML
     <div class="aboutContainer">
        <h2>Chevaleresk</h2>
        <hr>
        <p>
            Gestionnaire de chevaliers
        </p>
        <p>
            Auteur: Thierry Becker, Philippe Robichaud-Gionet Mathieu Lavallée
        </p>
        <p>
            Collège Lionel-Groulx, hiver 2024
        </p>
    </div>
HTML;
$viewScript = <<<HTML
   <script defer>
        $("#addPhotoCmd").hide();
    </script>
HTML;
include "views/master.php";
