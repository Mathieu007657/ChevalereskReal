<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
include_once 'php/formUtilities.php';

anonymousAccess();
JoueursTable()->AjouterJoueurs(new Joueur($_POST));
//redirect('loginForm.php'); 