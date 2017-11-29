<?php
  header('Content-Type: application/json');

  require_once '../db/conection.php';

  $db = connectDB();

  if($db->connect_errno > 0){
      die('Error de conexion con la base de datos [' . $db->connect_error . ']');
  }

  $results_arr = array();

  function getAdsJsons($db) {

    $query = "SELECT * FROM ads";

    //Realiza el query a la base de datos
    $query_result = $db->query($query)
                        or die("Error en el query " . mysqli_error($db));

    // cuenta las columnas de los resultados
    $rowcount = mysqli_num_rows($query_result);

    if ($rowcount > 0) {
      while ($row = $query_result->fetch_assoc()) {

          $results_arr[] = $row;
      }

    }else{
      $results_arr = null;
    }

    return $results_arr;

  }

  // Función para permitir el retorno de caracteres utf8
  function fixedUtf8($d) {
      if (is_array($d)) {
          foreach ($d as $k => $v) {
              $d[$k] = fixedUtf8($v);
          }
      } else if (is_string ($d)) {
          return utf8_encode($d);
      }
      return $d;
  }

  $ads = getAdsJsons($db);

  $arr = array("success" => "1", "ads" => $ads);

  echo json_encode(fixedUtf8($arr));
?>
