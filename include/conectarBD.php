<?php

	// Datos para conectar a la base de datos en LOCALHOST
	//define("HOST", "localhost");
	//define("USER", "root");
	//define("PASS", "");
	//define("DB", "id612976_3reinos");

	// Datos para conectar a la base de datos en internet
	define("HOST", "localhost");
	define("USER", "1160243");
	define("PASS", "donphan123");
	define("DB", "1160243");

	function conectar(){
		$conexion = new mysqli(HOST,USER,PASS,DB);
		if($conexion->connect_errno > 0){
			echo "ERROR: ".$conexion->connect_error;
		}else{
			return $conexion;
		}
	}

?>