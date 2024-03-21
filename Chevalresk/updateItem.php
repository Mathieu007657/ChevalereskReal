<?php
include 'php/sessionManager.php';
require 'DAL/ChevalereskDB.php';
userAccess();
PhotosTable()->update(new Photo($_POST));
redirect('itemsList.php');
