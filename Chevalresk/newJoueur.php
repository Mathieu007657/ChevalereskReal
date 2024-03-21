<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

anonymousAccess();
UsersTable()->insert(new User($_POST));
redirect('loginForm.php'); 