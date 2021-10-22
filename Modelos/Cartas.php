<?php

class CartasModelo{

    // Constructor del Modelo
    public function __construct()
    {

    }

    public function obtenerTodasLasCartas()
    {
        global $DB;
        $query = " SELECT * FROM cartas";
        $rel = $DB->query($query);
        return $rel;
    }

    public function obtenerCartasPorCategoria($categoria)
    {
        global $DB;
        $query = " SELECT * FROM cartas WHERE categoria = ?";
        $rel = $DB->query($query, array($categoria));
        return $rel;
    }

    public function cartasPorJugador( $codigo )
    {
        global $DB;
        $query = "
            SELECT 
                RPJC.id_jugador id_jugador
                ,C1.idcarta idcarta1
                ,C2.idcarta idcarta2
                ,C3.idcarta idcarta3
                ,C4.idcarta idcarta4
                ,C1.nombre carta1
                ,C2.nombre carta2
                ,C3.nombre carta3
                ,C4.nombre carta4
            FROM rel_partida_jugador_cartas RPJC 
                LEFT JOIN jugadores J ON J.id_jugador = RPJC.id_jugador
                LEFT JOIN cartas C1 ON C1.idcarta = RPJC.idcarta1
                LEFT JOIN cartas C2 ON C2.idcarta = RPJC.idcarta2
                LEFT JOIN cartas C3 ON C3.idcarta = RPJC.idcarta3
                LEFT JOIN cartas C4 ON C4.idcarta = RPJC.idcarta4
            WHERE 1=1
                AND (J.codigo LIKE ? OR J.id_jugador = ?)
        ";
        $res = $DB->query( $query , array( $codigo, $codigo ));
        return $res[0];
    }

    public function consultarCategoriaCarta($idcarta){
        global $DB;
        $query = " SELECT categoria FROM cartas WHERE idcarta = ?";
        $rel = $DB->query($query, array($idcarta));

        return $rel[0]["categoria"];
    }


}