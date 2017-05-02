<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
$conn->CargaCampanaSession(4);
$NomMall = $_POST['Mall'];
?>    
<div class="row">
    <div class="col-lg-2">
        <?php require_once '../../config/sidebarmplaza.php'; ?>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">Seleccion de Mall</div>
            <div class="panel-body">
                <form method="post" name="FormMall" id="FormMall">
                    <select onchange="this.form.submit()" class="form-control" name="Mall" id="Mall">
                        <?php echo $informes->ListaMalls(); ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Informes Mallplaza <strong>Mall <?php echo $NomMall ?></strong> </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Calificaciones Totales <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="containers"  ></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Journey <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="xItem"  ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Positivos <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="xDimension"  ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Negativos <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="xDimensionNeg"  ></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">NPS Calificados Neutral <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="xDimensionNeu"  ></div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-lg-10">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Detractores Negativos <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                   <!-- <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Categoria</th>
                                                <th>Ene - <?php echo date('Y')?></th>
                                                <th>Feb - <?php echo date('Y')?></th>
                                                <th>Mar - <?php echo date('Y')?></th>
                                                <th>Abr - <?php echo date('Y')?></th>
                                                <th>May - <?php echo date('Y')?></th>
                                                <th>Jun - <?php echo date('Y')?></th>
                                                <th>Jul - <?php echo date('Y')?></th>
                                                <th>Ago - <?php echo date('Y')?></th>
                                                <th>Sep - <?php echo date('Y')?></th>
                                                <th>Oct - <?php echo date('Y')?></th>
                                                <th>Nov - <?php echo date('Y')?></th>
                                                <th>Dic - <?php echo date('Y')?></th>
                                                <th>Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php //echo $informes->DetractoresTbl();?>
                                        </tbody>
                                    </table>
                                    
                                    <div id="xDetractoresNeg"></div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-lg-2">
                            <div class="panel panel-info panel-body-mplaza">
                                <div class="panel-heading">Division por Genero <strong>Mall <?php echo $NomMall ?></strong></div>
                                <div class="panel-body">
                                    <div id="xgenero"></div>
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
<?php $informes->TotalEncuestasRalizadasxMall($_SESSION['campana']['bd'], $_POST['Mall']); ?>


            ]);
            var options = {
                title: '',

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
<?php $informes->TotalencuestasxItemxMall($_SESSION['campana']['bd'], $_POST['Mall']) ?>
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
        function xSexo() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
                ['Item', 'Cantidad'],
<?php $informes->xGeneroxMal( $_POST['Mall']) ?>
            ]);
            var options = {

                bar: {groupWidth: "95%"},
                legend: {position: "none"},
                isStacked: true
            };
            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('xgenero'));
            chart.draw(data, options);
        }
        function xDimension() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Day');
            data.addColumn('number', 'Calificados');
            data.addRows([
                //['Variedad de Tiendas y Productos', 33],
<?php
$informes->TotalencuestasxDimensionxMall($_SESSION['campana']['bd'], 25, 'dim1', 'sen1', "desc", $_POST['Mall']);
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
<?php $informes->TotalencuestasxDimensionxMall($_SESSION['campana']['bd'], 27, 'dim1', 'sen1', "desc", $_POST['Mall']); ?>
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
$informes->TotalencuestasxDimensionxMall($_SESSION['campana']['bd'], 26, 'dim1', 'sen1', "desc", $_POST['Mall']);
?>
            ]);
            var chart = new google.visualization.AreaChart(document.getElementById('xDimensionNeg'));
            chart.draw(data, {

                legend: 'none'
            });
        }
        function xDetractoresNeg() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Day');
            data.addColumn('number', 'Calificados');
            data.addRows([
<?php
echo $informes->DetractoresTbl( $_POST['Mall']);
?>
            ]);
            var chart = new google.visualization.AreaChart(document.getElementById('xDetractoresNeg'));
            chart.draw(data, {

                legend: 'none'
            });
        }
        google.charts.setOnLoadCallback(xDimension);
        google.charts.setOnLoadCallback(xDimensionNeg);
        google.charts.setOnLoadCallback(xDimensionNeu);
        google.charts.setOnLoadCallback(xItem);
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(xSexo);
        google.charts.setOnLoadCallback(xDetractoresNeg);
        
    </script>
    <script src="<?php echo __BASE_URL__ . __MODULO_informes__ . 'js/informes_js.js'; ?>" ></script>
    <?php require_once '../../config/footer.php'; ?>
