<!doctype html>
<html lang="es">

<head>
  <title>Productos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


</head>

<body>
  <div class="conteiner mt-5 ms-5 me-5 table-responsive">
    <div class="alert alert-info" role="alert">
      <strong>Alert Heading</strong>
      <div>Datos registrados</div>
    </div>

    <table class="table table-sm text-nowrap table-bordered table-hover  shadow-lg" id="tabla-producto">
      <colgroup>
        <col width="5%"> <!-- # -->
        <col width="20%"> <!-- Categoría -->
        <col width="30%"> <!-- Descripción -->
        <col width="10%"> <!-- Precio -->
        <col width="10%"> <!-- Garantia -->
        <col width="10%"> <!-- Fotografia -->
        <col width="15%"> <!-- Comandos -->
      </colgroup>
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Categoría</th>
          <th class="text-center">Descripción</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Garantia</th>
          <th class="text-center">Fotografia</th>
          <th class="text-center">Comandos</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <!-- Datos cargados de forma asíncrona -->
      </tbody>
    </table>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

<script>
  //  VanillaJS (JS Puro)
  document.addEventListener("DOMContentLoaded", () => {

    //  Objeto que referencie a nuestra tabla HTML
    const tabla = document.querySelector("#tabla-producto");

    //  comunicación controlador
    //  renderizar los datos en la tabla > tbody
    function listarProductos() {

      //  Preparar los parámetros a enviar
      const parametros = new FormData()
      parametros.append("operacion", "listar")

      fetch(`../controllers/producto.controller.php`, {
          method: 'POST',
          body: parametros
        })
        .then(response => response.json())
        .then(datosRecibidos => {
          //console.log(datosRecibidos)
          //  Recorrer cada fila del arreglo

          numeroFila = 1;
          datosRecibidos.forEach(registro => {
            //console.log(element);
            let nuevaFila = ``;

            //  Enviar los valores obtenidos en celdas <td></td>  
            nuevaFila = `
              <tr>
                <td>${numeroFila}</td>  
                <td>${registro.categoria}</td>  
                <td>${registro.descripcion}</td>  
                <td>${registro.precio}</td>  
                <td>${registro.garantia}</td>  
                <td><a href='#'>Ver</td>  
                <td>
                  <button class='btn btn-danger btn-sm' type='button'>Eliminar</button>
                  <button class='btn btn-info btn-sm' type='button'>Editar</button>
                </td>  
              </tr>
              `;
            numeroFila++;

            tabla.innerHTML += nuevaFila;
          });
        })
        .catch(e => {
          console.error(e)
        })
    }



    listarProductos();
  });
</script>

</html>