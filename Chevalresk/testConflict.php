<?php
require 'DAL/ChevalereskDB.php';

$result = JoueursTable()->Conflict($_GET['Email'], $_GET['Id']);

header('Content-type: application/json');
echo json_encode($result);