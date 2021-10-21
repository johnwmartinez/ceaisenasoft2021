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
        $query = "SELECT J.id_partida id_partida, J.id_jugador id_jugador, P.codigo codigo_partida FROM jugadores J LEFT JOIN partidas P ON P.id_partida = J.id_partida
         WHERE J.codigo LIKE ?";
        $jugadores_data = $DB->query($query, array( $codigoUser ));
        
        $marca_time = time() - 120; /* Vamos a verificar usuariros que tengan más de 120 segundos inactivos */

        /* Ahora hacemos el análisis por jugador individual */
        $query = "SELECT * FROM rel_partida_jugador_cartas WHERE id_jugador IN (
            SELECT id_jugador FROM jugadores WHERE updated_at < ? AND id_jugador IN (SELECT id_jugador FROM rel_partida_jugador_cartas WHERE id_partida = ?) 
        ) AND activo = 1";
        $rel2 = $DB->query($query, array( $marca_time, $jugadores_data[0]["id_partida"] )); 
        
        $query = "UPDATE rel_partida_jugador_cartas SET activo = 0 WHERE id_jugador IN (
            SELECT id_jugador FROM jugadores WHERE updated_at < ?
        )";
        $rel = $DB->query($query, array( $marca_time )); /* LISTO: jugadores inactivado */

        if(isset($rel2[0]["id_jugador"])):
            
            /* Procedemos a revelarle a los otros jugadores, las cartas de este jugador inactivo */
            $partidas = new Partidas();
            $dataPartida = $partidas->getPartidaPorCodigo($jugadores_data[0]["codigo_partida"]);
    
            if($dataPartida["estado"] == 1): /* Si la partida está activa, entonces mostramos cartas */
        
                $contrincantes = array();
                $adversarios_array = $this->jugadoresContrincantes( $codigoUser );
                foreach($adversarios_array as $cadaAdversario):
                    $contrincantes[] = $cadaAdversario["id_jugador"];
                endforeach;
    
                /* Saber las cartas del jugador que estoy inactivando */
                $partidasJugadorCartas = new PartidaJugadorCartas();
                $dataCartas = $partidasJugadorCartas->consultarCartasPartidaPorJugador($jugadores_data[0]["id_jugador"], $jugadores_data[0]["codigo_partida"]);
                
                foreach($contrincantes as $cadaContr):
                    $partidaJugadorTabla = new PartidaJugadorTabla();
                    $datos = array(
                        $jugadores_data[0]["id_partida"],
                        $cadaContr,
                        $dataCartas[0]["idcarta1"],
                        $dataCartas[0]["idcarta2"],
                        $dataCartas[0]["idcarta3"],
                        $dataCartas[0]["idcarta4"],
                        $jugadores_data[0]["id_jugador"]
    
                    );
                    $partidaJugadorTabla->insertarCartasPorContrincante($datos);
                endforeach;
    
    
                /*
                3. insertarlos en rel_partida_jugador_tablas para TODOS los adversarios
                */
    
    
            endif; /* datapartida estado 1 */
        endif;



    }

    public function jugadoresContrincantes( $codigo )
    {
        global $DB;

        /* Primero traemos la información de la partida a la que pertenece el jugador consultante */
        $partidas = new Partidas();
        $dataPartida = $partidas->getPartidaPorCodigoUsuario( $codigo );
        
        /* Ahora traemos la info de todos los contrincantes de esa partida_id */
        $query = "SELECT 
            RPJC.id_jugador id_jugador,
            J.nombre nombre
        FROM rel_partida_jugador_cartas RPJC
            LEFT JOIN jugadores J ON J.id_jugador = RPJC.id_jugador AND RPJC.activo = 1
        WHERE 1=1
            AND RPJC.id_partida = ? 
            AND J.codigo NOT LIKE ?
            AND RPJC.activo = 1
        ";
        $res = $DB->query( $query, array( 
            $dataPartida["id_partida"],
            $codigo
         ) );
        return $res; /* Devuelvo array con todos los participantes de la partida */
    }

}