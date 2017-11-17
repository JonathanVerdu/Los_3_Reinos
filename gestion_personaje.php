<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimym-scale=1.0 shrink-to-fit=no">

    <!-- JQUERY -->
    <script src="jquery/jquery-3.2.1.js" type="text/javascript"></script>  

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

    <script>

      $(document).ready(function(){

        $("#seleccion_personaje").change(function(){

          // Obtener valores de base de datos en función del nombre del personaje
          var nombre = $(this).val();

          $.ajax(
          {
            data: {"nombre" : nombre, "prueba" : "prueba"}, 
            type: "POST", 
            dataType: "json",
            url: "http://los3reinos.freeoda.com/extra/obtener_datos_personaje.php" 
          })
              .done(function(json){
                // Pintar con los datos obtenidos la hoja de personaje dentro del div "ficha_personaje"
                alert(json.nombre+" y "+json.prueba);
              });

        });

      });

    </script>

  </head>

  <body>
        
    <?php include 'include/header.php' ?>

    <div id="main">

      <div class="container">

        <div class="row">

          <div class="col-md-3"></div> 
          <div class="col-md-6"> 

            <?php

              if(!isset($_SESSION["usuario"])){
                echo "INICIA SESIÓN PRIMERO";
              }else{              
                // VER SI ERES JUGADOR O DJ
                $usuario = $_SESSION["usuario"];
                $conexion = conectar();
                $conexion->query("SET NAMES 'utf8'");

                $sql = "SELECT * FROM usuario_dj WHERE nombre_dj = '$usuario';";
                $res = $conexion->query($sql);
                $fila = $res->num_rows;

                if($fila == 1) $tipo_usuario = 'dj';
                else $tipo_usuario = 'jugador';

                if($tipo_usuario == 'dj'){
                  // MENÚ PARA EL DJ ---------------------------------- POR HACER !!!!!!!!!!!!!!!
                }else{
                  // MENÚ PARA EL JUGADOR
                  $id_usuario = sacar_id($_SESSION["usuario"]);
                  echo "<a href='nuevo_personaje.php'>Crear personaje</a><br /><br />"; 
                  echo "<h3>Mis personajes</h3>";
                  $sql = "SELECT nombre FROM personajes WHERE usuario = '$id_usuario'";
                  $res = $conexion->query($sql);
                  if($res->num_rows > 0){
                    echo "<select id='seleccion_personaje'>";
                    while($fila = $res->fetch_array()){
                      echo "<option value'".$fila[0]."'>".$fila[0]."</option>";
                    }
                    echo "</select>";
                  }else echo "<b>No hay personajes creados</b>";
                }
                $conexion->close();
              }

            ?>

            <!-- FICHA DE PERSONAJE CARGADA POR JQUERY-->
            <br /><br /><div id="ficha_personaje"></div>

          </div>
          <div class="col-md-3"></div>  

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>