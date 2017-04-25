<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supervisor_class
 *
 * @author Analista 01
 */
class supervisor_class {
    function ObtenerListaencuestas($campana,$codCarga){
        switch ($campana){
    case 4:$tabla ="cliente_dato";        break;
    case 7:$tabla="qs_encuestascli_sodimac_emp";        break;
}
        $conn=new config();
        echo $sql="select * from ".$_SESSION['campana']['bd'].".$tabla where cod_carga='$codCarga' group by id_acceso";
        return;
    }
}
