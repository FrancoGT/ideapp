<br>
<?php
    $ci = &get_instance();
?>
<div id="reporte_general">
    <div align="center"> 
        <h1>Reportes</h1> <br>
        <h3>Materiales con mayor inversión</h3>
        <canvas id="bar-chart" width="75" height="37"></canvas>
        <script>
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                    labels:<?php $ci->get_array_materiales(); ?>,
                    datasets: [
                    {
                        label: "Costo de material",
                        backgroundColor: ["red", "blue","yellow","green","pink"],
                        data: <?php $ci->get_array_precios(); ?>
                    }
                    ]
                },
                options: {
                    legend: { display: false },
                    title: {
                    display: true,
                    text: ''
                    },

                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }

                }
            });
        </script>
    </div>
</div>