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
         height: data.getNumberOfRows() *200,
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