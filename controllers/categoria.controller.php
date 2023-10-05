<?php

require_once '../models/Categoria.php';

if (isset($_POST['operacion'])) {
  # code...
  $categoria = new Categoria();

  //  ¿Qué operación es?
  if ($_POST['operacion']) {
    # code...
    switch ($_POST['operacion']) {


      case 'listar':
        //  El método listar retorna un array PHP asociativo, esto NO lo entiende el navegador
        //  entoces, convertir el arreglo en un objeto JSON y lo enviamos a la vista.
        echo json_encode($categoria->listar());
        break;


      case 'registrar':
        //  Recolectar/recibir los valores enviados desde la vista
        $datosEnviar = [
          'categoria'   => $_POST['categoria'],
        ];
        //  Enviamos el arreglo al método
        $categoria->registrar($datosEnviar);
        break;


      case 'actualizar':
        $idCategoria = $_POST['id_categoria'];
        $nuevaCategoria = $_POST['nueva_categoria'];
        $categoria->actualizar($idCategoria, $nuevaCategoria);
        break;


      case 'eliminar':
        $idCategoria = $_POST['id_categoria'];
        $categoria->eliminar($idCategoria);
        break;


      default:
        echo "Error: Operación no válida.";
        break;
    }
  }
}
