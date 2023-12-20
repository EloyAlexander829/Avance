<?php 
require_once '../models/publisher.php';

if(isset($_GET['operacion'])){

    $alignment = new Publisher(); 

    if($_GET['operacion'] == 'getHeroesPorPublisher'){
        echo json_encode($alignment->getHeroesPorPublisher());
    }
}