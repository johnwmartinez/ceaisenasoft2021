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

    public function repartirCartasJugador($codigo, $idjugador, $total_cartas){

        //Se desordena el array con las cartas disponibles
        shuffle($total_cartas); 

        //Obtengo la carta 1 y se remueve del array de las disponibles
        $carta1 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta1, $total_cartas)]);
       
        //Obtengo la carta 2 y se remueve del array de las disponibles
        $carta2 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta2, $total_cartas)]);
       
        //Obtengo la carta 3 y se remueve del array de las disponibles
        $carta3 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta3, $total_cartas)]);

        //Obtengo la carta 4 y se remueve del array de las disponibles
        $carta4 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta4, $total_cartas)]);

        
        global $DB;
        $query = "INSERT INTO rel_partida_jugador_cartas (id_partida, id_jugador, idcarta1, idcarta2, idcarta3, idcarta4, fecha, orden_llegada) 
                VALUES ((SELECT id_partida FROM partidas WHERE codigo LIKE ?) ,?,?,?,?,?,?,?)";
        $rel = $DB->query($query, array(
            $codigo,
            $idjugador,
            $carta1,
            $carta2,
            $carta3,
            $carta4,
            date("Y-m-d H:m:i"),
            1 //Pendiente
        ));
    }


}