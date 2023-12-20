<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T2: Gráfico Alignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="alert alert-info mt-3">
            <h5>T2: Gráfico Alignment</h5>
            <span>Muestra el Gráfico de los Super Heroes de cada bando</span>
        </div>

        <div style="width: 50%; margin:auto;">
            <canvas id="lienzo"></canvas>
        </div>

        <!-- CDN de chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="container mt-3">
            <table class="table caption-top">
                <thead class="table-info">
                    <tr>
                        <th scope="col">Alignment</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="tablaTotal"></tbody>
            </table>
            <button class="btn btn-primary" id="volver" onclick="redirectToFile('Tarea_1.php');" type="button">Tarea
                1</button>
            <button class="btn btn-secondary" id="buscar" onclick="redirectToFile('Tarea_3.php');" type="button">Tarea
                3</button>
        </div>
    </div>
    <script>
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

    (function() {
        fetch(`../controllers/superhero.controller.php?operacion=getResumenAlignmentSuperHero()`)
            .then(respuesta => respuesta.json())
            .then(datos => {
                console.log(datos)
                grafico.data.labels = datos.map(registro => registro.alignment)
                grafico.data.datasets[0].data = datos.map(registro => registro.Total)
                grafico.update()

                const tablaDatos = document.getElementById("tablaTotal");
                datos.forEach(registro => {
                    const tr = document.createElement("tr");
                    const tdAlignment = document.createElement("td");
                    tdAlignment.textContent = registro.alignment;
                    const tdTotal = document.createElement("td");
                    tdTotal.textContent = registro.Total;
                    tr.appendChild(tdAlignment);
                    tr.appendChild(tdTotal);
                    tablaDatos.appendChild(tr);
                });
            })
            .catch(e => {
                console.error(e)
            })
    })();

    function redirectToFile(file) {
        window.location.href = file;
    }
    </script>
</body>

</html>