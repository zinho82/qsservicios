<?php
require_once '../../config/config.php';
$conn=new config();
var_dump($_POST);
echo $conn->ListaCampanas($_POST['id']);




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

