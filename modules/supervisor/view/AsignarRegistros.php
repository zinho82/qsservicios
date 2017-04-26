<?php
require_once '../../config/config.php';
$conn=new config();
//var_dump($_POST);
 switch ($_POST['Campanas']) {
            case 4:$tabla = "cliente_dato";
                break;
            case 7:$tabla = "qs_encuestascli_sodimac_emp";
                break;
            case 8:$tabla = "qs_encuestascli_sodimac_emp";
                break;
        }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $sql="update ".$_SESSION['campana']['bd'].".$tabla set id_acceso=".$_POST['EjAsigna']." where cod_carga='".$_POST['codCamReg']."' and id_acceso=".$_POST['EjQuita']."  limit ".$_POST['Cantidad'];
if(mysql_query($sql,$conn->conectar())){
    echo "Registros Asignados";
} else {
echo "NO GUARDADO"    ;
die(mysql_error());
}