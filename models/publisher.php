<?php 
require_once 'Conexion.php';

class Publisher extends Conexion{

  private $pdo;

  public function __CONSTRUCT()
  {
    $this->pdo = parent::getConexion();
  }

  public function getAll(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_publisher_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function getAlignmentSummaryByPublisher($publisher_name)
  {
    try{
      $consulta = $this->pdo->prepare("CALL spu_resumen_publisher(:publisher_name)");
      $consulta->bindParam(':publisher_name', $publisher_name, PDO::PARAM_STR); 
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
      die($e->getMessage());
    }
  }
}