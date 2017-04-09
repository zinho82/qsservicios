<?php require_once '../../config/superior.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading">Seguros</div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">Diferencias de Tarifa</div>
    <div class="panel-body">
        <table id="example" style="font-size: 10px;" class="display col-lg-12" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Num_Expediente </th>
                    <th>Fecha OT</th>
                    <th>Hora OT</th>
                    <th>Orden Trab</th>
                    <th>Num Linea</th>
                    <th>Usuario OT</th>
                    <th>Rut Titular</th>
                    <th>Nombre Cliente</th>
                    <th>Telefono</th>
                    <th>Comuna</th>
                    <th>Ciudad Origen</th>
                    <th>Id_Producto</th>
                    <th>Definicion Producto</th>
                    <th>ID_Version</th>
                    <th>Definicion Version</th>
                    <th>Descrip_Prestacion</th>
                    <th>Pleno_Fallido</th>
                    <th>Descripcion Medio</th>
                    <th>Id_Prestacion</th>
                    <th>Definicion Prestacion</th>
                    <th>Numero Matricula</th>
                    <th>Fecha Prestacion</th>
                    <th>Tarifa Cobrada</th>
                    <th>Conductor</th>
                    <td>Tarifa Convenio</td>
                    <td>Diferencia</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new config();

//   cargando dif autos
                $sql = "select * from " . __BASE_DATOS__ . ".temporal tm 
inner join qsservicios2.tarifas tf on tf.id_prestacion=tm.idprest and tm.idproducto=tf.pro and trim(tm.tarifa)!=trim(tf.monto) and tf.version=tm.idversion and (tm.descmedio  like '%auto%reemplazo%' or tm.descmedio  like 'vdr%') group by tm.ordentrab ";

                $res = mysql_query($sql, $conn->consulta($sql)) or die(mysql_error());
                while ($re = mysql_fetch_array($res)) {
                    echo "<tr>";
                    for ($i = 0; $i < 24; $i++) {
                        echo "<td>" . $re[$i] . "</td>";
                        $sumauto += $re[22];
                        $summonto += $re['monto'];
                        $dif += $re['monto'] - $re[22];
                    }
                    echo "<td>" . $re['monto'] . "</td>";
                    echo "<td>" . number_format(($re['monto'] - $re[22]), 3) . "</td>";
                    echo "</tr>";
                }
                $sql = "select * from " . __BASE_DATOS__ . ".temporal tm 
inner join qsservicios2.tarifas tf on tf.id_prestacion=tm.idprest and tm.idproducto=tf.pro and trim(tm.tarifa)!=trim(tf.monto)   and (tm.descmedio not  like '%auto%reemplazo%' and  tm.descmedio  not like 'vdr%') group by tm.ordentrab ";

                $res = mysql_query($sql, $conn->consulta($sql)) or die(mysql_error());
                while ($re = mysql_fetch_array($res)) {
                    echo "<tr>";
                    for ($i = 0; $i < 24; $i++) {
                        echo "<td>" . $re[$i] . "</td>";
                        $sumnauto += $re[22];
                        $sumnmonto += $re['monto'];
                        $dif += $re['monto'] - $re[22];
                    }
                    echo "<td>" . $re['monto'] . "</td>";
                    echo "<td>" . number_format(($re['monto'] - $re[22]), 3) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
          <!--  <tfoot><th>Totales</th>
            <?php
            // for($i=1;$i<=21;$i++){
            //    echo "<th></th>";
            // }
            ?>
            <th><?php //echo number_format(($sumauto+$sumnauto),3) ?></th>
            <th></th>
            <th><?php //echo number_format(($summonto+$sumnmonto),3) ?></th>
            <th><?php //echo number_format(($dif),3) ?></th>
        </tfoot>-->
        </table>
        <?php
        ?>

    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ . "js/seguros_js.js"; ?>"></script>
<?php require_once '../../config/footer.php'; ?>