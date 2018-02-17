<?php

	include_once "../include/conectarBD.php";
	
	// Recogemos datos del ajax de gestion_personajes.php
	$personaje = $_POST["personaje"];
	$exp = $_POST["exp"];
	$cambio_fu = $_POST["cambio_fu"];
	$cambio_de = $_POST["cambio_de"];
	$cambio_ca = $_POST["cambio_ca"];
	$cambio_in = $_POST["cambio_in"];

	$conexion = conectar();
    $conexion->query("SET NAMES 'utf8'");

	// Sacamos los máximos y los actuales de los atributos del personaje
	$sql = "SELECT * FROM relaciones_atributomax_personaje WHERE personaje = '$personaje';";
	$res = $conexion->query($sql);

	/*$fu_max  = 0;
	$fu_actual = 0;
	$de_max = 0;
	$de_actual = 0;
	$ca_max = 0;
	$ca_actual = 0;
	$in_max = 0;
	$in_actual = 0;*/

	while($fila=$res->fetch_array()){
		if($fila['atributo'] == "fu"){
			$fu_max = $fila['subida_total'];
			$fu_actual = $fila['subida_actual'];
		}
		if($fila['atributo'] == "de"){
			$de_max = $fila['subida_total'];
			$de_actual = $fila['subida_actual'];
		}
		if($fila['atributo'] == "ca"){
			$ca_max = $fila['subida_total'];
			$ca_actual = $fila['subida_actual'];
		}
		if($fila['atributo'] == "in"){
			$in_max = $fila['subida_total'];
			$in_actual = $fila['subida_actual'];
		}
	}

	// Sacamos los atributos totales que tiene el personaje de su tabla "personajes"
	$sql = "SELECT * FROM personajes WHERE nombre = '$personaje';";
	$res = $conexion->query($sql);
	$fila = $res->fetch_array();
	$fu_total = $fila["fuerza"];
	$de_total = $fila["destreza"];
	$ca_total = $fila["carisma"];
	$in_total = $fila["inteligencia"];

	// Sumamos lo que añadimos a estos totales
	$fu_total += $cambio_fu;
	$de_total += $cambio_de;
	$ca_total += $cambio_ca;
	$in_total += $cambio_in;

	// Variables para error
	$error = 0;

	// Comprobamos de nuevo que el cambio no supera los maximos, y si no lo supera, lo aplicamos a la BD.
	$fu_ahora = $fu_actual + $cambio_fu;
	if($fu_ahora <= $fu_max){
		// Cambio en relaciones_atributomax_personaje
		$sql = "UPDATE relaciones_atributomax_personaje SET subida_actual = '$fu_ahora' WHERE personaje = '$personaje' AND atributo = 'fu';";
		$conexion->query($sql);
		// Cambio en personajes
		$sql = "UPDATE personajes SET fuerza = '$fu_total' WHERE nombre = '$personaje';";
		$conexion->query($sql);
	}else $error = "fu";

	$de_ahora = $de_actual + $cambio_de;
	if($de_ahora <= $de_max){
		// Cambio en relaciones_atributomax_personaje
		$sql = "UPDATE relaciones_atributomax_personaje SET subida_actual = '$de_ahora' WHERE personaje = '$personaje' AND atributo = 'de';";
		$conexion->query($sql);
		// Cambio en personajes
		$sql = "UPDATE personajes SET destreza = '$de_total' WHERE nombre = '$personaje';";
		$conexion->query($sql);
	}else $error = "de";

	$ca_ahora = $ca_actual + $cambio_ca;
	if($ca_ahora <= $ca_max){
		// Cambio en relaciones_atributomax_personaje
		$sql = "UPDATE relaciones_atributomax_personaje SET subida_actual = '$ca_ahora' WHERE personaje = '$personaje' AND atributo = 'ca';";
		$conexion->query($sql);
		// Cambio en personajes
		$sql = "UPDATE personajes SET carisma = '$ca_total' WHERE nombre = '$personaje';";
		$conexion->query($sql);
	}else $error = "ca";

	$in_ahora = $in_actual + $cambio_in;
	if($in_ahora <= $in_max){
		// Cambio en relaciones_atributomax_personaje
		$sql = "UPDATE relaciones_atributomax_personaje SET subida_actual = '$in_ahora' WHERE personaje = '$personaje' AND atributo = 'in';";
		$conexion->query($sql);
		// Cambio en personajes
		$sql = "UPDATE personajes SET inteligencia = '$in_total' WHERE nombre = '$personaje';";
		$conexion->query($sql);
	}else $error = "in";

	// Aplicamos el cambio de la EXP a la table de "personajes";
	$sql = "UPDATE personajes SET exp = '$exp' WHERE nombre = '$personaje';";
	$conexion->query($sql);


	// Preparamos variable para enviar nuevos datos por json
	$jsondata = array();
	$jsondata["error"] = $error;
	$jsondata["fu_max"] = $fu_max;
	$jsondata["de_max"] = $de_max;
	$jsondata["ca_max"] = $ca_max;
	$jsondata["in_max"] = $in_max;
	$jsondata["in_actual"] = $in_ahora;
	$jsondata["ca_actual"] = $ca_ahora;
	$jsondata["de_actual"] = $de_ahora;
	$jsondata["fu_actual"] = $fu_ahora;
	$jsondata["fu_total"] = $fu_total;
	$jsondata["in_total"] = $in_total;
	$jsondata["de_total"] = $de_total;
	$jsondata["ca_total"] = $ca_total;

	/*$conexion->close();*/

	echo json_encode($jsondata);

?>