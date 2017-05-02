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
function ExportarDatosSodimac($desde, $hasta){
    $conn=new config();
     $sql="select  
emp.id_encuesta,emp.Cliente,emp.rut_dv,emp.cod_carga,emp.cvend,emp.ejecutivo,emp.subg
,emp.distrito,emp.Contacto
,emp.Mail,emp.CELULAR_CONTACTO,emp.TELEFONO_TRABAJO_CONTACTO,emp.TELEFONO_CASA_CONTACTO
,emp.DISC_AT4,emp.FONO_AT4,emp.DISC_AT5,emp.FONO_AT5
,emp.ddd_Cel,emp.Num_Celular,emp.observaciones
,emp.fec_termino as Fec_Realizada 
,ar1.texto as EstadoLlamada1
,ar2.texto as EstadoLlamada2
,ar3.texto as EstadoLlamada3
,ar.texto as EstadoEncuesta
,emp.num_post as Num_postergada
,emr.preg1,emr.preg2,emr.preg2_a1,emr.preg2_c1,emr.preg2_a2,emr.preg2_c2
,emr.preg2_a3,emr.preg2_c3,emr.preg3_1a,emr.preg3_1b,emr.preg3_1c,emr.preg3_1d
,emr.preg3_2a,emr.preg3_2b,emr.preg3_2c
,emr.preg3_3a,emr.preg3_3b,emr.preg3_3c
,emr.preg3_4a,emr.preg3_4b,emr.preg3_4c
,emr.preg3_5a,emr.preg3_5b,emr.preg3_5c
,emr.preg4
,emr.preg5_a,emr.preg5_b,emr.preg5_c,emr.preg5_d
,emr.contactado,emr.argumento_cliente
,usr.usuario
from  qsschile_qs_encuestas.qs_encuestascli_sodimac_emp emp
inner join qsschile_qs_encuestas.arbol ar on ar.idarbol=emp.estado
left join qsschile_qs_encuestas.arbol ar1 on ar1.idarbol=emp.status1_llamada
left join qsschile_qs_encuestas.arbol ar2 on ar2.idarbol=emp.status2_llamada
left join qsschile_qs_encuestas.arbol ar3 on ar3.idarbol=emp.status3_llamada
left join qsschile_qs_encuestas.arbol ar4 on ar4.idarbol=emp.status4_llamada
left join qsschile_qs_encuestas.arbol ar5 on ar5.idarbol=emp.status5_llamada
inner join qsschile_qs_encuestas.qs_encuesta_sodimac_emp emr on emr.id_encuesta=emp.id_encuesta  
inner join qsservicios.usuario usr on usr.idusuario=emr.ejecutivonew
where 
date(emp.fec_termino) between '$desde' and '$hasta'
and emp.Cliente!='HECTOR FERNANDEZ MUNOZ'
group by emp.id_encuesta
order by emp.estado asc

";
  $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
   $largo=sizeof(mysql_fetch_array($res));
  while($expo=mysql_fetch_array($res)){
      echo "<tr>";
      for($i=0;$i<59;$i++){
                echo "<td>".utf8_encode($expo[$i])."</td>";
}
      echo "</tr>";
  }
}
    function CargarTipificacion($bd, $tbla, $nivel, $campoPertenece, $pertenece, $campoMostrar, $CampoMostrarID) {
        $conn = new config();
        $opciones = "<option value='-1' selected=''>Seleccione una Opcion</option>";
        echo $sql = "select $CampoMostrarID as id,$campoMostrar as texto from $bd.$tbla where $campoPertenece=$pertenece";
        $res = mysql_query($sql, $conn->conectar());
        while ($opc = mysql_fetch_array($res)) {
            $opciones .= "<option value=" . $opc['id'] . ">" . $opc['texto'] . "</option>";
        }
        echo $opciones;
    }

    function BuscarAgenda($usuario) {
        $conn = new config();
         $sql = "select * from " . $_SESSION['campana']['bd'] . "." . $_SESSION['campana']['tabla'] . " where id_acceso=" . $_SESSION['usuario']['id'] . " and estado in (14,18) and cod_carga='".$_SESSION['campana']['codcarga']."'";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($rs = mysql_fetch_assoc($res)) {
            $tabla .= "<tr>"
                    . "<td>".$rs['cod_carga']."</td>"
                    . "<td>".$rs['Cliente']."</td>"
                      ."<td>".$enc['CELULAR_CONTACTO']."</td>"
                    . "<td>".$rs['fec_postergada']."</td>"
                    . "<td><a href='" . __BASE_URL__ . "modules/encuestas/view/Enc_hc_emp.php?id_encuesta=" . $rs['id_encuesta'] . "&id_formato=12&estado=2' ><i class='fa fa-search'></i></a></td>"
                    . "</tr>";
        }
        return $tabla;
    }

}
