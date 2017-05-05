<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require_once("../funciones/conectar.php");
$StrSql="select * From qs_acceso where	id_acceso='".$_SESSION['s_id_acceso']."' and perfil_acceso = 1";
$result=consulta_bd($StrSql);
$row = mysql_fetch_array($result);

echo "<meta http-equiv='content-type/' content='text/html;charset=iso-8859-1' />";
echo "<p><p><h2>Bienvenido ".$row['nombre_acceso']." al Sistema Ingreso de Encuestas.<p>Selecciones la alternativa deseada del menu de la izquierda.</h2></p>";
?>