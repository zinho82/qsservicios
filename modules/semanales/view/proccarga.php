<?php
require_once '../../config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);

$conn=new config();
$ruta =__ROOT__.__MODULO_ACCESORIOS__;
mysql_query("truncate ".__BASE_DATOS__.".semanales_temporal",$conn->conectar());
//CARGANDO ARCHIVO A TABLA TEMPORAL
echo ( shell_exec( 'mysql -uroot -pzinho1982 -e "load data local infile '."'".$ruta.$_POST['archivo']."'".' into table '.__BASE_DATOS__.'.semanales_temporal fields terminated by '."';'".'"'));
 $acttempo="update ".__BASE_DATOS__.".semanales_temporal set clasif=".$_POST['TipoCarga'];
mysql_query($acttempo,$conn->conectar()) or die(mysql_error());
//Actualizando datos
$actDatos="update qsservicios.semanales_temporal stm set stm.fecservicio=concat(substring(stm.fecservicio,-4),'-',substring(stm.fecservicio,4,2),'-',substring(stm.fecservicio,1,2))
,stm.vig_desde=concat(substring(stm.vig_desde,-4),'-',substring(stm.vig_desde,4,2),'-',substring(stm.vig_desde,1,2))
,stm.vig_hasta=concat(substring(stm.vig_hasta,-4),'-',substring(stm.vig_hasta,4,2),'-',substring(stm.vig_hasta,1,2))
,stm.ano_fab=concat(substring(stm.ano_fab,-4),'-',substring(stm.ano_fab,4,2),'-',substring(stm.ano_fab,1,2))
,stm.costoUF=replace(stm.costoUF,',','.')";
mysql_query($actDatos,$conn->conectar()) or die(mysql_error());
 $sql="insert into ".__BASE_DATOS__.".semanales_historico select * from ".__BASE_DATOS__.".semanales_temporal ";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
 $sql="insert ignore  into ".__BASE_DATOS__.".semanales_unico select * from ".__BASE_DATOS__.".semanales_temporal ";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
echo "Cargado<br> Tabla Temporal<br>Tabla Unica<br>Tabla Historica";
