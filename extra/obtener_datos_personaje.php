<?php

  include_once "../include/conectarBD.php";
  include_once "../include/funciones.php"; 
  session_start();

  $nombre = $_POST["nombre"];
  $jsondata = array();

  $conexion = conectar();
  $conexion->query("SET NAMES 'utf8'");

  // Datos de tabla personajes
  $sql = "SELECT * FROM personajes WHERE nombre = '$nombre'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();

  $edad = $fila["edad"]; 
  $altura = $fila["altura"];
  $peso = $fila["peso"];
  $raza = $fila["raza"];
  $sexo = $fila["sexo"];
  $clase = $fila["clase"];
  $exp = $fila["exp"];
  $fuerza = $fila["fuerza"];
  $destreza = $fila["destreza"];
  $carisma = $fila["carisma"];
  $inteligencia = $fila["inteligencia"];

  // Datos de la tabla clases que corresponda a la del personaje
  $sql2 = "SELECT * FROM clases WHERE nombre = '$clase';";
  $res = $conexion->query($sql2);
  $fila = $res-> fetch_array();

  $jsondata["sql2"] = $sql2; 

  $habilidad_facil_1 = $fila["habilidad_facil_1"];
  $habilidad_facil_2 = $fila["habilidad_facil_2"];
  $habilidad_facil_3 = $fila["habilidad_facil_3"];
  $habilidad_facil_4 = $fila["habilidad_facil_4"];
  $habilidad_facil_5 = $fila["habilidad_facil_5"];
  $habilidad_facil_6 = $fila["habilidad_facil_6"];
  $habilidad_media_1 = $fila["habilidad_media_1"];
  $habilidad_media_2 = $fila["habilidad_media_2"];
  $habilidad_media_3 = $fila["habilidad_media_3"];
  $habilidad_media_4 = $fila["habilidad_media_4"];
  $habilidad_media_5 = $fila["habilidad_media_5"];
  $habilidad_media_6 = $fila["habilidad_media_6"];
  $ventaja_1 = $fila["ventaja_1"];
  $ventaja_2 = $fila["ventaja_2"];
  $ventaja_3 = $fila["ventaja_3"];
  $ventaja_4 = $fila["ventaja_4"];
  $ventaja_5 = $fila["ventaja_5"];
  $ventaja_6 = $fila["ventaja_6"];
  $tecnica_1 = $fila["tecnica_1"];
  $tecnica_2 = $fila["tecnica_2"];
  $tecnica_3 = $fila["tecnica_3"];
  $tecnica_4 = $fila["tecnica_4"];
  $tecnica_5 = $fila["tecnica_5"];
  $tecnica_6 = $fila["tecnica_6"];
  $tecnica_7 = $fila["tecnica_7"];
  $tecnica_8 = $fila["tecnica_8"];
  $tecnica_9 = $fila["tecnica_9"];
  $tecnica_10 = $fila["tecnica_10"];

  // Sacamos los actuales y los máximos a los que puede subir de cada atributo
  $sql = "SELECT * FROM relaciones_atributomax_personaje WHERE personaje = '$nombre' AND atributo = 'fu'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();
  $actual_fuerza = $fila["subida_actual"];
  $max_fuerza = $fila["subida_total"];

  $sql = "SELECT * FROM relaciones_atributomax_personaje WHERE personaje = '$nombre' AND atributo = 'de'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();
  $actual_destreza = $fila["subida_actual"];
  $max_destreza = $fila["subida_total"];

  $sql = "SELECT * FROM relaciones_atributomax_personaje WHERE personaje = '$nombre' AND atributo = 'ca'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();
  $actual_carisma = $fila["subida_actual"];
  $max_carisma = $fila["subida_total"];

  $sql = "SELECT * FROM relaciones_atributomax_personaje WHERE personaje = '$nombre' AND atributo = 'in'";
  $res = $conexion->query($sql);
  $fila = $res->fetch_array();
  $actual_inteligencia = $fila["subida_actual"];
  $max_inteligencia = $fila["subida_total"];

  // Pasamos los datos recolectados al objeto JSON
  $jsondata["nombre"] = $nombre;
  $jsondata["edad"] = $edad;
  $jsondata["altura"] = $altura;
  $jsondata["peso"] = $peso;
  $jsondata["raza"] = $raza;
  $jsondata["sexo"] = $sexo;
  $jsondata["clase"] = $clase;
  $jsondata["exp"] = $exp;
  $jsondata["fuerza"] = $fuerza;
  $jsondata["destreza"] = $destreza;
  $jsondata["carisma"] = $carisma;
  $jsondata["inteligencia"] = $inteligencia;
  $jsondata["maxFuerza"] = $max_fuerza;
  $jsondata["actualFuerza"] = $actual_fuerza;
  $jsondata["maxDestreza"] = $max_destreza;
  $jsondata["actualDestreza"] = $actual_destreza;
  $jsondata["maxCarisma"] = $max_carisma;
  $jsondata["actualCarisma"] = $actual_carisma;
  $jsondata["maxInteligencia"] = $max_inteligencia;
  $jsondata["actualInteligencia"] = $actual_inteligencia;
  $jsondata["habilidad_facil_1"] = $habilidad_facil_1;
  $jsondata["habilidad_facil_2"] = $habilidad_facil_2;
  $jsondata["habilidad_facil_3"] = $habilidad_facil_3;
  $jsondata["habilidad_facil_4"] = $habilidad_facil_4;
  $jsondata["habilidad_facil_5"] = $habilidad_facil_5;
  $jsondata["habilidad_facil_6"] = $habilidad_facil_6;
  $jsondata["habilidad_media_1"] = $habilidad_media_1;
  $jsondata["habilidad_media_2"] = $habilidad_media_2;
  $jsondata["habilidad_media_3"] = $habilidad_media_3;
  $jsondata["habilidad_media_4"] = $habilidad_media_4;
  $jsondata["habilidad_media_5"] = $habilidad_media_5;
  $jsondata["habilidad_media_6"] = $habilidad_media_6;
  $jsondata["ventaja_1"] = $ventaja_1;
  $jsondata["ventaja_2"] = $ventaja_2;
  $jsondata["ventaja_3"] = $ventaja_3;
  $jsondata["ventaja_4"] = $ventaja_4;
  $jsondata["ventaja_5"] = $ventaja_5;
  $jsondata["ventaja_6"] = $ventaja_6;
  $jsondata["tecnica_1"] = $tecnica_1;
  $jsondata["tecnica_2"] = $tecnica_2;
  $jsondata["tecnica_3"] = $tecnica_3;
  $jsondata["tecnica_4"] = $tecnica_4;
  $jsondata["tecnica_5"] = $tecnica_5;
  $jsondata["tecnica_6"] = $tecnica_6;
  $jsondata["tecnica_7"] = $tecnica_7;
  $jsondata["tecnica_8"] = $tecnica_8;
  $jsondata["tecnica_9"] = $tecnica_9;
  $jsondata["tecnica_10"] = $tecnica_10;


  // Datos de las habilidades
  $sql = "SELECT * FROM relaciones_habilidad_personaje WHERE personaje = '$nombre'";
  $res = $conexion->query($sql);

  $i = 0;
  while($fila = $res->fetch_array()){
  	$nombre_hab = $fila["habilidad"];
  	$bono_hab = $fila["bono"];
  	$jsondata["habilidad_nombre"][$i] = $nombre_hab;
  	$jsondata["habilidad_bono"][$i] = $bono_hab;
  	$i++;
  }
  $jsondata["sql"] = $sql;

  // Datos de las mejoras
  $sql = "SELECT * FROM relaciones_mejora_personaje WHERE personaje = '$nombre'";
  $res = $conexion->query($sql);

  $i = 0;
  while($fila = $res->fetch_array()){
  	$mejora = $fila["mejora"];
  	$jsondata["mejora"][$i] = $mejora;
  	$i++;
  }

  // Datos de las tecnicas
  $sql = "SELECT * FROM relaciones_tecnica_personaje WHERE personaje = '$nombre'";
  $res = $conexion->query($sql);

  $i = 0;
  while($fila = $res->fetch_array()){
  	$tecnica = $fila["tecnica"];
  	$jsondata["tecnica"][$i] = $tecnica;
  	$i++;
  }
 
  echo json_encode($jsondata);
	 
?>