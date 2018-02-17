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

      // SIN JQUERY ////////////////////////////////////////////////////////
      /*// Función para saber la raza elegida en cada momento
      function capturaRaza(){
        var raza = "Humano"; // Es la raza inicial, no se capturaría si no se cambia el select, por eso se deja por defecto
        var raza = document.getElementById("raza").value;
        
        if(raza == "Sirronita"){
          var div = document.getElementById('esMujer');
          div.style.display = 'none';
          document.getElementById('opciones_1').checked = true;
          document.getElementById('opciones_2').checked = false;
        }else{
          var div = document.getElementById('esMujer');
          div.style.display = '';
        }
      }*/
      ////////////////////////////////////////////////////////////////////


      $(document).ready(function(){

        // Los Sirronitas solo tienen hombres
        $("#raza").on("change",function(){
          var x = this.value;
          if(x == "Sirronita"){
            $("#esMujer").css("display","none");
            $("#hombre").prop("checked",true);
          }else{
            $("#esMujer").css("display","");
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

          <div class="col-md-2"></div> 
          <div class="col-md-8"> 

            <!-- Formulario para datos básicos del personaje -->
            <form class="form-horizontal" role="form" action="nuevo_personaje_2.php" method="post">

              <div class="form-group">
                <div class="col-lg-10">
                  <input type="text" name='nombre' id='nombre' required pattern="[A-Z][a-z]+"  oninvalid="setCustomValidity('El campo nombre tiene que empezar por mayúscula y no tener espacios')" oninput="setCustomValidity('')" class="form-control" id="ejemplo_email_3"
                         placeholder="Nombre de tu personaje">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-10">
                  <input type="text" name='apellido' id='apellido' required pattern="[a-zA-Z]+[a-zA-Z ]+"  oninvalid="setCustomValidity('El campo apellido solo debe contener letras, espacios y no estar vacio')" oninput="setCustomValidity('')"  class="form-control" id="ejemplo_email_3"
                         placeholder="Apellido de tu personaje">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-10">
                  <input type="number" name='edad' required min='0' class="form-control" id="edad" 
                         placeholder="Edad de tu personaje">
                </div>
              </div>      

              <div class="form-group">
                <div class="col-lg-10">
                  <input type="number" name='altura' required min='0' step='0.01' class="form-control" id="altura" 
                         placeholder="Altura de tu personaje en metros">
                </div>
              </div>   

              <div class="form-group">
                <div class="col-lg-10">
                  <input type="number" name='peso' required min='0' step='0.01' class="form-control" id="peso" 
                         placeholder="Peso de tu personaje en kilos">
                </div>
              </div>   

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <select name='raza' class="form-control" id='raza'">
                    <option>Humano</option>
                    <option>Enano</option>
                    <option>Gnomo</option>
                    <option>Claro</option>
                    <option>Sirronita</option>
                    <option>Ogro</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <div class="radio">
                    <label>
                      <input type="radio" name="opciones" id="hombre" value="hombre" checked>
                      Hombre
                    </label>
                  </div>
                  <div class="radio" id='esMujer'>
                    <label>
                      <input type="radio" name="opciones" id="mujer" value="mujer">
                      Mujer
                    </label>
                  </div>
                </div>
              </div>

               <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-default">Siguiente</button>
                </div>
              </div>

            </form>


          </div>
          <div class="col-md-2"></div>  

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>


  
  </body>
</html>