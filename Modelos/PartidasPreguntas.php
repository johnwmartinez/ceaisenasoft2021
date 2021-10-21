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

}