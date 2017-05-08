<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
?>


<div class="row">
    <div class="col-lg-2">
        <?php require_once 'sidebarhcenter.php'; ?>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">Informes Sodimac Homcenter</div>
            <div class="panel-body">
                <div class="panel-info">
                    <div class="panel-heading">
                        Encuestas
                        <form method="post">
                            <select name="Sponsor" id="Sponsor">
                                <option selected="">Seleecione Sponsor</option>
                                <?php echo $conn->CargaSponsor() ?>
                            </select>
                            <select name="Campana" id="Campana" onchange="this.form.submit()">
                                <option  selected="">Seleccione Campana</option>

                            </select>
                        </form> 
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Encuestas</div>
                                        <div class="panel-body">
                                            <table class="table table-hover">
                                                <thead>
                                                <th>Mes</th>
                                                <th>Encuestas</th>
                                                <th>Contestadas</th>
                                                </thead>
                                                <tbody>
                                                    <?php echo $informes->TblEncuestas($_POST['Campana']) ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Tipos de Empresa Encuestadas</div>
                                        <div class="panel-body">
                                            <div id="tipo"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 1<BR>que tanto recomendaria a <span>Sodimac Venta Empresa</div>
                                        <div class="panel-body">
                                            <div id="preg1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.1 A<BR> Amabilidad y disposiciOn para la atencion:</div>
                                        <div class="panel-body">
                                            <div id="preg3a"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.1 B<br>Capacidad para resolver problemas</div>
                                        <div class="panel-body">
                                            <div id="preg3b"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.1 C<br>Tiempo de respuesta para enviar cotizaciones</div>
                                        <div class="panel-body">
                                            <div id="preg3c"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.1 D<br>Su nivel de satisfaccion con la atencion del ejecutivo </div>
                                        <div class="panel-body">
                                            <div id="preg3d"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.2 A<br>Facilidad para obtener su credito</div>
                                        <div class="panel-body">
                                            <div id="preg32a"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.2 B<br> Montos aprobados acorde a los solicitado</div>
                                        <div class="panel-body">
                                            <div id="preg32b"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.2 C<br>Cual es su nivel de satisfaccion con la linea de credito en gral.</div>
                                        <div class="panel-body">
                                            <div id="preg32c"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.3 A<br> Disponibilidad/stock de productos.</div>
                                        <div class="panel-body">
                                            <div id="preg33a"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.3 B<br> Cual es su nivel de satisfaccion con los productos en gral.</div>
                                        <div class="panel-body">
                                            <div id="preg33b"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.4 A<br> Tiempos de entrega del despacho</div>
                                        <div class="panel-body">
                                            <div id="preg34a"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.4 B<br> Informacion entregada sobre el estado de avance del despacho..</div>
                                        <div class="panel-body">
                                            <div id="preg34b"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.4 C<br> Su nivel de satisfaccion con el despacho de productos.</div>
                                        <div class="panel-body">
                                            <div id="preg34c"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.5 A<br> Atencion cobradores</div>
                                        <div class="panel-body">
                                            <div id="preg35a"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.5 B<br> Solucion de problemas de cobranza</div>
                                        <div class="panel-body">
                                            <div id="preg35b"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 3.5 C<br> Su nivel de satisfaccion con la cobranza.</div>
                                        <div class="panel-body">
                                            <div id="preg35c"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">Pregunta 4 <br>¿Que relacion tiene usted en su empresa con el proceso de compra de productos de construccion y/o obra gruesa, terminaciones o ferreteria?</div>
                                        <div class="panel-body">
                                            <div id="preg4"></div>
                                        </div>
                                    </div>
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
    function xItem() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Item', 'Cantidad'],
<?php echo $informes->TipoEmpresaChart($_POST['Campana']) ?>
        ]);
        var options = {
            bar: {groupWidth: "95%"},
            legend: {position: "none"},
            isStacked: true
        };
        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('tipo'));
        chart.draw(data, options);
    }
    function xDimension() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg1',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg1'));
        chart.draw(data, {
            legend: 'none'
        });
    }
     function xDimensionA() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_1a',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg3a'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimensionB() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_1b',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg3b'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimensionC() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_1c',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg3c'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimensionD() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_1d',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg3d'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension32A() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_2a',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg32a'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension32b() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_2b',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg32b'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension32c() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_2c',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg32c'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension33a() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_3a',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg33a'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension33b() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_3b',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg33b'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension34a() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_4a',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg34a'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension34b() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_4b',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg34b'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension34c() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_4c',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg34c'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension35a() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_5a',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg35a'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension35b() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_5b',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg35b'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    function xDimension35c() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg3_5c',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg35c'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    
    function xDimension4() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Nota');
        data.addRows([
<?php
 $informes->TotalPregunta($_POST['Campana'],'preg4',3);
?>
        ]);
        var chart = new google.visualization.AreaChart(document.getElementById('preg4'));
        chart.draw(data, {
            legend: 'none'
        });
    }
    google.charts.setOnLoadCallback(xDimension);
    google.charts.setOnLoadCallback(xDimensionA);
    google.charts.setOnLoadCallback(xDimensionB);
    google.charts.setOnLoadCallback(xDimensionC);
    google.charts.setOnLoadCallback(xDimensionD);
    google.charts.setOnLoadCallback(xDimension32A);
    google.charts.setOnLoadCallback(xDimension32b);
    google.charts.setOnLoadCallback(xDimension32c);
    google.charts.setOnLoadCallback(xDimension33a);
    google.charts.setOnLoadCallback(xDimension33b);
    google.charts.setOnLoadCallback(xDimension34a);
    google.charts.setOnLoadCallback(xDimension34b);
    google.charts.setOnLoadCallback(xDimension34c);
    google.charts.setOnLoadCallback(xDimension35a);
    google.charts.setOnLoadCallback(xDimension35b);
    google.charts.setOnLoadCallback(xDimension35c);
    google.charts.setOnLoadCallback(xDimension4);
    
    google.charts.setOnLoadCallback(xItem);
</script>

<script src="<?php echo __BASE_URL__ . __MODULO_informes__ . 'js/informes_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
