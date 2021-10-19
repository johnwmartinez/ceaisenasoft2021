<?php
require_once '../vendor/autoload.php';
require_once('../lib/db.php');

header('Content-Type: application/json');

$query = "SELECT * FROM jugadores WHERE created_at > ? ";
$salida = $DB->query($query, array('2020-10-20 00:00:00'));

echo(json_encode($salida));

?>