<!-- Cabecera -->
<header>

  <!-- Logo -->
  <img src="img/logo.png" alt="logo" id='logo'>

  <!-- Menú -->
  <div class="menu-bar text-xs-right">
    <div id="boton_menu_movil">
      <a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i>Menú</a>
    </div>
    <nav class="container" role="menu">

      <!-- Login -->
      <?php

        // Comprobamos si hemos entrado cerrando sesión
        if(isset($_GET["cerrar"])){
          unset($_SESSION["usuario"]);
        }
       
        if(isset($_POST["usuario"])){

          // Recogemos los datos del formulario
          $usuario = $_POST["usuario"];
          $password = $_POST["password"];

          // Conectamos con BD
          $conexion = conectar();

          // Recogemos los datos de todos los usuarios
          $sql = "SELECT * FROM usuarios;";
          $resultado = $conexion->query($sql);

          // Comprobamos registro a registro para ver si coinciden con los datos del formulario
          $login_correcto = false;
          while($fila = $resultado->fetch_array()){
            if($fila[1] == $usuario){
              if($fila[2] == $password){
                $login_correcto = true;
                $_SESSION["usuario"] = $usuario;
              }
            }
          }

          if($login_correcto == false){
            echo "<span class='error'>Datos incorrectos</span><br />";
            unset($_SESSION["usuario"]);
          }
          
          // Cerramos conexión con BD
          $conexion->close();

        }

        if(isset($_SESSION["usuario"])){

          // Si es un usuario que ha iniciado sesión comprobamos si es un DJ o un JUGADOR en la BD.
          $usuario = $_SESSION["usuario"];
          $conexion = conectar();
          $sql = "SELECT dj FROM usuarios WHERE nombre = '$usuario';";
          $resultado = $conexion->query($sql);
          $fila = $resultado->fetch_row();
          if($fila[0] == 1) $tipo_usuario = 'DJ:';
          else $tipo_usuario = 'Jugador:';
          $conexion->close();

          // Tipo de usuario y nombre usuario
          echo "
              <span>$tipo_usuario &nbsp;<b>".$_SESSION["usuario"]."</b></span>&nbsp;&nbsp;
          ";

          // Si es DJ mostrar enlace para dj_gestion.php y si es JUGADOR para jugador_gestion.php
          if($tipo_usuario == 'DJ:'){
            echo "<a href='dj_gestion.php'><i class='fa fa-cog' aria-hidden='true'></i></a>&nbsp;&nbsp;";
          }
          if($tipo_usuario == 'Jugador:'){
            echo "<a href='jugador_gestion.php'><i class='fa fa-cog' aria-hidden='true'></i></a>&nbsp;&nbsp;";
          }

          // Botón de logout
          echo "<a href='index.php?cerrar=1'><i class='fa fa-sign-out' aria-hidden='true'></i></a><br /><br />";

          // Alerta de invitación (en caso de tenerla)
          if(devolver_aviso($_SESSION['usuario']) != 0){
            echo "<a href='avisos.php' style='color:yellow;'>¡TIENES UN AVISO, PINCHA AQUÍ PARA VERLO!</a>";
          }

        }else{
          echo "

            <form class='form-inline' role='form-inline' method='post' action='index.php' id='formulario_login'>

              <div class='form-group'>
                <input type='text' name='usuario' class='form-control' id='usuario_login' placeholder='Usuario' required=''>
              </div>

              <div class='form-group'>
                <input type='password' name='password' class='form-control' id='password_login' placeholder='Contraseña'required=''>
              </div>

              <button type='submit' class='btn btn-primary'><i class='fa fa-sign-in' aria-hidden='true'></i></button><br /><br />

            </form>

            <a href='login.php'>Pulsa aquí para registrarte</a><br /><br />

          ";
        }

      ?>

      <ul class="menu-list list-inline">

        <li class="list-inline-item">
          <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
        </li>
        <li class="list-inline-item">
          <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Trasfondo</a>
        </li>
        <li class="list-inline-item">
          <a href="gestion_personaje.php"><i class="fa fa-users" aria-hidden="true"></i> Gestión de personajes</a>
        </li>
        <li class="list-inline-item">
          <a href="bd_mejoras.php?pag=0"><i class="fa fa-database" aria-hidden="true"></i> Base de datos</a>
        </li>

      </ul>

    </nav>

  </div>

</header>