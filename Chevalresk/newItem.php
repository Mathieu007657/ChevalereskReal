<?php
require 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';

userAccess();
PhotosTable()->insert(new Photo($_POST));
redirect('itemsList.php'); 