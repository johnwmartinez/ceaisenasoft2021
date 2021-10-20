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
        else:
            $partidas = new Partidas();
            $existePartida = $partidas->verSiPartidaExiste($codigo); /* Variable para saber si una partida existe */
        endif;
        
        if($existePartida): /* Si la partida existe, continuamos el proceso creando el jugador */
            
            $this->crearJugador($nombre);
            /* Metemos las cartas en secreto */
            // Método cartas en secreto

        endif;
    }
}