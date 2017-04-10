<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mallplaza_class
 *
 * @author Analista 01
 */
class mallplaza_class {

    public function CargarNPS($fecha, $bd, $tbl) {
        $conn = new config();
         $sql = "select * from $bd.$tbl where estado is null and  month(numcarga)=" . date('m');
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($np = mysql_fetch_array($res)) {
            echo "<tr>"
            . "<td>".$np['rut']."</td>"
            . "<td>".utf8_encode($np['nombre'].' '.$np['app'])."</td>"
            . "<td>".utf8_encode($np['mall'])."</td>"
                    . "<td><a href='".__BASE_URL__.__MODULO_MALLPLAZA__."view/calificar.php?id=".$np['idcliente']."&nom=".$np['nombre']."'><i class='fa fa-search fa-2x'></i></a></td>"
            . "</tr>";
        }
    }
    public function CargaPersona($rut) {
        $conn=new config();
         $sql="select * from ".$_SESSION['campana']['bd'].".cliente_dato where idcliente='$rut'";
        $res=mysql_query($sql,$conn->conectar());
        return mysql_fetch_assoc($res);
    }
    function CargaDimemsion() {
        $conn=new config();
      echo "<option values='-1' selected=''>Seleccione una dimension</option>";
        $sql="select * from ".$_SESSION['campana']['bd'].".areas";
        $res=mysql_query($sql,$conn->conectar());
        while($cau=mysql_fetch_array($res)){
            echo "<option value=".$cau['CodArea'].">".utf8_encode($cau['Area'])."</option>";
        }
    }
    function CargaClasificacion() {
        $conn=new config();
      echo "<option values='-1' selected=''>Seleccione una Clasificacion</option>";
        $sql="select * from ".__BASE_DATOS__.".config where pertenece=24";
        $res=mysql_query($sql,$conn->conectar());
        while($cau=mysql_fetch_array($res)){
            echo "<option value=".$cau['idconfig'].">".$cau['texto']."</option>";
        }
                
        
    }
}
