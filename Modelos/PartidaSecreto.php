<?php

class PartidaSecretoModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    function crearPartidaSecreto($codigo)
    {
        global $DB;
        
        /* Traemos todas las cartas disponibles */
        $cartas = new Cartas();
        $cartas_todas = $cartas->obtenerTodasLasCartas();
        shuffle($cartas_todas); /* Desordenamos el array de las cartas para hacerlo random */
        $categorias = array(1, 2, 3); /* Definimos las categorías de cada carta */
        $cartas_secretas = array(); /* Variable de salida con las cartas elegidas */

        /* Recorremos cada categoría para sacar una sola carta */
        foreach($categorias as $cadaCat){
            foreach($cartas_todas as $cadaCarta){
                if($cadaCarta["categoria"] == $cadaCat):
                    $cartas_secretas[] = $cadaCarta["idcarta"];
                    break; /* Cuando tenemos la carta elegida, rompemos el foreach */
                endif;
            }
        }

        /* Realizamos el insert a la DB con las cartas elegidas */
        $query = "INSERT INTO partidas_secreto (id_partida, idcarta1, idcarta2, idcarta3) VALUES ((
            SELECT id_partida FROM partidas WHERE codigo LIKE ?
        ), ?, ?, ?)";
        $rel = $DB->query($query, array(
            $codigo,
            $cartas_secretas[0], /* Carta 1 */
            $cartas_secretas[1], /* Carta 2 */
            $cartas_secretas[2]  /* Carta 3 */
        ));

        
    }

    /*Trae toda la información de las cartas secreto de la partida enviada por parámetro*/
    public function consultarCartasPartida($codigo){
        global $DB;

        $query = "SELECT * FROM partidas_secreto WHERE id_partida =  (SELECT id_partida FROM partidas WHERE codigo LIKE ?) ";
        $res = $DB->query($query, array( $codigo )); 
        return $res;
    }


}