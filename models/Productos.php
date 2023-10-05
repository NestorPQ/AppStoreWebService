<?php

require_once 'Conexion.php';

class Producto extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this -> conexion = parent::getConexion();
  }

  public function listar(){
    try {
      //code...
      $consulta = $this -> conexion -> prepare("CALL sp_listar_productos()");
      $consulta -> execute();
      return $consulta -> fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      die($e -> getMessage());
    }
  }

  public function registrar($datos = []){
    try {
      //code...
      $consulta = $this -> conexion -> prepare("CALL spu_productos_registrar(?,?,?,?,?)");
      $consulta -> execute(array(
        $datos['idcategoria'],
        $datos['descripcion'],
        $datos['precio'],
        $datos['garantia'],
        $datos['fotografia']
      ));

    } catch (Exception $e) {
      die($e -> getMessage());
    }
  }

}
