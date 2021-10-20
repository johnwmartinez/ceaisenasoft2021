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

}