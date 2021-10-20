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
require_once("../Modelos/Cartas.php");
require_once("../Controladores/CartasControlador.php");
require_once("../Modelos/PartidaSecreto.php");
require_once("../Controladores/PartidaSecretoControlador.php");
require_once("../Modelos/PartidaJugadorCartas.php");
require_once("../Controladores/PartidaJugadorCartasControlador.php");

// Pintamos el archivo como salida JSON para consultas desde Javascript
header('Content-Type: application/json');

/* Definir procesos que de forma asíncrona serán consultados */
if(isset($_POST["accion"])):
    $post = $_POST;
    $post["codigo"] = isset($post["codigo"]) ? $post["codigo"] : NULL;  /* Definimos si código llega desdee JS */
    switch($post["accion"]):
    
        case "ingresarNuevoUsuario":

            /* Ingresamos un nuevo usuario al sistema */
            $jugadores = new Jugadores();
            $salida = array(
                $jugadores->ingresarNuevoUsuario(
                    $post["nombre"],  /* nombre del jugador */
                    $post["codigo"]   /* código del jugador */
                )
            );
            echo(json_encode($salida));
        break;
    endswitch;
endif;


if(isset($_POST["processing"])):
    $salida = array();
    if($_POST["processing"] == 'SENASOFT'):
        /* A continuación viene el algoritmo que procesará el 'real time' de la aplicación 
        Disclaimer: sabemos que la app no es Real Time como tal, solo engaño al navegador para creerlo */

        /* Creamos los objetos */
        $jugadores = new Jugadores();

        /* Empezamos la lógica} */
        if(isset($_SESSION["codigo"])):
            $codigo = $_SESSION["codigo"];
            /* Usuario que ya está asignado a una partida */
            $jugadores->updated_atTime($codigo); /* Actualizamos el campo jugadores:updated_at */

            $salida = array(
                "codigo" => 999, /**/
                "mensaje" => "Código temporal de pruebas. Es que todo va ok.",
            );
        else:
            /* El usuario no está asignado a una partida */
            $salida = array(
                "codigo" => 100, /**/
                "mensaje" => "",
            );
        endif;
        echo(json_encode($salida));
    endif; // == SENASOFT
endif; // isset processing
