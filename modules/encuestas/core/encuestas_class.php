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
     function CargarTipificacion($bd,$tbla,$nivel,$campoPertenece,$pertenece,$campoMostrar,$CampoMostrarID){
        $conn=new config();
        $opciones="<option value='-1' selected=''>Seleccione una Opcion</option>";
      echo    $sql="select $CampoMostrarID as id,$campoMostrar as texto from $bd.$tbla where $campoPertenece=$pertenece";
        $res=mysql_query($sql,$conn->conectar());
        while($opc=mysql_fetch_array($res)){
             $opciones.="<option value=".$opc['id'].">".$opc['texto']."</option>";
        }
        echo $opciones;
    }
}
