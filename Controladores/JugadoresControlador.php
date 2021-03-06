<?php

class Jugadores extends JugadoresModelo{

    public function __construct()
    {
        
    }

    public function ingresarNuevoUsuario($nombre, $codigo = NULL)
    {
        /* $codigo es el código de partida. Si viene vacío, es partida nueva */
        
        $partidas = new Partidas();
        if($codigo === NULL): /* Procedemos a crear una nueva partida */
            $codigo = $partidas->crearPartida(); /* Código de la nueva partida */
            $existePartida = true; 
            $partidaSecreto = new PartidaSecreto(); /* Creamos las cartas de Partida secreto */
            $partidaSecreto->crearPartidaSecreto($codigo);
        else:
            $existePartida = $partidas->verSiPartidaExiste($codigo); /* Variable para saber si una partida existe */
        endif;
        
        if($existePartida): /* Si la partida existe, continuamos el proceso creando el jugador */

            $dataPartida = $partidas->getPartidaPorCodigo($codigo); /* Traemos la data de una partida */
            
            if($dataPartida["estado"] == 0): /* Si la partida está pendiente de iniciar */
                
                /* Creamos nuevo jugador */
                $codigoJugador = $this->crearJugador($nombre, $codigo);
    
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
    
                $jugadorRegistro = $this->getJugadorbyCodigo($codigoJugador); /*Obtengo el registro del jugador por el código del mismo*/
                
                if(count($cartasPartida) <= 0):
                    /*Se reparten las 4 cartas para cada jugador, enviando el código de la partida, el idjugador y las cartas restantes*/
                    $partidaJugadorCartas->repartirCartasJugador($codigo, $jugadorRegistro[0]["id_jugador"], $total_cartas);
                else: 
                    $cartasBarajadas = $partidaJugadorCartas->consultarCartasPartida($codigo); /*Obtengo el registro del jugador por el código del mismo*/
                    $cartasEntregadas = array();
                    foreach($cartasBarajadas as $cadaRegistro):
                        unset($total_cartas[array_search($cadaRegistro["idcarta1"], $total_cartas)]);
                        unset($total_cartas[array_search($cadaRegistro["idcarta2"], $total_cartas)]);
                        unset($total_cartas[array_search($cadaRegistro["idcarta3"], $total_cartas)]);
                        unset($total_cartas[array_search($cadaRegistro["idcarta4"], $total_cartas)]);
                    endforeach;
    
                    /*Se reparten las 4 cartas para cada jugador, enviando el código de la partida, el idjugador y las cartas restantes*/
                    $partidaJugadorCartas->repartirCartasJugador($codigo, $jugadorRegistro[0]["id_jugador"], $total_cartas);
    
                endif;
                $salida = array(
                    "codigo" => 101,
                    "mensaje" => "Usuario creado satisfactoriamente",
                    "data" => array(
                        "codigo_jugador" => $codigoJugador,
                        "codigo_partida" => $codigo
                    ),
                );
                return $salida;
            else:
                $salida = array(
                    "codigo" => 102,
                    "mensaje" => "La partida a la que intenta ingresar ya tiene sus cupos llenos.",
                );
                return $salida;
            endif;
            
            
            return $codigo;

        else:
            return "error";
        endif;
    }
}