<?php
  include_once "include/conectarBD.php";
  include_once "include/funciones.php"; 
  session_start();

  $id_jugador= sacar_id($_SESSION["usuario"]);
  desligar_dj($id_jugador);
?>

<script languaje="javascript">
  window.location.href = "index.php";
</script>