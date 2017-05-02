<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of panel_class
 *
 * @author Analista 01
 */
class panel_class {

    function Obtenerejecutivos($bd) {
        $conn = new config();
        $sql = "select * from usuario usr where usr.perfil in (10,12) and usr.estado=14";
        $res = mysql_query($sql, $conn->conectar());
        while ($users = mysql_fetch_array($res)) {
            echo "<tr><td class='info'>" . $users['nombre'] . ' ' . $users['app'] . "</td></tr>";
        }
    }

    function CampanasActivasTH($bd) {
        $conn = new config();
        $sql = "select ca.*,sp.nombre as sponsornom from $bd.campana ca "
                . " inner join $bd.sponsor sp on ca.sponsor=sp.idsponsor where ca.estado=14";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        //var_dump($cam = mysql_fetch_assoc($res));
        while ($cam = mysql_fetch_assoc($res)) {
            if (!$sponsor) {
                $sponsor = $cam['sponsornom'];
            }
            if (!$nomcam) {
                $nomcam = $cam['nombre'];
            }
            if ($nomcam != $cam['nombre']) {
                $nomcamp .= "<th>" . $nomcam . "</th>";
            } else {
                $nomcam = $cam['nombre'];
            }
            if ($sponsor == $cam['sponsornom']) {
                $cabecera = ' <tr>'
                        . '<th class="text-center info" rowspan="3" >Ejecutivo</th>'
                        . '<th colspan="' . ++$i . '" class="text-center">' . $sponsor . '</th>'
                        . '<th>Total</th>'
                        . '</tr>'
                        . '<tr>'
                        .$nomcam
                        . '</tr>';
            } else {
                $sponsor = $cam['sponsornom'];
            }
        }
        echo $cabecera;
    }
    function EncuestasTotalesMes() {
        $conn=new config();
        $sql="select * from ";
        
        
    }

}
