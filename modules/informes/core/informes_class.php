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

    function DetractoresTbl($mall) {
        $conn = new config();
//        #BORRANDO TBL TEMPORAL
        $sq1 = "drop temporary table IF EXISTS enc_mplaza_cali.tmp1 ";
#CREANDO TBL TEMPORAL
        $sql2 = "create temporary table enc_mplaza_cali.tmp1 (total int, area text,mes int,sentido int);";
#INSERTANDO CAMPOS SEN1
        $dim1 = "insert into enc_mplaza_cali.tmp1
select count(*),ar.Area,month(cr.fechaenc) as Mes,cr.sen1 from enc_mplaza_cali.cliente_respuestas cr 
inner join enc_mplaza_cali.areas ar on ar.CodArea=cr.dim1 and cr.sen1=26
group by cr.fechaenc,cr.dim1
order by count(*) desc";
#insertando campos SEN 2
        $dim2 = "insert into enc_mplaza_cali.tmp1
select count(*),ar.Area,month(cr.fechaenc) as Mes,sen2 from enc_mplaza_cali.cliente_respuestas cr 
inner join enc_mplaza_cali.areas ar on ar.CodArea=cr.dim2 and cr.sen2=26
group by cr.fechaenc,cr.dim2
order by count(*) desc";
#Insertando sentido 3
        $dim3 = "
insert into enc_mplaza_cali.tmp1
select count(*),ar.Area,month(cr.fechaenc) as Mes,sen3 from enc_mplaza_cali.cliente_respuestas cr 
inner join enc_mplaza_cali.areas ar on ar.CodArea=cr.dim3 and cr.sen3=26
group by cr.fechaenc,cr.dim3
order by count(*) desc";
        $sql4 = "select sum(total) as total,area
from enc_mplaza_cali.tmp1  
group by area,mes
order by area asc;";
        ;
        echo "['test',1]";
        mysql_query($sql1, $conn->conectar());
        mysql_query($sql2, $conn->conectar());
        mysql_query($dim1, $conn->conectar());
        mysql_query($dim2, $conn->conectar());
        mysql_query($dim3, $conn->conectar());
        $res = mysql_query($sql4, $conn->conectar());
        while ($tabla = mysql_fetch_assoc($res)) {

            echo "['" . $tabla['area'] . "'],";
        }

        return;
    }

    function xGeneroxMal($mall) {
        $conn = new config();

        $sql = "select count(*) as cant ,cd.sexo from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.mall='$mall' group by cd.sexo";
        $sql1 = "select count(*) as cant ,cd.sexo from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.mall='$mall' ";
        $ress = mysql_query($sql1, $conn->conectar());
        $tsexo = mysql_fetch_assoc($ress);
        $res = mysql_query($sql, $conn->conectar());
        while ($malls = mysql_fetch_assoc($res)) {
            if ($malls['sexo'] == "") {
                $sexo = "N/E";
            } else {
                $sexo = $malls['sexo'];
            }
            echo "['" . $sexo . "'," . (($malls['cant'] / $tsexo['cant']) * 100) . "],";
        }
    }

    function ListaMalls() {
        $conn = new config();
        $m = "<option value='-1' selected=''>Selecione un mall</option>";
        echo $sql = "select mall from " . $_SESSION['campana']['bd'] . ".cliente_dato group by mall order by mall asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($malls = mysql_fetch_assoc($res)) {
            $m .= "<option >" . utf8_encode($malls['mall']) . "</option>";
        }
        return $m;
    }

    function EncxMall($bd, $tbl, $condicion, $grupo) {
        $conn = new config();
        echo "<tbody>";
        $sql = "select  mall,count(*) as Q,
(select count(*) from $bd.cliente_dato cdne where  cdne.nps between 0 and 6 and  cdne.mall=cd.mall) as qneg
,(select count(*) from $bd.cliente_dato cdne where  cdne.nps between 9 and 10 and  cdne.mall=cd.mall) as qpos
,(select count(*) from $bd.cliente_dato cdne where  cdne.nps between 7 and 8 and  cdne.mall=cd.mall) as qneu
from $bd.cliente_dato cd group by mall";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mall = mysql_fetch_array($res)) {
            echo "<tr>"
            . "<td class='warning'><strong>" . utf8_encode($mall['mall']) . "</strong></td>"
            . "<td >" . $mall['Q'] . "</td>"
            . "<td>" . $mall['qneg'] . "</td>"
            . "<td>" . $mall['qpos'] . "</td>"
            . "<td>" . $mall['qneu'] . "</td>"
            . "<td class='info text-center'>" . ($mall['qneg'] + $mall['qpos'] + $mall['qneu']) . "</td>"
            . "</tr>";
            $tQ += $mall['Q'];
            $tQN += $mall['qneg'];
            $tQP += $mall['qpos'];
            $tQNE += $mall['qneu'];
        }
        echo "</tbody>
              <tfoot class='text-center'><tr class=' danger text-center'><th>Total</th><th>$tQ</th><th>$tQN</th><th>$tQP</th><th>$tQNE</th><th>$tQ</th></tr></tfoot>";
    }

    function TotalEncuestasRalizadas($bd) {
        $conn = new config();
        $sql = "select 
month(cda.fresp) as Mes
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 0 and 6  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qneg
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 9 and 10 and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qpos
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 7 and 8  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp)) as qneu
,sum(cda.nps) as npst
from " . $_SESSION['campana']['bd'] . ".cliente_dato cda  
group by month(cda.fresp) ";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mall = mysql_fetch_array($res)) {
            $npspt += $mall['qpos'];
            $npsn += $mall['qpneg'];
            $npst += $mall['npst'];
            $qtott += $mall['npst'];
            $neg += $mall['qneg'];
            $neu += $mall['qneu'];
            $pos += $mall['qpos'];
            $nps = (($mall['qpos'] / $mall['npst']) - ($mall['qne'] / $mall['npst']));
            $qtot = $mall['qneg'] + $mall['qneu'] + $mall['qpos'];
            $qtotalAc += $qtot;
            $npsAc = (($npspt / $qtott) - ($npsn / $qtott)) * 100;
            echo "['" . $conn->MesRecortado($mall['Mes']) . '-' . date('y') . "',-" . (($mall['qneg'] / $qtot) * 100) . "," . (($mall['qneu'] / $qtot) * 100) . "," . (($mall['qpos'] / $qtot) * 100) . "," . ($nps * 100 ) . "],";
        }
        echo "['Acum',-" . (($neg / $qtott) * 100) . "," . (($neu / $qtott) * 100) . "," . (($pos / $qtott) * 100) . "," . ($npsAc) . "]";
    }

    function TotalEncuestasRalizadasxMall($bd, $mall) {
        $conn = new config();
        $sql = "select 
month(cda.fresp) as Mes
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 0 and 6  and month(cd.fresp)=month(cda.fresp)  and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp) ) as qneg
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 9 and 10 and month(cd.fresp)=month(cda.fresp)  and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp) ) as qpos
,(select sum(cd.nps) from " . $_SESSION['campana']['bd'] . ".cliente_dato cd where cd.nps between 7 and 8  and month(cd.fresp)=month(cda.fresp) and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp)) as qneu
,sum(cda.nps) as npst
from " . $_SESSION['campana']['bd'] . ".cliente_dato cda  
where mall='$mall'
group by month(cda.fresp) ";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mall = mysql_fetch_array($res)) {
            $npspt += $mall['qpos'];
            $npsn += $mall['qpneg'];
            $npst += $mall['npst'];
            $qtott += $mall['npst'];
            $neg += $mall['qneg'];
            $neu += $mall['qneu'];
            $pos += $mall['qpos'];
            $nps = (($mall['qpos'] / $mall['npst']) - ($mall['qne'] / $mall['npst']));
            $qtot = $mall['qneg'] + $mall['qneu'] + $mall['qpos'];
            $qtotalAc += $qtot;
            $npsAc = (($npspt / $qtott) - ($npsn / $qtott)) * 100;
            echo "['" . $conn->MesRecortado($mall['Mes']) . '-' . date('y') . "',-" . (($mall['qneg'] / $qtot) * 100) . "," . (($mall['qneu'] / $qtot) * 100) . "," . (($mall['qpos'] / $qtot) * 100) . "," . ($nps * 100) . "],";
        }
        echo "['Acum',-" . (($neg / $qtotalAc) * 100) . "," . (($neu / $qtotalAc) * 100) . "," . (($pos / $qtotalAc) * 100) . ",$npsAc]";
    }

    function TotalencuestasxItem($bd) {
        $conn = new config();
        $sql = "select cda.encuesta,count(*) as cant,(select count(*) from $bd.cliente_dato) from $bd.cliente_dato cda group by cda.encuesta";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mall = mysql_fetch_array($res)) {

            echo "['" . utf8_encode($mall['encuesta']) . "'," . $mall['cant'] . "],";
        }
    }

    function TotalencuestasxItemxMall($bd, $mall) {
        $conn = new config();
        $sql = "select cda.encuesta,count(*) as cant from $bd.cliente_dato cda where cda.mall='$mall' group by cda.encuesta";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mall = mysql_fetch_array($res)) {

            echo "['" . utf8_encode($mall['encuesta']) . "'," . $mall['cant'] . "],";
        }
    }

    function TotalencuestasxDimension($bd, $SentidoID, $NomDimension, $nomSentido, $orden) {
        $conn = new config();

        $sql1 = "drop temporary table IF EXISTS $bd.tmp1 ;";
        $sql2 = "create temporary table $bd.tmp1 (total int, dim int);";
        $sql3 = "insert into $bd.tmp1 SELECT COUNT(dim1), dim1
	FROM $bd.cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=$SentidoID
	GROUP BY cr.dim1;";

        $sql4 = "insert into $bd.tmp1 SELECT COUNT(dim2), dim2
	FROM " . $_SESSION['campana']['bd'] . ".cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=$SentidoID
	GROUP BY cr.dim2;";

        $sql5 = "insert into $bd.tmp1 SELECT COUNT(dim3), dim3
	FROM " . $_SESSION['campana']['bd'] . ".cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=2$SentidoID5
	GROUP BY cr.dim3;";

        $sql6 = "select ar.Area,sum(tmp1.total) as cant from $bd.tmp1
    inner join $bd.areas ar on ar.CodArea=tmp1.dim group by tmp1.dim order by sum(tmp1.total) desc  ";
        mysql_query($sql1, $conn->conectar()) or die(mysql_error());
        mysql_query($sql2, $conn->conectar()) or die(mysql_error());
        mysql_query($sql3, $conn->conectar()) or die(mysql_error());
        mysql_query($sql4, $conn->conectar()) or die(mysql_error());
        mysql_query($sql5, $conn->conectar()) or die(mysql_error());
        $res = mysql_query($sql6, $conn->conectar()) or die(mysql_error());
        while ($row = mysql_fetch_assoc($res)) {

            echo "['" . utf8_encode($row['Area']) . "'," . $row['cant'] . '],';
        }
    }

    function TotalencuestasxDimensionxMall($bd, $SentidoID, $NomDimension, $nomSentido, $orden, $mall) {
        $conn = new config();
        $sql1 = "drop temporary table IF EXISTS " . $_SESSION['campana']['bd'] . ".tmp1 ;";
        $sql2 = "create temporary table " . $_SESSION['campana']['bd'] . ".tmp1 (total int, dim int);";
        $sql3 = "insert into " . $_SESSION['campana']['bd'] . ".tmp1 SELECT COUNT(dim1), dim1
	FROM " . $_SESSION['campana']['bd'] . ".cliente_respuestas cr 
	inner join " . $_SESSION['campana']['bd'] . ".cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen1=$SentidoID  and cd.mall='$mall'
	GROUP BY cr.dim1;";

        $sql4 = "insert into " . $_SESSION['campana']['bd'] . ".tmp1 SELECT COUNT(dim2), dim2
	FROM " . $_SESSION['campana']['bd'] . ".cliente_respuestas cr 
        inner join " . $_SESSION['campana']['bd'] . ".cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen2=$SentidoID  and cd.mall='$mall'
	GROUP BY cr.dim2;";

        $sql5 = "insert into " . $_SESSION['campana']['bd'] . ".tmp1 SELECT COUNT(dim3), dim3
	FROM " . $_SESSION['campana']['bd'] . ".cliente_respuestas cr 
        inner join " . $_SESSION['campana']['bd'] . ".cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen3=$SentidoID and cd.mall='$mall'
	GROUP BY cr.dim3;";

        $sql6 = "select ar.Area,sum(tmp1.total) as cant from " . $_SESSION['campana']['bd'] . ".tmp1
    inner join " . $bd . ".areas ar on ar.CodArea=tmp1.dim group by tmp1.dim order by sum(tmp1.total) desc  ";
        mysql_query($sql1, $conn->conectar()) or die(mysql_error());
        mysql_query($sql2, $conn->conectar()) or die(mysql_error());
        mysql_query($sql3, $conn->conectar()) or die(mysql_error());
        mysql_query($sql4, $conn->conectar()) or die(mysql_error());
        mysql_query($sql5, $conn->conectar()) or die(mysql_error());
        $res = mysql_query($sql6, $conn->conectar()) or die(mysql_error());
        while ($row = mysql_fetch_array($res)) {

            echo "['" . utf8_encode($row['Area']) . "'," . $row['cant'] . '],';
        }
    }

    /*     * ************************************
     * 
     * HOMECENTER
     * Encuestas Contestadas
     * 
     * ************************************ */

    function TipoEmpresaChart($campana,$mes,$ano) {
        $conn = new config();
        $conn->CargaTablaSession($campana);
        $conn->CargaCampanaSession($campana);
         $sql = "select count(*) as cant,em.TIPO
from " . $_SESSION['campana']['bd'] . "." . $_SESSION['campana']['tabla'] . " em 
where year(em.fec_termino)=year(now()) 
group by em.TIPO";
        $res = mysql_query($sql, $conn->conectar());
        while ($tabla = mysql_fetch_assoc($res)) {
             $enc.="['" . utf8_encode($tabla['TIPO']) . "'," . $tabla['cant'] . "],";
        }
        return $enc;
    }

    function TblEncuestas($campana,$mes,$ano) {
        $conn = new config();
        $conn->CargaTablaSession($campana);
        $conn->CargaCampanaSession($campana);
        $sql = "select count(*) as cant,month(em.fec_termino) as mes,(select count(*) from  " . $_SESSION['campana']['bd'] . "." . $_SESSION['campana']['tabla'] . " e where month(e.fec_termino)=month(em.fec_termino) and e.estado=7 ) as contes from " . $_SESSION['campana']['bd'] . "." . $_SESSION['campana']['tabla'] . " em where year(em.fec_termino)=$ano and month(fec_termino)=4 group by month(em.fec_termino)";
        $res = mysql_query($sql, $conn->conectar()) ;
        while ($cam = mysql_fetch_assoc($res)) {
            $tabla .= "<tr>"
                    . "<td>" . $conn->MesRecortado($cam['mes']) . "</td>"
                    . "<td>" . $cam['cant'] . "</td>"
                    . "<td>" . $cam['contes'] . "</td>"
                    . "</tr>";
        }
        return $tabla;
    }
    function TotalPregunta($campana,$pregunta,$mes,$ano) {
        $conn=new config();
        $conn->CargaTablaSession($campana);
        $conn->CargaCampanaSession($campana);
         $sql1="select count(*) as cant,er.$pregunta
from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']." em 
inner join ".$_SESSION['campana']['bd'].".qs_encuesta_sodimac_emp er on er.id_encuesta=em.id_encuesta
where year(em.fec_termino)=$ano and month(fec_termino)=$mes and $pregunta!=''
";
    $rr=mysql_query($sql1,$conn->conectar());
$total=mysql_result($rr,0);
           $sql="select count(*) as cant,er.$pregunta

from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']." em 
inner join ".$_SESSION['campana']['bd'].".qs_encuesta_sodimac_emp er on er.id_encuesta=em.id_encuesta
where year(em.fec_termino)=year(now()) and month(fec_termino)=$mes and $pregunta!=''
group by er.$pregunta order by count(*) desc";
        $res=mysql_query($sql,$conn->conectar());
        while($row=mysql_fetch_assoc($res)){
             echo "['" . utf8_encode($row[$pregunta]) . "'," . ($row['cant']/$total)*100 . '],';
        }
    }

}
