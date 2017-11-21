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

        // Comprobamos si estamos viendo esto en un mobil o en un pc
        var isMobile = window.matchMedia("only screen and (max-width: 760px)");

        // VENTANA QUE TE SIGUE (SOLO VERSION PC) //////////////////////////////////////////////
          $(function(){
            var offset = $("#sidebar").offset();
            var topPadding = 15;
            $(window).scroll(function() {
              if($("#sidebar").height() < $(window).height() && $(window).scrollTop() > offset.top){ /* LINEA MODIFICADA PARA NO ANIMAR SI EL SIDEBAR ES MAYOR AL TAMANO DE PANTALLA */
                $("#sidebar").stop().animate({
                  marginTop: $(window).scrollTop() - offset.top + topPadding
                });
              }else{
                $("#sidebar").stop().animate({
                  marginTop: 0
                });
              };
            });
          });
        /////////////////////////////////////////////////////////////////////////////////////

        $("#seleccion_personaje").change(function(){

          // Obtener valores de base de datos en función del nombre del personaje
          var nombre = $(this).val();

          if(nombre != "nada"){

            $.ajax(
            {
              data: {"nombre" : nombre, "prueba" : "prueba"}, 
              type: "POST", 
              dataType: "json",
              url: "http://los3reinos.freeoda.com/extra/obtener_datos_personaje.php" 
            })

            .done(function(json){

              // Pintar con los datos obtenidos la hoja de personaje dentro del div "ficha_personaje"

              // --- Borrar lo anterior ---
              $("#ficha_personaje").html(" ");

              // --- Nombre y clase---
              $("#ficha_personaje").append('<div id="datos_generales"><span class="letraMuyGrande negrita">'+json.nombre+'</span><br /><span class="letraGrande">'+json.clase+'</span><br /><br /></div>');

              // --- Los Atributos ----
              $("#ficha_personaje").append('<div id="atributos"><span class="negrita letraGrande margenDerechoPeque">FU: <span class="sinNegrita">'+json.fuerza+'</span></span><span class="negrita letraGrande margenDerechoPeque">DE:<span class="sinNegrita">'+json.destreza+'</span></span><span class="negrita letraGrande margenDerechoPeque">CA:<span class="sinNegrita">'+json.carisma+'</span></span><span class="negrita letraGrande">IN:<span class="sinNegrita">'+json.inteligencia+'</span></span></div><br />');

              // --- Los Datos Personales ---
              $("#ficha_personaje").append('<div id="datos_personales" class="bordeRedondeado"><ul><li>Raza: '+json.raza+'</li><li>Sexo: '+json.sexo+'</li><li>Edad: '+json.edad+'</li><li>Altura: '+json.altura+'</li><li>Peso: '+json.peso+'</li></ul></div><br />'); 

              // --- La Experiencia ---
              if(!isMobile.matches){
                $("#sidebar").css("display","block");
                $("#exp").append(""); // Vaciamos primero la de otro posible personaje
                $("#exp").append(json.exp);
              }else{
                $("#ficha_personaje").append('<div id="sidebar" class="bordeRedondeado">Experiencia: <span id="exp">'+json.exp+'</span></div><br />');
              }

              // --- Las Habilidades ---
              if(json.habilidad_nombre.length != 0){
                $("#ficha_personaje").append('<h3>Habilidades</h3><ul>');
                for(var i=0; i<json.habilidad_nombre.length; i++){
                  $("#ficha_personaje").append('<li class="negrita"><a href="extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre='+json.habilidad_nombre[i]+'" target="_blank">'+json.habilidad_nombre[i]+'</a>: '+json.habilidad_bono[i]+'</li>'); 
                }
                $("#ficha_personaje").append('</ul><br />');
              }

              // --- Las Ventajas ---
              if(json.mejora.length != 0){
                $("#ficha_personaje").append('<h3>Mejoras</h3><ul>');
                for(var i=0; i<json.mejora.length; i++){
                  $("#ficha_personaje").append('<li class="negrita"><a href="extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre='+json.mejora[i]+'" target="_blank">'+json.mejora[i]+'</a></li>'); 
                }
                $("#ficha_personaje").append('</ul><br />');
              }

              // --- Las Tecnicas ---
              if(json.tecnica.length != 0){
                $("#ficha_personaje").append('<h3>Tecnicas</h3><ul>');
                for(var i=0; i<json.tecnica.length; i++){
                  $("#ficha_personaje").append('<li class="negrita"><a href="extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre='+json.tecnica[i]+'" target="_blank">'+json.tecnica[i]+'</a></li>'); 
                }
                $("#ficha_personaje").append('</ul>');
              }

            });

        }

        });

      });

    </script>

  </head>

  <body>
        
    <?php include 'include/header.php' ?>

    <div id="main">

      <div class="container">

        <div class="row">

          <div class="col-md-1"></div> 
          <div class="col-md-2">
            <div id="sidebar" class="bordeRedondeado" style="display: none">
              Experiencia: <span id="exp"></span>
            </div>
          </div> 
          <div class="col-md-7"> 

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
                    echo "<option label='Selecciona un personaje' value='nada' />";
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
          <div class="col-md-2"></div>  

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>