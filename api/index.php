<?php
// Insertamos los archivos PHP necesarios para funcionar
require_once '../vendor/autoload.php';
require_once('../lib/db.php');
require_once("../lib/funciones.php");
require_once("../lib/config.php");

require_once("../Modelos/Participantes.php");
require_once("../Controladores/ParticipantesControlador.php");
require_once("../Modelos/Partidas.php");
require_once("../Controladores/PartidasControlador.php");

// Pintamos el archivo como salida JSON para consultas desde Javascript
header('Content-Type: application/json');


$query = "SELECT * FROM jugadores WHERE created_at > ? ";
$salida = $DB->query($query, array('2020-10-20 00:00:00'));
echo(json_encode($salida));


/* Creación de eventos */



?>