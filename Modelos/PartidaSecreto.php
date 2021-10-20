<?php

class PartidaSecretoModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    function crearPartidaSecreto($idpartida)
    {
        global $DB;
        $query = "INSERT INTO partidas_secreto (idpartida, idcarta1, idcarta2, idcarta3) VALUES (?, ?, ?)";
        $rel = $DB->query($query, array(
            $idpartida,
            //Pendiente llamar la función del modelo de cartas que genera aleatorio las carta1, carta2 y carta3
        ));
        
    }


}