<?php

  include_once "../include/conectarBD.php";
  include_once "../include/funciones.php"; 
  session_start();

  $nombre = $_POST["nombre"];
  $jsondata = array();

  $jsondata["nombre"] = $nombre;
  $jsondata["prueba"] = "caca";
 
  echo json_encode($jsondata);

?>