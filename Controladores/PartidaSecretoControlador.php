<?php

class PartidaSecreto extends PartidaSecretoModelo{

    function __construct()
    {
        
    }

   public function consultaracusacion($idprogramador, $idmodulo, 
                $iderror, $cartasPartidaSecreto, $codigopartida, $idjugadoracusacion){
       
        /*Obtengo las 3 cartas secreto en un array*/
        $cartassecreto = array();
        $cartassecreto[0] =  $cartasPartidaSecreto[0]["idcarta1"];
        $cartassecreto[1] =  $cartasPartidaSecreto[0]["idcarta2"];
        $cartassecreto[2] =  $cartasPartidaSecreto[0]["idcarta3"];

        $indiceCartaProgramador =  array_search($idprogramador, $cartassecreto);
        $indiceCartaModulo =  array_search($idmodulo, $cartassecreto);
        $indiceCartaError =  array_search($iderror, $cartassecreto);

        if($indiceCartaProgramador != "" && $indiceCartaModulo != ""  && $indiceCartaError != "" ){
           $partida = new Partidas();
           $partida->definirPartidaGanadora($idjugadoracusacion,$codigopartida);

            return "El jugador ganó la partida";
        }else{

          /*Se pierde el turno*/

           /*Se cambia el turno de la partida*/ 
          $partida = new Partidas();
          $partida->cambiarTurno($codigopartida);

          /*Se inactivan las preguntas*/
          $partidaPreguntas = new PartidasPreguntas();
          $partidaPreguntas->inactivarPreguntasPartidas($codigopartida);

          return "La acusación es falsa, el jugador perdió el turno";
        }

   }

}