<?php

  include_once "../include/conectarBD.php";
  include_once "../include/funciones.php"; 
  session_start();

  $nombre = $_SESSION["nombre_pj"]." ".$_SESSION["apellido_pj"];
  $edad = $_SESSION["edad_pj"];
  $altura = $_SESSION["altura_pj"];
  $peso = $_SESSION["peso_pj"];
  $raza = $_SESSION["raza_pj"];
  $sexo = $_SESSION["sexo_pj"];
  $clase = $_SESSION["clase"];
  $usuario_nombre = $_SESSION["usuario"];
  $exp = 0;
  $fu = $_SESSION["fu"];
  $de = $_SESSION["de"];
  $ca = $_SESSION["ca"];
  $in = $_SESSION["int"];
  $array_nombres_habilidades_medias = $_SESSION["array_nombres_habilidades_medias"];
  $array_habilidades_medias = $_SESSION["array_habilidades_medias"];
  $array_nombres_habilidades_faciles = $_SESSION["array_nombres_habilidades_faciles"];
  $array_habilidades_faciles = $_SESSION["array_habilidades_faciles"];
  $array_nombre_habilidades = $_SESSION["array_nombre_habilidades"];
  $array_habilidades = $_SESSION["array_habilidades"];
  $array_ventajas = $_SESSION["array_ventajas"];
  $array_tecnicas = $_SESSION["array_tecnicas"];

  $conexion = conectar();
  $conexion->query("SET NAMES 'utf8'");

  // Sacar el id del usuario en base a su nombre
  $sql = "SELECT ID from usuarios WHERE nombre = '$usuario_nombre'";
  $query = $conexion->query($sql);
  $res = $query->fetch_array();

  $usuario = $res["ID"];

  // Agregar personaje a la tabla "personajes"
  $sql = "INSERT INTO personajes(nombre, edad, altura, peso, raza, sexo, clase, usuario, exp, fuerza, destreza, carisma, inteligencia) VALUES ('$nombre', $edad, $altura, $peso, '$raza', '$sexo', '$clase', $usuario, $exp, $fu, $de, $ca, $in)";
  $res = $conexion->query($sql);

  // Agregar habilidades en la tabla "relaciones_habilidad_personaje"
  for($i=0; $i<count($array_nombres_habilidades_medias); $i++){
  	$habilidad = $array_nombres_habilidades_medias[$i];
  	$bono = $array_habilidades_medias[$i];
  	$sql = "INSERT INTO relaciones_habilidad_personaje VALUES ('$nombre', '$habilidad', $bono)";
  	$res = $conexion->query($sql);
  }
  for($i=0; $i<count($array_nombres_habilidades_faciles); $i++){
  	$habilidad = $array_nombres_habilidades_faciles[$i];
  	$bono = $array_habilidades_faciles[$i];
  	$sql = "INSERT INTO relaciones_habilidad_personaje VALUES ('$nombre', '$habilidad', $bono)";
  	$res = $conexion->query($sql);
  }
  for($i=0; $i<count($array_nombre_habilidades); $i++){
  	$habilidad = $array_nombre_habilidades[$i];
  	$bono = $array_habilidades[$i];
  	$sql = "INSERT INTO relaciones_habilidad_personaje VALUES ('$nombre', '$habilidad', $bono)";
  	$res = $conexion->query($sql);
  }

  // Agregar ventajas
  for($i=0; $i<count($array_ventajas);$i++){
  	$ventaja = $array_ventajas[$i];
  	$sql = "INSERT INTO relaciones_mejora_personaje VALUES ('$nombre', '$ventaja')";
  	$res = $conexion->query($sql);
  }

   // Agregar tecnicas
  for($i=0; $i<count($array_tecnicas);$i++){
  	$tecnica = $array_tecnicas[$i];
  	$sql = "INSERT INTO relaciones_tecnica_personaje VALUES ('$nombre', '$tecnica')";
  	$res = $conexion->query($sql);
  }

  // Agregar el personaje al usuario
  $sql = "INSERT INTO relaciones_usuario_personaje VALUES ('$nombre', $usuario)";
  $res = $conexion->query($sql);

  $conexion->close();

  header('Location: ../gestion_personaje.php');
 
?>
