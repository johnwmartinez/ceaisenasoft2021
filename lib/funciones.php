<?php

/* Listado de funciones del juego */

function hexa_aleatorio() /* Función que crea códigos hexadecimales de 5 caracteres */
{
    $numero_ejemplo = rand(65536, 1048575);
    return strtoupper(dechex($numero_ejemplo));
}

function session_code_user()
{
    $numero = rand(100, 999) . time();
    return $numero;
}
