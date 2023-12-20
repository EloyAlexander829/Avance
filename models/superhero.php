<?php 
require 'Conexion.php';

class SuperHero extends Conexion{
    
    private $pdo; 

    public function __CONSTRUCT(){
        $this->pdo = parent::getConexion();
    }

    public function search($data = []){
        try{
            $consulta = $this->pdo->prepare("CALL spu_superhero_buscar(?)");
            $consulta->execute(
                array($data['publisher_name'])
            );
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getResumenAlignmentSuperHero(){
        try{
            $consulta = $this->pdo->prepare("CALL spu_resumen_alignment()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}
?>