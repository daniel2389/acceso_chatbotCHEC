export function initIngresoPorDia(data) {
  let dataForGraph = [0,0,0,0,0,0,0];
  data.forEach(element => {
      switch (element._id) {
        case 1:
          dataForGraph[0] = element.sum
          break;
        case 2:
          dataForGraph[1] = element.sum
          break;
        case 3:
          dataForGraph[2] = element.sum
          break;
        case 4:
          dataForGraph[3] = element.sum
          break;
        case 5:
          dataForGraph[4] = element.sum
          break;
        case 6:
          dataForGraph[5] = element.sum
          break;
        case 7:
          dataForGraph[6] = element.sum
          break;
        default:
          break;
      }
  });



  

  new Chart(document.getElementById("usoPorDia"), {
    type: 'line',
    data: {
      labels: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],
      datasets: [{
        data: [dataForGraph[0], dataForGraph[1], dataForGraph[2], dataForGraph[3], dataForGraph[4], dataForGraph[5], dataForGraph[6]],
        label: "Uso por día",
        borderColor: "#3e95cd",
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

