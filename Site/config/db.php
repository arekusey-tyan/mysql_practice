<?php

$dsn = 'mysql:host=db;port=3306;dbname=demo';
$user = 'demo';
$password = 'demo';

$dbh = new PDO($dsn, $user, $password);