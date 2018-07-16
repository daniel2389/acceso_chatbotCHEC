//criterio busqueda
var ctx = document.getElementById("criterioBusqueda");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["NIU", "Nombre", "Dirección", "Cédula Ciudadanía", "NIT"],
        datasets: [{
            label: '# de Criterios de Búsqueda',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
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
                    beginAtZero:true
                }
            }]
        }
    }
});