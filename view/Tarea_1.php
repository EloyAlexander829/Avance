<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Publisher</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="alert alert-info mt-3">
            <h5>T1: Vista Publisher</h5>
            <span>Muestra Registros Relacionados</span>
        </div>

        <div class="card mt-2">
            <div class="card-body">

                <form action="" id="formBusqueda" autocomplete="off">

                    <div class="mb-3">
                        <select name="publisher" id="publisher" class="form-select">
                            <option value="">Seleccionar</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" id="Tarea_2" onclick="redirectToFile('Tarea_2.php');" type="button">Tarea 2</button>
                        <button class="btn btn-secondary" id="Tarea_3" onclick="redirectToFile('Tarea_3.php');" type="button">Tarea 3</button>
                    </div>
                    <small id="status">No hay Búsquedas Activas</small>
                </form>

                <table class="table caption-top">
                    <thead class="table-info">
                        <tr>
                            <th id="id"             scope="col">Id</th>
                            <th id="publisher_name" scope="col">publisher_name</th>
                            <th id="superhero_name" scope="col">Name</th>
                            <th id="full_name"      scope="col">FullName</th>
                            <th id="gender"         scope="col">gender</th>
                            <th id="race"           scope="col">Race</th>
                        </tr>
                    </thead>
                    <tbody id="tablaRegistros"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {

        function $(id) {
            return document.querySelector(id)
        }

        (function() {
            fetch(`../controllers/publisher.controller.php?operacion=listar`, {})
                .then(respuesta => respuesta.json())
                .then(datos => {
                    datos.forEach(element => {
                        const tagOption = document.createElement("option")
                        tagOption.value = element.publisher_name
                        tagOption.innerHTML = element.publisher_name
                        $("#publisher").appendChild(tagOption)
                    });
                })
                .catch(e => {
                    console.error(e)
                })
        })();

        function buscarPublisher() {
            const selector = $("#publisher");
            selector.addEventListener("change", () => {
                const publisher_name = selector.value;

                $("#status").innerHTML = "Buscando, por favor espere..."

                if (publisher_name !== "") {
                    $("#tablaRegistros").innerHTML = "";

                    const datos =
                        `operacion=buscar&publisher_name=${encodeURIComponent(publisher_name)}`;

                    fetch("../controllers/superhero.controller.php", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: datos
                        })
                        .then(respuesta => respuesta.json())
                        .then(datos => {
                            datos.forEach(element => {
                                $("#status").innerHTML = "Registros Encontrados"

                                const tr = document.createElement("tr");

                                const idhero = document.createElement("td");
                                idhero.textContent = element.id;
                                tr.appendChild(idhero);

                                const publisher_name = document.createElement("td");
                                publisher_name.textContent = element.publisher_name;
                                tr.appendChild(publisher_name);

                                const superhero_name = document.createElement("td");
                                superhero_name.textContent = element.superhero_name; 
                                tr.appendChild(superhero_name);

                                const full_name = document.createElement("td"); 
                                full_name.textContent = element.full_name;
                                tr.appendChild(full_name);

                                const gender = document.createElement("td"); 
                                gender.textContent = element.gender; 
                                tr.appendChild(gender); 

                                const race = document.createElement("td");
                                race.textContent = element.race;
                                tr.appendChild(race);

                                $("#tablaRegistros").appendChild(tr);
                            });
                        })
                        .catch(e => {
                          console.error(e);
                        });
                }
            });
        }
        buscarPublisher();
    });

    function redirectToFile(file) {
        window.location.href = file;
      }
    </script>
</body>

</html>