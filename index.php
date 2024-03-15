<!doctype html>
<html lang="es">

<head>
  <title>Productos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
  <div class="container mt-3">
    <div class="row">
      <div class="alert alert-info" role="alert">
        <h4>VENDEDORES</h4>
        <div>Lista de vendedores</div>
          <button class="btn btn-success btn-sm botones" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-vendedor">
            Crear&nbsp;&nbsp;
          </button>
      </div>
    </div>
    
    <table class="table table-sm table-striped" id="tabla-vendedores">
      <colgroup>
        <col width="5%">  <!-- # -->
        <col width="20%"> <!-- Apellidos -->
        <col width="30%"> <!-- Nombres -->
        <col width="10%"> <!-- DNI -->
        <col width="10%"> <!-- Telefono -->
        <col width="10%"> <!-- Correo -->
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>DNI</th>
          <th>Teléfono</th>
          <th>Correo</th>
        </tr>
      </thead>
      <tbody>
          <!-- DATOS CARGADOS DE FORMA ASINCRONA -->
      </tbody>
    </table>
  </div> <!-- Cierre del container -->
  <div class="modal fade" id="modal-vendedor" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-titulo">REGISTRO VENDEDOR</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="form-producto" enctype="multipart/form-data">
            <div class="row">
              <!-- Apellidos del vendedor -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="apellidos" class="form-label">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos">
                </div>
              </div>
              <!-- Nombres del vendedor -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nombres" class="form-label">Nombres</label>
                  <input type="text" class="form-control" id="nombres">
                </div>
              </div>            
            </div>
            <div class="row">
              <!-- DNI VENDEDOR -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="dni" class="form-label">DNI</label>
                  <input type="tel" class="form-control" id="dni">
                </div>
              </div>      
              <!-- TELEFONO VENDEDOR -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono</label>
                  <input type="tel" class="form-control" id="telefono">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col md-12">
                <div class="mb-3">
                  <label for="correo" class="form-label">Correo</label>
                  <input type="text" class="form-control" id="correo">
                </div>
              </div>
            </div>
          </form> <!-- FIN DEL FORMULARIO-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" modalVisor data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="guardarDatos">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () =>{
      const myModal = new bootstrap.Modal(document.getElementById("modal-vendedor"));
      function $(id){
        return document.querySelector(id);
      }

      function listar(){
        const parametros = new FormData();
        parametros.append("operacion", "listar")

        fetch(`./controllers/vendedor.controller.php`,{
          method:"POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          let numFila = 1;
          $("#tabla-vendedores tbody").innerHTML = '';
          datos.forEach(element => {
            let nuevaFila = ``;
            nuevaFila = `
              <tr>
                <td>${numFila}</td>
                <td>${element.apellidos}</td>
                <td>${element.nombres}</td>
                <td>${element.dni}</td>
                <td>${element.telefono}</td>
                <td>${element.correo}</td>
              </tr>
            `;
            $("#tabla-vendedores tbody").innerHTML += nuevaFila;
            numFila++;
          });
        })
        .catch(e=>{
          console.error(e)
        })
      }

      function registrar(){
        const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("apellidos", $("#apellidos").value);
        parametros.append("nombres", $("#nombres").value);
        parametros.append("dni", $("#dni").value);
        parametros.append("telefono", $("#telefono").value);
        parametros.append("correo", $("#correo").value);

        fetch(`./controllers/vendedor.controller.php`, {
          method:"POST",
          body:parametros
        })
        .then(respuesta => respuesta.text())
        .then(datos =>{
          // console.log(datos);
          myModal.hide();
          listar();
        })
        .catch(e =>{
          console.error(e)
        })
      }
      $("#guardarDatos").addEventListener("click", function() {
        registrar();
      });
      listar();
    })
  </script>

</body>

</html>