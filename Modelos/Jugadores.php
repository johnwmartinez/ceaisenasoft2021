<?php

class JugadoresModelo{

    // Constructor del Modelo
    function __construct()
    {

    }

    /* Creamos el jugador */
    function crearJugador($nombre, $codigoPartida)
    {
        global $DB;
        $_SESSION["codigo"] = session_code_user();
        
        $query = "INSERT INTO jugadores (id_partida, codigo, nombre, updated_at) VALUES ( (SELECT id_partida FROM partidas WHERE codigo LIKE ?), ?, ?, ?)";
        $rel = $DB->query($query, array(
            $codigoPartida,
            $_SESSION["codigo"],
            $nombre,
            time()
        ));
    
        return $_SESSION["codigo"]; /*Devuelvo el codigo del jugador que fue creado*/

    }

    /* Traer la data del jugador por código (session) */
    public function getJugadorByCodigo($codigo){

        global $DB;
        $query = "SELECT * FROM  jugadores WHERE codigo = ?";
        $rel = $DB->query($query, array($codigo));
        return $rel;
    
    }
    
    /* Función que actualiza la marca time en el jugador para verificar que esté activo */
    public function updated_atTime($codigo)
    {
        global $DB;
        /* Primero verificamos si el usuario, aunque tenga session, quedó inactivo */
        $activo = $this->usuarioActivoPorCodigo($codigo);
        /* Actualizamos marca time en el usuario */
        if($activo === 1):
            $query = "UPDATE jugadores SET updated_at = ? WHERE codigo LIKE ? ";
            $rel = $DB->query($query, array(
                time(),
                $codigo
            ));
        else:
            unset($_SESSION["codigo"]); /* Usuario inactivo. Borramos variable sesión para crear una nueva */
        endif;
    }

    /* Verificar si un usuario está activo */
    public function usuarioActivoPorCodigo($codigo)
    {
        global $DB;
        /* Intersectamos dos tablas para consultar por código */
        $query = "SELECT RPJC.activo activo FROM rel_partida_jugador_cartas RPJC 
            LEFT JOIN jugadores J ON J.id_jugador = RPJC.id_jugador
            WHERE J.codigo LIKE ? ";
        $res  = $DB->query($query, array( $codigo ));
        return $res[0]["activo"];
    }

    /* verificar que los usuarios de una partida estén activos */
    public function verificarJugadoresActivos($codigoUser)
    {
        global $DB;
        $query = "SELECT id_partida FROM jugadores WHERE codigo LIKE ?";
        $rel = $DB->query($query, array( $codigoUser ));
        
        $marca_time = time() - 120; /* Vamos a verificar usuariros que tengan más de 120 segundos inactivos */
        $query = "UPDATE rel_partida_jugador_cartas SET activo = 0 WHERE id_jugador IN (
            SELECT id_jugador FROM jugadores WHERE updated_at <= ?
        )";
        $rel = $DB->query($query, array( $marca_time ));
        
    }

}