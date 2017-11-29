<?php
  header("Access-Control-Allow-Origin: *");

  require_once 'conection.php';

  $db = connectDB();
  $db->set_charset("utf8");


  if($db->connect_errno > 0){
      die('Error de conexion con la base de datos [' . $db->connect_error . ']');
  }

  function isValidJSON($str) {
     json_decode($str);
     return json_last_error() == JSON_ERROR_NONE;
  }

  $jsonParam = file_get_contents("php://input");



  if (strlen($jsonParam) > 0 && isValidJSON($jsonParam)){
    $arrayAds = json_decode($jsonParam,true);

    $arrayAds = $arrayAds['items_ads'];
    $query = "";

    foreach ($arrayAds as $objAd) {
      // $objAd = json_encode($objAd);

      // $name = preg_replace('/\s(?=([^"]*"[^"]*")*[^"]*$)/', '', $objAd['name']);
      $name = trim($objAd['name']);
      $price = trim($objAd['price']);
      $image = trim($objAd['image']);
      $type = trim($objAd['type']);
      $color = trim($objAd['color']);
      $doors = trim($objAd['doors']);
      $year = trim($objAd['year']);



      $query .= "INSERT INTO ads (name,price,image,year,type,color,doors)
      VALUES ('$name','$price','$image','$type','$color','$doors','$year');";

    }

  }

  if ($db->multi_query($query) === TRUE) {
      $response = array("success" => "1", "message" => "Querys ingresados");
  } else {
      $response = array("success" => "0", "message" => $db->error);
  }

  $db->close();
  echo json_encode($response);

?>
