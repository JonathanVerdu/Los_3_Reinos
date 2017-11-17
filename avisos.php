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
        
  <?php include 'include/header.php' ?>

  <div id="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
          <div class="col-sm-6">

            <script language="Javascript">
              function aceptar(){
                eliminar=confirm("¿Estás seguro de que quieres unirte a este DJ como jugador?");
                if(eliminar){
                  eliminar2=confirm("¿Seguro, seguro de verdad?, luego no habrá marcha atrás...");
                  if(eliminar2){
                    window.location.href = "extra/aceptar_invitacion.php";
                  }
                }
              }
            </script>

            <!-- Aquí los avisos -->
            <?php
              $conexion = conectar();

              $num_aviso = devolver_aviso($_SESSION["usuario"]);

              if($num_aviso == 1){
                $id_usuario = sacar_id($_SESSION["usuario"]);
                $sql = "SELECT nombre_dj FROM usuario_dj WHERE invitando_a = '$id_usuario';";
                $res = $conexion->query($sql);
                $fila = $res->fetch_array();
                $nom_dj = $fila[0]; // nombre del dj que te invita
                $id_dj = sacar_id($fila[0]);
                $_SESSION['id_dj'] = $id_dj;
                echo "Tienes una invitación del DJ ".$nom_dj." para unirte a el como jugador<br />";
                echo "<a href='javascript:aceptar()'>Aceptar</a>";
              }

              $conexion->close();
            ?>

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