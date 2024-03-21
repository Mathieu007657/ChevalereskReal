<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

anonymousAccess();
UsersTable()->insert(new Joueur($_POST));
redirect('loginForm.php'); 