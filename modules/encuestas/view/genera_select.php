<?php
require_once '../../config/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var_dump($_POST);
$encuesta=new encuestas_class();
 $encuesta->CargarTipificacion($_SESSION['campana']['bd'], "arbol", 2, "pertenece", $_POST['id'], "texto", "idarbol");

