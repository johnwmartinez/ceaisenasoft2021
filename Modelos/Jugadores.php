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
            time()
        ));
    
        return  $_SESSION["codigo"]; /*Devuelvo el codigo del jugador que fue creado*/

    }

    public function getJugadorByCodigo($codigo){

        global $DB;
        $query = "SELECT * FROM  jugadores WHERE codigo = ?";
        $rel = $DB->query($query, array($codigo));
        return $rel;
    
    }
    
    
    public function updated_atTime($codigo)
    {
        global $DB;

        $query = "UPDATE jugadores SET updated_at = ? WHERE codigo LIKE ? ";
        $rel = $DB->query($query, array(
            time(),
            $codigo
        ));
    }

}