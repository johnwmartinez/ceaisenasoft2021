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

    public function consultarCartasPartidaPorJugador($id_jugador, $codigo){
        global $DB;
        $query = "SELECT * FROM rel_partida_jugador_cartas WHERE id_partida =  (SELECT id_partida FROM partidas WHERE codigo LIKE ?) AND activo = 1 AND id_jugador = ?";
        $res = $DB->query($query, array($codigo, $id_jugador)); 
        return $res;
    }

    public function repartirCartasJugador($codigo, $idjugador, $total_cartas){ /* $codigo es de la partida */

        global $DB;

        //Se desordena el array con las cartas disponibles
        shuffle($total_cartas); 
        /* Con el array desordenado, puedo tomar las primeras cuatro cartas */
        $carta1 = $total_cartas[0];
        $carta2 = $total_cartas[1];
        $carta3 = $total_cartas[2];
        $carta4 = $total_cartas[3];
       
        /* Verificamos cuantos participantes tenemos para definir el orden de llegada */
        $query = "SELECT orden_llegada FROM rel_partida_jugador_cartas WHERE id_partida = (SELECT id_partida FROM partidas WHERE codigo LIKE ?) AND activo = 1";
        $rel = $DB->query($query, array( $codigo ));
        $ordenes_sql = array();
        foreach($rel as $cadaOrden){
            $ordenes_sql[] = $cadaOrden["orden_llegada"]; /** */
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

        /*Inserto los registros a la tabla rel_partida_jugador_tablas*/
        $partidaJugadorTabla = new PartidaJugadorTabla();
        $partidaJugadorTabla->insertarPartidaJugadorTabla($codigo, $idjugador);

        /* Verificamos si los turnos ya est??n llenos para arrancar la partida */
        if(count($ordenes_sql) == 3): /* Si es == a 3 ya est?? lleno, porque despu??s del insert quedan en 4 */
            /* Activamos la partida como "iniciada" */
            $partidas = new Partidas();
            $partidas->activarPartida($codigo); /* Activamos la partida como iniciada */
        endif;
    }

    public function inactivarParticipante( $codigo ){
        global $DB;
        $query = "UPDATE ";
    }




}