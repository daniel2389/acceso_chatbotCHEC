// Grafico busquedas
var ctx = document.getElementById("busqueda");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["No tengo servicio de energía", "Suspensión Programada"],
        datasets: [{
            label: 'Opciones más buscadas',
            data: [12, 19],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
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