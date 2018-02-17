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

  </head>

  <body>
        
    <?php include 'include/header.php' ?>

    <div id="main">

      <div class="container">

        <div class="row">

          <div class="col-md-2"></div> 
          <div class="col-md-6"> 

            <?php

                // Recogemos todos los datos anteriores
                if (isset($_POST["nombre_pj"])){

                  // Datos de nuevo_personaje_1
                  $nombre = $_POST["nombre_pj"];
                  $apellido = str_replace("_", " ", $_POST["apellido_pj"]); // cambiamos guiones por espacios para mostrar y guardar en BD definitivamente de esta forma
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

                  // Habilidades medias
                  $array_nombres_habilidades_medias = array();
                  $conexion=conectar();
                  $conexion->query("SET NAMES 'utf8'");
                  $sql = "SELECT habilidad_media_1, habilidad_media_2, habilidad_media_3, habilidad_media_4, habilidad_media_5 FROM clases WHERE nombre = '$clase';";
                  $res = $conexion->query($sql);
                  $fila = $res->fetch_array();
                  for($i=0; $i<=5; $i++){
                    if($fila[$i] != null) $array_nombres_habilidades_medias[$i] = $fila[$i];
                  }

                  $array_habilidades_medias = array();
                  for($i=0; $i<5; $i++){
                  	$a = "habilidad_media_".$i;
                  	if($_POST[$a] != null){
                  		$array_habilidades_medias[$i] = $_POST[$a];
                  	}
                  }

                  // Metemos las habilidades medias en sesion
                  $_SESSION["array_nombres_habilidades_medias"] = $array_nombres_habilidades_medias;
                  $_SESSION["array_habilidades_medias"] = $array_habilidades_medias;

                  // Habilidades fáciles
                  $array_nombres_habilidades_faciles = array();
                  $conexion=conectar();
                  $conexion->query("SET NAMES 'utf8'");
                  $sql = "SELECT habilidad_facil_1, habilidad_facil_2, habilidad_facil_3, habilidad_facil_4, habilidad_facil_5 FROM clases WHERE nombre = '$clase';";
                  $res = $conexion->query($sql);
                  $fila = $res->fetch_array();
                  for($i=0; $i<=5; $i++){
                    if($fila[$i] != null) $array_nombres_habilidades_faciles[$i] = $fila[$i];
                  }

                  $array_habilidades_faciles = array();
                  for($i=0; $i<5; $i++){
                  	$a = "habilidad_facil_".($i+1);
                  	if($_POST[$a] != null){
                  		$array_habilidades_faciles[$i] = $_POST[$a];
                  	}
                  }

                  // Metemos las habilidades faciles en sesion
                  $_SESSION["array_nombres_habilidades_faciles"] = $array_nombres_habilidades_faciles;
                  $_SESSION["array_habilidades_faciles"] = $array_habilidades_faciles;


                  // Habilidades 
                  $array_nombre_habilidades = array();
                  for($i=0; $i<10; $i++){
                  	$a = "nombre_habilidad_".$i;
                  	if(isset($_POST[$a])){
                  		$array_nombre_habilidades[$i] = $_POST[$a];
                  	}
                  }

                  $array_habilidades = array();
                  for($i=0; $i<10; $i++){
                  	if(isset($_POST[$i])){
                  		$array_habilidades[$i] = $_POST[$i];
                  	}
                  }

                  // Metemos las habilidades en sesion
                  $_SESSION["array_nombre_habilidades"] = $array_nombre_habilidades;
                  $_SESSION["array_habilidades"] = $array_habilidades;

                  // Metemos las Ventajas  en sesion
                  $array_ventajas = $_POST["ventajas"];
                  $_SESSION["array_ventajas"] = $array_ventajas;

                  // Metemos las Tecnicas en sesion
                  $array_tecnicas = $_POST["tecnicas"];
                  $_SESSION["array_tecnicas"] = $array_tecnicas;
               
              }

            ?>

            <div id="resumen_personaje">

              <h1>RESUMEN DE TU PERSONAJE</h1><br />

              <div id="datos_generales">
                <!-- Nombre del personaje -->
                <span class='letraGrande negrita'><?php echo "$nombre $apellido"; ?></span><br />
                <!-- Clase -->
                <span class="letraGrande"><?php echo "$clase" ?></span><br /><br />
              </div>

              <div id="atributos">
                <span class="negrita letraGrande margenDerechoPeque">FU: <?php echo "<span class='sinNegrita'>$fu</span>" ?></span>
                <span class="negrita letraGrande margenDerechoPeque">DE: <?php echo "<span class='sinNegrita'>$de</span>" ?></span>
                <span class="negrita letraGrande margenDerechoPeque">CA: <?php echo "<span class='sinNegrita'>$ca</span>" ?></span>
                <span class="negrita letraGrande">IN: <?php echo "<span class='sinNegrita'>$int</span>" ?></span>
              </div><br />

              <div id="datos_personales" class='bordeRedondeado'>
                <ul>
                  <li>Raza: <?php echo "$raza"; ?></li>
                  <li>Sexo: <?php echo "$sexo"; ?></li>
                  <li>Edad: <?php echo "$edad"; ?></li>
                  <li>Altura: <?php echo "$altura"; ?></li>
                  <li>Peso: <?php echo "$peso"; ?></li>
                </ul>
              </div><br />

              <div id="habilidades">
                <?php
                  // Habilidades fáciles
                  if(count($array_nombres_habilidades_faciles) != 0){
                    echo "<h3>Habilidades fáciles</h3>";
                    echo "<ul>";
                    for($i=0; $i<count($array_nombres_habilidades_faciles); $i++){
                      echo "<li class='negrita'>".$array_nombres_habilidades_faciles[$i].": ".$array_habilidades_faciles[$i];
                    }
                    echo "</ul>";
                  }
                  // Habilidades medias
                  if(count($array_nombres_habilidades_medias) != 0){
                    echo "<h3>Habilidades médias</h3>";
                    echo "<ul>";
                    for($i=0; $i<count($array_nombres_habilidades_medias); $i++){
                      echo "<li class='negrita'>".$array_nombres_habilidades_medias[$i].": ".$array_habilidades_medias[$i];
                    }
                    echo "</ul>";
                  }
                  // Habilidades difíciles
                  if(count($array_nombre_habilidades) != 0){
                    echo "<h3>Habilidades difíciles</h3>";
                    echo "<ul>";
                    for($i=0; $i<count($array_nombre_habilidades); $i++){
                      echo "<li class='negrita'>".str_replace("_"," ",$array_nombre_habilidades[$i]).": ".$array_habilidades[$i];
                    }
                    echo "</ul>";
                  }
                ?>
              </div>

              <div id="ventajas">
                <?php
                  if(count($array_ventajas) != 0){
                    echo "<h3>Ventajas</h3>";
                    echo "<ul>";
                    for($i=0; $i<count($array_ventajas); $i++){
                      echo "<li class='negrita'>".$array_ventajas[$i]."</li>";
                    }
                    echo "</ul>";
                  }
                ?>
              </div>

              <div id="tecnicas">
                <?php
                  if(count($array_tecnicas) != 0){
                    echo "<h3>Técnicas</h3>";
                    echo "<ul>";
                    for($i=0; $i<count($array_tecnicas); $i++){
                      echo "<li class='negrita'>".$array_tecnicas[$i]."</li>";
                    }
                    echo "</ul>";
                  }
                ?>
              </div>

              <button><a href="extra/personaje_a_bd.php">Crear personaje</a></button>
 
            </div> 

            <br /><a href="nuevo_personaje_3.php?atras=1">Volver atrás</a>

          </div> <!-- Cerrar el div col-md-6 -->

          <div class="col-md-2"></div> 
 

        </div> <!-- Cerrar el div row -->

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>