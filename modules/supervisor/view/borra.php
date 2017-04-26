<?php
require_once '../../config/config.php';
$conn=new config();
echo $sql="delete from ".__BASE_DATOS__.".ejecutivocampana where idejecutivocampana=".$_GET['i'];
mysql_query($sql,$conn->conectar()) or die(mysql_error());
header("Location:".__BASE_URL__.__MODULO_SUPERVISOR__."view/EjecutivoCampana.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

