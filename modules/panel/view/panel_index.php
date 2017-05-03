<?php
require_once '../../config/superior.php';
$conn = new config();
if (!$_POST['mes']) {
    $mes = date('m');
} else {
    $mes = $_POST['mes'];
}
?>

<div class="wrapper">

    <div class="col-lg-12">
        <div class="col-lg-2">
            <?php require_once 'sidebarAdmin.php'; ?>
        </div>
        <div class="col-lg-10">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <form id="formMes" name="formMes" method="post">
                            <select class="form-control" name="mes" id="mes" onchange="this.form.submit()">
                                <option value="%" selected="">Seleecione un mes</option>
                                <?php
                                for ($i = 1; $i < 13; $i++) {
                                    echo "<option value=$i>" . $conn->MesEntero($i) . "</option>";
                                }
                                ?>

                            </select>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $sql = "select count(*) from enc_mplaza_cali.cliente_dato cd where month(cd.fencuesta)=$mes and estado=21 ";
                                        $sql1 = "select count(*) from qsschile_qs_encuestas.qs_encuestascli_sodimac_emp cd where month(cd.fec_termino)=$mes and  (cd.status1_llamada='7' or cd.status2_llamada='7' or cd.status3_llamada='7' or cd.status4_llamada='7' or cd.status5_llamada='7')";
                                        $res = mysql_query($sql, $conn->conectar());
                                        $res1 = mysql_query($sql1, $conn->conectar());
                                        $res = mysql_query($sql, $conn->conectar());
                                        echo number_format(mysql_result($res, 0) + mysql_result($res1, 0), 0, ',', '.');
                                        ?>

                                    </div>
                                    <div>Encuestas Contestadas</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo __BASE_URL__ . __MODULO_PANEL__ ?>view/EncuestasCont.php?m=<?php echo $mes ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--  <div class="col-lg-3 col-md-6">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-comments fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">26</div>
                                      <div>Encuestas x ejecutivo</div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">
                                  <span class="pull-left">Detalles</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-comments fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">26</div>
                                      <div>Encuestas Realizadas</div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">
                                  <span class="pull-left">Detalles</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>-->
            </div>
            <div class="row">
                 <div class="panel panel-primary">
                  <div class="panel-heading">Avances Sistema</div>
                  <div class="panel-body">
                      <div id="gantt"></div>
                  </div>
              </div> 
              </div>
        </div>

    </div>


</div>
<script src="<?php echo __BASE_URL__ . __MODULO_PANEL__ . 'js/panel_js.js'; ?>" ></script>
 <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
          <?php
          $conn=new config();
          $sql="select 
*, datediff(ftermino,finicio) as diasdura 
,(select count(*) from gantt ga where ga.tareaanterior=g.idgantt) as subt
,(select count(*) from gantt ga where ga.tareaanterior=g.idgantt and ga.estado=1) as subtter
from gantt g ";
          $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
          while($ga=mysql_fetch_assoc($res)){
              $finicio= explode("-", $ga['finicio']);
              $ftermino= explode("-", $ga['ftermino']);
              $porcentajeTermino=$ga['subtter']/$ga['subt']*100;
             echo "['".$ga['idgantt']."','".$ga['tarea']."',new Date(".$finicio[0].",".($finicio[1]-1).",".$finicio[2]."),new Date(".$ftermino[0].",".($ftermino[1]-1).",".$ftermino[2]."),daysToMilliseconds(".$ga['diasdura']."),$porcentajeTermino,'".$ga['tareaanterior']."'],";
          }
          
          ?>
     
      ]);

      var options = {
         height: data.getNumberOfRows() * 65,
         gantt: {
            criticalPathEnabled: true,
            criticalPathStyle: {
              stroke: '#58554C',
              strokeWidth: 5
            },
            arrow: {
              angle: 45,
              width: 5,
              color: '#CBCE3F',
              radius: 0
            },
            innerGridHorizLine: {
            stroke: '#56A6BF',
            strokeWidth: 2
          },
          innerGridTrack: {fill: '#58554C'},
          innerGridDarkTrack: {fill: '#fff'}
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('gantt'));

      chart.draw(data, options);
    }
  </script>
<?php require_once '../../config/footer.php'; ?>
