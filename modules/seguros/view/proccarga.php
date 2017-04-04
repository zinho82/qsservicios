<?php
require_once '../../config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var_dump($_POST);

$conn=new config();
$ruta =__ROOT__.__MODULO_ACCESORIOS__;
mysql_query("truncate ".__BASE_DATOS__.".temporal",$conn->conectar());
//CONVIRTIENDO CAMOPOS de FECHA A TEXTO
echo shell_exec( 'mysql -uroot -pzinho1982 -e "ALTER TABLE '.__BASE_DATOS__.'.temporal CHANGE COLUMN fechaot fechaot VARCHAR(50) NULL DEFAULT NULL AFTER expediente;ALTER TABLE '.__BASE_DATOS__.'.temporal CHANGE COLUMN fechaprestacion fechaprestacion VARCHAR(50) NULL DEFAULT NULL AFTER matricula;"');
//CARGADO ARCHIVO a TABLA TEMPORAL
echo ( shell_exec( 'mysql -uroot -pzinho1982 -e "load data local infile '."'".$ruta.$_POST['archivo']."'".' into table '.__BASE_DATOS__.'.temporal fields terminated by '."';'".'"'));

echo shell_exec ( 'mysql -uroot -pzinho1982 -e "update '.__BASE_DATOS__.'.temporal tm set tm.fechaot= concat(substring(tm.fechaot,7,4),'."'-'".',substring(tm.fechaot,4,2),'."'-'".',substring(tm.fechaot,1,2),'."' '".',substring(tm.fechaot,-5)) ;'
        .'update '.__BASE_DATOS__.'.temporal tm set tm.fechaprestacion= concat(substring(tm.fechaprestacion,7,4),'."'-'".',substring(tm.fechaprestacion,4,2),'."'-'".',substring(tm.fechaprestacion,1,2),'."' '".',substring(tm.fechaprestacion,-5)) ;'
        . ' ALTER TABLE '.__BASE_DATOS__.'.temporal CHANGE COLUMN fechaot fechaot DATETIME NULL DEFAULT NULL AFTER expediente;'
        . ' ALTER TABLE '.__BASE_DATOS__.'.temporal CHANGE COLUMN fechaprestacion fechaprestacion DATETIME NULL DEFAULT NULL AFTER matricula;"');

//CARGANDO FECHA DE CARGA
mysql_query("update ".__BASE_DATOS__.".temporal set ad25='".date('Y-m-d')."'");
 $sql="insert into ".__BASE_DATOS__.".historico select * from ".__BASE_DATOS__.".temporal ";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
 $sql="insert ignore  into ".__BASE_DATOS__.".clientes select * from ".__BASE_DATOS__.".temporal ";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
$sqls="update ".__BASE_DATOS__.".temporal tm set tm.ad23=replace(tm.ad23,',','.')";
                    mysql_query($sqls,$conn->conectar());
