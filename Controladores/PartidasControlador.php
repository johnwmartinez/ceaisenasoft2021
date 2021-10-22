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
        $cartas = new Cartas();
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

        /* 5. Acusar / Preguntar */
        $categorias = array(
            "programador" => $cartas->obtenerCartasPorCategoria(1),
            "modulo" => $cartas->obtenerCartasPorCategoria(2),
            "tipo_error" => $cartas->obtenerCartasPorCategoria(3),
        );

        /* 6. Cartas del usuario */
        $cartas_jugador = $cartas->cartasPorJugador($codigo);
        
        $salida = array(
            "contrincantes" => $contrincantes,
            "turno" => $turno,
            "preguntas" => $pregunta,
            "tablas" => $tablas,
            "categorias" => $categorias,
            "cartas" => $cartas_jugador,
        );
        return $salida;
    }
   
}