<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seguros_class
 *
 * @author zinho
 */
class seguros_class {

    function CantDuplicados() {
        $conn=new config();
        $sql="select count(*),tm.* from qsservicios.temporal tm
group by concat(tm.ad1,tm.ad2,tm.ad4,tm.ad7,tm.ad21,tm.ad13,tm.ad18) having count(*)>1;
";
        $conn->consulta($sql);
    }
}
