<?php
    include_once 'DAL/MySQLDataBase.php';
    include_once 'DAL/JoueursTable.php';
    function DB()
    {
        return MySQLDataBase::getInstance('ChevalereskDB');
    }
    function JoueursTable()
    {
        return new JoueursTable();
    }