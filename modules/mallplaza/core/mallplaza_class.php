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
     function ExportarDatos($FechaDesde,$FechaHasta){
        $conn=new config();
          $sql="select *,substring(fencuesta,4,2) as mes from enc_mplaza_cali.cliente_dato cda
inner join enc_mplaza_cali.cliente_respuestas cre on cre.cliente_idcliente=cda.idcliente and date(cda.fencuesta) between '$FechaDesde' and '$FechaHasta'";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
       // var_dump($expo=mysql_fetch_assoc($res));
        while($expo=mysql_fetch_assoc($res)){
            $encuesta= explode(" " , $expo['fresp']);
            if($expo['nps']<7){
                $tipo="Detractor";
            }
            if(($expo['nps']==7) or $expo['nps']==8){
                $tipo="Neutro";
            }
             if(($expo['nps']==9) or $expo['nps']==10){
                $tipo="promotor";
            }
            echo "<tr>"
            . "<td>".$expo['idcliente']."</td>"
                    . "<td>".$encuesta[0]."</td>"
                    . "<td>".$encuesta[1]."</td>"
                    . "<td>".utf8_encode($expo['mall'])."</td>"
                    . "<td>".utf8_encode($expo['origen'])."</td>"
                    . "<td>".$expo['fencuesta']."</td>"
                    . "<td>".$expo['hencuesta']."</td>"
                    . "<td>".$expo['nps']."</td>"
                    ."<td>".utf8_encode($expo['encuesta'])."</td>"
                    . "<td>".utf8_encode($expo['npspasivo'])."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"areas", $expo['dim1'], "CodArea", "Area"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"causas", $expo['area1'], "CodCausa", "Causa"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos(__BASE_DATOS__, "config", $expo['sen1'], "idconfig", "texto"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"areas", $expo['dim2'], "CodArea", "Area"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"causas", $expo['area2'], "CodCausa", "Causa"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos(__BASE_DATOS__, "config", $expo['sen2'], "idconfig", "texto"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"areas", $expo['dim3'], "CodArea", "Area"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos($_SESSION['campana']['bd'],"causas", $expo['area3'], "CodCausa", "Causa"))."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos(__BASE_DATOS__, "config", $expo['sen3'], "idconfig", "texto"))."</td>"
                    . "<td>".utf8_encode($expo['mediotransp'])."</td>"
                    . "<td>".$expo['obs']."</td>"
                    . "<td>".utf8_encode($conn->BuscaDatos(__BASE_DATOS__, "usuario", $expo['ejecutivo'], "idusuario", "usuario"))."</td>"
                    . "<td>".$expo['nombre']."</td>"
                    . "<td>".$expo['app']."</td>"
                    . "<td>".$expo['rut']."</td>"
                    . "<td>".$expo['fono1']."</td>"
                    . "<td>".$expo['fono2']."</td>"
                    . "<td>".$expo['correo']."</td>"
                    . "<td>".$expo['aucont']."</td>"
                    . "<td>".$expo['hencuesta']."</td>"
                    . "<td>".$expo['sexo']."</td>"
                    . "<td>".$expo['edad']."</td>"
                    . "<td>".$expo['dire']."</td>"
                    . "<td>".utf8_encode($expo['comuna'])."</td>"
                    . "<td>".$expo['pais']."</td>"
                    . "<td>".$expo['fono1']."</td>"
                    . "<td>".$expo['fono2']."</td>"
                    . "<td>".$expo['aceptabase']."</td>"
                    . "<td>".$expo['enccompleta']."</td>"
                    . "<td>".$expo['sativisita']."</td>"
                    . "<td>".$expo['satilimp']."</td>"
                    . "<td>".$expo['satisseg']."</td>"
                    . "<td>".$expo['satienre']."</td>"
                    . "<td>".$expo['mtransp2']."</td>"
                    . "<td>".$expo['satiesta']."</td>"
                    . "<td>".$expo['satiacceso']."</td>"
                    . "<td>".$expo['ofetienda']."</td>"
                    . "<td>".$expo['ofetiendaserv']."</td>"
                    . "<td>".$expo['reco']."</td>"
                    . "<td>".$tipo."</td>"
                    . "<td>".$expo['mes']."</td>"
                    . "<td>".utf8_encode($expo['mall'].$expo['pais'].$tipo)."</td>"
                    . "<td>".utf8_encode($expo['mall'].$expo['comuna'].$tipo)."</td>"
                    . "<td>".utf8_encode($expo['mall'].$expo['catcliente'].$tipo)."</td>"
                    
                    . "</tr>";
        }
    }
}
