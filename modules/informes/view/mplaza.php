<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
$conn->CargaCampanaSession(4);
?>


<div class="row">
    <div class="col-lg-2">
    <?php require_once 'sidebarmplaza.php'; ?>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">Informes Mall plaza <img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logo_mplaza2.jpg" width="50"></div>
            <div class="panel-body">
                    <div class=" col-lg-10">
                        <div class="col-lg-10">
                            <div class="panel panel-info">
                                <div class="panel-heading">Encuestas por Mall</div>
                                <div class="panel-body ">
                                    <table class="table table-hover" >
                                        <thead>
                                        <th>Mall</th>
                                        <th>Q Encuestas</th>
                                        <th>Q Negativo</th>
                                        <th>Q Promotor</th>
                                        <th>Q Neutro</th>
                                        <th>Q Encuestas Realizadas</th>
                                        </thead>
                                        <?php $informes->EncxMall($_SESSION['campana']['bd'], "cliente_dato", "", "group by mall") ?>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Calificaciones Totales</div>
                                <div class="panel-body">
                                    <div id="containers"  ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Journey</div>
                                <div class="panel-body">
                                    <div id="xItem"  ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Positivos</div>
                                <div class="panel-body">
                                    <div id="xDimension"  ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Negativos</div>
                                <div class="panel-body">
                                    <div id="xDimensionNeg"  ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Neutral</div>
                                <div class="panel-body">
                                    <div id="xDimensionNeu"  ></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            ['Mes', 'Negativo', 'Neutro', 'Positivo', 'nps'],
<?php $informes->TotalEncuestasRalizadas($_SESSION['campana']['bd']); ?>


        ]);
        var options = {
            
            colors: ['#ff0000', '#EBEF1B', '#00ff00', '#0000ff'],
            isStacked: true,
            seriesType: "bars",
            series: {3: {type: "line"}}
        };
        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('containers'));
        chart.draw(data, options);
    }
    function xItem() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Item', 'Cantidad'],
<?php $informes->TotalencuestasxItem($_SESSION['campana']['bd']) ?>
        ]);
        var options = {
            bar: {groupWidth: "95%"},
            legend: {position: "none"},
            isStacked: true
        };
        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('xItem'));
        chart.draw(data, options);
    }
    function xDimension() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Calificados');
        data.addRows([
<?php
$informes->TotalencuestasxDimension($_SESSION['campana']['bd'], 25, "desc");
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('xDimension'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimensionNeu() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Calificados');
        data.addRows([
<?php $informes->TotalencuestasxDimension($_SESSION['campana']['bd'], 27, "dim1", 'sen1'); ?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('xDimensionNeu'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimensionNeg() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Calificados');
        data.addRows([
<?php
$informes->TotalencuestasxDimension($_SESSION['campana']['bd'], 26, "dim1", 'sen1');
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('xDimensionNeg'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    google.charts.setOnLoadCallback(xDimension);
    google.charts.setOnLoadCallback(xDimensionNeg);
    google.charts.setOnLoadCallback(xDimensionNeu);
    google.charts.setOnLoadCallback(xItem);
    google.charts.setOnLoadCallback(drawChart); 
</script>
<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
