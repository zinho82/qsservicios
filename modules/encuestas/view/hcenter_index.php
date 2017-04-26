<?php
require_once '../../config/superior.php';
$conn = new config();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Encuestas Homcenter Empresas</div>
    <table class="table" id='ListaEncuestas'>
        <thead>
        <th>Cod_carga</th>
        <th>IDEncuesta</th>
        <th>Rut</th> 
        <th>Nombre</th>
        <th>Estado</th>
        <th>Ultima Llamada</th>
        <th></th>
        </thead>
        <tbody >
            <?php
               $conn->CargarCodCargaSession($_SESSION['usuario']['id']);
             $sql = "select * from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']."  sm where sm.id_acceso=" . $_SESSION['usuario']['id'] . " and (sm.estado!=30 and  sm.estado!=7) and id_encuesta!=0 and  sm.cod_carga='".$_SESSION['campana']['codcarga']."' and sm.num_post<6";
            $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            while ($enc = mysql_fetch_assoc($res)) {
                echo "<tr><td>" . $enc['cod_carga'] . "</td>"
                . "<td>" . $enc['id_encuesta'] . "</td>"
                . "<td>" . $enc['rut'] . "</td>"
                . "<td>" . $enc['Cliente'] . "</td>"
                . "<td>" . $conn->BuscaDatos($_SESSION['campana']['bd'], 'arbol', $enc['estado'], 'idarbol', 'texto') . "</td>"
                . "<td>" . $enc['fec_termino'] . "</td>"
                . "<td><a href='" . __BASE_URL__ . "modules/encuestas/view/Enc_hc_emp.php?id_encuesta=" . $enc['id_encuesta'] . "&id_formato=12&estado=2' ><i class='fa fa-search'></i></a></td>"
                . "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_Encuestas__ ?>js/hcenter_js.js"></script>
<?php require_once '../../config/footer.php'; ?>
