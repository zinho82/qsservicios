<?php
require_once '../../config/superior.php';
$conn = new config();

?>
<div class="panel panel-primary">
    <div class="panel-heading">Encuestas Homcenter Empresas</div>
    <table class="table" id='ListaEncuestas'>
        <thead>
            <tr><th><button id="Agenda" type="button" class="btn btn-info">Mi Agenda</button></th></tr>
            <tr>
        <th>Cod_carga</th>
        <th>IDEncuesta</th>
        <th>Rut</th>  
        <th>Nombre</th>
        <th>Fono1</th>
        <th>Estado</th>
        <th>Ultima Llamada</th>
        <th></th></tr>
        </thead>
        <tbody >
            <?php 
               $conn->CargarCodCargaSession($_SESSION['usuario']['id']);
             $sql = "select * from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']."  sm where sm.id_acceso=" . $_SESSION['usuario']['id'] . "  and (sm.estado!=30 and  sm.estado!=7) and id_encuesta!=0 and  sm.cod_carga='".$_SESSION['campana']['codcarga']."' and datediff(date(now()),date(fec_termino))>0 and sm.num_post<6";
            $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            if( mysql_num_rows($res)==0){
                 $SQL="UPDATE ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']." set estado=33 where estado!=14 and estado!=18 and estado!=30 and id_acceso=" . $_SESSION['usuario']['id'] . " and estado!=7 and datediff(date(now()),date(fec_termino))>0 and cod_carga='".$_SESSION['campana']['codcarga']."'" ;
                mysql_query($SQL,$conn->conectar()) or die(mysql_error());
                 $sql = "select * from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']."  sm where sm.id_acceso=" . $_SESSION['usuario']['id'] . " and sm.estado=33 and id_encuesta!=0 and  sm.cod_carga='".$_SESSION['campana']['codcarga']."'  and sm.num_post<6";
                $resi = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            } else {
$resi = mysql_query($sql, $conn->conectar()) or die(mysql_error());                
}
            
            while ($enc = mysql_fetch_assoc($resi)) {
                echo "<tr><td>" . $enc['cod_carga'] . "</td>"
                . "<td>" . $enc['id_encuesta'] . "</td>"
                . "<td>" . $enc['rut'] . "</td>"
                . "<td>" . $enc['Cliente'] . "</td>"
                . "<td>" . $conn->BuscaDatos($_SESSION['campana']['bd'], 'arbol', $enc['estado'], 'idarbol', 'texto') . "</td>"
                        ."<td>".$enc['CELULAR_CONTACTO']."</td>"
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
