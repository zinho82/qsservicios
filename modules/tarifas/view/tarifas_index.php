<?php
require_once '../../config/superior.php';
$conn=new config();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Listado de Tarifas</div>
    <div class="panel-body">
        <table id="TablaTarifa" class="display" >
            <thead>
            <th>ID Prestacion</th>
            <th>ID Tipo</th>
            <th>Definicion Prestacion</th>
            <th>Usuario</th>
            <th>Fecha Actualizacion</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Version</th>
            <th>Producto</th>
            <th>IDTarifa</th>
            
            </thead>
            <tbody>
                <?php
                $sql="select * from ".__BASE_DATOS__.".tarifas";
                $res=mysql_query($sql,$conn->conectar());
                while($tarifas=mysql_fetch_array($res)){
                    echo "<tr>";
                    for($i=0;$i<10;$i++){
                        echo "<td>".$tarifas[$i]."</td>";
                        
                    }
                            echo  "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_TARIFAS__ . 'js/tarifas_js.js'; ?>" ></script>
<?php require_once '../../config/superior.php';?>