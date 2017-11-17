<?php

	include_once "conectarBD.php";


    session_start();


	$usuario_borrar = $_SESSION["usuario"];

	$conexion = conectar();
	$sql = "DELETE FROM usuarios WHERE nombre = '$usuario_borrar';";
	$conexion->query($sql);
	$conexion->close();

	unset($_SESSION["usuario"]);

	header('Location: index.php');

?>