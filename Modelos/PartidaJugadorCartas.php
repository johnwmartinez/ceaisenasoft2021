<?php

class PartidasJugadorCartasModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    public function consultarCartasPartida($codigo){
        global $DB;
        $query = "SELECT * FROM rel_partida_jugador_cartas WHERE id_partida =  (SELECT id_partida FROM partidas WHERE codigo LIKE ?) AND activo = 1";
        $res = $DB->query($query, array($codigo)); 
        return $res;
    }

    public function repartirCartasJugador($codigo, $idjugador, $total_cartas){

        global $DB;

        //Se desordena el array con las cartas disponibles
        shuffle($total_cartas); 
<<<<<<< HEAD
        /* Con el array desordenado, puedo tomar las primeras cuatro cartas */
        $carta1 = $total_cartas[0];
        $carta2 = $total_cartas[1];
        $carta3 = $total_cartas[2];
        $carta4 = $total_cartas[3];
       
        // Verificamos cuantos participantes tenemos para definir el orden de llegada
        $query = "SELECT orden_llegada FROM rel_partida_jugador_cartas WHERE id_partida = (SELECT id_partida FROM partidas WHERE codigo LIKE ?) AND activo = 1";
        $rel = $DB->query($query, array( $codigo ));
        $ordenes_sql = array();
        foreach($rel as $cadaOrden){
            $ordenes_sql[] = $cadaOrden["orden_llegada"];
        }

        $ordenes = array(1, 2, 3, 4);
        foreach($ordenes as $cadaOrden){
            if(!(in_array($cadaOrden, $ordenes_sql)))
            {
                $orden_llegada = $cadaOrden;
                break;
            }
        }
        /* Insertamos a la base de datos el jugador con sus cartas */
=======


        //Obtengo la carta 1 y se remueve del array de las disponibles
        $carta1 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta1, $total_cartas)]);

        echo "La carta 1 es: ".$carta1. "<br>";
       
        //Obtengo la carta 2 y se remueve del array de las disponibles
        $carta2 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta2, $total_cartas)]);

        echo "La carta 2 es: ".$carta2. "<br>";
     
        //Obtengo la carta 3 y se remueve del array de las disponibles
        $carta3 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta3, $total_cartas)]);

        echo "La carta 3 es: ".$carta3. "<br>";
       
        //Obtengo la carta 4 y se remueve del array de las disponibles
        $carta4 = array_rand($total_cartas,1);
        unset($total_cartas[array_search($carta4, $total_cartas)]);

        echo "La carta 4 es: ".$carta4. "<br>";
      

        
        global $DB;

        var_dump($carta1);
        var_dump($carta2);
        var_dump($carta3);
        var_dump($carta4);

>>>>>>> ab7e34327e38da2880399d40413c4c150e59ef32
        $query = "INSERT INTO rel_partida_jugador_cartas (id_partida, id_jugador, idcarta1, idcarta2, idcarta3, idcarta4, fecha, orden_llegada) 
                VALUES ((SELECT id_partida FROM partidas WHERE codigo LIKE ?) ,?,?,?,?,?,?,?
                )";
        $rel = $DB->query($query, array(
            $codigo,
            $idjugador,
            $carta1,
            $carta2,
            $carta3,
            $carta4,
            date("Y-m-d H:m:i"),
            $orden_llegada
        ));
    }




}