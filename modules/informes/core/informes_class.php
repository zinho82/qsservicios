<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of informes_class
 *
 * @author Analista 01
 */
class informes_class {
    function EncxMall($bd,$tbl,$condicion,$grupo) {
        $conn=new config();
          $sql="select mall, count(*) as Q
,(select count(*) from $bd.cliente_dato cd inner join $bd.cliente_respuestas cr on cr.cliente_idcliente=cd.idcliente where cd.mall=cda.mall and cr.sen1=26 group by cr.sen1)   as qneg
,(select count(*) from $bd.cliente_dato cd inner join $bd.cliente_respuestas cr on cr.cliente_idcliente=cd.idcliente where cd.mall=cda.mall and cr.sen1=25 group by cr.sen1)   as qpos
,(select count(*) from $bd.cliente_dato cd inner join $bd.cliente_respuestas cr on cr.cliente_idcliente=cd.idcliente where cd.mall=cda.mall and cr.sen1=27 group by cr.sen1)   as qneu
,(select count(*) from enc_mplaza_cali.cliente_dato cd inner join enc_mplaza_cali.cliente_respuestas cr on cr.cliente_idcliente=cd.idcliente where cd.mall=cda.mall   group by cd.mall)   as qto
from $bd.cliente_dato cda  where month(cda.fresp)=month(now()) and year(cda.fresp)=year(now()) group by cda.mall";
        $res=mysql_query($sql,$conn->conectar());
        while($mall=mysql_fetch_array($res)){
            echo "<tr>"
            . "<td class='warning'><strong>".utf8_encode($mall['mall'])."</strong></td>"
                    . "<td >".$mall['Q']."</td>"
                    . "<td>".$mall['qneg']."</td>"
                    . "<td>".$mall['qpos']."</td>"
                    . "<td>".$mall['qneu']."</td>"
                    . "<td class='info text-center'>".$mall['qto']."</td>"
            . "</tr>";
            
        }
        
    }
    function TotalEncuestasRalizadas($bd) {
        $conn=new config();
         $sql="select 
month(cr.fechaenc) as Mes
,(select count(*) from $bd.cliente_respuestas crs where crs.sen1=25 and month(crs.fechaenc)=month(cr.fechaenc)) as qpos
,(select count(*) from $bd.cliente_respuestas crs where crs.sen1=26 and month(crs.fechaenc)=month(cr.fechaenc)) as qneg
,(select count(*) from $bd.cliente_respuestas crs where crs.sen1=27 and month(crs.fechaenc)=month(cr.fechaenc)) as qneu
from $bd.cliente_respuestas cr
group by month(cr.fechaenc)";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
        while($mall=mysql_fetch_array($res)){
            echo "['".$conn->MesRecortado($mall['Mes']).'-'.date('y')."',-".$mall['qneg'].",".$mall['qneu'].",".$mall['qpos']."],";
            
        }
        
    }
}
