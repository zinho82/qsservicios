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
        <?php require_once 'sidebarAdmin.php'; ?>
            <div class="col-lg-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <form id="formMes" name="formMes" method="post">
                            <select class="form-control" name="mes" id="mes" onchange="this.form.submit()">
                                <option value="%" selected="">Seleecione un mes</option>
                                <?php 
                                for($i=1;$i<13;$i++){
                                    echo "<option value=$i>".$conn->MesEntero($i)."</option>";
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
                                        echo number_format(mysql_result($res, 0)+mysql_result($res1, 0), 0, ',', '.');
                                        ?>

                                    </div>
                                    <div>Encuestas Contestadas</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo __BASE_URL__ . __MODULO_PANEL__ ?>view/EncuestasCont.php?m=<?php echo $mes?>">
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
        </div>

    </div>
<script src="<?php echo __BASE_URL__ . __MODULO_PANEL__ . 'js/panel_js.js'; ?>" ></script>
    <?php require_once '../../config/footer.php'; ?>
