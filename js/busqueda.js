new Chart(document.getElementById("busqueda"), {
    type: 'bar',
    data: {
        labels: ["No tengo servicio de energía", "Suspensión Programada"],
        datasets: [{
            label: "# de veces buscadas",
            backgroundColor: ["#3e95cd", "#E8680C"],
            data: [2478, 5267]
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