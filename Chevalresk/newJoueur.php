<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
include_once 'php/formUtilities.php';

anonymousAccess();
JoueursTable()->insert(new Joueur($_POST));
redirect('loginForm.php'); 