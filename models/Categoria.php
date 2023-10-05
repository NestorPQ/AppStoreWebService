<?php
require_once 'Conexion.php';

class Categoria extends Conexion
{
  private $conexion;

  public function __CONSTRUCT()
  {
    $this->conexion = parent::getConexion();
  }

  public function listar()
  {
    try {
      //code...
      $consulta = $this->conexion->prepare("CALL sp_listar_categoria()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function registrar($datos = [])
  {
    try {
      //code...
      $consulta = $this->conexion->prepare("CALL sp_agregar_categoria(?) ");
      $consulta->execute(array(
        $datos['categoria']
      ));
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function eliminar($id)
  {
    try {
      $consulta = $this->conexion->prepare("CALL sp_eliminar_categoria(?)");
      $consulta->execute([$id]);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function actualizar($id, $nuevaCategoria)
  {
    try {
      $consulta = $this->conexion->prepare("CALL sp_actualizar_categoria(?,?)");
      $consulta->execute([$id, $nuevaCategoria]);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  //  Métodos extras 
  //  Método para obtener una categoría por ID
  public function obtenerPorId($id)
  {
    try {
      $consulta = $this->conexion->prepare("CALL sp_obtener_categoria_por_id(?)");
      $consulta->execute([$id]);
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  //  Método de validación de datos
  public function validarNombre($nombre)
  {
    // Realiza la validación según tus reglas de negocio
    if (empty($nombre)) {
      return "El nombre de la categoría no puede estar vacío.";
    }
    // Puedes agregar más validaciones aquí
    return null; // Si la validación es exitosa
  }

  //  Método para contar categorías
  public function contarCategorias()
  {
    try {
      $consulta = $this->conexion->prepare("SELECT COUNT(*) as total FROM categorias");
      $consulta->execute();
      $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
      return $resultado['total'];
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  //  Método para obtener todas las categorías relacionadas con un producto
  public function obtenerCategoriasDeProducto($idProducto)
  {
    try {
      $consulta = $this->conexion->prepare("CALL sp_obtener_categorias_de_producto(?)");
      $consulta->execute([$idProducto]);
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
