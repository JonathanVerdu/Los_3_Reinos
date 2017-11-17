<?php
	// Saca el id a partir del nombre del usuario y lo devuelve
	function sacar_id($nom_usuario){
		$conexion=conectar();
		$sql = "SELECT ID FROM usuarios WHERE nombre = '$nom_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$conexion->close();
		return $fila[0];
	}

	// Saca el nombre del jugador a partir de su id y lo devuelve
	function sacar_nombre($id){
		$conexion=conectar();
		$sql = "SELECT nombre FROM usuarios WHERE ID = '$id';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$conexion->close();
		return $fila[0];
	}

	// Vemos los jugadores asociados a un DJ y los escribe en fila
	function usuarios_de_dj($id_dj){
		$conexion=conectar();
		$sql = "SELECT id_jugador FROM relaciones_dj_jugador WHERE id_dj = '$id_dj';";
		$res = $conexion->query($sql);
		$cont = 0;
		while($fila = $res->fetch_array()){
			echo "- ".sacar_nombre($fila[0])."<br />";
			$cont++;
		}
		if($cont == 0) echo "- No tienes jugadores asociados";
		$conexion->close();
	}

	// Comprobar si el nombre existe como usuario. Devuelve true o false
	function existe_usuario($nom_usuario){
		$conexion=conectar();
		$sql ="SELECT ID FROM usuarios WHERE nombre = '$nom_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->num_rows;
		$existe=false;
		if($fila != 0) $existe=true;
		$conexion->close();
		return $existe;
	}

	// Saber si es jugador o no. Si lo es devuelve true, sino devuelve false
	function es_jugador($nom_usuario){
		$conexion=conectar();
		$sql ="SELECT dj FROM usuarios WHERE nombre = '$nom_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$esjugador=false;
		if($fila[0] == 0) $esjugador=true;
		$conexion->close();
		return $esjugador;
	}

	// Comprobar si el usuario tiene una invitación pendiente, si la tiene devuelve true y si no false
	function tiene_invitacion($nom_usuario){
		$conexion=conectar();
		$sql ="SELECT aviso FROM usuarios WHERE nombre = '$nom_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$invitado=false;
		if($fila[0] == 1) $invitado=true;
		$conexion->close();
		return $invitado;
	}

	// Devuelve el número de aviso que el usuario tiene
	function devolver_aviso($nom_usuario){
		$conexion=conectar();
		$sql ="SELECT aviso FROM usuarios WHERE nombre = '$nom_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$conexion->close();
		return $fila[0];
	}

	// Mandar invitación a un usuario. Devuelve true o false si puede mandar o no la invitación
	function mandar_invitacion($nom_usuario, $nom_dj){
		$conexion=conectar();
		if(!tiene_invitacion($nom_usuario)){
			// Poner campo de aviso del invitado a 1;
			$sql = "UPDATE usuarios SET aviso = 1 WHERE nombre = '$nom_usuario';";
			$conexion->query($sql);
			// Poner campo "invitando a" del usuario_dj con valor del invitado
			$id_usuario = sacar_id($nom_usuario);
			$sql2 = "UPDATE usuario_dj SET invitando_a = '$id_usuario' WHERE nombre_dj = '$nom_dj';";
			$conexion->query($sql2);
			$conexion->close();
			return true;
		}else{
			$conexion->close();
			return false;
		} 
	}

	// Aplica los cambios en la BD para que hayas aceptado la invitación del DJ a unirte a el
	function aceptar_invitacion($id_usuario, $id_dj){
		$conexion=conectar();
		// Poner en la tabla usuario_dj el invitando_a del dj a 0
		$sql = "UPDATE usuario_dj SET invitando_a = 0 WHERE id_dj = '$id_dj';";
		$conexion->query($sql);
		// Poner en la tabla usuario el aviso del usuario a 0
		$sql2 = "UPDATE usuarios SET aviso = 0 WHERE ID = '$id_usuario';";
		$conexion->query($sql2);
		// Ligar el usuario al dj en la tabla relaciones_dj_jugador
		$sql3 = "INSERT INTO relaciones_dj_jugador(id_dj,id_jugador) VALUES ('$id_dj','$id_usuario');";
		$conexion->query($sql3);
		$conexion->close();
	}

	// Comprobamos si el usuario introducido tiene un dj asociado, devolvemos true o false
	function tiene_dj($id_usuario){
		$conexion=conectar();
		$sql ="SELECT id_dj FROM relaciones_dj_jugador WHERE id_jugador = '$id_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->num_rows;
		$existe=false;
		if($fila != 0) $existe=true;
		$conexion->close();
		return $existe;
	}

	function mi_dj_es($id_usuario){
		$conexion=conectar();
		$sql = "SELECT id_dj FROM relaciones_dj_jugador WHERE id_jugador = '$id_usuario';";
		$res = $conexion->query($sql);
		$fila = $res->fetch_array();
		$dj = sacar_nombre($fila[0]);
		return $dj;
		$conexion->close();
	}

	// Te quita del dm que tengas asociado
	function desligar_dj($id_usuario){
		$conexion=conectar();
		$sql = "DELETE FROM relaciones_dj_jugador WHERE id_jugador = '$id_usuario';";
		$conexion->query($sql);
		$conexion->close();
	}

	// Ver mis variables de session
	function mis_variables_session(){
		foreach($_SESSION as $key =>$valor){
			echo "$key: $valor <br>";
		}
	}

?>