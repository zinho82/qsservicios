<?php
require_once '../../config/superior.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = new config();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Encuestas Homcenter Empresas</div>
    <table class="table">
        <tbody>
            <?php
            echo $sql = "select * from qsschile_qs_encuestas.qs_encuestascli_sodimac_emp  sm where sm.id_acceso=".$_SESSION['usuario']['ant']." and estado in (1,2) and id_encuesta!=0";
            $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            while ($enc = mysql_fetch_assoc($res)) {
                echo "<tr><td>" . $enc['cod_carga'] . "</td>"
                . "<td>" . $enc['id_encuesta'] . "</td>"
                        . "<td>" . $enc['rut'] . "</td>"
                . "<td>" . $enc['Cliente'] . "</td>"
                . "<td>" . $enc['estado'] . "</td>"
                . "<td><a href='" . __BASE_URL__ . "modules/homecenter/view/encuestador/EditarEncuestaSODI_EMP.php?id_encuesta=" . $enc['id_encuesta'] . "&id_formato=12&estado=2' target='_new'><i class='fa fa-search'></i></a></td>"
                . "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<?php require_once '../../config/superior.php'; ?>