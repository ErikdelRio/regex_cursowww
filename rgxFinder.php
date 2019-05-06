#!php

<?php
// $argv[0] = Este archivo (rgxFinder.php)
// $argv[1] = Regex que se va a usar
// $argv[2] = Archivo en el que se va a buscar
// php rgxFinder.php <regex> <archivo>

  // No se pasó un archivo como parámetro
  if(!isset($argv[2])){
    echo "No pasaste archivón\n\n";
    return;
  }
  // Abrir y verificar que el archivo se abrió correctamente
  $arch = fopen($argv[2], "r");
  if(!$arch){
    echo "No se encontró archivo o no se pudo abrir\n\n";
    return;
  }

  // Leer el archivo, y luego cerrarlo
  $text = [];
  while(!feof($arch)){
    $line = fgets($arch);
    array_push($text, $line);
  }
  fclose($arch);
  // Leer la regex que se le dio al archivo
  $regex = "/".$argv[1]."/";

  //Encontrar las coincidencias línea por línea
  $matches = [];
  $findGlobal = false;
  for($i=0; $i< sizeof($text); $i++){
    $encontrado = preg_match($regex, $text[$i], $match);
    if($encontrado)
      array_push($matches, $text[$i]);
      //array_push($matches, $match);
    $findGlobal |= $encontrado;
  }

  //Si se encontraron coincidencias, imprimirlas
  if($findGlobal){
    for($i=0; $i< sizeof($matches); $i++){
      print_r($matches[$i]);
    }
  } else {
    echo "No se encontraron coincidencias\n\n";
  }
?>
