<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//$dbh = mysql_connect("localhost", "root", "jotaoh11");
//$db = mysql_select_db("jcabrera_qs_encuestas");


echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
header('Content-Type: text/html; charset=utf-8');
echo '<option value="">Selecciona</option>';

require_once("../funciones/conectar.php");
$consulta = "SELECT * from qs_causas_encuestas WHERE encuesta = '".$_GET['encuesta']."' and CodArea = '".$_GET['id']."'";
//$query = mysql_query($consulta);
$query=consulta_bd($consulta);
while ($fila = mysql_fetch_array($query)) {
    echo '<option value="'.str_replace(" ","%20",$fila['CodCausa']).'">'.$fila['Causa'].'</option>';	
};

?>