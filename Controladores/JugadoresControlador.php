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
            
            $codigoJugador = $this->crearJugador($nombre);

            /* Traemos el listado de todas las cartas disponibles */
            $cartas = new Cartas();
            $cartas_totales = $cartas->obtenerTodasLasCartas();

            /*Formo un array con los ids de todas las cartas*/
            $total_cartas = array();
            for ($i=0; $i < count($cartas_totales); $i++) { 
                $total_cartas[$i] = $cartas_totales[$i]["idcarta"];
            }

            /*Hay que eliminiar las cartas que ya tiene partidas_secreto */
            $partidaSecreto = new PartidaSecreto();
            $cartasSecreto = $partidaSecreto->consultarCartasPartida($codigo); /*Consulto la cartas que tiene partida secreto*/

            /*Traigo las 3 cartas*/ 
            $carta1 = $cartasSecreto[0]["idcarta1"];
            $carta2 = $cartasSecreto[0]["idcarta2"];
            $carta3 = $cartasSecreto[0]["idcarta3"];
           
            //Elimino los ids de las cartas secreto de la lista de ids de todas las cartas
            unset($total_cartas[array_search($carta1, $total_cartas)]);
            unset($total_cartas[array_search($carta2, $total_cartas)]);
            unset($total_cartas[array_search($carta3, $total_cartas)]);

           

            /*Consulto si existen cartas en la partida*/ 
            $partidaJugadorCartas = new PartidaJugadorCartas();
            $cartasPartida = $partidaJugadorCartas->consultarCartasPartida($codigo);

            /*Si no existen cartas para ese jugador entonces se reparten */
            /*Si ya existen cartas para esa partida se eliminan de las cartas totales*/
            /*Agregar 4 cartas de entre las disponibles al usuario nuevo */

            if(count($cartasPartida) <= 0):
                $jugadorRegistro = $this->getJugadorbyCodigo($codigoJugador); /*Obtengo el registro del jugador por el código del mismo*/

                /*Se reparten las 4 cartas para cada jugador, enviando el código de la partida, el idjugador y las cartas restantes*/
                $partidaJugadorCartas->repartirCartasJugador($codigo, $jugadorRegistro[0]["id_jugador"], $total_cartas);
            else: 
                                
            endif;
            


        else:
            return json_encode(array("error"));
        endif;
    }
}