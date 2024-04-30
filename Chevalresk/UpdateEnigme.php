<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
include_once 'DAL/EnigmesTable.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $enigmesTable = new EnigmesTable();
    $enigmeId = $_GET['id'];
    $estReussi = $_GET['estReussi'] === 'true' ? true : false;
    echo "$enigmeId et $estReussi";
    $enigmesTable->updateEnigme($enigmeId, $estReussi);
    $idpp = $_SESSION["currentUserId"];
    $Joueur = JoueursTable()->get($idpp);
    if ($Joueur->QuestRep == 3) {
        //redirect("enigmaMenu.php?devAlch=true");
    }
}
//redirect("enigmaMenu.php");
