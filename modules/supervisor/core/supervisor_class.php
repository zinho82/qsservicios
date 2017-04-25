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
         $sql = "select count(*) as cant,emp.cod_carga,emp.id_acceso  from " . $_SESSION['campana']['bd'] . ".$tabla  emp group by emp.cod_carga,emp.id_acceso order by emp.cod_carga desc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($tbl = mysql_fetch_assoc($res)) {
            $TblDatos .= "<tr>"
                    . "<td>" . $conn->BuscaDatos(__BASE_DATOS__, 'usuario', $tbl['id_acceso'], 'idusuario', 'usuario') . "</td>"
                    . "<td>" . $tbl['cod_carga'] . "</td>"
                    . "<td>" . $tbl['cant'] . "</td>"
                    . "<td>" . $conn->BuscaDatos(__BASE_DATOS__, 'campana', $campana, 'idcampana', 'nombre') . "</td>"
                    . "<td></td>"
                    . "</tr>";
        }
        return $TblDatos;
    }

}
