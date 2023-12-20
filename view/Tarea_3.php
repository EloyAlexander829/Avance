<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T3:Publisher</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="alert alert-info mt-3">
            <h5>T3: Publisher</h5>
            <span>Gráfico con los registros de Heroes de diferentes distribuidores</span>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <form action="" id="formBusqueda" autocomplete="off">

                    <div class="mb-3">
                        <select name="publisher" id="publisher" class="form-select">
                            <option value="">Seleccionar</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" id="Tarea_1" onclick="redirectToFile('Tarea_1.php');"
                            type="button">Tarea
                            1</button>
                        <button class="btn btn-secondary" id="Tarea_2" onclick="redirectToFile('Tarea_2.php');"
                            type="button">Tarea
                            2</button>
                    </div>
                </form>

                <div style="width: 50%; margin: auto;">
                    <canvas id="lienzo"></canvas>
                </div>

                <!-- CDN de chart -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        function $(id) {
            return document.querySelector(id);
        }

        (function() {
            fetch(`../controllers/publisher.controller.php?operacion=listar`, {})
                .then(respuesta => respuesta.json())
                .then(datos => {
                    datos.forEach(element => {
                        const tagOption = document.createElement("option");
                        tagOption.value = element.publisher_name;
                        tagOption.innerHTML = element.publisher_name;
                        $("#publisher").appendChild(tagOption);
                    });
                })
                .catch(e => {
                    console.error(e);
                });
        })();

        const contexto = document.querySelector("#lienzo")
        const grafico = new Chart(contexto, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: "Alignment",
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        $("#publisher").addEventListener("change", function() {
            const selectedPublisher = this.value;

            fetch(
                    `../controllers/publisher.controller.php?operacion=getAlignmentSummaryByPublisher&publisher=${selectedPublisher}`
                )
                .then(respuesta => respuesta.json())
                .then(datos => {
                    grafico.data.labels = datos.map(registro => registro.alignment);
                    grafico.data.datasets[0].data = datos.map(registro => registro.Total);
                    grafico.update();
                })
                .catch(e => {
                    console.error(e);
                });
        });
    })

    function redirectToFile(file) {
        window.location.href = file;
    }
    </script>
</body>

</html>