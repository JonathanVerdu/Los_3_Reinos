<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimym-scale=1.0 shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="../style.css">

    <!-- Conexión con BD -->
    <?php include_once "../include/conectarBD.php"; ?>

    <!-- Include de funciones -->
    <?php include_once "../include/funciones.php"; ?>

    <!-- Iniciar sesión -->
    <?php session_start(); ?>

  </head>
  <body>
	<?php
	// HACER BUSQUEDA GENERAL
	$tabla = $_GET["tabla"];
	$nombre = $_GET["nombre"];

	$conexion= conectar();
	$conexion->query("SET NAMES 'utf8'");
	$sql = "SELECT * FROM $tabla WHERE nombre = '$nombre';";
	$res = $conexion->query($sql);


	// RESULTADOS SI ES TABLA MEJORAS 
	if ($tabla == "mejoras" ){

		$fila = $res->fetch_array();
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $efecto = $fila['efecto'];
        $origen = $fila['origen'];
		echo
		"
	    <div id='recuadro_bd'>
	      <h3>MEJORA</h3>
	      <p class='titulo_bd'>$nombre</p>
	      <p><span class='apartado_bd'>Clase/s: </span>$origen</p>
	      <p class='descripcion_bd'>$descripcion</p>
	      <p>$efecto</p>
	    </div>
		";
	}

	// RESULTADOS SI ES TABLA TECNICAS
	if ($tabla == "tecnicas"){

        $fila = $res->fetch_array();
        $nombre = $fila['nombre'];
      	$coste_pv = $fila['coste_pv'];
      	$coste_accion = $fila['coste_accion'];
      	$impactar = $fila["habilidad_impactar"];
      	$descripcion = $fila['descripcion'];
      	$efecto = $fila['efecto'];
      	$origen = $fila['origen'];

		echo
		"
			<div id='recuadro_bd'>
			  <h3>TECNICA</h3>
	          <p class='titulo_bd'>$nombre</p>
	          <p><span class='apartado_bd'>Clase/s: </span>$origen</p>
	          <p><span class='apartado_bd'>Impactar con: </span>$impactar</p>
	          <p><span class='apartado_bd'>Coste PV: </span>$coste_pv</p>
	          <p><span class='apartado_bd'>Coste Acción: </span>$coste_accion</p>
	          <p class='descripcion_bd'>$descripcion </p>
	          <p>$efecto</p>
	        </div>
		";
	}

	// RESULTADOS SI ES TABLA HABILIDADES
	if ($tabla == "habilidades" ){

		$fila = $res->fetch_array();
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $efecto = $fila['efecto'];
        $origen = $fila['origen'];
		echo
		"
	    <div id='recuadro_bd'>
	      <h3>HABILIDAD</h3>
	      <p class='titulo_bd'>$nombre</p>
	      <p><span class='apartado_bd'>Clase/s: </span>$origen</p>
	      <p class='descripcion_bd'>$descripcion</p>
	      <p>$efecto</p>
	    </div>
		";
	}


	$conexion->close();

	?>
  </body>
</html>