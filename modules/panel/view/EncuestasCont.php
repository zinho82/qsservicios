<?php
require_once '../../config/superior.php';
$conn = new config();
$mes = $_GET['m'];
?>
<div class="wrapper">

    <div class="col-lg-12">
        <div class=" col-lg-2">
            <?php require_once 'sidebarAdmin.php'; ?>
        </div>
        <div class="col-lg-10">
            <div class="panel panel-primary">
                <div class="panel-heading">Encuestas Realizadas</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Campaña</th>
                                <th>Cargadas</th>
                                <th>Recorridas</th>
                                <th>Realizadas</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mall Plaza</td>
                                <td>
                                    <?php
                                     $sql = "select count(*) from qsschile_enc_mplaza_cali.cliente_dato cd where month(cd.fencuesta)=$mes ";
                                    $res = mysql_query($sql, $conn->conectar());
                                     echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?>
                                </td>
                                <td><?php
                                    $sql = "select count(*) from qsschile_enc_mplaza_cali.cliente_dato cd where month(cd.fencuesta)=$mes and estado=21";
                                    $res = mysql_query($sql, $conn->conectar());
                                    echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?></td>
                                <td>
                                    <?php
                                    $sql = "select count(*) from qsschile_enc_mplaza_cali.cliente_dato cd where month(cd.fencuesta)=$mes and estado=21";
                                    $res = mysql_query($sql, $conn->conectar());
                                    echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?>
                                </td>
                                <td><a href="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ ?>view/exportar.php"><i class="fa fa-search fa-2x"></i></a></td>
                            </tr>
                            <tr>
                                <td>Sodimac Empresa</td>
                                <td>
                                    <?php
                                    $sql = "select count(*) from qsschile_qs_encuestas.qs_encuestascli_sodimac_emp cd where month(cd.fec_termino)=$mes ";
                                    $res = mysql_query($sql, $conn->conectar());
                                    echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?>
                                </td>
                                <td><?php
                                    $sql = "select count(*) from qsschile_qs_encuestas.qs_encuestascli_sodimac_emp cd where month(cd.fec_termino)=$mes and estado!=''";
                                    $res = mysql_query($sql, $conn->conectar());
                                    echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?></td>
                                <td>
                                    <?php
                                    $sql = "select count(*) from qsschile_qs_encuestas.qs_encuestascli_sodimac_emp cd where month(cd.fec_termino)=$mes and  (cd.status1_llamada='7' or cd.status2_llamada='7' or cd.status3_llamada='7' or cd.status4_llamada='7' or cd.status5_llamada='7')";
                                    $res = mysql_query($sql, $conn->conectar());
                                    echo number_format(mysql_result($res, 0), 0, ',', '.');
                                    ?>
                                </td>
                                <td><a href="<?php echo __BASE_URL__ . __MODULO_Encuestas__ ?>view/exportar.php"><i class="fa fa-search fa-2x"></i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!--<center><img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logoQs.jpg" title="Qs servicios" width="1000"><br><br></center>-->
    <?php require_once '../../config/footer.php'; ?>
