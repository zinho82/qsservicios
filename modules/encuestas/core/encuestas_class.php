<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of encuestas_class
 *
 * @author Analista 01
 */
class encuestas_class {

    function CargarTipificacion($bd, $tbla, $nivel, $campoPertenece, $pertenece, $campoMostrar, $CampoMostrarID) {
        $conn = new config();
        $opciones = "<option value='-1' selected=''>Seleccione una Opcion</option>";
        echo $sql = "select $CampoMostrarID as id,$campoMostrar as texto from $bd.$tbla where $campoPertenece=$pertenece";
        $res = mysql_query($sql, $conn->conectar());
        while ($opc = mysql_fetch_array($res)) {
            $opciones .= "<option value=" . $opc['id'] . ">" . $opc['texto'] . "</option>";
        }
        echo $opciones;
    }

    function BuscarAgenda($usuario) {
        $conn = new config();
         $sql = "select * from " . $_SESSION['campana']['bd'] . "." . $_SESSION['campana']['tabla'] . " where id_acceso=" . $_SESSION['usuario']['id'] . " and estado in (14,18) and cod_carga='".$_SESSION['campana']['codcarga']."'";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($rs = mysql_fetch_assoc($res)) {
            $tabla .= "<tr>"
                    . "<td>".$rs['cod_carga']."</td>"
                    . "<td>".$rs['Cliente']."</td>"
                    . "<td>".$rs['fec_postergada']."</td>"
                    . "<td><a href='" . __BASE_URL__ . "modules/encuestas/view/Enc_hc_emp.php?id_encuesta=" . $rs['id_encuesta'] . "&id_formato=12&estado=2' ><i class='fa fa-search'></i></a></td>"
                    . "</tr>";
        }
        return $tabla;
    }

}
