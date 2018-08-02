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
            }, ]
        },
        options: {
            title: {
                display: false,
                text: ''
            }
        }
    });
}