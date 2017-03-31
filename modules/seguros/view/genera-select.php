<?php

require_once '../../config/config.php';
;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn= new config();
var_dump($_POST);
$select='<option value="-1" selected="">Seleccione Un Archivo</option>';
                $sql="select * from ".__BASE_DATOS__.".archivos where year(fechacarga)=".$_POST['ano']." and month(fechacarga)=".$_POST['mes']." order by id desc";
                $res=mysql_query($sql,$conn->conectar());
               // var_dump(mysql_fetch_array($res));
                while($arch=mysql_fetch_assoc($res)){
                
                 $select.="<option value=". $arch['nomarchivo'].">". $arch['archivo'] ." (".$arch['fechacarga'].")</option>                ";
                }
echo $select;