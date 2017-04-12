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
month(cda.fresp) as Mes
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 0 and 6  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qneg
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 9 and 10 and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qpos
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 7 and 8  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp)) as qneu
,sum(cda.nps) as npst
from enc_mplaza_cali.cliente_dato cda 
group by month(cda.fresp) ";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
        while($mall=mysql_fetch_array($res)){
        $npspt+=$mall['qpos'];
        $npsn+=$mall['qpneg'];
       $npst +=$mall['npst'];
            $qtott+=$mall['npst'];
            $neg+=$mall['qneg'];
            $neu+=$mall['qneu'];
            $pos+=$mall['qpos'];
            //$nps=(($mall['qpos']/$mall['npst'])-($mall['qpos']/$mall['npst']));
            $nps=(($mall['qpos']/$mall['npst'])-($mall['qneg']/$mall['npst']));
            $qtot=$mall['qneg']+$mall['qpos']+$mall['qneu']; 
            $npst=(($npspt/$npst)-($npsn/$npst));
            echo "['".$conn->MesRecortado($mall['Mes']).'-'.date('y')."',-".(($mall['qneg']/$qtot)*100).",".(($mall['qneu']/$qtot)*100).",".(($mall['qpos']/$qtot)*100).",".($nps*100)."],";
        }
        echo "['Acum',-".(($neg/$qtott)*100).",".(($neu/$qtott)*100).",".(($pos/$qtott)*100).",".($npst*100)."]";
    }
    function TotalencuestasxItem($bd) {
        $conn=new config();
          $sql="select cda.encuesta,count(*) as cant,(select count(*) from $bd.cliente_dato) from $bd.cliente_dato cda group by cda.encuesta";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
        while($mall=mysql_fetch_array($res)){
            
            echo "['".utf8_encode($mall['encuesta'])."',".$mall['cant']."],";
        }
       // echo "['Acum',-".(($neg/$qtott)*100).",".(($neu/$qtott)*100).",".(($pos/$qtott)*100).",".($npst*100)."]";
    }
    function TotalencuestasxDimension($bd,$SentidoID,$NomDimension,$nomSentido,$orden) {
        $conn=new config();
            $sql="select di.Area, count(*)as cant from $bd.cliente_dato cda
inner join $bd.cliente_respuestas cr on cr.cliente_idcliente=cda.idcliente
inner join $bd.areas di on di.CodArea=cr.$NomDimension
    inner join ".__BASE_DATOS__.".config con on con.idconfig=cr.$nomSentido and cr.$nomSentido=$SentidoID
 group by cr.$nomSentido,cr.$NomDimension order by count(*) $orden ";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
        return mysql_fetch_array($res);
      /*  while($mall=mysql_fetch_array($res)){
            
            echo "['".utf8_encode($mall['Area'])."',".$mall['cant']."],";
        }*/
       // echo "['Acum',-".(($neg/$qtott)*100).",".(($neu/$qtott)*100).",".(($pos/$qtott)*100).",".($npst*100)."]";
    }
    function TotalencuestasxDimensionOrden($bd,$SentidoID,$orden) {
         $arr1=$this->TotalencuestasxDimension($bd, $SentidoID, "dim1", "sen1" ,$orden);
         $arr2=$this->TotalencuestasxDimension($bd, $SentidoID, "dim2", "sen2" ,$orden);
         $arr3=$this->TotalencuestasxDimension($bd, $SentidoID, "dim3", "sen3" ,$orden);
         $arr= array_merge($arr1,$arr2,$arr3);
         print_r($arr);
       
    }
}
