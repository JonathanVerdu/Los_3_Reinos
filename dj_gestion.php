<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimym-scale=1.0 shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Conexión con BD -->
    <?php include_once "include/conectarBD.php"; ?>

    <!-- Include de funciones -->
    <?php include_once "include/funciones.php"; ?>

    <!-- Iniciar sesión -->
    <?php session_start(); ?>

  </head>

  <body>

    <!-- FUNCIÓN JS -->
    <script language="Javascript">
      function preguntar(){
        eliminar=confirm("¿Estás seguro de que quieres borrar este usuario?");
        if(eliminar){
          eliminar2=confirm("¿Seguro, seguro de verdad?, luego no habrá marcha atrás...");
          if(eliminar2){
            window.location.href = "extra/borrar.php";
          }
        }
      }
    </script>

    <?php include 'include/header.php' ?>

    <div id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div> 
          <div class="col-md-6"> 

            <h3>Opciones</h3>

            <ul class="menu-list list-inline">

              <li class="list-item">
                <a href="javascript:preguntar()"><i class="fa fa-times-circle" aria-hidden="true"></i> Borrar usuario</a>
              </li>

            </ul><br />
          
            <h3>Mis jugadores</h3>
            <!-- Invitar a jugadores -->
            <?php
              if (isset($_POST["nombre"])){
                // Comprobar si el usuario al que mandas la invitación existe
                if(existe_usuario($_POST["nombre"])){
                  // Comprobar si es dj
                  if(es_jugador($_POST["nombre"])){
                    // Comprobar si está ya invitado o no
                    if(!tiene_invitacion($_POST["nombre"])){
                      // Comprobar si ya tiene un DJ asociado
                      if(!tiene_dj(sacar_id($_POST["nombre"]))){
                        // SI LLEGAS HASTA AQUÍ MANDAR INVITACIÓN AL JUGADOR
                        if(mandar_invitacion($_POST["nombre"],$_SESSION['usuario'])) echo "<p style='color:green;'>Invitación mandada</p>"; 
                      }else echo "<p class='error'>El jugador ya tiene un DJ asociado</p>";  
                    }else echo "<p class='error'>El jugador tiene una invitación pendiente</p>";
                  }else echo "<p class='error'>El usuario es un DJ, tiene que ser jugador</p>";
                }else echo "<p class='error'>No hay existe jugador con ese nombre</p>";
              }
            ?>
            <p align="center"> 
              <form action="dj_gestion.php" method=post style="display:inline">
                <input type="text" id="nombre" name="nombre" placeholder="jugador al que invitar">
                <input type="submit" name="Submit" value="Invitar" >
              </form>
            </p>
            <!-- Lista de jugadores asociados a este DJ -->
            <?php

              $id = sacar_id($_SESSION["usuario"]);
              usuarios_de_dj($id);
            ?>

          </div>
          <div class="col-md-3"></div>  
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