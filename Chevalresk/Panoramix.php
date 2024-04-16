<?php
require 'DAL/MySQLDataBase.php';
include 'php/sessionManager.php';
include 'php/formUtilities.php';
include 'php/date.php';
require 'DAL/ChevalereskDB.php';

$ListPotionitem = ItemTable()->selectWhere("type = P");
foreach ($ListPotionitem as $Potion) {
    $idPotion = $Potion->ItemId;
    $NamePotion = $Potion->Nom;
}
