<?php

require_once '../../config/config.php';
$conn = new config();
 $sql = "insert into " . $_SESSION['campana']['bd'] . ".cliente_respuestas values(" . $_POST['IdCli'] . ",'" . date('Y-m-d G:i:s') . "'," . $_POST['Dim1'] . "," . $_POST['Area1'] . ",'" . $_POST['Dim2'] . "','" . $_POST['Area2'] . "','" . $_POST['Dim3'] . "','" . $_POST['Area3'] . "',null,'" . $_POST['Clasi1'] . "','" . $_POST['Clasi2'] . "','" . $_POST['Clasi3'] . "',".$_SESSION['usuario']['id'].")";
if (!mysql_query($sql, $conn->conectar()) ) {
    echo "  No se pudo guardar la encuesta << RESPUESTAS >>  ";
}

$sql = "update " . $_SESSION['campana']['bd'] . ".cliente_dato set estado=21 where idcliente=" . $_POST['IdCli'];
if(!mysql_query($sql, $conn->conectar())){
    echo "  No se pudo guardar la encuesta << Cliente >>  ";
}
else{
    echo "  Encuesta Guardada  ";
}
