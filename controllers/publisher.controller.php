<?php 
require_once '../models/publisher.php';

if(isset($_POST['operacion'])){

  $publisher = new Publisher();

  if ($_POST['operacion'] == 'listar'){
    $respuesta = $publisher->getAll();
    echo json_encode($respuesta);
  }

}