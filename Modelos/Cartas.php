<?php

class CartasModelo{

    // Constructor del Modelo
    public function __construct()
    {

    }

    public function obtenerCartasPorCategoria($categoria)
    {
        global $DB;
        $query = " SELECT * FROM cartas WHERE categoria = ?";
        $rel = $DB->query($query, array($categoria));
        return $rel;
    }

}