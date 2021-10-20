<?php
// Insertamos los archivos PHP necesarios para funcionar
require_once '../vendor/autoload.php';
require_once('../lib/db.php');
require_once("../lib/funciones.php");
require_once("../lib/config.php");

require_once("../Modelos/Jugadores.php");
require_once("../Controladores/JugadoresControlador.php");
require_once("../Modelos/Partidas.php");
require_once("../Controladores/PartidasControlador.php");

// Pintamos el archivo como salida JSON para consultas desde Javascript
header('Content-Type: application/json');

/* Definir procesos que de forma asíncrona serán consultados */
if(isset($_POST["accion"])):
    $post = $_POST;
    $post["codigo"] = isset($post["codigo"]) ? $post["codigo"] : NULL;
    switch($post["accion"])
    {
        case "ingresarNuevoUsuario":

            /* Ingresamos un nuevo usuario al sistema */
            $jugadores = new Jugadores();
            $jugadores->ingresarNuevoUsuario(
                $post["nombre"],
                $post["codigo"]
            );
            $salida = array(1);
            echo(json_encode($salida));
            
        break;
    }
else:
    $query = "SELECT * FROM jugadores WHERE created_at > ? ";
    $salida = $DB->query($query, array('2020-10-20 00:00:00'));
    echo(json_encode($salida));
endif;

