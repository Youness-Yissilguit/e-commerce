<?php 
    $conn = mysqli_connect('localhost','root','','techshopbd') ;
    
    if(!$conn) {
      echo 'connection error: ' . mysqli_connect_error();
      }
?>