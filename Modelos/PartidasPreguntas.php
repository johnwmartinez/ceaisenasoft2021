<?php

class PartidasPreguntasModelo{

    // Constructor del Modelo
    public function __construct()
    {

    }

    /*Método que desactiva todas las preguntas existentes para la partida actual, enviando un estado de 0*/
    public function inactivarPreguntasPartidas($codigo){

        global $DB;
        $query = "UPDATE partidas_preguntas SET estado = 0
        WHERE id_partida =  (SELECT id_partida FROM partidas WHERE codigo LIKE ?) ";

        $rel = $DB->query($query, array(
            $codigo
        ));

    }

    public function insertPartidasPreguntas($codigo, $idjugador, $cartaspreguntas){ //recibe un array de las 3 cartas para realizar la pregunta.

        /*Antes de insertar una nueva pregunta que por defecto el estado será 1 activa, desactivo todas
        las preguntas existentes para la partida actual*/
        $this->inactivarPreguntasPartidas($codigo);

        global $DB;
        $query = "INSERT INTO partidas_preguntas (id_partida, id_jugador, idcarta1, idcarta2, idcarta3) 
        VALUES ((SELECT id_partida FROM partidas WHERE codigo LIKE ?) ,?,?,?,?
        )";


        $rel = $DB->query($query, array(
            $codigo,
            $idjugador,
            $cartaspreguntas[0],
            $cartaspreguntas[1],
            $cartaspreguntas[2]
        ));

    }

    public function preguntaReciente( $codigo ) /* con el código de un usuario, calculamos la última pregunta de esa Partida */
    {
        global $DB;
        /* Primero traemos la información de la partida a la que pertenece el jugador consultante */
        $partidas = new Partidas();
        $dataPartida = $partidas->getPartidaPorCodigoUsuario( $codigo );

        $query = "
            SELECT 
                C1.nombre carta_1, 
                C2.nombre carta_2, 
                C3.nombre carta_3,
                J.nombre nombre
            FROM partidas_preguntas PP
                LEFT JOIN cartas C1 ON C1.idcarta = PP.idcarta1
                LEFT JOIN cartas C2 ON C2.idcarta = PP.idcarta2
                LEFT JOIN cartas C3 ON C3.idcarta = PP.idcarta3
                LEFT JOIN jugadores J ON J.id_jugador = PP.id_jugador
            WHERE 1=1
                AND PP.id_partida = ?
                AND PP.estado = 1
        ";
        $res = $DB->query( $query , array(
            $dataPartida["id_partida"]
        ));
        if(isset($res[0]))
            return $res[0];
        return array(0);
    }

    
    

}