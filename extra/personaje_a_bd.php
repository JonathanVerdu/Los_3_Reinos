<?php

  include_once "../include/conectarBD.php";
  include_once "../include/funciones.php"; 
  session_start();

  $nombre = $_SESSION["nombre_pj"]." ".str_replace("_"," ",$_SESSION["apellido_pj"]);
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

  // Sabiendo la clase sacamos los máximos a los que puede subir
  $sql = "SELECT * FROM clases WHERE nombre = '$clase'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();
  $max_fuerza = $fila["subir_fu"];
  $max_destreza = $fila["subir_de"];
  $max_carisma = $fila["subir_ca"];
  $max_inteligencia = $fila["subir_in"];

  // Agregar personaje a la tabla "personajes"
  $sql = "INSERT INTO personajes(nombre, edad, altura, peso, raza, sexo, clase, usuario, exp, fuerza, destreza, carisma, inteligencia) VALUES ('$nombre', $edad, $altura, $peso, '$raza', '$sexo', '$clase', $usuario, $exp, $fu, $de, $ca, $in)";
  $res = $conexion->query($sql);

  // Agregar estado de las subidas de atributos (actualmente a 0 por ser personaje recien creados) y sus máximos según la clase inicial escogida, a la tabla "relaciones_atributomax_personaje"
  $sql = "INSERT INTO relaciones_atributomax_personaje VALUES ('$nombre', 'fu','0','$max_fuerza')";
  $res = $conexion->query($sql);
  $sql = "INSERT INTO relaciones_atributomax_personaje VALUES ('$nombre', 'de','0','$max_destreza')";
  $res = $conexion->query($sql);
  $sql = "INSERT INTO relaciones_atributomax_personaje VALUES ('$nombre', 'ca','0','$max_carisma')";
  $res = $conexion->query($sql);
  $sql = "INSERT INTO relaciones_atributomax_personaje VALUES ('$nombre', 'in','0','$max_inteligencia')";
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

  // Agregar ventajas a la tabla "relaciones_mejora_personaje"
  for($i=0; $i<count($array_ventajas);$i++){
  	$ventaja = $array_ventajas[$i];
  	$sql = "INSERT INTO relaciones_mejora_personaje VALUES ('$nombre', '$ventaja')";
  	$res = $conexion->query($sql);
  }

   // Agregar tecnicas a la tabla "relaciones_tecnica_personaje"
  for($i=0; $i<count($array_tecnicas);$i++){
  	$tecnica = $array_tecnicas[$i];
  	$sql = "INSERT INTO relaciones_tecnica_personaje VALUES ('$nombre', '$tecnica')";
  	$res = $conexion->query($sql);
  }

  // Agregar el personaje a la tabla "relaciones_usuario_personaje"
  $sql = "INSERT INTO relaciones_usuario_personaje VALUES ('$nombre', $usuario)";
  $res = $conexion->query($sql);

  $conexion->close();

  header('Location: ../gestion_personaje.php');
 
?>
