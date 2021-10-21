<?php

class PartidasModelo{

    // Constructor del Modelo
    public function __construct()
    {

    }

    public function crearPartida() /* Esta función crea una nueva partida en el sistema */
    {
        global $DB;

        $codigo = hexa_aleatorio();  /* Código de partida */
        $query = "INSERT INTO partidas (codigo) VALUES (?)";
        $rel = $DB->query($query, array($codigo));

        return $codigo; /* Devuelvo el código con el que la partida fue creada */
    }

    public function getPartidaPorCodigo($codigo) /* Traemos toda la info de una partida por código de partida */
    {
        global $DB;

        $query = "SELECT * FROM partidas WHERE codigo LIKE ? ";
        $res = $DB->query($query, array( $codigo ));
        if(isset($res[0]))
            return $res[0]; /* Devolvemos array con la data de la partida */
        return 0;
    }

    public function getPartidaPorCodigoUsuario($codigo) /* Traemos toda la info de una partida por código de usuario */
    {
        
        global $DB;
        $query = "SELECT codigo FROM partidas WHERE id_partida = 
            (
                SELECT id_partida FROM jugadores WHERE codigo = ?
            )";
        $res = $DB->query($query, array( $codigo ));
        
        if(isset($res[0]["codigo"]))
            return $this->getPartidaPorCodigo($res[0]["codigo"]); /*  */
        return array(0);
        
    }

    public function activarPartida($codigo) /* Activar una partida */
    {
        global $DB;

        $query = "UPDATE partidas SET estado = 1 WHERE codigo LIKE ?";
        $res = $DB->query($query, array( $codigo ));
    }

    

}