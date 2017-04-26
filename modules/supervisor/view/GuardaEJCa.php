<?php
require_once '../../config/config.php';
$conn=new config();
 $sql="insert into ".__BASE_DATOS__.".ejecutivocampana values(null,".$_POST['Ejecutivo'].",".$_POST['CampanaA'].",'".$_POST['CodCarga']."')";

if(mysql_query($sql,$conn->conectar())){
    echo 'Cargado';
}else{
    echo "No Cargado";
}