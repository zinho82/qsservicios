<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of campana_class
 *
 * @author Analista 01
 */
class campana_class {
   function GetCampana() {
        $conn = new config();
         $sql = "select * from " . __BASE_DATOS__.".campana order by nombre asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($spon = mysql_fetch_assoc($res)) {
          echo "<tr>"
                    . "<td>" . $spon['nombre'] . "</td>"
                  . "<td>" . $spon['codigo'] . "</td>"
                  . "<td>" . $spon['finicio'] . "</td>"
                  . "<td>" . $spon['ftermino'] . "</td>"
                  . "<td>" . $conn->BuscaDatos("sponsor",$spon['sponsor']  , "idsponsor", "nombre"). "</td>"
                   . "<td>" . $conn->BuscaDatos("config",$spon['estado']  , "idconfig", "texto"). "</td>"
                    . "</tr>"; 
        }
        return $tbl;
    }
}
