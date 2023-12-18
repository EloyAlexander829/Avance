<?php
require("Conexion.php");

try {
    $conexion = new Conexion();
    $pdo = $conexion->getConexion();

    $consulta = $pdo->prepare("CALL spu_superhero_listar()");
    $consulta->execute();
    
    $datosComics = $consulta->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>