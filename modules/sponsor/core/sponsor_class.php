<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sponsor_class
 *
 * @author Analista 01
 */
class sponsor_class {

    function GetEmpresa() {
        $conn = new config();
        echo $sql = "select * from " . __BASE_DATOS__.".sponsor order by nombre asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($spon = mysql_fetch_assoc($res)) {
          echo "<tr>"
                    . "<td>" . $spon['nombre'] . "</td>"
                    . "</tr>"; 
        }
        return $tbl;
    }

}
