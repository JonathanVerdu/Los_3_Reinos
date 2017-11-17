<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Conexión con BD -->
    <?php include_once "include/conectarBD.php"; ?>

    <!-- Iniciar sesión -->
    <?php session_start(); ?>

  </head>

  <body>

    <header>

      <!-- Logo -->
      <img src="img/logo.png" alt="logo" id='logo'>

      <!-- Menú -->
      <div class="menu-bar text-xs-right">

        <div id="boton_menu_movil">
          <a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i>Menú</a>
        </div>

        <nav class="container" role="menu">

          <ul class="menu-list list-inline">
            <li class="list-inline-item">
              <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>

            </li>
            <li class="list-inline-item">
              <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Trasfondo</a>
            </li>
            <li class="list-inline-item">
              <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Gestión de personajes</a>
            </li>
            <li class="list-inline-item">
              <a href="#"><i class="fa fa-database" aria-hidden="true"></i> Base de datos</a>
            </li>

          </ul>

        </nav>
      </div>

    </header>

    <div id="main">

      <!-- Comprobar Login -->
      <?php

        if(isset($_POST["usuario"])){

          // Recogemos los datos del formulario
          $usuario = $_POST["usuario"];
          $password = $_POST["password"];
          if(isset($_POST["dj"])) $dj = 1;
          else $dj = 0;

          // Pasamos la validación (ningún campo con mas de 20 carácteres)
          $validado = true;
          if(strlen($usuario) > 20){
            $validado = false;
            $texto_error = "<p class='error'>El usuario no puede tener mas de 20 carácteres</p>";
          }
          if(strlen($password) > 20){
            $validado = false;
            $texto_error = "<p class='error'>La contraseña no puede tener mas de 20 carácteres</p>";
          }
          if($validado){
            // Conectamos con BD
            $conexion = conectar();

            // Recogemos los datos de todos los usuarios
            $sql = "SELECT * FROM usuarios;";
            $resultado = $conexion->query($sql);

            // Comprobamos registro a registro para ver si coinciden con los datos del formulario
            $usuario_repetido = false;
            while($fila = $resultado->fetch_array()){
              if($fila[1] == $usuario){
                // Si encuentra un usuario repetido
                $validado = false;
                $texto_error = "<p class='error'>Ya existe un usuario con ese nombre</p>";
                $usuario_repetido = true;
              }
            }

            // Comprobamos si el usuario introducido ya existe o no
            if($usuario_repetido == false){
              // Si no tenemos dicho usuario lo registramos en la BD y en SESSION, redirigiendo a index.php
              $sql = "INSERT INTO usuarios(nombre, password, dj) VALUES('$usuario','$password', '$dj');";
              $conexion->query($sql);
              $_SESSION["usuario"] = $usuario;
              // Luego tendremos que sacar el ID a partir del nombre.
              $sql_select = "SELECT ID FROM usuarios WHERE nombre = '$usuario'";
              $resultado = $conexion->query($sql_select);
              $fila = $resultado->fetch_array();
              $id = $fila["ID"];
              // Comprobamos si el usuario nuevo va a ser DJ o JUGADOR para introducirlo en la tabla correspondiente
              if($dj == 1){
                // Insertar todos los datos en la tabla de DJ
                $sql_insert = "INSERT INTO usuario_dj(id_dj, nombre_dj) VALUES('$id','$usuario');";
                $conexion->query($sql_insert);
              }else{
                // Insertar todos los datos en la tabla de JUGADOR
                $sql_insert = "INSERT INTO usuario_jugador(id_jugador, nombre_jugador) VALUES('$id','$usuario');";
                $conexion->query($sql_insert);
              }
              // Cerramos conexión con BD
              $conexion->close();
              // Volvemos a index.php
              header('Location: index.php');
            }

            // Cerramos conexión con BD
            $conexion->close();
          }

        }

      ?>

      <!-- Login -->
      <div class="container">
        <div class="row">

          <div class="col-sm-3"></div>

          <div class="col-sm-6">

            <form class="form" role="form-inline" method="post" action="login.php" id="formulario_registro">

              <span>Introduce los datos de registro para tu nuevo usuario</span><br /><br />  

              <?php  if(isset($texto_error)) echo $texto_error  ?>

              <div class="form-group">
                <label for="usuario_login"><b>Usuario</b></label>
                <input type="text" name="usuario" class="form-control" id="usuario_login" placeholder="Introduce tu usuario" required="">
              </div>

              <div class="form-group">
                <label for="password_login"><b>Contraseña</b></label>
                <input type="password" name="password" class="form-control" id="password_login" placeholder="Introduce tu contraseña" required="">
              </div>

              <div class="form-group">
                <label><input type="checkbox" name="dj" value="1"> Voy a ser Director de Juego (DJ)</label>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Entrar</button><br /><br />
              </div>

            </form>

          </div>

          <div class="col-sm-3"></div>

        </div>
      </div>

    </div>

    <footer style="position:absolute;
    bottom:0;
    width:100%;">
      
      <div class="container">
        <div class="row">
          
          <div class="col-sm-6">
            <strong>Los3Reinos</strong> &copy;2017 - Todos los derechos reservados. Sitio diseñado por <a href="#">Jonathan Verdú Líria</a>
          </div>

          <div class="col-sm-6 text-xs-right">
            
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Aviso legal</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Cookies</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Contacto</a>
              </li>
            </ul>

          </div>

        </div>
      </div>

    </footer>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

     <!-- Mis JS -->
    <script src="js/general.js" type="text/javascript"></script>
    <script src="js/menu.js"></script>

  </body>
</html>