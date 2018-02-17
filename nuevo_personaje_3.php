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

    <!-- JQUERY -->
    <script src="jquery/jquery-3.2.1.min.js" type="text/javascript"></script>   

    <!-- Conexión con BD -->
    <?php include_once "include/conectarBD.php"; ?>

    <!-- Include de funciones -->
    <?php include_once "include/funciones.php"; ?>

    <!-- Iniciar sesión -->
    <?php session_start(); ?>

    <script>

      // JQUERY //////////////////////////////////////////////////////////////////////////////////////////
      $(document).ready(function(){

        // Evento que se carga al clickar un checbox (elemento con clase checkbox)
        $(".checkbox").change(function(){

          // Variables que vamos a utilizar
          var exp = parseInt($("#exp").html());
          var estado = $(this).prop("checked");
          //console.log("Exp actual: "+exp);
          //console.log("Estado actual: "+estado);
          // Sacamos la nueva experiencia cual serían y hacemos comprobaciones.
          if(estado == true){
            // Si el checbox pasa a true
            //console.log("Pasamos al checked true");
            var nueva_exp = exp - 3; 
            //console.log("La nueva exp: "+nueva_exp);
            if(nueva_exp < 0){
              //console.log("La nueva exp es menor de 0");
              alert("No puedes adquirir esto, cuesta 3 puntos de experiencia");
              $(this).prop("checked",false); // Dejamos el check a false
            }else{
              //console.log("La nueva exp es mayor de 0");
              // Ponemos el nuevo valor de la exp
              $("#exp").html(nueva_exp); 
            }
          }else{
            //console.log("Pasamos al checked false");
            var nueva_exp = exp + 3;
            //console.log("La nueva exp: "+nueva_exp);
            // Ponemos el nuevo valor de la exp
            $("#exp").html(nueva_exp); 
          }

        });

      });
      ////////////////////////////////////////////////////////////////////////////////////////////////////

      // Función restar experiencia
      function restaExp(numeroRestar){
          var exp_actual = document.getElementById('exp').innerHTML;
          if(exp_actual < numeroRestar){
            alert("No puedes pagar el coste")
            return false;
          }else{
            var exp = parseInt(exp_actual) - numeroRestar;
            document.getElementById('exp').innerHTML = exp;
            return true;
          }
      }

      // Funcion sumar experiencia
      function sumaExp(numeroSumar){
         var exp_actual = document.getElementById('exp').innerHTML;
         if(exp_actual == 100){
            return false;
         }else{
            var exp = parseInt(exp_actual) + numeroSumar;
            document.getElementById('exp').innerHTML = exp;
            return true;
         }
      }

      function sumarUno(a){
        var valor = a.id;
        var numero = a.name;
        if(a.getAttribute("class") == "boton_sumar_habilidad"){
          var x = valor.slice(6);
          var id = "nivel_"+x;
        }else var id = valor.slice(6)+"_"+numero;
        var coste = 3;

        if(valor == 'sumar_habilidad_media') var coste = 2;
        if(valor == 'sumar_habilidad_facil') var coste = 1;

        var valor_habilidad = document.getElementById(id).value;

        if(restaExp(coste)){
          var valor_habilidad = parseInt(valor_habilidad) + 1;
          document.getElementById(id).value = valor_habilidad;
          document.getElementById(id).setAttribute("value",valor_habilidad);
        }
      }

      function restarUno(a){
        var valor = a.id;
        var numero = a.name;
        if(a.getAttribute("class") == "boton_restar_habilidad"){
          var x = valor.slice(7);
          var id = "nivel_"+x;
        }else var id = valor.slice(7)+"_"+numero;
        //console.log(id);

        var coste = 3;
        if(valor == 'restar_habilidad_media') var coste = 2;
        if(valor == 'restar_habilidad_facil') var coste = 1;

        var valor_habilidad = document.getElementById(id).value;

        if(valor_habilidad != 0){
          if(sumaExp(coste)){
            var valor_habilidad = parseInt(valor_habilidad) - 1;
            document.getElementById(id).value = valor_habilidad;
            document.getElementById(id).setAttribute("value",valor_habilidad);
          }
        }
      }

      function alertArray(array){
        for(i = 0; i<array.length;i++){
          alert(i+" - "+array[i]);
        }
      }

      // Inicializar variable contador de habilidades a 0
      var cont_habilidades = 0;
      // Iniciar array con nombre de las habilidades
      var array_habilidades_agregadas = [];

      function agregarHabilidad(a){

        // Si tenemos 10 o menos habilidades ejecutamos la función
        if(cont_habilidades <= 9){

          // Tomamos el nombre de la habilidad del select
          var select = document.getElementById("select_habilidades");
          var nombre_original = select.options[select.selectedIndex].value;
          var nombre = nombre_original.replace(/\s/g,"_");
          var id_campo_nombre = "nombre_habilidad_"+cont_habilidades;
          var id_campo_nivel = "nivel_habilidad_"+cont_habilidades;

          // Comprobamos que la habilidad elegida no esté ya en el array de habilidades
          var habilidad_repetida = false;
          for (var i = 0; i<array_habilidades_agregadas.length; i++) {
            var x = array_habilidades_agregadas[i];
            if(nombre == array_habilidades_agregadas[i]) habilidad_repetida = true;
          }

          // Si no está repetida la agregamos al array de habilidades, al div y sumamos 1 al contador
          if(!habilidad_repetida){

            document.getElementById("habilidades_escogidas").innerHTML+='<div class="div_habilidad" id=div_'+cont_habilidades+'><b>'+nombre_original+'</b><input type="hidden" class="nombre_habilidad" name='+id_campo_nombre+' id='+id_campo_nombre+' value='+nombre+'> <input  class="nivel_habilidad" name='+cont_habilidades+' id='+id_campo_nivel+' type="number" value="0" readonly></input><a class="boton_sumar_habilidad" id="sumar_habilidad_'+cont_habilidades+'" name='+cont_habilidades+' onclick="sumarUno(this)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> <a class="boton_restar_habilidad" id="restar_habilidad_'+cont_habilidades+'" name='+cont_habilidades+' onclick="restarUno(this)"><i class="fa fa-minus-circle" aria-hidden="true"></i></a> <a class="boton_quitar_habilidad" id="quitar_habilidad_'+cont_habilidades+'" name='+cont_habilidades+' onclick="quitarHabilidad(this)"><i class="fa fa-times" aria-hidden="true"></i></a> <br /></div>';

            array_habilidades_agregadas.push(nombre);

            cont_habilidades++;

          }else alert("La habilidad "+nombre+" ya está agregada");

        }else alert("El máximo de habilidades que puedes agregar es 10");

        //alertArray(array_habilidades_agregadas);

      }

      function devolverEXP(exp_devolver){
        var exp_actual = parseInt(document.getElementById("exp").innerHTML);
        var exp_devuelta = parseInt(exp_devolver) * 3;
        var exp_final = parseInt(exp_actual + exp_devuelta);
        //console.log("exp_actual = "+exp_actual);
        //console.log("exp_devuelta = "+exp_devuelta);
        //console.log("exp_final = "+exp_final);
        document.getElementById("exp").innerHTML = exp_final;
      }

      function quitarHabilidad(a){

        var cantidad_habilidades = array_habilidades_agregadas.length - 1;
        if(cantidad_habilidades < 0) cantidad_habilidades == 0;
        var numero_habilidad_clickeada = parseInt(a.name);
        var nivel_habilidad_clickeada = document.getElementById("nivel_habilidad_"+numero_habilidad_clickeada).value;
        var div_padre = document.getElementById("habilidades_escogidas");
        var div_actual = document.getElementById("div_"+numero_habilidad_clickeada);
        //console.log("numero_habilidad_clickeada: "+numero_habilidad_clickeada);
        //console.log("nivel_habilidad_clickeada: "+nivel_habilidad_clickeada);

        div_padre.removeChild(div_actual); // quitamos la habilidad de la pantalla
        array_habilidades_agregadas = array_habilidades_agregadas.splice(numero_habilidad_clickeada,numero_habilidad_clickeada); // La quitamos del array 

        devolverEXP(nivel_habilidad_clickeada);

        console.log("Vamos a borrar la "+numero_habilidad_clickeada+" y en total hay "+cantidad_habilidades);

        if(numero_habilidad_clickeada != cantidad_habilidades){

          // Recorrer div de habilidades
          var array_div_habilidades = $(".div_habilidad");
          $.each(array_div_habilidades,function(i,val){
            val.id = "div_"+i;
          });

          // Recorrer input de nombre de habilidades
          var array_nombre_habilidades = $(".nombre_habilidad");
          $.each(array_nombre_habilidades,function(i,val){
              val.id = "nombre_habilidad_"+i; 
              val.name = "nombre_habilidad_"+i;
          });

          // Recorrer input de nivel de habilidades
          var array_nivel_habilidades = $(".nivel_habilidad");
          $.each(array_nivel_habilidades,function(i,val){
              val.id = "nivel_habilidad_"+i; 
              val.name = "nivel_habilidad_"+i;
          });

          // Recorrer input de botones de sumar habilidades
          var array_boton_sumar_habilidades = $(".boton_sumar_habilidad");
          $.each(array_boton_sumar_habilidades,function(i,val){
            var id_boton_sumar_habilidad = val.id;
            var numero_habilidad = parseInt(id_boton_sumar_habilidad.substr(16));
            val.id = "sumar_habilidad_"+i;
            val.name = i;  
          });

          // Recorrer input de botones de restar habilidades
          var array_boton_restar_habilidades = $(".boton_restar_habilidad");
          $.each(array_boton_restar_habilidades,function(i,val){
            var id_boton_restar_habilidad = val.id;
            var numero_habilidad = parseInt(id_boton_restar_habilidad.substr(17));
            var numero_habilidad_correcto = numero_habilidad - 1;
            val.id = "restar_habilidad_"+i;
            val.name = i;  
          });

          // Recorrer input de botones de quitar habilidades
          var array_boton_quitar_habilidades = $(".boton_quitar_habilidad");
          $.each(array_boton_quitar_habilidades,function(i,val){
            var id_boton_quitar_habilidad = val.id;
            var numero_habilidad = parseInt(id_boton_quitar_habilidad.substr(17));
            var numero_habilidad_correcto = numero_habilidad - 1;
            val.id = "quitar_habilidad_"+i;
            val.name = i;
          });

        }

        cont_habilidades--;

      }

    </script>

  </head>

  <body>
        
    <?php include 'include/header.php' ?>

    <div id="main">

      <div class="container">

        <div class="row">

          <div class="col-md-2"></div> 
          <div class="col-md-8"> 

            <form class="form-horizontal" role="form" action="nuevo_personaje_resumen.php" method="post">

            <?php
                // Si volvemos atrás de la pantalla siguiente
                if (isset($_GET["atras"])) unset($_GET["atras"]);

                // Recibimos todos los datos anteriores ////////////////////////////////////////////////////

                if (isset($_POST["nombre_pj"])){
                  // Datos de nuevo_personaje_1
                  $nombre = $_POST["nombre_pj"];
                  $apellido = $_POST["apellido_pj"];
                  $edad = $_POST["edad_pj"];
                  $altura = $_POST["altura_pj"];
                  $peso = $_POST["peso_pj"];
                  $raza = $_POST["raza_pj"];
                  $sexo = $_POST["sexo_pj"];

                  // Datos de nuevo_personaje_2
                  $fu = $_POST["fu"];
                  $de = $_POST["de"];
                  $ca = $_POST["ca"];
                  $int = $_POST["int"];
                  $clase = $_POST["clase"];

                  // Datos a sesión
                  $_SESSION["nombre_pj"] = $nombre;
                  $_SESSION["apellido_pj"] = $apellido;
                  $_SESSION["altura_pj"] = $altura;
                  $_SESSION["peso_pj"] = $peso;
                  $_SESSION["raza_pj"] = $raza;
                  $_SESSION["sexo_pj"] = $sexo;
                  $_SESSION["edad_pj"] = $edad;
                  $_SESSION["fu"] = $fu;
                  $_SESSION["de"] = $de;
                  $_SESSION["ca"] = $ca;
                  $_SESSION["int"] = $int;
                  $_SESSION["clase"] = $clase;
                }else{
                  $nombre = $_SESSION["nombre_pj"];
                  $apellido = $_SESSION["apellido_pj"];
                  $altura = $_SESSION["altura_pj"];
                  $peso = $_SESSION["peso_pj"];
                  $raza = $_SESSION["raza_pj"];
                  $sexo = $_SESSION["sexo_pj"];
                  $edad = $_SESSION["edad_pj"];
                  $fu = $_SESSION["fu"];
                  $de = $_SESSION["de"];
                  $ca = $_SESSION["ca"];
                  $int = $_SESSION["int"];
                  $clase = $_SESSION["clase"];
                }

                 // Crear div oculto con los datos recogidos
                echo "
                  <div style='display:none;'>
                    <input type='text' name='nombre_pj' value=$nombre></input>
                    <input type='text' name='apellido_pj' value=".str_replace(" ", "_", $apellido)."></input>
                    <input type='text' name='altura_pj' value=$altura></input>
                    <input type='text' name='peso_pj'value=$peso></input>
                    <input type='text' name='raza_pj'value=$raza></input>
                    <input type='text' name='sexo_pj'value=$sexo></input>
                    <input type='text' name='edad_pj'value=$edad></input>

                    <input type='text' name='fu'value=$fu></input>
                    <input type='text' name='de'value=$de></input>
                    <input type='text' name='ca'value=$ca></input>
                    <input type='text' name='int'value=$int></input>
                    <input type='text' name='clase'value=$clase></input>
                  </div>
                ";   

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

              ?>


              <h2>CLASE </h2>
              <?php echo "<p>CLASE ELEGIDA: $clase</p>" ?>
              <p>Experiencia por gastar: <span id='exp'>100</span></p><br />

              <h3>Habilidades de aprendizaje medio</h3>

              <?php
                // Sacar las habilidades medias de la clase
                  $array_habilidades_medias = array();
                  $conexion = conectar();
                  $conexion->query("SET NAMES 'utf8'");
                  $sql = "SELECT habilidad_media_1, habilidad_media_2, habilidad_media_3, habilidad_media_4, habilidad_media_5 FROM clases WHERE nombre = '$clase';";
                  $res = $conexion->query($sql);
                  $fila = $res->fetch_array();
                  for($i=0; $i<=4; $i++){
                    if($fila[$i] != null){
                      $habilidad = 'habilidad_media_'.$i;
                      $numero = $i;
                      echo "<b>$fila[$i]</b>
                            <input  name='$habilidad' id='$habilidad' type='number' value='0' readonly></input>
                            <a id='sumar_habilidad_media' name='$numero' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> 
                            <a id='restar_habilidad_media' name='$numero' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a>
                            <br/>";
                      $array_habilidades_medias[] = $fila[$i];
                    }
                  }
                  $conexion->close();
              ?>


            <br /><h3>Habilidades de aprendizaje fácil</h3>

            <?php
              // Sacar las habilidades faciles de la clase
                $array_habilidades_faciles = array();
                $conexion = conectar();
                $conexion->query("SET NAMES 'utf8'");
                $sql = "SELECT habilidad_facil_1, habilidad_facil_2, habilidad_facil_3, habilidad_facil_4, habilidad_facil_5 FROM clases WHERE nombre = '$clase';";
                $res = $conexion->query($sql);
                $fila = $res->fetch_array();
                for($i=0; $i<=4; $i++){
                  if($fila[$i] != null){
                    $habilidad = 'habilidad_facil_'.($i+1);
                    $numero = $i+1;
                    echo "<b>$fila[$i]</b>
                          <input  name='$habilidad' id='$habilidad' type='number' value='0' readonly></input>
                          <a id='sumar_habilidad_facil' name='$numero' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> 
                          <a id='restar_habilidad_facil' name='$numero' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a>
                          <br/>";
                    $array_habilidades_faciles[] = $fila[$i];
                  }
                }
                $conexion->close();
            ?>

            <br /><h3>Habilidades</h3>

            <?php
              // Sacar un desplegable de todas las habilidades (menos las que ya son medias o fáciles para la clase) que al pulsarlo agrege la nueva habilidad para poder ir subiendola.
              $conexion = conectar();
              $conexion->query("SET NAMES 'utf8'");
              $sql = "SELECT nombre FROM habilidades";
              $res = $conexion->query($sql);
              echo "
                  <b>Escoge habilidad: </b>
                  <select id='select_habilidades'>
                  ";
              while($fila = $res->fetch_array()){
                $habilidad_facil_repetida = false;
                for($i=0; $i<sizeof($array_habilidades_faciles); $i++){
                  if($fila[0] == $array_habilidades_faciles[$i]){
                    $habilidad_facil_repetida = true;
                  }
                }
                $habilidad_media_repetida = false;
                for($i=0; $i<sizeof($array_habilidades_medias); $i++){
                  if($fila[0] == $array_habilidades_medias[$i]){
                    $habilidad_media_repetida = true;
                  }
                }
                // Si la habilidad no está ya repetida
                if(!$habilidad_facil_repetida && !$habilidad_media_repetida) echo "<option>$fila[0]</option>";
              }
             echo "
                </select>
                <a id='sumar_habilidad_media' name='$numero' onclick='agregarHabilidad(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> 
              ";

              echo "
                  <div id='habilidades_escogidas'><br />
                  </div>
              ";

              $conexion->close();
            ?><br />

            <h3>Ventajas</h3>
            <?php

              $conexion = conectar();
              $conexion->query("SET NAMES 'utf8'");
              $sql = "SELECT ventaja_1, ventaja_2, ventaja_3, ventaja_4, ventaja_5, ventaja_6 FROM clases WHERE nombre = '$clase';";
              $res = $conexion->query($sql);
              $row = $res->fetch_array();

              echo "<div id='ventajas'>";
              for($i = 0; $i < 6; $i++){
                if($row[$i] != null){
                  echo "<input type='checkbox' name='ventajas[]' class='checkbox' value='$row[$i]'> <b>$row[$i]</b></input><br />";
                }
              }
              echo "</div><br />";

            ?>

            <h3>Técnicas</h3>
            <?php

              $conexion = conectar();
              $conexion->query("SET NAMES 'utf8'");
              $sql = "SELECT tecnica_1, tecnica_2, tecnica_3, tecnica_4, tecnica_5, tecnica_6 FROM clases WHERE nombre = '$clase';";
              $res = $conexion->query($sql);
              $row = $res->fetch_array();

              echo "<div id='tecnicas'>";
              for($i = 0; $i < 6; $i++){
                if($row[$i] != null){
                  echo "<input type='checkbox' name='tecnicas[]' class='checkbox' value='$row[$i]'> <b>$row[$i]</b></input><br />";
                }
              }
              echo "</div><br />";

            ?>

            <input value="Siguiente" type="submit" /><br />

            <br /><a href="nuevo_personaje_2.php?atras=1">Volver atrás</a>

          </form>

          </div>
          <div class="col-md-2"></div>  

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>