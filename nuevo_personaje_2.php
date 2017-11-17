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

    <!-- Funciones Javascript -->
    <script>

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
         if(exp_actual == 60){
            alert("No puedes obtener mas experiencia, 100 es el máximo para gastar")
            return false;
         }else{
            var exp = parseInt(exp_actual) + numeroSumar;
            document.getElementById('exp').innerHTML = exp;
            return true;
         }
      }

      // Función para saber sumar uno al atributo
      function sumarUno(a){
        var valor = a.id;
        if(restaExp(3)){
          if(valor == "sumar_fu"){
            var fu = document.getElementById("fu").innerHTML;
            var fu = parseInt(fu) + 1;
            document.getElementById("fu").innerHTML = fu;
            document.getElementById("fu_form").value = fu;
          }
          if(valor == "sumar_de"){
            var de = document.getElementById("de").innerHTML;
            var de = parseInt(de) + 1;
            document.getElementById("de").innerHTML = de;
            document.getElementById("de_form").value = de;
          }
          if(valor == "sumar_ca"){
            var ca = document.getElementById("ca").innerHTML;
            var ca = parseInt(ca) + 1;
            document.getElementById("ca").innerHTML = ca;
            document.getElementById("ca_form").value = ca;
          }
          if(valor == "sumar_in"){
            var int = document.getElementById("int").innerHTML;
            var int = parseInt(int) + 1;
            document.getElementById("int").innerHTML = int;
            document.getElementById("int_form").value = int;
          }
        }
      }

      // Función para restar uno al atributo
      function restarUno(a){
        var valor = a.id;

        if(valor == "restar_fu"){
          var fu_min = a.getAttribute('value');
          var fu = document.getElementById("fu").innerHTML;
          if( fu == fu_min){ 
            alert("No puedo bajar la fuerza menos");
          }else{
            if(sumaExp(3)){
              var fu = parseInt(fu) - 1;
              document.getElementById("fu").innerHTML = fu;
              document.getElementById("fu_form").value = fu;
            }
          }
        }
        if(valor == "restar_de"){
          var de_min = a.getAttribute('value');
          var de = document.getElementById("de").innerHTML;
          if( de == de_min){ 
            alert("No puedo bajar la destreza menos");
          }else{
            if(sumaExp(3)){
              var de = parseInt(de) - 1;
              document.getElementById("de").innerHTML = de;
              document.getElementById("de_form").value = de;
            }
          }
        }
        if(valor == "restar_ca"){
          var ca_min = a.getAttribute('value');
          var ca = document.getElementById("ca").innerHTML;
          if( ca == ca_min){ 
            alert("No puedo bajar el carisma menos");
          }else{
            if(sumaExp(3)){
              var ca = parseInt(ca) - 1;
              document.getElementById("ca").innerHTML = ca;
              document.getElementById("ca_form").value = ca;
            }
          }
        }
        if(valor == "restar_in"){
           var int_min = a.getAttribute('value');
          var int = document.getElementById("int").innerHTML;
          if( int == int_min){ 
            alert("No puedo bajar la inteligencia menos");
          }else{
            if(sumaExp(3)){
              var int = parseInt(int) - 1;
              document.getElementById("int").innerHTML = int;
              document.getElementById("int_form").value = int;
            }
          }
        } 
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

          <form class="form-horizontal" role="form" action="nuevo_personaje_3.php" method="post">

          <?php

            if (isset($_POST["nombre"])){
              // Datos recogidos
              $nombre = $_POST["nombre"];
              $apellido = $_POST["apellido"];
              $edad = $_POST["edad"];
              $altura = $_POST["altura"];
              $peso = $_POST["peso"];
              $raza = $_POST["raza"];
              $sexo = $_POST["opciones"];

              // Datos a sesión
              $_SESSION["nombre_pj"] = $nombre;
              $_SESSION["apellido_pj"] = $apellido;
              $_SESSION["altura_pj"] = $altura;
              $_SESSION["peso_pj"] = $peso;
              $_SESSION["raza_pj"] = $raza;
              $_SESSION["sexo_pj"] = $sexo;
              $_SESSION["edad_pj"] = $edad;
            }else{
              $nombre = $_SESSION["nombre_pj"];
              $apellido = $_SESSION["apellido_pj"];
              $altura = $_SESSION["altura_pj"];
              $peso = $_SESSION["peso_pj"];
              $raza = $_SESSION["raza_pj"];
              $sexo = $_SESSION["sexo_pj"];
              $edad = $_SESSION["edad_pj"];
            }

            // Crear div oculto con los datos recogidos
            echo "
              <div style='display:none;'>
                <input type='text' name='nombre_pj' value=$nombre></input>
                <input type='text' name='apellido_pj' value=$apellido></input>
                <input type='text' name='altura_pj' value=$altura></input>
                <input type='text' name='peso_pj'value=$peso></input>
                <input type='text' name='raza_pj'value=$raza></input>
                <input type='text' name='sexo_pj'value=$sexo></input>
                <input type='text' name='edad_pj'value=$edad></input>
              </div>
            ";    
          ?>
          
          <h1>Atributos</h1>
            Experiencia por gastar: <span id='exp'>60</span><br /><br />


            <!-- ATRIBUTOS -->

            <?php if($raza == "Humano"){ ?>

              <?php
                $fu=20;
                $de=20;
                $ca=20;
                $int=20;
              ?>

            <!-- Estadisticas iniciales HUMANO -->
            <p>Fuerza: <span id='fu'>20</span> <a id='sumar_fu'  onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> <a id='restar_fu' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a> </p>
            <p>Destreza: <span id='de' value='20'>20</span> <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> <a id='restar_de' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a> </p>
            <p>Carisma: <span id='ca' value='20'>20</span> <a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> <a id='restar_ca' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a> </p>
            <p>Inteligencia: <span id='int' value='20'>20</span> <a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a> <a id='restar_in' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a>  </p>

            <?php } ?>

            <?php if($raza == "Enano"){ ?>

              <?php
                $fu=25;
                $de=15;
                $ca=20;
                $int=20;
              ?>

            <!-- Estadisticas iniciales ENANO -->
            <p>Fuerza: <span id='fu'>25</span> <a id='sumar_fu' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a>
            <a id='restar_fu' value='25' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Destreza: <span id='de'>15</span>  <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_de' value='15' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Carisma: <span id='ca'>20</span>  <a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_ca' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Inteligencia: <span id='int'>20</span> <a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_in' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>

            <?php } ?>

            <?php if($raza == "Claro"){ ?>

              <?php
                $fu=15;
                $de=25;
                $ca=20;
                $int=20;
              ?>

            <!-- Estadisticas iniciales CLARO -->
            <p>Fuerza: <span id='fu'>15</span>  <a id='sumar_fu' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_fu' value='15' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Destreza: <span id='de'>25</span> <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_de' value='25' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Carisma: <span id='ca'>20</span>  <a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_ca' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Inteligencia: <span id='int'>20</span>  <a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_in' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>

            <?php } ?>

            <?php if($raza == "Sirronita"){ ?>

              <?php
                $fu=30;
                $de=20;
                $ca=15;
                $int=15;
              ?>

            <!-- Estadisticas iniciales SIRRONITA -->
            <p>Fuerza:<span id='fu'>30</span> <a id='sumar_fu' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_fu' value='30' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Destreza:<span id='de'>20</span> <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_de' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Carisma:<span id='ca'>15</span> <a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_ca' value='15' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Inteligencia:<span id='int'>15</span><a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_in' value='15' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>

            <?php } ?>


            <?php if($raza == "Gnomo"){ ?>

              <?php
                $fu=10;
                $de=20;
                $ca=25;
                $int=25;
              ?>

            <!-- Estadisticas iniciales GNOMO -->
            <p>Fuerza:<span id='fu'>10</span> <a id='sumar_fu' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_fu' value='10' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Destreza:<span id='de'>20</span> <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_de' value='20' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Carisma:<span id='ca'>25</span><a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_ca' value='25' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Inteligencia:<span id='int'>25</span> <a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_in' value='25' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>

            <?php } ?>


            <?php if($raza == "Ogro"){ ?>

             <?php
                $fu=30;
                $de=10;
                $ca=15;
                $int=25;
              ?>

            <!-- Estadisticas iniciales OGRO -->
            <p>Fuerza:<span id='fu'>30</span> <a id='sumar_fu' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_fu' value='30' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Destreza:<span id='de'>10</span> <a id='sumar_de' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_de' value='10' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Carisma:<span id='ca'>15</span> <a id='sumar_ca' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_ca' value='15' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>
            <p>Inteligencia:<span id='int'>25</span> <a id='sumar_in' onclick='sumarUno(this)'><i class='fa fa-plus-circle' aria-hidden='true'></i></a><a id='restar_in' value='25' onclick='restarUno(this)'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></p>

            <?php } ?>

             <?php

              // Crear div oculto con los atributos principales para el formulario
              echo "
                <div style='display:none;'>
                  <input type='text' id='fu_form' name='fu' value=$fu></input>
                  <input type='text' id='de_form' name='de' value=$de></input>
                  <input type='text' id='ca_form' name='ca' value=$ca></input>
                  <input type='text' id='int_form' name='int' value=$int></input>
                </div>
              ";   

            ?>

            <!--  FIN ATRIBUTOS -->

            <!-- CLASES -->
            
            <h1>Clase</h1>

            <?php

              $conexion = conectar();
              $conexion->query("SET NAMES 'utf8'");

              $sql = "SELECT nombre FROM clases";
              $res = $conexion->query($sql);

              echo '
                       <div class="form-group">
                          <select name="clase" class="form-control" id="clase">
              ';

              while($fila = $res->fetch_array()){
                  ?>
                    <option><?php echo $fila[0]  ?></option>
                  <?php
              }

              echo '
                          </select>
                        </div>
              ';

            ?>

            <button type="submit" id="enviar" class="btn btn-default">Siguiente</button>

            </form>

            <br /><a href="nuevo_personaje.php">Volver atrás </a>

            <!-- FIN CLASES -->

          </div>

          <div class="col-md-2"></div> 

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>