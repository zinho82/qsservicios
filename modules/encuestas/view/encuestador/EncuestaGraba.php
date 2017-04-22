<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$TipoBusqueda=$_POST['TipoBusqueda'];
$FactNoResultado=$_POST['FactNoResultado'];

$estado=2;

if($_POST['enviar']=='Guardar') $estado=1;

$StrSql="UPDATE cv_encuesta SET 
explab='".$_POST['explab']."' , explabyear = '".$_POST['explabyear']."', CantEmple = '".$_POST['CantEmple']."', 
ExpLabMeses = '".$_POST['ExpLabMeses']."', CateIngresos = '".$_POST['CateIngresos']."', Contrato = '".$_POST['Contrato']."', 
CantHoras = '".$_POST['CantHoras']."', MontoSueldo = '".$_POST['MontoSueldo']."', 
MontoSueldoa1 = '".$_POST['MontoSueldoa1']."', PeriodosIngresos11 = '".$_POST['PeriodosIngresos11']."', 
MontoSueldoa2 = '".$_POST['MontoSueldoa2']."', PeriodosIngresos12 = '".$_POST['PeriodosIngresos12']."', 
MontoSueldoa3 = '".$_POST['MontoSueldoa3']."', PeriodosIngresos13 = '".$_POST['PeriodosIngresos13']."', 
MontoSueldoa4 = '".$_POST['MontoSueldoa4']."', PeriodosIngresos14 = '".$_POST['PeriodosIngresos14']."', 
MontoSueldoa5 = '".$_POST['MontoSueldoa5']."', PeriodosIngresos15 = '".$_POST['PeriodosIngresos15']."', 
MontoSueldoa6 = '".$_POST['MontoSueldoa6']."', PeriodosIngresos16 = '".$_POST['PeriodosIngresos16']."', 
MontoSueldob1 = '".$_POST['MontoSueldob1']."', PeriodosIngresos21 = '".$_POST['PeriodosIngresos21']."', 
MontoSueldob2 = '".$_POST['MontoSueldob2']."', PeriodosIngresos22 = '".$_POST['PeriodosIngresos22']."', 
MontoSueldob3 = '".$_POST['MontoSueldob3']."', PeriodosIngresos23 = '".$_POST['PeriodosIngresos23']."', 
MontoSueldob4 = '".$_POST['MontoSueldob4']."', PeriodosIngresos24 = '".$_POST['PeriodosIngresos24']."', 
FinContrato = '".$_POST['FinContrato']."', BuscoTrabDS = '".$_POST['BuscoTrabDS']."', BuscoTrabDSRZ = '".$_POST['BuscoTrabDSRZ']."', 
SalarioMinimoM = '".$_POST['SalarioMinimoM']."', SalarioMinimoU = '".$_POST['SalarioMinimoU']."', 
TipoBusqueda1 = '".$TipoBusqueda[0]."', TipoBusqueda2 = '".$TipoBusqueda[1]."', 
TipoBusqueda3 = '".$TipoBusqueda[2]."', TipoBusqueda4 = '".$TipoBusqueda[3]."', 
TipoBusqueda5 = '".$TipoBusqueda[4]."', 
FactNoResultado1 = '".$FactNoResultado[0]."', FactNoResultado2 = '".$FactNoResultado[1]."', FactNoResultado3 = '".$FactNoResultado[2]."', 
FactNoResultado4 = '".$FactNoResultado[3]."', FactNoResultado5 = '".$FactNoResultado[4]."', FactNoResultado6 = '".$FactNoResultado[5]."', 
FactNoResultado7 = '".$FactNoResultado[6]."' 
WHERE id_postulante = '".$_SESSION['s_id_postulante']."'";

require_once("../funciones/conectar.php");

if(query_bd($StrSql))
{
	$StrSql="UPDATE cv_postulantes SET estado=".$estado." where id_postulante='".$_SESSION['s_id_postulante']."'";
	query_bd($StrSql);

	$StrSql="insert into cv_eventos (id_acceso, id_postulante, fec_evento, gls_evento) 
	VALUES ('".$_SESSION['s_id_acceso']."','".$_SESSION['s_id_postulante']."', ADDDATE(NOW(),INTERVAL 1 HOUR), 'Se Actualiza Encuesta Postulante Rut:".$rut."-Estado:".$estado."')";
	query_bd($StrSql);
	
	$url="index.php?g_enviar=1";
	Header("Location: $url");
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}
?>
