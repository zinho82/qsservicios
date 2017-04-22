<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$id_encuesta="";
$id_formato="";
$estado="";
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];

$estado2=9;

if($_POST['enviar']=='Anterior') $estado2=7;
if($_POST['enviar']=='Proxima') $estado2=8;
if($_POST['enviar']=='POSTERGAR ENCUESTA') $estado2=2;
if($_POST['enviar']=='GRABAR ENCUESTA') $estado2=1;
if($_POST['enviar']=='FINALIZAR ENCUESTA') $estado2=9;
if($_POST['enviar']=='Dejar Pendiente Envio Mail') $estado2=4;
if($_POST['enviar']=='Enviada por Mail') $estado2=5;

require_once("../funciones/conectar.php");

if ($estado2==8)
{
	$strsql="select * from qs_encuestas 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";
	
	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuesta1.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuesta1.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestas 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuesta1.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuesta1.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";
$status_historia="";

$registrocli="";
//$codservicio="";
$rut_cliente="";
$dv="";
$nom_cliente="";
$ape_cliente="";
$edad="";
$marca_modelo="";
$patente="";
$cobertura="";
//$tip_siniestro="";
$fec_siniestro="";
//$hor_siniestro="";
$ciu_siniestro="";
$com_siniestro="";
$reg_siniestro="";
$fec_solicitud="";
$servicio="";
$compania="";
$telefono1="";
$telefono2="";
$sexo="";
//$ramo="";

$status1_llamada="";
$status2_llamada="";
$status3_llamada="";
$status4_llamada="";
$status5_llamada="";

$preg1="";
$preg1_a="";
$preg2="";
$preg3="";
$preg4="";
$preg5="";
$preg6="";
$preg7="";
$preg8_a="";
$preg8_b="";
$preg9="";
$preg10="";
$preg11="";
$preg12="";
$preg13="";
$preg14_a="";
$preg14_b="";
$preg14_c="";
$preg15="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

if(isset($_POST['registrocli'])) $registrocli=$_POST['registrocli'];
//if(isset($_POST['codservicio'])) $codservicio=$_POST['codservicio'];
if(isset($_POST['rut_cliente'])) $rut_cliente=$_POST['rut_cliente'];
if(isset($_POST['dv'])) $dv=$_POST['dv'];
if(isset($_POST['nom_cliente'])) $nom_cliente=$_POST['nom_cliente'];
if(isset($_POST['ape_cliente'])) $ape_cliente=$_POST['ape_cliente'];
if(isset($_POST['edad'])) $edad=$_POST['edad'];
if(isset($_POST['marca_modelo'])) $marca_modelo=$_POST['marca_modelo'];
if(isset($_POST['patente'])) $patente=$_POST['patente'];
if(isset($_POST['cobertura'])) $cobertura=$_POST['cobertura'];
//if(isset($_POST['tip_siniestro'])) $tip_siniestro=$_POST['tip_siniestro'];
if(isset($_POST['fec_siniestro'])) $fec_siniestro=$_POST['fec_siniestro'];
//if(isset($_POST['hor_siniestro'])) $hor_siniestro=$_POST['hor_siniestro'];
if(isset($_POST['ciu_siniestro'])) $ciu_siniestro=$_POST['ciu_siniestro'];
if(isset($_POST['com_siniestro'])) $com_siniestro=$_POST['com_siniestro'];
if(isset($_POST['reg_siniestro'])) $reg_siniestro=$_POST['reg_siniestro'];
if(isset($_POST['fec_solicitud'])) $fec_solicitud=$_POST['fec_solicitud'];
if(isset($_POST['servicio'])) $servicio=$_POST['servicio'];
if(isset($_POST['compania'])) $compania=$_POST['compania'];
if(isset($_POST['telefono1'])) $telefono1=$_POST['telefono1'];
if(isset($_POST['telefono2'])) $telefono2=$_POST['telefono2'];
if(isset($_POST['sexo'])) $sexo=$_POST['sexo'];
//if(isset($_POST['ramo'])) $ramo=$_POST['ramo'];

if(isset($_POST['status1_llamada'])) $status1_llamada=$_POST['status1_llamada'];
if(isset($_POST['status2_llamada'])) $status2_llamada=$_POST['status2_llamada'];
if(isset($_POST['status3_llamada'])) $status3_llamada=$_POST['status3_llamada'];
if(isset($_POST['status4_llamada'])) $status4_llamada=$_POST['status4_llamada'];
if(isset($_POST['status5_llamada'])) $status5_llamada=$_POST['status5_llamada'];
if(isset($_POST['status_historia'])) $status_historia=$_POST['status_historia'];
$status_historia = $status_historia.'**'.$status1_llamada.'-'.$status2_llamada.'-'.$status3_llamada.'-'.$status4_llamada.'-'.$status5_llamada.'||';

if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg1_a'])) $preg1_a=$_POST['preg1_a'];
if(isset($_POST['preg2'])) $preg2=$_POST['preg2'];
if(isset($_POST['preg3'])) $preg3=$_POST['preg3'];
if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];
if(isset($_POST['preg5'])) $preg5=$_POST['preg5'];
if(isset($_POST['preg6'])) $preg6=$_POST['preg6'];
if(isset($_POST['preg7'])) $preg7=$_POST['preg7'];
if(isset($_POST['preg8_a'])) $preg8_a=$_POST['preg8_a'];
if(isset($_POST['preg8_b'])) $preg8_b=$_POST['preg8_b'];
if(isset($_POST['preg9'])) $preg9=$_POST['preg9'];
if(isset($_POST['preg10'])) $preg10=$_POST['preg10'];
if(isset($_POST['preg11'])) $preg11=$_POST['preg11'];
if(isset($_POST['preg12'])) $preg12=$_POST['preg12'];
if(isset($_POST['preg13'])) $preg13=$_POST['preg13'];
if(isset($_POST['preg14_a'])) $preg14_a=$_POST['preg14_a'];
if(isset($_POST['preg14_b'])) $preg14_b=$_POST['preg14_b'];
if(isset($_POST['preg14_c'])) $preg14_c=$_POST['preg14_c'];
if(isset($_POST['preg15'])) $preg15=$_POST['preg15'];

$StrSql="UPDATE qs_encuestas set 
registrocli = '".$registrocli."', 
rut_cliente = '".$rut_cliente."', 
dv = '".$dv."', 
nom_cliente = '".$nom_cliente."', 
ape_cliente = '".$ape_cliente."', 
edad = '".$edad."', 
marca_modelo = '".$marca_modelo."', 
patente = '".$patente."', 
cobertura = '".$cobertura."', 
fec_siniestro = '".$fec_siniestro."', 
ciu_siniestro = '".$ciu_siniestro."', 
com_siniestro = '".$com_siniestro."', 
reg_siniestro = '".$reg_siniestro."', 
fec_solicitud = '".$fec_solicitud."', 
servicio = '".$servicio."', 
compania = '".$compania."', 
telefono1 = '".$telefono1."', 
telefono2 = '".$telefono2."', 
sexo = '".$sexo."', 

status1_llamada = '".$status1_llamada."', 
status2_llamada = '".$status2_llamada."', 
status3_llamada = '".$status3_llamada."', 
status4_llamada = '".$status4_llamada."', 
status5_llamada = '".$status5_llamada."', 

fec_termino = ADDDATE(NOW(),INTERVAL 1 HOUR) 
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_1 where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_1 set 
	preg1 = '".$preg1."', 
	preg1_a = '".$preg1_a."', 
	preg2 = '".$preg2."', 
	preg3 = '".$preg3."', 
	preg4 = '".$preg4."', 
	preg5 = '".$preg5."', 
	preg6 = '".$preg6."', 
	preg7 = '".$preg7."', 
	preg8_a = '".$preg8_a."', 
	preg8_b = '".$preg8_b."', 
	preg9 = '".$preg9."', 
	preg10 = '".$preg10."', 
	preg11 = '".$preg11."', 
	preg12 = '".$preg12."', 
	preg13 = '".$preg13."', 
	preg14_a = '".$preg14_a."', 
	preg14_b = '".$preg14_b."', 
	preg14_c = '".$preg14_c."', 
	preg15 = '".$preg15."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_1(id_encuesta,
	preg1, preg1_a, preg2, preg3, preg4, preg5, preg6, preg7, preg8_a, preg8_b, preg9, preg10, preg11, preg12, preg13, preg14_a, preg14_b, preg14_c, preg15 
	) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg1_a."', 
	'".$preg2."', 
	'".$preg3."', 
	'".$preg4."', 
	'".$preg5."', 
	'".$preg6."', 
	'".$preg7."', 
	'".$preg8_a."', 
	'".$preg8_b."', 
	'".$preg9."', 
	'".$preg10."', 
	'".$preg11."', 
	'".$preg12."', 
	'".$preg13."', 
	'".$preg14_a."', 
	'".$preg14_b."', 
	'".$preg14_c."', 
	'".$preg15."')";
}


if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestas set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestas set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestas set num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}
		
		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
		$strsql="select * from qs_encuestas 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. "
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuesta1.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuesta1.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}
}
?>