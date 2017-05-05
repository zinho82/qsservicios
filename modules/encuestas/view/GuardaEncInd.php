<?php

require_once '../../config/config.php';
$conn = new config();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($_POST['Arbol3']==-1){
   $_POST['Arbol3']=$_POST['Arbol2'];
}
$preg1 = $_POST['preg1'];
switch ($_POST['num_post']) {
    case 0:$CampoStatus = 'status1_llamada';
        break;
    case 1:$CampoStatus = 'status2_llamada';
        break;
    case 2:$CampoStatus = 'status3_llamada';
        break;
    case 3:$CampoStatus = 'status4_llamada';
        break;
    case 4:$CampoStatus = 'status5_llamada';
        break;
    default:$CampoStatus = 'status5_llamada';
        break;
}
//ACTUALIZANDO ENCUESTA CLIENTE
 $sql = "update " . $_SESSION['campana']['bd'] . ".".$_SESSION['campana']['tabla']." set "
        . "num_post=(num_post+1) "
        . ",TIPO_CLIENTE='" . $_POST['TIPO_CLIENTE'] . "' "
        . ",DISC_AT1='" . $_POST['DISC_AT1'] . "'"
        . ",FONO_AT1='" . $_POST['FONOA_AT1'] . "'"
        . ",FONO_AT4='" . $_POST['FONO_AT4'] . "'"
        . ",FONO_AT5='" . $_POST['FONO_AT5'] . "'"
        . ",fec_termino='" . date("Y-m-d G:i:s") . "' "
        . ",fec_inicio='" . date("Y-m-d G:i:s") . "' "
        . ",fec_postergada='" . $_POST['FecPosterga'] . "'"
        . ",estado=" . $_POST['Arbol3'] . " "
        . ",$CampoStatus='" . $_POST['Arbol3'] . "'"
        . " where id_encuesta=" . $_POST['id_encuesta'];
if (!mysql_query($sql, $conn->conectar())) {
    echo "no se Pudo Actualizar <<<CLIENTE>>> ";
    mysql_error();
}


//INSERTANDO RESULTADO ENCUESTA

 $sqls = "insert into " . $_SESSION['campana']['bd'] . ".qs_encuesta_sodimac_ind values "
        . "("
        . "'" . $_POST['id_encuesta'] . "','" . $_SESSION['usuario']['id'] . "','".date("Y-m-d G:i:s")."'"
        . ",'" . $_POST['preg1'] . "',null,'" . $_POST['preg2_1'] . "','" . $_POST['preg2_2'] . "'"
        .",'" . $_POST['preg3'] . "','" . $_POST['preg4'] . "','" . $_POST['preg4_area1'] . "','" . $_POST['preg4_causa1'] . "','" . $_POST['preg4_area2'] . "','" . $_POST['preg4_causa2'] . "','" . $_POST['preg4_area3'] . "','" . $_POST['preg4_causa3'] 
        . "','" . $_POST['preg5'] . "','" . $_POST['preg6'] . "','" . $_POST['preg6_area1'] . "','" . $_POST['preg6_causa1'] . "','" . $_POST['preg6_area2'] . "','" . $_POST['preg6_causa2'] . "','" . $_POST['preg6_area3'] . "','" . $_POST['preg6_causa3'] ."'"
        .",'".$_POST['preg7']."','".$_POST['preg8']."'"
        . ")";

if (!mysql_query($sqls, $conn->conectar())) {

    echo "NO GUARDADO RESPUESTAS\n";
    mysql_error();
} else {
    echo "Guardado";
}
//Envio mail automatico 
if (trim($preg1) <> '' and $preg1 >= 0 and $preg1 < 6 and $_POST['Arbol3']==7 ) 
 {

    $destinatario="josegonzalez@sodimac.cl";
    //$destinatario = "erick@qsservicios.cl";

    $asunto = "Nueva Encuesta SODIMAC EMPRESAS - Nota < 6 | " . $_POST['rut_dv'];

    $fecha = date("Y-m-d H:i:s");



    $mensaje = "Nota Pregunta 1: " . $preg1 . "\r\n" .
            'Razones de la Nota : ' . $_POST['preg2'] . "\r\n\r\n" .
            'Tipo Venta Empresa: ' . $_POST['TIPO_CLIENTE'] . "\r\n" .
            'Ejecutivo Venta Empresa: ' . $_POST['ejecutivo'] . "\r\n" .
            'Distrito: ' . $_POST['distrito'] . "\r\n" .
            'Cliente: ' . $_POST['Cliente'] . "\r\n" .
            'Nombre Contacto en Empresa Cliente: ' . $_POST['preg5_a'] . "\r\n" .
            'E-mail Contacto en Empresa Cliente: ' . $_POST['Mail'] . "\r\n" .
            'Celular Contacto en Empresa Cliente: ' . $_POST['CELULAR_CONTACTO'] . "\r\n" .
            'Telefono Trabajo Contacto en Empresa Cliente: ' . $_POST['TELEFONO_TRABAJO_CONTACTO'] . "\r\n" .
            'Telefono Casa Contacto en Empresa Cliente: ' . $_POST['TELEFONO_CASA_CONTACTO'] . "\r\n";



    $encabezados = 'To: gsobrevia@sodimac.cl' . "\r\n" .
            'From: contacto@qsservicios.cl' . "\r\n" .
            'Cc: fescudero@sodimac.cl, gsamur@sodimac.cl, laraya@Falabella.cl, ajunes@sodimac.cl, carlos.rios@qsservicios.cl,erick.leal@qsservicios.cl' . "\r\n";
    /*$encabezados = 'To: erick.leal@qsservicios.cl' . "\r\n" .
            'From: contacto@qsservicios.cl' . "\r\n";

    'Cc: fescudero@sodimac.cl, gsamur@sodimac.cl, laraya@Falabella.cl, ajunes@sodimac.cl, carlos.rios@qsservicios.cl' . "\r\n";

*/


  //  mail($destinatario, $asunto, $mensaje, $encabezados);
}
