<?php
    include_once './DAL/ChevalereskDB.php';
    include 'php/sessionManager.php';

    CommentaireTable()->addCommentaire($_GET["id"],$_SESSION['currentUserId'],$_POST["Comment"],$_POST["Star"]);
    redirect('DetailItem.php?id=' . $_GET["id"]);
