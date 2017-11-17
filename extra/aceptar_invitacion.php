<?php
  include_once "include/conectarBD.php";
  include_once "include/funciones.php"; 
  session_start();

  $id_jugador= sacar_id($_SESSION["usuario"]);
  $id_dj = $_SESSION["id_dj"];
  aceptar_invitacion($id_jugador,$id_dj);
?>

<script languaje="javascript">
  window.location.href = "index.php";
</script>