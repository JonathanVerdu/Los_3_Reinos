<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimym-scale=1.0 shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="jquery/jquery-3.2.1.js" type="text/javascript"></script> 

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

          <div class="col-md-3"></div>

            <div class="col-md-6">

                <?php

                  // Menú para elegir tabla de la BD
                  include_once "include/menu_bd.php";
                  
                  $conexion = conectar();
                  $conexion->query("SET NAMES 'utf8'");

                  // PREPARAR REGISTRO

                  // Registros totales
                  $sql = "SELECT * FROM clases;";
                  $res = $conexion->query($sql);
                  $num_total_registros = $res->num_rows;
                  // Límite de la busqueda
                  $TAMANO_PAGINA = 1;
                  // Ver página a mostrar
                  $pag = $_GET["pag"];
                  if(!$pag) $pag = 0;
                  // Sacar datos de consulta a mostrar
                  $sql = "SELECT * FROM clases LIMIT $pag, $TAMANO_PAGINA;";
                  $res = $conexion->query($sql);
                  $fila = $res->fetch_array();
                  $nombre = $fila['nombre'];
                  $descripcion = $fila['descripcion'];

                  $habilidad_facil_1 = $fila['habilidad_facil_1'];
                  $habilidad_facil_2 = $fila['habilidad_facil_2'];
                  $habilidad_facil_3 = $fila['habilidad_facil_3'];
                  $habilidad_facil_4 = $fila['habilidad_facil_4'];
                  $habilidad_facil_5 = $fila['habilidad_facil_5'];

                  $habilidad_media_1 = $fila['habilidad_media_1'];
                  $habilidad_media_2 = $fila['habilidad_media_2'];
                  $habilidad_media_3 = $fila['habilidad_media_3'];
                  $habilidad_media_4 = $fila['habilidad_media_4'];
                  $habilidad_media_5 = $fila['habilidad_media_5'];

                  $ventaja_1 = $fila['ventaja_1'];
                  $ventaja_2 = $fila['ventaja_2'];
                  $ventaja_3 = $fila['ventaja_3'];
                  $ventaja_4 = $fila['ventaja_4'];
                  $ventaja_5 = $fila['ventaja_5'];
                  $ventaja_6 = $fila['ventaja_6'];

                  $tecnica_1 = $fila['tecnica_1'];
                  $tecnica_2 = $fila['tecnica_2'];
                  $tecnica_3 = $fila['tecnica_3'];
                  $tecnica_4 = $fila['tecnica_4'];
                  $tecnica_5 = $fila['tecnica_5'];
                  $tecnica_6 = $fila['tecnica_6'];

                  $subir_fu = $fila['subir_fu'];
                  $subir_de = $fila['subir_de'];
                  $subir_ca = $fila['subir_ca'];
                  $subir_in = $fila['subir_in'];

                  $nombre_clasea_1 = $fila['nombre_clasea_1'];
                  $nombre_clasea_2 = $fila['nombre_clasea_2'];
                  $nombre_clasea_3 = $fila['nombre_clasea_3'];
                  $clasea_1 = $fila['clasea_1'];
                  $clasea_2 = $fila['clasea_2'];
                  $clasea_3 = $fila['clasea_3'];

                  $conexion->close();

                  // BOTONES CAMBIAR REGISTROS

                  // Variables 
                  $siguiente = $pag + 1;
                  $anterior = $pag - 1;
                  $primero = 0;
                  $ultimo = $num_total_registros - 1;

                  // Botones 
                  echo "<h3>CLASES</h3>";
                  if($pag == 0){
                    echo "
                        <a href='bd_clases.php?pag=$siguiente'> > </a> &nbsp;&nbsp; 
                        <a href='bd_clases.php?pag=$ultimo'> >> </a>
                        ";
                  }else{
                    if($pag == $ultimo){
                      echo "
                        <a href='bd_clases.php?pag=$primero'> << </a>&nbsp;&nbsp;   
                        <a href='bd_clases.php?pag=$anterior'> < </a>                    
                        ";
                    }else{
                      echo "
                        <a href='bd_clases.php?pag=$primero'> << </a>&nbsp;&nbsp; 
                        <a href='bd_clases.php?pag=$anterior'> < </a>&nbsp;&nbsp; 
                        <a href='bd_clases.php?pag=$siguiente'> > </a>&nbsp;&nbsp; 
                        <a href='bd_clases?pag=$ultimo'> >> </a>
                        ";
                    }
                  }
                ?>
                
                <!-- MOSTRAR REGISTRO -->
                <div id='recuadro_bd'>
                  <p class="titulo_bd"><?php echo $nombre ?></p>
                  <!-- Descripción de clase -->
                  <class="descripcion_bd"><?php echo $descripcion ?></p>
                  <!-- Tabla subida atributos -->
                  <h3>Subida de Atributos</h3>
                  <table class="tabla">
                    <tr>
                      <th>FU</th>
                      <th>DE</th>
                      <th>CA</th>
                      <th>IN</th>
                    </tr>
                    <tr>
                      <td><?php echo $subir_fu ?></td>
                      <td><?php echo $subir_de ?></td>
                      <td><?php echo $subir_ca ?></td>
                      <td><?php echo $subir_in ?></td>
                    </tr>
                  </table><br />
                  <!-- Aprendizaje de habilidades -->
                  <h3>Aprendizaje de Habilidades</h3>
                  <span class='apartado_bd'>FÁCIL:</span>
                  <?php
                    if (isset($habilidad_facil_1)) echo "<a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_facil_1' target='_blank'>$habilidad_facil_1</a>";
                    if (isset($habilidad_facil_2)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_facil_2' target='_blank'>$habilidad_facil_2</a>";
                    if (isset($habilidad_facil_3)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_facil_3' target='_blank'>$habilidad_facil_3</a>";
                    if (isset($habilidad_facil_4)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_facil_4' target='_blank'>$habilidad_facil_4</a>";
                    if (isset($habilidad_facil_5)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_facil_5' target='_blank'>$habilidad_facil_5</a>";
                  ?>
                  <br />
                  <span class='apartado_bd'>MEDIO: </span>
                  <?php
                    if (isset($habilidad_media_1)) echo "<a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_media_1' target='_blank'>$habilidad_media_1</a>";
                    if (isset($habilidad_media_2)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_media_2' target='_blank'>$habilidad_media_2</a>";
                    if (isset($habilidad_media_3)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_media_3' target='_blank'>$habilidad_media_3</a>";
                    if (isset($habilidad_media_4)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_media_4' target='_blank'>$habilidad_media_4</a>";
                    if (isset($habilidad_media_5)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=habilidades&nombre=$habilidad_media_5' target='_blank'>$habilidad_media_5</a>";
                  ?><br /><br />
                  <!-- Mejoras disponibles -->
                  <h3>Mejoras disponibles </h3>
                  <?php
                    if (isset($ventaja_1)) echo "<a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_1' target='_blank'>$ventaja_1</a>";
                    if (isset($ventaja_2)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_2' target='_blank'>$ventaja_2</a>";
                    if (isset($ventaja_3)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_3' target='_blank'>$ventaja_3</a>";
                    if (isset($ventaja_4)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_4' target='_blank'>$ventaja_4</a>";
                    if (isset($ventaja_5)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_5' target='_blank'>$ventaja_5</a>";
                    if (isset($ventaja_6)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=mejoras&nombre=$ventaja_6' target='_blank'>$ventaja_6</a>";
                  ?><br /><br />
                  <!-- Técnicas disponibles -->
                  <h3>Tecnicas disponibles </h3>
                  <?php
                    if (isset($tecnica_1)) echo "<a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_1' target='_blank'>$tecnica_1</a>";
                    if (isset($tecnica_2)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_2' target='_blank'>$tecnica_2</a>";
                    if (isset($tecnica_3)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_3' target='_blank'>$tecnica_3</a>";
                    if (isset($tecnica_4)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_4' target='_blank'>$tecnica_4</a>";
                    if (isset($tecnica_5)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_5' target='_blank'>$tecnica_5</a>";
                    if (isset($tecnica_6)) echo ", <a href='extra/mostrar_ventana_busqueda.php?tabla=tecnicas&nombre=$tecnica_6' target='_blank'>$tecnica_6</a>";
                  ?><br /><br />
                  <h3>Especiales de clase </h3>
                  <!-- Cláseas -->
                  <?php echo "1. ".$nombre_clasea_1."<br />" ?>
                  <span class="apartado_bd"><?php echo $clasea_1 ?></span><br /><br />
                  <?php echo "2. ".$nombre_clasea_2."<br />" ?>
                  <span class="apartado_bd"><?php echo $clasea_2 ?></span><br /><br />
                  <?php echo "3. ".$nombre_clasea_3."<br />" ?>
                  <span class="apartado_bd"><?php echo $clasea_3 ?></span><br /><br />
  
                </div>

            </div>

          <div class="col-md-3"></div>

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>