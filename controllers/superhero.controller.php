<?php
require_once '../models/superhero.php';

if(isset($_POST['operacion'])){

    $superhero = new SuperHero();

    if($_POST['operacion'] == 'buscar'){
        $respuesta = $superhero->search(["publisher_name" => $_POST["publisher_name"]]);
        sleep(2);
        echo json_encode($respuesta);
    }
}

if(isset($_GET['operacion'])){

    $superhero = new SuperHero();

    if($_GET['operacion'] == 'getResumenAlignmentSuperHero()'){
        echo json_encode($superhero->getResumenAlignmentSuperHero());
    }
}
?>