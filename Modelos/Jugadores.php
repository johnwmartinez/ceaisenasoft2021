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
        
        $segundos = 30; /* Cantidad de segundos que dura un usuario inactivo para ser retirado */
        $marca_time = time() - $segundos; /* Vamos a verificar usuariros que tengan más de 120 segundos inactivos */
        $query = "
            SELECT 
                RPJC.id_partida id_partida
                ,RPJC.id_jugador id_jugador
                ,RPJC.idcarta1 idcarta1
                ,RPJC.idcarta2 idcarta2
                ,RPJC.idcarta3 idcarta3
                ,RPJC.idcarta4 idcarta4
                ,P.codigo codigo
                ,J.codigo codigo_usuario
            FROM rel_partida_jugador_cartas RPJC 
                LEFT JOIN jugadores J ON J.id_jugador = RPJC.id_jugador
                LEFT JOIN partidas P ON P.id_partida = J.id_partida
            WHERE RPJC.activo = 1 
                AND J.updated_at < ?
        ";
        $rel = $DB->query($query, array( $marca_time )); /* LISTO: jugadores inactivado por tiempo */
        /* Capturamos los IDS que vamos a inactivar en DB */
        $ids_inactivar = array();
        $id_partida = 0;
        $modifica_partida = 0;
        $partidas_modificadas = array();
        foreach($rel as $cadaID):
            $modifica_partida = 1;
            $ids_inactivar[] = $cadaID["id_jugador"];
            if (!(in_array($cadaID["id_partida"], $partidas_modificadas))):
                $partidas_modificadas[] = $cadaID["id_partida"];
            endif;
        endforeach;
        
        if(isset($rel[0])):
            /* Query para inactivar en DB */
            $eliminados = '';
            foreach($ids_inactivar as $eliminado):
                $eliminados = ($eliminados == "") ? $eliminado : $eliminados . ', ' .$eliminado;  /* Cada eliminado separado por coma */
            endforeach;
            $query = "UPDATE rel_partida_jugador_cartas SET activo = 0 WHERE id_jugador IN (?)";
            $res2 = $DB->query( $query , array( $eliminados )); /* Quedan inactivos del juego */
            
            if($modifica_partida == 1): /* Hay gente eliminada de esta partida */
                /* Ahora que los jugadores están inactivos, voy a repartir sus cartas */
                $partidas = new Partidas();
                foreach($partidas_modificadas as $id_partida):
                    $dataPartida = $partidas->getPartidaPorCodigo( $id_partida );
        
                    /* Procesamos los participantes eliminados */
                    foreach($rel as $cadaEliminado):
                        /* Traemos los contrincantes del usuario a ser eliminado */
                        $contrincantes = array();
                        $adversarios_array = $this->jugadoresContrincantes( $cadaEliminado["codigo"], $id_partida );
                        foreach($adversarios_array as $cadaAdversario):
                            $contrincantes[] = $cadaAdversario["id_jugador"];
                        endforeach;
                        
                        foreach($contrincantes as $cadaContr):
                            $partidaJugadorTabla = new PartidaJugadorTabla();
                            $datos = array(
                                $cadaEliminado["id_partida"],
                                $cadaContr,
                                $cadaEliminado["idcarta1"],
                                $cadaEliminado["idcarta2"],
                                $cadaEliminado["idcarta3"],
                                $cadaEliminado["idcarta4"],
                                $cadaEliminado["id_jugador"]
            
                            );
                            $partidaJugadorTabla->insertarCartasPorContrincante($datos);
                        endforeach;
                    endforeach;

                endforeach; /* foreach por partida */
            endif; /* end partida existe */
        endif; /* end isset rel 0 */

    }

    public function jugadoresContrincantes( $codigo, $id_partida = null ) /* Capturamos todos los jugadores contrincantes */
    {
        global $DB;

        /* Primero traemos la información de la partida a la que pertenece el jugador consultante */
        $partidas = new Partidas();
        $dataPartida = $partidas->getPartidaPorCodigoUsuario( $codigo );
        
        /* Ahora traemos la info de todos los contrincantes de esa partida_id */
        $query = "
        SELECT 
            RPJC.id_jugador id_jugador,
            J.nombre nombre
        FROM rel_partida_jugador_cartas RPJC
            LEFT JOIN jugadores J ON J.id_jugador = RPJC.id_jugador AND RPJC.activo = 1
        WHERE 1=1
            AND RPJC.id_partida = ? 
            AND J.codigo NOT LIKE ?
        ";
        $id_partida = ($id_partida == NULL) ? $dataPartida["id_partida"] : $id_partida;
        $res = $DB->query( $query, array( 
            $id_partida,
            $codigo
         ) );
        return $res; /* Devuelvo array con todos los participantes de la partida */
    }

}