<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

anonymousAccess();
UsersTable()->insert(new Joueurs($_POST));
redirect('loginForm.php'); 