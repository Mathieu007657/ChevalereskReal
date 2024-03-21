<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

anonymousAccess();
JoueursTable()->insert(new Joueur($_POST));
redirect('loginForm.php'); 