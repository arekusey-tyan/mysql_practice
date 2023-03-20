<?php

$dsn = 'mysql:host=db;port=3306;dbname=demo';
$user = 'demo';
$password = 'demo';

$dbh = new PDO($dsn, $user, $password);

function getFiles()
{
    global $dbh;
    return $dbh->query('SELECT * FROM `pictures`;')
        ->fetchAll(PDO::FETCH_ASSOC);
};
