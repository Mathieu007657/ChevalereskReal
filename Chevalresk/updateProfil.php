<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
userAccess();
$user = JoueursTable()->get($_SESSION['currentUserId']);
JoueursTable()->updateJoueur($_SESSION['currentUserId'],$_POST['Alias'],$_POST [ 'Password' ],$_POST [ 'Avatar' ],$_POST [ 'Email' ]);
redirect('itemsList.php');