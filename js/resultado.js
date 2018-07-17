export function initResultadosGraph(data) {
    // grafico resultados
    var ctx = document.getElementById("resultados");
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ["Suspensión Programada", "Suspensión Efectiva", "Circuito", "Daño", "Nada"],
            datasets: [{
                label: 'Resultados',
                data: [data.suspensionProgramada.n, data.suspensionEfectiva.n, data.indisponibilidadNivelCircuito.n, data.indisponibilidadNivelNodo.n, data.sinIndisponibilidadReportada.n],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(153, 102, 255, 0.3)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}