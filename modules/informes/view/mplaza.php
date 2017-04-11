<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
$conn->CargaCampanaSession(4);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Informes Mall plaza <img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logo_mplaza2.jpg" width="50"></div>
    <div class="panel-body">
        <div class="row col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Encuestas por Mall</div>
                <div class="panel-body ">
                    <table  id="EncMall" class="table table-hover">
                        <thead>
                        <th>Mall</th>
                        <th>Q Encuestas</th>
                        <th>Q Negativo</th>
                        <th>Q Promotor</th>
                        <th>Q Neutro</th>
                        <th>Q Encuestas Realizadas</th>
                        </thead>
                        <tbody>
                            <?php $informes->EncxMall($_SESSION['campana']['bd'], "cliente_dato", "", "group by mall") ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row col-md-6">
            <div class="panel panel-info panel-body-mplaza">
                <div class="panel-heading">Calificaciones Totales</div>
                <div class="panel-body">
                    <div id="containers"  ></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************************
*CHARTS 
*
*************************************************-->
<script language="JavaScript">
    google.charts.load('current', {packages: ['corechart']});
    /*
     * GRAFICO TOTAL NPS
     * @return {undefined}
     * 
     */
    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Mes', 'Negativo', 'Neutro', 'Positivo','nps'],
<?php $informes->TotalEncuestasRalizadas($_SESSION['campana']['bd']); ?>
            

        ]);
        var options = {
            title: '',
            width: 550,
            heigth: 400,
            colors: ['#ff0000', '#EBEF1B', '#00ff00','#0000ff'],
            isStacked: true,
            seriesType:"bars",
            series:{3:{type:"line"}}
        };
        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('containers'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart);
</script>
<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
