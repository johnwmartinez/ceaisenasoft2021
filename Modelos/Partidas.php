<?php

class PartidasModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    function crearPartida()
    {
        global $DB;
        $query = "INSERT INTO partidas (codigo) VALUES (?)";
        $rel = $DB->query($query, array(hexa_aleatorio()));
    }

}