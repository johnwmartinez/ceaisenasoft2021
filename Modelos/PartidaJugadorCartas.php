<?php

class PartidasJugadorCartasModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    public function consultarCartasPartida($codigo){
        global $DB;
        $query = "SELECT * FROM rel_partida_jugador_cartas WHERE id_partida =  (SELECT id_partida FROM partidas WHERE codigo LIKE ?) ";
        $res = $DB->query($query, array($codigo)); 
        return $res;
    }

    public function repartirCartasJugador($codigo, $idjugador, $cartastotales){
        global $DB;
        $query = "INSERT INTO rel_partida_jugador_cartas (id_partida, id_jugador, idcarta1, idcarta2, idcarta3, idcarta4, fecha, orden_llegada) 
                VALUES ((SELECT id_partida FROM partidas WHERE codigo LIKE ?) ,?,?,?,?,?,?,?)";
        $rel = $DB->query($query, array(
            $codigo,
            $idjugador,
            1,
            2,
            3,
            4,
            date("Y-m-d H:m:i"),
            1
        ));
    }


}