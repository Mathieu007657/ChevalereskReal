<?php
    include_once 'DAL/MySQLDataBase.php';
    include_once 'DAL/JoueursTable.php';
    include_once 'DAL/ItemsTable.php';
    include_once 'DAL/PaniersTable.php';

    function DB()
    {
        return MySQLDataBase::getInstance('dbchevalersk8');
    }
    function JoueursTable()
    {
        return new JoueursTable();
    }
    function ItemTable()
    {
        return new ItemTable();
    }
<<<<<<< HEAD
    function PanierTable(){
=======
    function PanierTable()
    {
>>>>>>> 8b9d5e2f12cbe76dbba6df8ec5ed378d5d4e8421
        return new PaniersTable();
    }