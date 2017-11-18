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
                  $sql = "SELECT * FROM tecnicas;";
                  $res = $conexion->query($sql);
                  $num_total_registros = $res->num_rows;
                  // Límite de la busqueda
                  $TAMANO_PAGINA = 1;
                  // Ver página a mostrar
                  $pag = $_GET["pag"];
                  if(!$pag) $pag = 0;
                  // Sacar datos de consulta a mostrar
                  $sql = "SELECT * FROM tecnicas LIMIT $pag, $TAMANO_PAGINA;";
                  $res = $conexion->query($sql);
                  $fila = $res->fetch_array();
                  $nombre = $fila['nombre'];
                  $coste_pv = $fila['coste_pv'];
                  $coste_accion = $fila['coste_accion'];
                  $impactar = $fila["habilidad_impactar"];
                  $descripcion = $fila['descripcion'];
                  $efecto = $fila['efecto'];
                  $origen = $fila['origen'];

                  $conexion->close();

                  // BOTONES CAMBIAR REGISTRO

                  // Variables 
                  $siguiente = $pag + 1;
                  $anterior = $pag - 1;
                  $primero = 0;
                  $ultimo = $num_total_registros - 1;

                  // Botones 
                  echo "<h3>TÉCNICAS</h3>";
                  if($pag == 0){
                    echo "
                        <a href='bd_tecnicas.php?pag=$siguiente'> > </a> &nbsp;&nbsp; 
                        <a href='bd_tecnicas.php?pag=$ultimo'> >> </a>
                        ";
                  }else{
                    if($pag == $ultimo){
                      echo "
                        <a href='bd_tecnicas.php?pag=$primero'> << </a>&nbsp;&nbsp;   
                        <a href='bd_tecnicas.php?pag=$anterior'> < </a>                    
                        ";
                    }else{
                      echo "
                        <a href='bd_tecnicas.php?pag=$primero'> << </a>&nbsp;&nbsp; 
                        <a href='bd_tecnicas.php?pag=$anterior'> < </a>&nbsp;&nbsp; 
                        <a href='bd_tecnicas.php?pag=$siguiente'> > </a>&nbsp;&nbsp; 
                        <a href='bd_tecnicas?pag=$ultimo'> >> </a>
                        ";
                    }
                  }
                ?>
                
                <!-- MOSTRAR REGISTRO -->
                <div id='recuadro_bd'>
                  <p class="titulo_bd"><?php echo $nombre ?></p>
                  <p><?php echo "<span class='apartado_bd'>Clase/s: </span>".$origen ?></p>
                  <p><?php echo "<span class='apartado_bd'>Impactar con: </span>".$impactar ?></p>
                  <p><?php echo "<span class='apartado_bd'>Coste PV: </span>".$coste_pv ?></p>
                  <p><?php echo "<span class='apartado_bd'>Coste Acción: </span>".$coste_accion ?></p>
                  <p class="descripcion_bd"><?php echo $descripcion ?></p>
                  <p><?php echo $efecto ?></p>
                </div>

            </div>

          <div class="col-md-3"></div>

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>