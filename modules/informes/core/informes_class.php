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
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 0 and 6  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qneg
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 9 and 10 and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp) ) as qpos
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 7 and 8  and month(cd.fresp)=month(cda.fresp) and year(cd.fresp)=year(cda.fresp)) as qneu
,sum(cda.nps) as npst
from enc_mplaza_cali.cliente_dato cda  
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
//$nps=(($mall['qpos']/$mall['npst'])-($mall['qpos']/$mall['npst']));
            $nps = (($mall['qpos'] / $mall['npst']) - ($mall['qneg'] / $mall['npst'])) / 100;
            $qtot = $mall['qneg'] + $mall['qpos'] + $mall['qneu'];
            $npsto = (($npspt / $npst) - ($npsn / $npst));
            echo "['" . $conn->MesRecortado($mall['Mes']) . '-' . date('y') . "',-" . (($mall['qneg'] / $qtot) * 100) . "," . (($mall['qneu'] / $qtot) * 100) . "," . (($mall['qpos'] / $qtot) * 100) . "," . (0 ) . "],";
        }
        echo "['Acum',-" . (($neg / $qtott) * 100) . "," . (($neu / $qtott) * 100) . "," . (($pos / $qtott) * 100) . "," . (0) . "]";
    }

    function TotalEncuestasRalizadasxMall($bd, $mall) {
        $conn = new config();
        $sql = "select 
month(cda.fresp) as Mes
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 0 and 6  and month(cd.fresp)=month(cda.fresp)  and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp) ) as qneg
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 9 and 10 and month(cd.fresp)=month(cda.fresp)  and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp) ) as qpos
,(select sum(cd.nps) from enc_mplaza_cali.cliente_dato cd where cd.nps between 7 and 8  and month(cd.fresp)=month(cda.fresp) and cd.mall=cda.mall and year(cd.fresp)=year(cda.fresp)) as qneu
,sum(cda.nps) as npst
from enc_mplaza_cali.cliente_dato cda  
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
//            $npsto = (($npspt / $npst) - ($npsn / $npst));
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

        $sql1 = "drop temporary table IF EXISTS tmp1 ;";
        $sql2 = "create temporary table enc_mplaza_cali.tmp1 (total int, dim int);";
        $sql3 = "insert into tmp1 SELECT COUNT(dim1), dim1
	FROM enc_mplaza_cali.cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=$SentidoID
	GROUP BY cr.dim1;";

        $sql4 = "insert into enc_mplaza_cali.tmp1 SELECT COUNT(dim2), dim2
	FROM enc_mplaza_cali.cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=$SentidoID
	GROUP BY cr.dim2;";

        $sql5 = "insert into enc_mplaza_cali.tmp1 SELECT COUNT(dim3), dim3
	FROM enc_mplaza_cali.cliente_respuestas cr 
	WHERE sen1=$SentidoID and sen2=$SentidoID and sen3=2$SentidoID5
	GROUP BY cr.dim3;";

        $sql6 = "select ar.Area,sum(tmp1.total) as cant from enc_mplaza_cali.tmp1
    inner join " . $bd . ".areas ar on ar.CodArea=tmp1.dim group by tmp1.dim order by sum(tmp1.total) desc  ";
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
         $sql1 = "drop temporary table IF EXISTS enc_mplaza_cali.tmp1 ;";
          $sql2 = "create temporary table enc_mplaza_cali.tmp1 (total int, dim int);";
           $sql3 = "insert into enc_mplaza_cali.tmp1 SELECT COUNT(dim1), dim1
	FROM enc_mplaza_cali.cliente_respuestas cr 
	inner join enc_mplaza_cali.cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen1=$SentidoID  and cd.mall='$mall'
	GROUP BY cr.dim1;";

          $sql4 = "insert into enc_mplaza_cali.tmp1 SELECT COUNT(dim2), dim2
	FROM enc_mplaza_cali.cliente_respuestas cr 
        inner join enc_mplaza_cali.cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen2=$SentidoID  and cd.mall='$mall'
	GROUP BY cr.dim2;";

             $sql5 = "insert into enc_mplaza_cali.tmp1 SELECT COUNT(dim3), dim3
	FROM enc_mplaza_cali.cliente_respuestas cr 
        inner join enc_mplaza_cali.cliente_dato cd on cd.idcliente=cliente_idcliente
	WHERE sen3=$SentidoID and cd.mall='$mall'
	GROUP BY cr.dim3;";

           $sql6 = "select ar.Area,sum(tmp1.total) as cant from enc_mplaza_cali.tmp1
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

}
