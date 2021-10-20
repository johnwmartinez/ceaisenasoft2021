<?php

class JugadoresModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    function crearJugador($nombre)
    {
        global $DB;
        $_SESSION["codigo"] = session_code_user();

        $query = "INSERT INTO jugadores (codigo, nombre, updated_at) VALUES (?, ?, ?)";
        $rel = $DB->query($query, array(
            $_SESSION["codigo"],
            $nombre,
            date("Y-m-d H:m:i")
        ));
    
        return  $_SESSION["codigo"]; /*Devuelvo el codigo del jugador que fue creado*/

    }

    public function getJugadorByCodigo($codigo){

        global $DB;

        $query = "SELECT * FROM  jugadores WHERE codigo = ?";
        $rel = $DB->query($query, array($codigo));
        return $rel;
    
    }


}