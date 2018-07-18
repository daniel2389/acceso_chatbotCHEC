export function initBusquedasGraph(data) {
    new Chart(document.getElementById("busqueda"), {
        type: 'doughnut',
        data: {
            labels: ["Sin energía", "Susp. Programada"],
            datasets: [{
                label: "# de veces buscadas",
                backgroundColor: ["#3e95cd", "#E8680C"],
                data: [data.c1.n, data.c2.n]
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: ''
            }
        }
    });
}