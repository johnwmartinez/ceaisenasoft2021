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

    public function insertarCartasPorContrincante($datos)
    {
        global $DB;
        // $datos = array(
        //     $jugadores_data[0]["id_partida"],
        //     $cadaContr,
        //     $dataCartas[0]["idcarta1"],
        //     $dataCartas[0]["idcarta2"],
        //     $dataCartas[0]["idcarta3"],
        //     $dataCartas[0]["idcarta4"],
        //     $jugadores_data[0]["id_jugador"]

        // );
        $query = "INSERT INTO rel_partida_jugador_tablas (id_partida, id_jugador, idcarta, poseedor_id) 
            VALUES (?,?,?,?)";
        $rel = $DB->query($query, array(
            $datos[0], $datos[1], $datos[2], $datos[6]));  /* Inserta carta 1 */
        $rel = $DB->query($query, array(
            $datos[0], $datos[1], $datos[3], $datos[6]));/* Inserta carta 2 */
        $rel = $DB->query($query, array(
            $datos[0], $datos[1], $datos[4], $datos[6]));/* Inserta carta 3 */
        $rel = $DB->query($query, array(
            $datos[0], $datos[1], $datos[5], $datos[6]));/* Inserta carta 4 */
    }

    public function getTablaCompletaPorPartida( $id_partida, $id_jugador ){ /* Nos traemos toda la data de las tablas*/
        global $DB;
        
        $salida = array();
        $query = "
        SELECT 
            RPJT.id_jugador id_jugador,
            RPJT.idcarta idcarta,
            RPJT.poseedor_id poseedor_id,
            J.nombre nombre,
            P.nombre poseedor
        FROM rel_partida_jugador_tablas RPJT
            LEFT JOIN jugadores J ON J.id_jugador = RPJT.id_jugador
            LEFT JOIN jugadores P ON P.id_jugador = RPJT.poseedor_id
        WHERE RPJT.id_partida = ? AND RPJT.id_jugador = ? ";
        $res = $DB->query($query, array( $id_partida, $id_jugador ));
        /* armamos la tabla con los campos que necesito */
        foreach($res as $cadaCarta){
            $cadaCarta["poseedor"] = ($cadaCarta["poseedor"] == $cadaCarta["nombre"]) ? 'Tú mismo' : $cadaCarta["poseedor"];
            $salida[$cadaCarta["idcarta"]] = array(
                "id_jugador" => $cadaCarta["id_jugador"],
                "idcarta" => $cadaCarta["idcarta"],
                "poseedor_id" => $cadaCarta["poseedor_id"],
                "nombre" => $cadaCarta["nombre"],
                "poseedor" => $cadaCarta["poseedor"],
            );
        }
        return $salida; /* retornamos la tabla en arrays */
    }
    
}