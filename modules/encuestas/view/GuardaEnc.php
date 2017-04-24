<?php
require_once '../../config/config.php';
$conn=new config();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$preg1=$_POST['preg1'];
switch($_POST['num_post'])
{
    case 0:$CampoStatus='status1_llamada';break;
    case 1:$CampoStatus='status2_llamada';break;
    case 2:$CampoStatus='status3_llamada';break;
    case 3:$CampoStatus='status4_llamada';break;
    case 4:$CampoStatus='status5_llamada';break;
    default:$CampoStatus='status5_llamada';break;

}
//ACTUALIZANDO ENCUESTA CLIENTE
  $sql="update ".$_SESSION['campana']['bd'].".qs_encuestascli_sodimac_emp set "
         . "num_post=(num_post+1) "
          . ",TIPO='".$_POST['TIPO_CLIENTE']."' "
          .",CELULAR_CONTACTO='".$_POST['CELULAR_CONTACTO']."'"
          .",TELEFONO_CASA_CONTACTO='".$_POST['TELEFONO_CASA_CONTACTO']."'"
          .",FONO_AT4='".$_POST['FONO_AT4']."'"
          .",FONO_AT5='".$_POST['FONO_AT5']."'"
         .",fec_termino='".date("Y-m-d G:i:s")."' "
         .",fec_inicio='".date("Y-m-d G:i:s")."' "
         .",fec_postergada='".$_POST['FecPosterga']."'"
         .",estado=".$_POST['Arbol3']." "
         .",$CampoStatus='".$_POST['Arbol3']."'"
         . " where id_encuesta=".$_POST['id_encuesta'];
 if(!mysql_query($sql,$conn->conectar())){
     echo "no se Pudo Actualizar <<<CLIENTE>>> ";
     mysql_error();
}


//INSERTANDO RESULTADO ENCUESTA

 $sqls="insert into ".$_SESSION['campana']['bd'].".qs_encuesta_sodimac_emp values "
        . "("
        . "'".$_POST['id_encuesta']."','".$_POST['Mail']."',null,null,'".$_SESSION['usuario']['id']."'"
        . ",'".$_POST['preg1']."','".$_POST['preg2']."','".$_POST['preg2_a1']."','".$_POST['preg2_c1']."','".$_POST['preg2_a2']."'"
        . ",'".$_POST['preg2_c2']."','".$_POST['preg2_a3']."','".$_POST['preg2_c3']."','".$_POST['preg3_1a']."','".$_POST['preg3_1b']."','".$_POST['preg3_1c']."'"
        . ",'".$_POST['preg3_1d']."','".$_POST['preg3_2a']."','".$_POST['preg3_2b']."','".$_POST['preg3_2c']."','".$_POST['preg3_3a']."'"
        . ",'".$_POST['preg3_3b']."','".$_POST['preg3_3c']."','".$_POST['preg3_4a']."','".$_POST['preg3_4b']."','".$_POST['preg3_4c']."'"
        . ",'".$_POST['preg3_5a']."','".$_POST['preg3_5b']."','".$_POST['preg3_5c']."','".$_POST['preg4']."','".$_POST['preg5_a']."'"
        . ",'".$_POST['preg5_b']."','".$_POST['preg5_c']."','".$_POST['preg5_d']."','".$_POST['Contacto']."','".$_POST['observaciones']."'"
        . ",null"
        . ")";

if(!mysql_query($sqls,$conn->conectar())){
   
    echo "NO GUARDADO RESPUESTAS<br>";
    mysql_error();
}else{
    echo "Guardado";
}
//Envio mail automatico 
if (trim($preg1) <> '' and $preg1 >= 0 and $preg1 < 6 and $estado2 == 9 and $status3_llamada=='1.a.iii. Contesta encuesta') {

	//$destinatario="josegonzalez@sodimac.cl";
    $destinatario="erick@qsservicios.cl";

	$asunto="Nueva Encuesta SODIMAC EMPRESAS - Nota < 6 | ".$rut_dv;

	$fecha=date("Y-m-d H:i:s");

	

	$mensaje="Nota Pregunta 1: " .$preg1. "\r\n" . 

	'Razones de la Nota : ' .$_POST['preg2']. "\r\n\r\n" .

	'Tipo Venta Empresa: ' .$_POST['TIPO_CLIENTE']. "\r\n" .

	'Ejecutivo Venta Empresa: ' .$_POST['ejecutivo']. "\r\n" .

	'Distrito: ' .$_POST['distrito']. "\r\n".

	'Cliente: ' .$_POST['Cliente']. "\r\n".

	'Nombre Contacto en Empresa Cliente: ' .$_POST['preg5_a']. "\r\n" .

	'E-mail Contacto en Empresa Cliente: ' .$_POST['Mail']. "\r\n".

	'Celular Contacto en Empresa Cliente: ' .$_POST['CELULAR_CONTACTO']. "\r\n".

	'Tel�fono Trabajo Contacto en Empresa Cliente: ' .$_POST['TELEFONO_TRABAJO_CONTACTO']. "\r\n".

	'Tel�fono Casa Contacto en Empresa Cliente: ' .$_POST['TELEFONO_CASA_CONTACTO']. "\r\n";

	

	/*$encabezados = 'To: gsobrevia@sodimac.cl' . "\r\n" .

	'From: contacto@qsservicios.cl' . "\r\n" .

	'Cc: fescudero@sodimac.cl, gsamur@sodimac.cl, laraya@Falabella.cl, ajunes@sodimac.cl, carlos.rios@qsservicios.cl' . "\r\n";*/
$encabezados = 'To: erick.leal@qsservicios.cl' . "\r\n" .

	'From: contacto@qsservicios.cl' . "\r\n" ;

	//'Cc: fescudero@sodimac.cl, gsamur@sodimac.cl, laraya@Falabella.cl, ajunes@sodimac.cl, carlos.rios@qsservicios.cl' . "\r\n";


	

	mail($destinatario, $asunto, $mensaje, $encabezados);

}
