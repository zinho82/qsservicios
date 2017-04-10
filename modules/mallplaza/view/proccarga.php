<?php

require_once '../../config/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var_dump($_POST);


$conn = new config();
$conn->CargaCampanaSession($_POST['campana']);
var_dump($_SESSION);
$ruta = __ROOT__ . __MODULO_ACCESORIOS__;
mysql_query("truncate " . $_SESSION['campana']['bd'] . ".temporal", $conn->conectar());
//CONVIRTIENDO CAMOPOS de FECHA A TEXTO
/*echo shell_exec('mysql -uroot -pzinho1982 -e "ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN fechaot fechaot VARCHAR(50) NULL DEFAULT NULL AFTER expediente;'
        . 'ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN fechaprestacion fechaprestacion VARCHAR(50) NULL DEFAULT NULL AFTER matricula;'
        . ' ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN tarifa tarifa VARCHAR(50) NULL DEFAULT NULL AFTER fechaprestacion;"');

 * //CARGADO ARCHIVO a TABLA TEMPORAL
 */

$row = 3;
$fp = fopen ($ruta.$_POST['archivo'],"r");
while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;
//echo "$row- ".$data[0].$data[1].$data[2].$data[3].$data[4].$data[5].$data[6].$data[7].$data[8].$data[9].$data[10 ].$data[11].$data[12].$data[13].$data[14].$data[15 ].$data[16].$data[17].$data[18];
$insertar="INSERT INTO  ".$_SESSION['campana']['bd'].".temporal VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]'"
        . "                                                             ,'$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]'"
        . "                                                             ,'$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]'"
        . "                                                             ,'". str_replace(array("\r", "\n"),' ', $data[31])."','". str_replace(array("\r", "\n"), ' ', $data[32])."','". str_replace(array("\r", "\n"), ' ', $data[33])."','". str_replace(array("\r", "\n"), ' ', $data[34])."','$data[35]','$data[36]','$data[37]','$data[38]','$data[39]','$data[40]'"
        . "                                                             ,'$data[41]','$data[42]','$data[43]','$data[44]','$data[45]','$data[46]','$data[47]','$data[48]','$data[49]','$data[50]','".date('Ymd')."')";
mysql_query($insertar,$conn->conectar()) or die(mysql_error());
}
fclose ($fp);
//Cargando tbl datos
mysql_query("truncate " . $_SESSION['campana']['bd'] . ".cliente_dato", $conn->conectar());
$sql="insert into ".$_SESSION['campana']['bd'].".cliente_dato select *,null from ".$_SESSION['campana']['bd'].".temporal ";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
$npndetra="update ".$_SESSION['campana']['bd'].".cliente_dato set npsdtractor=npspromotor where npspromotor!='' ";
mysql_query($npndetra,$conn->conectar());
$npndetra="update ".$_SESSION['campana']['bd'].".cliente_dato set npsdtractor=npspasivo where npspasivo!='' ";
mysql_query($npndetra,$conn->conectar());

//echo (shell_exec ('mysql -uroot -pzinho1982 -e "load data local infile ' . "'" . $ruta . $_POST['archivo'] . "'" . ' into table ' . $_SESSION['campana']['bd'] . '.temporal fields terminated by ' . "';'" .' escaped by ' . "'\n%%\r'" .' ignore 3 lines )"'));

/*echo shell_exec('mysql -uroot -pzinho1982 -e "update ' . __BASE_DATOS__ . '.temporal tm set tm.fechaot= concat(substring(tm.fechaot,7,4),' . "'-'" . ',substring(tm.fechaot,4,2),' . "'-'" . ',substring(tm.fechaot,1,2),' . "' '" . ',substring(tm.fechaot,-5)) ;'
        . 'update ' . __BASE_DATOS__ . '.temporal tm set tm.fechaprestacion= concat(substring(tm.fechaprestacion,7,4),' . "'-'" . ',substring(tm.fechaprestacion,4,2),' . "'-'" . ',substring(tm.fechaprestacion,1,2),' . "' '" . ',substring(tm.fechaprestacion,-5)) ;'
        . 'update ' . __BASE_DATOS__ . '.temporal tm set tm.tarifa=replace(tm.tarifa,'."',','.'".');'
        . ' ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN fechaot fechaot DATETIME NULL DEFAULT NULL AFTER expediente;'
        . ' ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN fechaprestacion fechaprestacion DATETIME NULL DEFAULT NULL AFTER matricula;'
        . ' ALTER TABLE ' . __BASE_DATOS__ . '.temporal CHANGE COLUMN tarifa tarifa DOUBLE NULL DEFAULT NULL AFTER fechaprestacion;"');

//CARGANDO FECHA DE CARGA
mysql_query("update " . __BASE_DATOS__ . ".temporal set ad25='" . date('Y-m-d') . "'");
$sql = "insert into " . __BASE_DATOS__ . ".historico select * from " . __BASE_DATOS__ . ".temporal ";
mysql_query($sql, $conn->conectar()) or die(mysql_error());
$sql = "insert ignore  into " . __BASE_DATOS__ . ".clientes select * from " . __BASE_DATOS__ . ".temporal ";
mysql_query($sql, $conn->conectar()) or die(mysql_error());
$sqls = "update " . __BASE_DATOS__ . ".temporal tm set tm.ad23=replace(tm.ad23,',','.')";
mysql_query($sqls, $conn->conectar());
*/