<?php
require_once '../../config/config.php';
$exporta=new mallplaza_class();
var_dump($_POST);
$exporta->ExportarDatos($_POST['mesd'],$_POST['anod'],$_POST['mesh'],$_POST['anoh']);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

