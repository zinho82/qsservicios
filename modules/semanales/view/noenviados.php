<?php require_once '../../config/superior.php'; ?>
<div class="panel panel-primary">
    <div class="panel-heading">Seguros</div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">Registros Anteriores No Enviados</div>
    <div class="panel-body">
        <table id="example" style="font-size: 10px;" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                   <th>Num_Expediente </th>
                    <th>Fecha Servicio</th>
                    <th>Poliza</th>
                    <th>Item</th>
                    <th>Cod Servicio</th>
                    <th>Vigencia Desde</th>
                    <th>Vigencia Hasta</th>
                    <th>Nombre Asegurado</th>
                    <th>Telefono 1</th>
                    <th>Telefono 2</th>
                    <th>Nombre Contacto</th>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año Fabricacion</th>
                    <th>Descrip_Prestacion</th>
                    <th>Provincia Prestacion</th>
                    <th>Comuna Prestacion</th>
                    <th>Comuna Destino</th>
                    <th>Num Servicio</th>
                    <th>Cod. Colectivo</th>
                    <th>Cod. Contrato</th>
                    <th>Cod. Prestacion</th>
                    <th>Prestacion</th>
                    <th>Costo UF</th>
                    <th>Producto</th>
                    <th>Clasificacion</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new config();
                
                $sql="update qsservicios.semanales_temporal stm
inner join qsservicios.historico hi on hi.numexpediente=stm.expediente and stm.patente=hi.nummat
set stm.existe=1;";
                mysql_query($sql,$conn->conectar());
                        

                $sql = "select * from ".__BASE_DATOS__.".semanales_temporal stm where stm.existe is null"; 

                $res = mysql_query($sql, $conn->consulta($sql));
                while ($re = mysql_fetch_array($res)) {
                    echo "<tr>";
                    for ($i = 0; $i <= 25; $i++) {
                        echo "<td>" . $re[$i] . "</td>";
                    }
                     echo "<td>".$conn->BuscaDatos("config", $re[26], "idconfig", "texto")."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        ?>

    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SEMANALES__ . "js/semanales_js.js"; ?>"></script>
<?php require_once '../../config/footer.php'; ?>