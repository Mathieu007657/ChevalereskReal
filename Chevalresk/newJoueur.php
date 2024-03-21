<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

anonymousAccess();
JoueursTable()->insert(new Joueurs($_POST));
redirect('loginForm.php'); 