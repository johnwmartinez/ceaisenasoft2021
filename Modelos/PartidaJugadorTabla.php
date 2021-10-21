<?php

class PartidaJugadorTablaModelo{

    // Constructor del Modelo
    public function __construct()
    {

    }

    public function insertarPartidaJugadorTabla($codigo, $id_jugador){
        global $DB;

        /*Consulto las cartas que tiene el jugador en esa partida*/
        $partidaJugadorCartas = new PartidaJugadorCartas();
        $cartas_jugador = $partidaJugadorCartas->consultarCartasPartidaPorJugador($id_jugador, $codigo);


        //Se debe insertar las 4 cartas por cada jugador
        for ($i=1; $i <=4 ; $i++) { 

            $query = "INSERT INTO rel_partida_jugador_tablas (id_partida, id_jugador, idcarta, poseedor_id) 
            VALUES ((SELECT id_partida FROM partidas WHERE codigo LIKE ?) ,?,?,?)";

            $rel = $DB->query($query, array(
                $codigo,
                $id_jugador,
                $cartas_jugador[0]["idcarta".$i],
                $id_jugador
            ));
        }


       
    }
    
}