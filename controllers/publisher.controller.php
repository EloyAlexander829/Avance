<?php 
require_once '../models/publisher.php';

if(isset($_GET['operacion'])){

  $publisher = new Publisher();

  if ($_GET['operacion'] == 'listar'){
    $respuesta = $publisher->getAll();
    echo json_encode($respuesta);
  } else if ($_GET['operacion'] == 'getAlignmentSummaryByPublisher'){
    $publisher_name = isset($_GET['publisher']) ? $_GET['publisher'] : '';
    $respuesta = $publisher->getAlignmentSummaryByPublisher($publisher_name);
    echo json_encode($respuesta);
  }
}
?>