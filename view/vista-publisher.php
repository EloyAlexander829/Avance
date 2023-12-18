<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista Publisher</title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
</head>
<body>
  <h1>Vista Publisher</h1>
  <div class="container">
    <div class="alert alert-info mt-3">
      <h5>Vista Publisher</h5>
      <span>Complete la Información Solicitada</span>
    </div>

    <div class="card mt-2">
      <div class="card-body">

      <form action="" id="form" autocomplete="off">
        
        <div class="mb-3">
          <select name="publisher" id="publisher" class="form-select"  required>
            <option value="">Seleccionar</option>
          </select>
        </div>
      </form>

        <table class="table caption-top">
          <thead class="table-info">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">FullName</th>
              <th scope="col">gender</th>
              <th scope="col">Race</th>
            </tr>
          </thead>
          <tbody>
            <!-- Todos los registros de la Base de Datos -->
            <?php include_once("../models/listar-publisher.php");?>
            <?php foreach($datosComics as $datosC){?>

            <tr>
              <td class="text-nowrap"> <?php echo $datosC->id ?></td>
              <td class="text-nowrap"> <?php echo $datosC->superhero_name ?></td>
              <td class="text-nowrap"> <?php echo $datosC->full_name ?></td>
              <td class="text-nowrap"> <?php echo $datosC->gender ?></td>
              <td class="text-nowrap"> <?php echo $datosC->race ?></td>
            </tr>

            <?php  }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      function $(id) {return document.querySelector(id)}

      (function () {
          fetch(`../controllers/publisher.controller.php?operacion=listar`,{})
            .then(respuesta => respuesta.json())
            .then(datos => {
 
              datos.forEach(element => {
                const tagOption = document.createElement("option")
                tagOption.value = element.id
                tagOption.innerHTML = element.publisher_name
                $("#publisher").appendChild(tagOption)
              });

            })
            .catch(e => {
              console.error(e)
            })
        })();
    })
  </script>
</body>
</html>