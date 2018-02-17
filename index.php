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

        <!-- Slider (Carousel) -->
        <div id="slider_home" class="carousel slide" data-ride="carousel">

          <ol class="carousel-indicators">

            <li data-target="#slider_home" data-slide-to="0" class="active"></li>
            <li data-target="#slider_home" data-slide-to="1"></li>
            <li data-target="#slider_home" data-slide-to="2"></li>

          </ol>

          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">

              <img class="d-block img-fluid" src="img/slider1.jpg" alt="First slide">

              <div class="carousel-caption">
                
                <h2>Titulo </h2>
                <p>Este es el texto de prueba de la imagen. </p>
                <a href="#">Enlace</a>

              </div>

            </div>

            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/slider2.jpg" alt="Second slide">
            </div>

            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/slider3.jpg" alt="Third slide">
            </div>

          </div>     
               
        </div>

        <!-- Contenido -->
        <div class="row">      
          
          <div class="col-md-6">

            <h3>Cabecera noticia <i class="fa fa-bookmark pull-right hidden-xs-down" aria-hidden="true"></i> </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec molestie arcu vel augue ornare, sed semper arcu semper. Morbi justo metus, blandit sit amet aliquam ac, congue in ex. Integer bibendum aliquam convallis. Nullam pulvinar orci ac est pulvinar, ac imperdiet augue cursus. Ut aliquam nulla sed mauris pharetra, sit amet interdum sapien tempor. Vivamus dui quam, accumsan non tincidunt viverra, elementum et quam.</p>
            

          </div>

          <div class="col-md-6">

            <h3>Cabecera noticia <i class="fa fa-bookmark pull-right hidden-xs-down" aria-hidden="true"></i> </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec molestie arcu vel augue ornare, sed semper arcu semper. Morbi justo metus, blandit sit amet aliquam ac, congue in ex. Integer bibendum aliquam convallis. Nullam pulvinar orci ac est pulvinar, ac imperdiet augue cursus. Ut aliquam nulla sed mauris pharetra, sit amet interdum sapien tempor. Vivamus dui quam, accumsan non tincidunt viverra, elementum et quam.</p>

          </div>

        </div>

        <h3>Imágenes prueba</h3>

        <!-- Imágenes -->
        <div class="row">
          
          <div class="col-md-4">
            <img src="img/prueba1.jpg" alt="Imagen 1" class="img-fluid">
          </div>

          <div class="col-md-4">
            <img src="img/prueba2.jpg" alt="Imagen 2" class="img-fluid">
          </div>

          <div class="col-md-4">           
            <img src="img/prueba3.jpg" alt="Imagen 3" class="img-fluid">
          </div>

        </div>

      </div> <!-- Cerrar div container -->

    </div> <!-- Cerrar div main -->

   <?php include 'include/footer.php' ?>
  
  </body>
</html>