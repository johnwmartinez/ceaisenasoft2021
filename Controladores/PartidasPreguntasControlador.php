<?php

class PartidasPreguntas extends PartidasPreguntasModelo
{

    function __construct()
    {
    }

    public function preguntar_a_jugadores($datos)
    {
        /* Necesitamos la data del usuario y de la partida */
        $jugadores = new Jugadores();
        $partidas = new Partidas();
        $cartas = new Cartas();
        $partidaJugadorTabla = new PartidaJugadorTabla();
        $dataJugador = $jugadores->getJugadorByCodigo($datos["codigo"]); /* Data jugador */
        $dataPartida = $partidas->getPartidaPorCodigoUsuario($datos["codigo"]); /* Data partida */

        /* Insertamos la nueva pregunta - Esto también inactiva */
        $preguntas = array(
            $datos["programador"],
            $datos["modulo"],
            $datos["tipo_error"],
        );
        
        $this->insertPartidasPreguntas($dataPartida["codigo"], $dataJugador[0]["id_jugador"], $preguntas);

        /* Definimos los contrincantes */
        $contrincantes = $jugadores->jugadoresContrincantes($datos["codigo"], $dataPartida["id_partida"]);
        $cartas_por_contrincante = array();
        foreach ($contrincantes as $cadaContrincante) : /* este ciclo define las cartas de cada adversario */
            $cartasJugador = $cartas->cartasPorJugador($cadaContrincante["id_jugador"]);
            $cartas_por_contrincante[$cartasJugador["id_jugador"]] = array(
                $cartasJugador["idcarta1"],
                $cartasJugador["idcarta2"],
                $cartasJugador["idcarta3"],
                $cartasJugador["idcarta4"],
            );
        endforeach;

        $cartas_encontradas = array(); /* Si encontramos una de las cartas en el array, va a "tabla" */

        foreach ($cartas_por_contrincante as $id_contrincante => $cadaContrincante) :
            if (in_array($datos["programador"], $cadaContrincante)) :
                $cartas_encontradas[$id_contrincante] = $datos["programador"];
            elseif (in_array($datos["modulo"], $cadaContrincante)) :
                $cartas_encontradas[$id_contrincante] = $datos["modulo"];
            elseif (in_array($datos["tipo_error"], $cadaContrincante)) :
                $cartas_encontradas[$id_contrincante] = $datos["tipo_error"];
            endif;
        endforeach;
        
        /* Insertamos las cartas en la tabla */
        foreach($cartas_encontradas as $llave => $cadaIngreso):
            $datos_insertar = array(
                "id_partida" => $dataPartida["id_partida"],
                "id_jugador" => $dataJugador[0]["id_jugador"],
                "idcarta" => $cadaIngreso,
                "poseedor_id" => $llave,
            );
            $partidaJugadorTabla->insertarRegistroTabla($datos_insertar);
        endforeach;

        /* Cambiamos de turno */
        $partidas->cambiarTurno($dataPartida["id_partida"]);

        /* Listo */
        return 1;
    }
}
