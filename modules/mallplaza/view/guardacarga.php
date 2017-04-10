<?php
require_once '../../config/config.php';
var_dump($_POST);
$conn=new config();
echo $sql="insert into ".$_SESSION['campana']['bd'].".cliente_respuestas values(".$_POST['IdCli'].",'".date('Y-m-d G:i:s')."',".$_POST['Dim1'].",".$_POST['Area1'].",'".$_POST['Dim2']."','".$_POST['Area2']."','".$_POST['Dim3']."','".$_POST['Area3']."',null)";
mysql_query($sql,$conn->conectar()) or die(mysql_error());
$sql="update ".$_SESSION['campana']['bd'].".cliente_dato set estado=21 where idcliente=".$_POST['IdCli'];
mysql_query($sql,$conn->conectar()) or die(mysql_error());