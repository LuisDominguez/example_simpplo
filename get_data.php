<?php
  // http://www.avisosdeocasion.com/vehiculos-usados-y-nuevos.aspx?n=autos-chevrolet-usados-y-nuevos-nuevo-leon&PlazaBusqueda=2&Plaza=2&pagina=3&idvehiculo=1&Marcas=11
  header('Content-Type: application/json');

  $result_list_ads = array();

  function getHTMLByID($id, $html) {
      $dom = new DOMDocument;
      libxml_use_internal_errors(true);
      $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      $node = $dom->getElementById($id);
      if ($node) {
          return $dom->saveXML($node);
      }
      return FALSE;
  }

  function getHtmlByClassName($classname, $html) {
      $dom = new DOMDocument;
      $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
      $finder = new DomXPath($dom);
      $spaner = $finder->query("//*[contains(@class, '$classname')]");
      return $spaner;
  };

  function getElementsByTag($tagname,$html){
    $dom = new DOMDocument;
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    $result = $dom->getElementsByTagName($tagname);
    return $result;
  }

  function getDateInListObjects($list){
      $list_ads = array();

      foreach ($list as $item) {
        if ($item->hasAttribute('onmouseover')){
          $obj_html = $item->ownerDocument->saveHTML($item);

          /*Se va solo por la imagen del anuncio con una clase especifica para filtrar las demas imagenes que no correspondan
           a la busqueda */
          $images  = getHTMLByID('fotoresult',$obj_html);
          $images = getElementsByTag("img",$images);

          foreach ($images as $image) {
            if ($image->hasAttribute('class') && strstr($image->getAttribute('class'), 'imgfotoaviso')) {
              // echo $image->ownerDocument->saveHTML($image);
              $scr_image = $image->getAttribute("src");
              break;
            }
          }

          $name_and_price = getHtmlByClassName('nombre',$obj_html);


          // Obtener elementos de información del vehiculo
          $info_ads = getElementsByTag("h3",$obj_html);

          // mapeo de los datos leidos
          $price = $name_and_price[0]-> nodeValue;

          $price = explode("|", $price)[0];

          $obj_ad = array(
            "name" => trim($name_and_price[1]-> nodeValue),
            "price" => trim($price),
            "image" => trim($scr_image),
            "year" => trim($info_ads[0]-> nodeValue),
            "type" => trim($info_ads[1]-> nodeValue),
            "color" => trim($info_ads[2]-> nodeValue),
            "doors" => trim($info_ads[3]-> nodeValue),
          );

          array_push($list_ads,$obj_ad);

        }
      }

      return json_encode($list_ads);
  }

  //verifica el parametro de url
  if (isset($_GET["url"])) {

    $url = $_GET["url"];

    $url = base64_decode($url);
    // echo $url;
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];

    // valida que venga del dominio de aviso de ocasion
    if ($domain == "www.avisosdeocasion.com") {

      $pag_web = file_get_contents($url);


      $result = getHTMLByID("divDetalleResultados",$pag_web);
      $result = getHtmlByClassName("cuerporesultado",$result);
      $main_content = $result[0]->ownerDocument->saveHTML($result[0]);
      $result = getElementsByTag("table",$main_content);
      $result_list_ads = getDateInListObjects($result);

    }
  }

  echo $result_list_ads;

?>
