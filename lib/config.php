<?php
    session_start();
	// Directorio del juego
	$app_dir = dirname(dirname(__FILE__));
	// Se incluye en el ambiente el directorio de mi aplicacion
	include_path_ini($app_dir);
	function include_path_ini($app_dir) {
      //echo php_uname();
	  $include_path = ini_get("include_path");
	  $include_path .= (substr(php_uname(), 0, 3) == "Win") ? ";" : ":";
	  $include_path .= $app_dir;
	  //echo $include_path;
	  ini_set("include_path", $include_path);
	}	