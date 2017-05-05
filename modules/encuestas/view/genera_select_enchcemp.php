<?php
require_once '../../config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn=new config();
echo "<option value='-1' selected=''>Seleccione Causa</option>";
 $sql="SELECT * from ".$_SESSION['campana']['bd'].".qs_causas WHERE CodArea = '".$_POST['id']."'";
$res=mysql_query($sql,$conn->conectar());
while($sal=mysql_fetch_array($res)){
    echo "<option value='".$sal['CodCausa']."'>". utf8_encode($sal['Causa'])."</option>";
}