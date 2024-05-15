<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

if (!isset($_GET["id"])) {
    redirect("illegalAction.php");
}
$comId = (int) $_GET["id"];
CommentaireTable()->deleteCommentaire($comId);
//redirect("CommentaireAfficher.php");

