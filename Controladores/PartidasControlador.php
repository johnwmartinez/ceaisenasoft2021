<?php

class Partidas extends PartidasModelo{

    public function __construct()
    {
        
    }

    public function verSiPartidaExiste($codigo) /* Verificamos si la partida existe */
    {
        $dataPartida = $this->getPartidaPorCodigo($codigo);
        if(isset($dataPartida["id_partida"]))
            return true;
        return false;
    }

    /* Creamos la lógica deuna partida Total abierta */
    public function dataPartidaTotal($codigo) 
    {
        $jugadores = new Jugadores();
        $partidas = new Partidas();
        $partidasPreguntas = new PartidasPreguntas();
        $partidaJugadorTabla = new PartidaJugadorTabla();
        /* 1. Determinar los jugadores diferentes a mi  */
        $contrincantes = $jugadores->jugadoresContrincantes( $codigo ); /* Listos los contrincantes */
        
        /* 2. Quién tiene el turno */
        $turno = $partidas->quienTieneElTurno( $codigo );
        if($turno["yomismo"] === $turno["turno"]):
            $turno["nombre"] = "Es tu turno";
        endif;

        /* 3. Traer la última pregunta */
        $pregunta = $partidasPreguntas->preguntaReciente($codigo);

        /* 4. Tabla del jugador con cartas tachadas */
        $tablas = $partidaJugadorTabla->getTablaPorJugador($codigo);
        
        $salida = array(
            "contrincantes" => $contrincantes,
            "turno" => $turno,
            "preguntas" => $pregunta,
            "tablas" => $tablas,
        );
        return $salida;
    }
   
}