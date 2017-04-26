<?php
require_once '../../config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn=new config();
$conn->CargaCampanaSession($_POST['id']);
switch ($_POST['id']){
    case 4:$tabla ="cliente_dato";        break;
    case 7:$tabla="qs_encuestascli_sodimac_emp";        break;
    case 8:$tabla="qs_encuestascli_sodimac_emp";        break;
}
echo $conn->CargaCodCarga($tabla);

