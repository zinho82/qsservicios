<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of semanales_class
 *
 * @author zinho
 */
class semanales_class {
    /******************
     * VARIABLES
     * 
     ****************/
//  private  $conn = new config();
    /**********************************************
     * CALCULOS
     * obtiene el resultado para el informe  semanal
     * segun el tipo de carga asignada
     * 
     *********************************************/
    function calculos($TipoCarga,$ValorMostrar,$Tabla){
        $conn=new config();
        $sql="select $ValorMostrar as dato from " . __BASE_DATOS__ . ".$Tabla stm where stm.clasif=$TipoCarga group by stm.producto";
        $res=mysql_query($sql,$conn->conectar());
        while ($r = mysql_fetch_assoc($res)) {
                    echo"<tr>"
                    . "<td>" . $r['producto'] . "</td>"
                    . "<td></td><td></td>"
                    . "<td>" . $r['cantidad'] . "</td><td>" . number_format($r['costouf'], 3, ',', '.') . "</td></tr>";
                }
        return;
    }
}
