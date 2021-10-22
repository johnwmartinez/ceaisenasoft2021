<?php

class PartidaJugadorTabla extends PartidaJugadorTablaModelo{

    function __construct()
    {
        
    }

    public function getTablaPorJugador( $codigo ) /* Vamos a armar en arrays la tabla del jugador */
    {
        /* Creamos objeto jugadores */
        $jugadores = new Jugadores();
        $dataJugador = $jugadores->getJugadorByCodigo( $codigo );
        /* Traemos todas las cartas que ya están en tablas de la DB */
        $dataDeTabla = $this->getTablaCompletaPorPartida($dataJugador[0]["id_partida"], $dataJugador[0]["id_jugador"]);
        /* Traemos todas las cartas del juego disponibles */
        $cartas = new Cartas();
        $todas_las_cartas = $cartas->obtenerTodasLasCartas();
        /* Armamos tabla HTML */
        $html = '
        <table class="table table-bordered table-hover table-sm tabla">
        ';
        foreach($todas_las_cartas as $cadaCarta){
            $poseedor = (isset($dataDeTabla[$cadaCarta["idcarta"]]))  ? $dataDeTabla[$cadaCarta["idcarta"]]["poseedor"] : '';
            $html .= '<tr>
                <td data-id-carta="'.$cadaCarta["idcarta"].'">'.$cadaCarta["nombre"].'</td>
                <td>'.$poseedor.'</td>
            </tr>';
        }
        $html .= '
        </table>';

        return $html;
    }

   
}