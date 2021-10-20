<?php

class Jugadores extends JugadoresModelo{

    public function __construct()
    {
        
    }

    public function ingresarNuevoUsuario($nombre, $codigo = NULL)
    {
        /* $codigo es el código de partida. Si viene vacío, es partida nueva */
        
        if($codigo === NULL): /* Procedemos a crear una nueva partida */
            $partida = new Partidas();
            $codigo = $partida->crearPartida(); /* Código de la nueva partida */
            $existePartida = true; 

            /* Creamos las cartas de Partida secreto */
            $partidaSecreto = new PartidaSecreto();
            $partidaSecreto->crearPartidaSecreto($codigo);
        else:
            $partidas = new Partidas();
            $existePartida = $partidas->verSiPartidaExiste($codigo); /* Variable para saber si una partida existe */
        endif;
        
        if($existePartida): /* Si la partida existe, continuamos el proceso creando el jugador */
            
            $this->crearJugador($nombre);
            /* Traemos el listado de todas las cartas disponibles */
            $cartas = new Cartas();
            $cartas_totales = $cartas->obtenerTodasLasCartas();
            
            /* Hay que eliminiar las cartas que ya tiene secreto */
            /* Eliminar las cartas que ya se repartieron a usurios */
            /* Agregar 4 cartas de entre las disponibles al usuario nuevo */

        else:
            return json_encode(array("error"));
        endif;
    }
}