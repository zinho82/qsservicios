<?php

require_once '../../config/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = new config();
$conn->CargaCampanaSession($_POST['campana']);
$ruta = __ROOT__ . __MODULO_ACCESORIOS__;
mysql_query("truncate " . $_SESSION['campana']['bd'] . ".temporal", $conn->conectar());

//CONVIRTIENDO CAMOPOS de FECHA A TEXTO
//secho shell_exec('mysql -uroot -pzinho1982 -e "ALTER TABLE ' . $_SESSION['campana']['bd']  . '.cliente_dato CHANGE COLUMN fencuesta fencuesta VARCHAR(50) NULL DEFAULT NULL AFTER rut;"');

  //CARGADO ARCHIVO a TABLA TEMPORAL

$row = 3;
$fp = fopen ($ruta.$_POST['archivo'],"r");
while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;
$insertar="INSERT INTO  ".$_SESSION['campana']['bd'].".temporal VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]'"
        . "                                                             ,'$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]'"
        . "                                                             ,'$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]'"
        . "                                                             ,'". str_replace(array("\r", "\n"),' ', $data[31])."','". str_replace(array("\r", "\n"), ' ', $data[32])."','". str_replace(array("\r", "\n"), ' ', $data[33])."','". str_replace(array("\r", "\n"), ' ', $data[34])."','$data[35]','$data[36]','$data[37]','$data[38]','$data[39]','$data[40]'"
        . "                                                             ,'$data[41]','$data[42]','$data[43]','$data[44]','$data[45]','$data[46]','$data[47]','$data[48]','$data[49]','$data[50]','".date('Ymd')."')";
mysql_query($insertar,$conn->conectar()) or die(mysql_error());
}
fclose ($fp);
//Cargando tbl datos
$npndetra="update ".$_SESSION['campana']['bd'].".temporal set fecha_resp=concat(substring(fecha_resp,7,4),'-',substring(fecha_resp,4,2),'-',substring(fecha_resp,1,2),' ',substring(fecha_resp,-5))  ";
if(!mysql_query($npndetra,$conn->conectar())){
    echo "Error al Actualizar <<TEMPORAL FECHA RESPUESTA>>\n".mysql_error();
}
    $npndetra="update ".$_SESSION['campana']['bd'].".temporal set fencuesta=concat(substring(fencuesta,7,4),'-',substring(fencuesta,4,2),'-',substring(fencuesta,1,2)) ";
if(!mysql_query($npndetra,$conn->conectar())){
    echo "Error al Actualizar <<TEMPORAL FECHA ENCUESTA>>";
}
$sql="insert into ".$_SESSION['campana']['bd'].".cliente_dato select *,null,null from ".$_SESSION['campana']['bd'].".temporal ";
if(!mysql_query($sql,$conn->conectar()) ){
    echo "Error al Cargar <<clientes>>";
}
$npndetra="update ".$_SESSION['campana']['bd'].".cliente_dato set npsdtractor=npspromotor where npspromotor!='' ";
if(!mysql_query($npndetra,$conn->conectar())){
        echo "Error al Actualizar <<PROMOTOR>>";
}
$npndetra="update ".$_SESSION['campana']['bd'].".cliente_dato set npsdtractor=npspasivo where npspasivo!='' ";
if(!mysql_query($npndetra,$conn->conectar())){
    echo "Error al Actualizar <<PASIVO>>";
}
 $npndetra="delete  from ".$_SESSION['campana']['bd'].".cliente_dato  where (nombre='' or nombre is null or nombre like '%first%') ";
if(!mysql_query($npndetra,$conn->conectar())){
    echo "Error al Borrar Campos Vacios <<CLIENTES>>";
}else{
    echo "Encuestas  Cargadas";
}