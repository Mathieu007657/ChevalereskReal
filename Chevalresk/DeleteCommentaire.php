<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"])) {
    redirect("illegalAction.php");
    exit();
}
$comId = (int) $_GET["id"];
CommentaireTable()->deleteCommentaire($comId);
$html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Suppression du commentaire</title>
<style>
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
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
</style>
</head>
<body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        alert("Le commentaire a été supprimé avec succès.");
        window.history.back();
    }, 1500);
});
</script>
</body>
</html>
HTML;
echo $html;
