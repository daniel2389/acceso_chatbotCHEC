//uso por hora
/* var ctx = document.getElementById("usoPorHora");
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
}); */

export function initIngresoHora(data) {
    let hours = [];
    let sum = [];
    data.forEach(element => {
        hours.push(element._id);
        sum.push(element.sum)
    });
    new Chart(document.getElementById("usoPorHora"), {
        type: 'line',
        data: {
            labels: hours,
            datasets: [{
                data: sum,
                label: "Uso por hora",
                borderColor: "#077F00",
                fill: false
            },
            ]
        },
        options: {
            title: {
                display: false,
                text: ''
            }
        }
    });
}

