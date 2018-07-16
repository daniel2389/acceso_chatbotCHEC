// grafico resultados
var ctx = document.getElementById("resultados");
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ["Suspensión Programada", "Suspensión Efectiva", "Circuito", "Daño", "Nada"],
        datasets: [{
            label: 'Resultados',
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