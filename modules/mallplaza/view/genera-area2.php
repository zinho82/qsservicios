<?php

require_once '../../config/config.php';
;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn= new config();
$select='<option value="-1" selected="">Seleccione una causa</option>';
                 $sql="select * from ".$_SESSION['campana']['bd'].".causas where  CodArea=".$_POST['Dim2']."  order by causa asc";
                $res=mysql_query($sql,$conn->conectar());
               // var_dump(mysql_fetch_array($res));
                while($arch=mysql_fetch_assoc($res)){
                 $select.="<option value=". $arch['CodCausa'].">".utf8_encode( $arch['Causa']) ."</option>";
                }
echo $select;