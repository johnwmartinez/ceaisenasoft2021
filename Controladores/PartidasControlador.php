<?php

class Partidas extends PartidasModelo{

    public function __construct()
    {
        
    }

    public function verSiPartidaExiste($codigo) /* Verificamos si la partida existe */
    {
        $dataPartida = $this->getPartidaPorCodigo($codigo);
        if(isset($dataPartida["id_partida"]))
            return true;
        return false;
    }

    /* Creamos la lógica deuna partida Total abierta */
    public function dataPartidaTotal($codigo) 
    {
        
    }
   
}