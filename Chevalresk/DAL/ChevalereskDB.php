<?php
    include_once 'DAL/MySQLDataBase.php';
    include_once 'DAL/UsersTable.php';
    function DB()
    {
        return MySQLDataBase::getInstance('ChevalereskDB');
    }
    function UsersTable()
    {
        return new UsersTable();
    }