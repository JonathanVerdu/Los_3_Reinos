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
              $("#ficha_personaje").append('<div id="datos_generales"><span class="letraGrande negrita">'+json.nombre+'</span><br /><span class="letraGrande">'+json.clase+'</span><br /><br /></div>');

              // --- Ventana cambiar Atributos ---
              $("#ficha_personaje").append('<button id="boton_modificar_atributo">Cambiar atributos</button><br /><div id="modificar_atributo" class="borde" style="display:none"><ul><li>FUERZA :  <span id="fu_cambiar">0</span>&nbsp;<i class="fa fa-plus-circle subir" aria-hidden="true" name="fu"></i>&nbsp;<i class="fa fa-minus-circle bajar" aria-hidden="true" name="fu"></i><span id="fu_totales"> '+json.actualFuerza+' / '+json.maxFuerza+'</span></li><li>DESTREZA: <span id="de_cambiar">0</span>&nbsp;<i class="fa fa-plus-circle subir" aria-hidden="true" name="de"></i>&nbsp;<i class="fa fa-minus-circle bajar" aria-hidden="true" name="de"></i><span id="de_totales"> '+json.actualDestreza+' / '+json.maxDestreza+'</span></li><li>CARISMA: <span id="ca_cambiar">0</span>&nbsp;<i class="fa fa-plus-circle subir" aria-hidden="true" name="ca"></i>&nbsp;<i class="fa fa-minus-circle bajar" aria-hidden="true"  name="ca"></i><span id="ca_totales"> '+json.actualCarisma+' / '+json.maxCarisma+'</span></li><li>INTELIGENCIA: <span id="in_cambiar">0</span>&nbsp;<i class="fa fa-plus-circle subir" aria-hidden="true" name="in"></i>&nbsp;<i class="fa fa-minus-circle bajar" aria-hidden="true" name="in"></i><span id="in_totales"> '+json.actualInteligencia+' / '+json.maxInteligencia+'</span></li></ul><button id="aceptar_cambios">Aceptar cambios</div>');

              // FUNCIONALIDADES DE LA VENTANA DE CAMBIAR ATRIBUTOS ////////////////////////////////////////////////////////

                  // --- Botón subir atributo, funcionamiento
                  $(".subir").click(function(){
                    // Subir el contador del atributo que se va a subir
                    $atributo_seleccionado = $(this).attr("name");
                    if($atributo_seleccionado == "fu") $subida_por_hacer = $("#fu_cambiar").html();
                    if($atributo_seleccionado == "de") $subida_por_hacer = $("#de_cambiar").html();
                    if($atributo_seleccionado == "ca") $subida_por_hacer = $("#ca_cambiar").html();
                    if($atributo_seleccionado == "in") $subida_por_hacer = $("#in_cambiar").html();
                    // Comprobar si se puede pagar con EXP la subida
                    $exp = $("#exp").html() - 3;
                    if($exp >= 0){
                      $subida_por_hacer++;
                      // Comprobar si la subida va a superar el máximo de subidas que puedes
                      if($atributo_seleccionado == "fu"){
                        $atributo_actual = json.actualFuerza; 
                        $atributo_maximo = json.maxFuerza;
                      }
                      if($atributo_seleccionado == "de"){
                        $atributo_actual = json.actualDestreza; 
                        $atributo_maximo = json.maxDestreza;
                      }
                      if($atributo_seleccionado == "ca"){
                        $atributo_actual = json.actualCarisma; 
                        $atributo_maximo = json.maxCarisma;
                      }
                      if($atributo_seleccionado == "in"){
                        $atributo_actual = json.actualInteligencia; 
                        $atributo_maximo = json.maxInteligencia;
                      }
                      $res_atributos = parseInt($atributo_actual) + parseInt($subida_por_hacer);
                      if($res_atributos > parseInt($atributo_maximo)){
                        alert("No puedes subir mas este atributo");
                      }else{
                        if($atributo_seleccionado == "fu") $("#fu_cambiar").html($subida_por_hacer);
                        if($atributo_seleccionado == "de") $("#de_cambiar").html($subida_por_hacer);
                        if($atributo_seleccionado == "ca") $("#ca_cambiar").html($subida_por_hacer);
                        if($atributo_seleccionado == "in") $("#in_cambiar").html($subida_por_hacer);
                        $("#exp").html($exp);
                      }
                    }else{
                      alert("No tienes suficiente exp para subir un atributo (necesitas 3 puntos de EXP para ello)");
                    }
                  });

                  // --- Botón bajar atributo, funcionamiento
                  $(".bajar").click(function(){
                    $atributo_seleccionado = $(this).attr("name");
                    if($atributo_seleccionado == "fu") $subida_por_hacer = parseInt($("#fu_cambiar").html());
                    if($atributo_seleccionado == "de") $subida_por_hacer = parseInt($("#de_cambiar").html());
                    if($atributo_seleccionado == "ca") $subida_por_hacer = parseInt($("#ca_cambiar").html());
                    if($atributo_seleccionado == "in") $subida_por_hacer = parseInt($("#in_cambiar").html());

                    if($subida_por_hacer > 0){
                      $exp = parseInt($("#exp").html()) + 3; 
                      $("#exp").html($exp);
                      $subida_por_hacer--;
                      if($atributo_seleccionado == "fu") $("#fu_cambiar").html($subida_por_hacer);
                      if($atributo_seleccionado == "de") $("#de_cambiar").html($subida_por_hacer);
                      if($atributo_seleccionado == "ca") $("#ca_cambiar").html($subida_por_hacer);
                      if($atributo_seleccionado == "in") $("#in_cambiar").html($subida_por_hacer);
                    }else{ 
                      alert("No puedes bajar mas de 0");
                    }
                  });

                  // --- Aceptar cambios y pasarlos con AJAX
                  $("#aceptar_cambios").click(function(){
                    // Preguntar si queremos aplicar los cambios
                    if(confirm("¿Quieres aplicar los cambios?, una vez aceptado los puntos de EXP y los cambios realizados se quedarán guardaos")){
                      // Recogemos los datos que necesitamos
                      $personaje = $("#seleccion_personaje").attr("selected",true).val();
                      $cambio_fu = $("#fu_cambiar").html();
                      $cambio_de = $("#de_cambiar").html();
                      $cambio_ca = $("#ca_cambiar").html();
                      $cambio_in = $("#in_cambiar").html();
                      $exp = parseInt($("#exp").html());
       
                      // Función ajax de jquery con los datos para pasar /*
                      $.ajax(
                      {
                        data: {"personaje" : $personaje, "exp" : $exp, "cambio_fu" : $cambio_fu, "cambio_de" : $cambio_de, "cambio_ca" : $cambio_ca, "cambio_in" : $cambio_in}, 
                        type: "POST", 
                        dataType: "json",
                        url: "http://los3reinos.freeoda.com/extra/pasar_datos_atributos_a_bd.php" 
                      })

                      .done(function(json){
                        // Si no hay error mostrar mensaje de todo hecho con éxito
                        if(json.error == 0) alert("Cambios aplicados con éxito");

                        // Cambiar los valores para dar el efecto de que se ha hecho el cambio al instante
                        $("#fu_totales").html(" "+json.fu_actual+" / "+json.fu_max);
                        $("#de_totales").html(" "+json.de_actual+" / "+json.de_max);
                        $("#ca_totales").html(" "+json.ca_actual+" / "+json.ca_max);
                        $("#in_totales").html(" "+json.in_actual+" / "+json.in_max);
                        $("#atr_fu").html(json.fu_total);
                        $("#atr_de").html(json.de_total);
                        $("#atr_ca").html(json.ca_total);
                        $("#atr_in").html(json.in_total);

                        // Poner los contadores de subir atributo a 0
                        $("#fu_cambiar").html("0");
                        $("#de_cambiar").html("0");
                        $("#ca_cambiar").html("0");
                        $("#in_cambiar").html("0");
                      });
                    }
                });

              ///////////////////////////////////////////////////////////////////////////////////////////////////////

              // --- Los Atributos ----
              $("#ficha_personaje").append('<div id="atributos"><span class="negrita letraGrande margenDerechoPeque">FU: <span class="sinNegrita" id="atr_fu">'+json.fuerza+'</span></span><span class="negrita letraGrande margenDerechoPeque">DE:<span class="sinNegrita" id="atr_de">'+json.destreza+'</span></span><span class="negrita letraGrande margenDerechoPeque">CA:<span class="sinNegrita" id="atr_ca">'+json.carisma+'</span></span><span class="negrita letraGrande">IN:<span class="sinNegrita" id="atr_in">'+json.inteligencia+'</span></span></div><br />');

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
              if(json.habilidad_nombre != undefined && json.habilidad_nombre != ""){
                $("#ficha_personaje").append('<h3><i class="fa fa-bars" id="boton_habilidad" aria-hidden="true"></i> Habilidades</h3><ul>');
                for(var i=0; i<json.habilidad_nombre.length; i++){
                  $tipo_coste = "Coste EXP: 3";
                  // Comprobamos si la habilidad es fácil
                  if(json.habilidad_facil_1 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  if(json.habilidad_facil_2 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  if(json.habilidad_facil_3 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  if(json.habilidad_facil_4 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  if(json.habilidad_facil_5 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  if(json.habilidad_facil_6 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 1";
                  // Comprobamos si la habilidad es media
                  if(json.habilidad_media_1 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";
                  if(json.habilidad_media_2 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";
                  if(json.habilidad_media_3 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";
                  if(json.habilidad_media_4 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";
                  if(json.habilidad_media_5 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";
                  if(json.habilidad_media_6 == json.habilidad_nombre[i]) $tipo_coste = "Coste EXP: 2";

                  if(json.habilidad_bono[i] != 0){
                    $("#ficha_personaje").append('<li class="negrita habilidad"><a href="extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre='+json.habilidad_nombre[i]+'" target="_blank">'+json.habilidad_nombre[i]+'</a>: '+json.habilidad_bono[i]+'&nbsp;&nbsp;'+$tipo_coste+'&nbsp;&nbsp;<i class="fa fa-plus-circle bajar" aria-hidden="true" name="fu"></i></li>');
                  }
                }
                $("#ficha_personaje").append('</ul><br />');
              }

              // --- Las Ventajas ---
              if(json.mejora != undefined && json.mejora != ""){
                $("#ficha_personaje").append('<h3><i class="fa fa-bars" id="boton_mejora" aria-hidden="true"></i> Mejoras</h3><ul>');
                for(var i=0; i<json.mejora.length; i++){
                  $("#ficha_personaje").append('<li class="negrita mejora"><a href="extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre='+json.mejora[i]+'" target="_blank">'+json.mejora[i]+'</a></li>'); 
                }
                $("#ficha_personaje").append('</ul><br />');
              }

              // --- Las Tecnicas ---
              if(json.tecnica != undefined && json.tecnica != ""){
                $("#ficha_personaje").append('<h3><i class="fa fa-bars" id="boton_tecnica" aria-hidden="true"></i> Tecnicas</h3><ul>');
                for(var i=0; i<json.tecnica.length; i++){
                  $("#ficha_personaje").append('<li class="negrita tecnica"><a href="extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre='+json.tecnica[i]+'" target="_blank">'+json.tecnica[i]+'</a></li>'); 
                }
                $("#ficha_personaje").append('</ul>');
              }

              // Activar ventana de modificar atributos
              $("#boton_modificar_atributo").click(function(){
                $("#modificar_atributo").toggle();
              });

              // Ocultar y mostrar tus habilidades
              $("#boton_habilidad").click(function(){
                $(".habilidad").toggle();
              });

              // Ocultar y mostrar tus mejoras
              $("#boton_mejora").click(function(){
                $(".mejora").toggle();
              });

              // Ocultar y mostrar tus tecnicas
              $("#boton_tecnica").click(function(){
                $(".tecnica").toggle();
              });

            }); // Fin del done

          } // Fin del if

        }); // Fin del evento change que se activa al elegir personaje

      }); // Fin del document ready

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