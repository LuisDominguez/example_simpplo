<?php
  function connectDB(){
    $db = new mysqli('127.0.0.1', 'root', 'root', 'simpplo');
    if($db->connect_errno > 0){
        die('Error de conexion con la base de datos [' . $db->connect_error . ']');
    }
    return $db;
  }


?>
