<?php
    include_once 'DAL/MySQLDataBase.php';
    include_once 'DAL/JoueursTable.php';
    include_once 'DAL/ItemsTable.php';
    include_once 'DAL/PaniersTable.php';
    include_once 'DAL/InventaireTable.php';
    include_once 'DAL/ConcocterTable.php';

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
    function PanierTable(){
        return new PaniersTable();
    }
    function InventaireTable(){
        return new InventaireTable();
    }
    function EnigmesTable(){
        return new EnigmesTable();
    }
    function ConcocterTable(){
        return new ConcocterTable();
    }