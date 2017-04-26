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

    function ObtenerListaencuestas($campana, $codCarga) {
        switch ($campana) {
            case 4:$tabla = "cliente_dato";
                break;
            case 7:$tabla = "qs_encuestascli_sodimac_emp";
                break;
            case 8:$tabla = "qs_encuestascli_sodimac_emp";
                break;
        }
        $conn = new config();
        //$sql = "select count(*) as cant,emp.cod_carga,emp.id_acceso,(select count(*) from " . $_SESSION['campana']['bd'] . ".$tabla em where em.estado!=1 and em.cod_carga=emp.cod_carga and em.id_acceso=emp.id_acceso) as recorrido  from " . $_SESSION['campana']['bd'] . ".$tabla  emp group by emp.cod_carga,emp.id_acceso order by emp.cod_carga desc";
        $sql = "select count(*) as cant,emp.cod_carga,emp.id_acceso  from " . $_SESSION['campana']['bd'] . ".$tabla  emp group by emp.cod_carga,emp.id_acceso order by emp.cod_carga desc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($tbl = mysql_fetch_assoc($res)) {
            $TblDatos .= "<tr>"
                    . "<td>" . $conn->BuscaDatos(__BASE_DATOS__, 'usuario', $tbl['id_acceso'], 'idusuario', 'usuario')
                    . "</td>"
                    . "<td>"
                    . $tbl['cod_carga']
                    . "</td>"
                    . "<td>" . $tbl['cant'] . "</td>"
                    . "<td>" . $tbl['recorrido'] . "</td>"
                    . "<td>" . $conn->BuscaDatos(__BASE_DATOS__, 'campana', $campana, 'idcampana', 'nombre') . "</td>"
                    . "<td>"
                    . "<button type='button' onclick='window.open(".'"cambiarReg.php?c='.$campana.'&id='.$tbl['id_acceso'].'&cod='.$tbl['cod_carga'].'&reg='.$tbl['cant'].'&acc=asignar","_self"'.")'  class='btn btn-success' ><i title='Asignar' class='fa fa-plus-circle fa-1x'></i></button>"
                    . "<button type='button' class='btn btn-danger' id='Qui'><i title='Quitar' onclick='window.open(".'"cambiarReg.php?c='.$campana.'&id='.$tbl['id_acceso'].'&cod='.$tbl['cod_carga'].'&reg='.$tbl['cant'].'&acc=Quitar","_self"'.")'   class='fa fa-minus-circle fa-1x'></i></button>"
                    . "</td>"
                    . "</tr>";
        }
        return $TblDatos;
    }

    function ListaEjecutivos() {
        $conn = new config();
        if ($_SESSION['usuario']['perfil'] > 9) {

            $sql = "select * from " . __BASE_DATOS__ . ".usuario where perfil>9 and estado=14 order by usuario asc";
        } else {
            $sql = "select * from " . __BASE_DATOS__ . ".usuario where estado=14 order by usuario asc";
        }
        $res = mysql_query($sql, $conn->conectar());
        while ($opc = mysql_fetch_assoc($res)) {
            $opcs .= "<option value='" . $opc['idusuario'] . "'>" . $opc['usuario'] . "</option>";
        }
        return $opcs;
    }

}
