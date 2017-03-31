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

                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new config();
                $sql = "select * from qsservicios.temporal tm 
inner join qsservicios.tarifas tf on tf.id_prestacion=tm.ad19 
and tm.ad12=tf.pro
and trim(tm.ad23)!=trim(tf.monto)
group by tm.ad1";

                $res = mysql_query($sql, $conn->consulta($sql));
                while ($re = mysql_fetch_assoc($res)) {
                    echo "<tr>";
                    for ($i = 1; $i < 25; $i++) {
                        echo "<td>" . $re['ad' . $i] . "</td>";
                    }
                    echo "<td>".$re['monto']."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        ?>

    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ . "js/seguros_js.js"; ?>"></script>
<?php require_once '../../config/footer.php'; ?>