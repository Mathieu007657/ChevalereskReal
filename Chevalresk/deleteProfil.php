<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

userAccess();
$currentUserId = (int) $_SESSION["currentUserId"];
JoueursTable()->delete($currentUserId);
redirect('loginForm.php');