<?php

require_once '../models/Productos.php';

if (isset($_POST['operacion'])) {
  # code...
  $producto = new Producto();

  //  ¿Qué operación es?
  if ($_POST['operacion']) {
    # code...
    switch($_POST['operacion']){
      case 'listar':
        //  El método listar retorna un array PHP asociativo, esto NO lo entiende el navegador
        //  entoces, convertir el arreglo en un objeto JSON y lo enviamos a la vista.
  echo json_encode($producto -> listar());
        break;
        case 'registrar':
          //  Recolectar/recibir los valores enviados desde la vista
          $datosEnviar = [
            'idcategoria'   => $_POST['idcategoria'],
            'descripcion'   => $_POST['descripcion'],
            'precio'        => $_POST['precio'],
            'garantia'      => $_POST['garantia'],
            'fotografia'    => $_POST['fotografia'],
          ];

          //  Enviamos el arreglo al método
          $producto -> registrar($datosEnviar);
          break;
    }
  }
}