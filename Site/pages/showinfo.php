<?php
header('Content-Type: application/json; ');
require('../config/db.php');
require('../utils/functions.php');


$query = $dbh->prepare("SELECT * FROM `pictures` WHERE id = :id");
$query->execute([':id' => $_GET['id']]);
$result = $query->fetch(PDO::FETCH_ASSOC);

$result['size'] = convert($result['size']);

echo json_encode($result);
