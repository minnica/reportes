$(document).ready(function() {
    $.ajax({
        url: "php/datos.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var fecha = [];
            var montaje = [];
            var dia = [];
            
            var color = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
            var bordercolor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
            console.log(data);
            //console.log(data2);

            for (var i in data) {
                fecha.push(data[i].fecha);
                montaje.push(data[i].montaje); 
                dia.push(data[i].dia);                
            }

/*=============================================
=            Section comment block            =
=============================================*/
            var mostrar = $("#miGrafico3");

            var grafico = new Chart(mostrar, {
                type: 'line',
                data: {
                    labels: fecha,
                    datasets: [
                    { 
                        data: montaje, 
                        label: "MONTAJE POR DIA",
                        borderColor: "#45B39D",
                        backgroundColor: "#45B39D",
                        fill: false
                       
                    }


                    ]
                },
                /*options: {
                    title: {
                      display: true,
                      text: 'MONTAJE MODULOS'
                  }
              }*/
            });
/*=====  End of Section comment block  ======*/


        },
        error: function(data) {
            console.log(data);
        }
    });
});
