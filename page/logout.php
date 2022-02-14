<?php
  session_start();
  if(isset($_SESSION["username"])){
    session_unset();
    header('location: index.php');
  }else{
    header('location: index.php');
  }

 ?>