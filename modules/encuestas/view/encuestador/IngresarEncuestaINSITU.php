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
//if($_POST['enviar']=='GRABAR ENCUESTA') $estado2=1;
if($_POST['enviar']=='FINALIZAR ENCUESTA') $estado2=9;
if($_POST['enviar']=='Dejar Pendiente Envio Mail') $estado2=4;
if($_POST['enviar']=='Enviada por Mail') $estado2=5;

require_once("../funciones/conectar.php");

if ($estado2==8)
{
	$strsql="select * from qs_encuestascli_insitu 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaINSITU.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaINSITU.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_insitu 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaINSITU.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaINSITU.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";

//$id_servicio="";
//$N_Visit="";
//$N_Enc="";
//$Nombre_cli="";
//$Rut_cli="";
//$Telefono_1="";
//$Telefono_2="";
//$Patente_cli="";
//$Ciudad_cli="";
//$CiaSeg_cli="";
//$Ramseg_cli="";
//$FechaSin_cli="";
//$HoraSin_cli="";
//$Ciudad_Sini="";
//$Servicio_Sini="";
//$CobApl_Sini="";
//$Provee_Sini="";
//$FechaAtt_Sini="";
//$HoraAtt_Sini="";

$preg1_1="";
$preg1_2="";
$preg2_1="";
$preg2_2="";
$preg3_1="";
$preg3_2="";
$preg4_1="";
$preg4_2="";
$preg5_1="";
$preg5_2="";
$preg6_1="";
$preg6_2="";
$preg7_1="";
$preg7_2="";
$preg8_1="";
$preg8_2="";
$preg9_1="";
$preg9_2="";
$preg10_1="";
$preg10_2="";
$preg11_1="";
$preg11_2="";
$preg12_1="";
$preg12_2="";
$preg13_1="";
$preg13_2="";
$preg14_1_desde="";
$preg14_1_hasta="";
$preg14_2="";
$preg15_1="";
$preg15_2="";
$preg16_1="";
$preg16_2="";
$preg17_1="";
$preg17_2="";
$preg18_1="";
$preg18_2="";
$preg19_1="";
$preg19_2="";
$preg20_1="";
$preg20_2="";
$preg21_1="";
$preg21_2="";
$preg22_1="";
$preg22_2="";
$preg23_1="";
$preg23_2="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

//if(isset($_POST['id_servicio'])) $id_servicio=$_POST['id_servicio'];
//if(isset($_POST['N_Visit'])) $N_Visit=$_POST['N_Visit'];
//if(isset($_POST['N_Enc'])) $N_Enc=$_POST['N_Enc'];
//if(isset($_POST['Nombre_cli'])) $Nombre_cli=$_POST['Nombre_cli'];
//if(isset($_POST['Rut_cli'])) $Rut_cli=$_POST['Rut_cli'];
//if(isset($_POST['Telefono_1'])) $Telefono_1=$_POST['Telefono_1'];
//if(isset($_POST['Telefono_2'])) $Telefono_2=$_POST['Telefono_2'];
//if(isset($_POST['Patente_cli'])) $Patente_cli=$_POST['Patente_cli'];
//if(isset($_POST['Ciudad_cli'])) $Ciudad_cli=$_POST['Ciudad_cli'];
//if(isset($_POST['CiaSeg_cli'])) $CiaSeg_cli=$_POST['CiaSeg_cli'];
//if(isset($_POST['Ramseg_cli'])) $Ramseg_cli=$_POST['Ramseg_cli'];
//if(isset($_POST['FechaSin_cli'])) $FechaSin_cli=$_POST['FechaSin_cli'];
//if(isset($_POST['HoraSin_cli'])) $HoraSin_cli=$_POST['HoraSin_cli'];
//if(isset($_POST['Ciudad_Sini'])) $Ciudad_Sini=$_POST['Ciudad_Sini'];
//if(isset($_POST['Servicio_Sini'])) $Servicio_Sini=$_POST['Servicio_Sini'];
//if(isset($_POST['CobApl_Sini'])) $CobApl_Sini=$_POST['CobApl_Sini'];
//if(isset($_POST['Provee_Sini'])) $Provee_Sini=$_POST['Provee_Sini'];
//if(isset($_POST['FechaAtt_Sini'])) $FechaAtt_Sini=$_POST['FechaAtt_Sini'];
//if(isset($_POST['HoraAtt_Sini'])) $HoraAtt_Sini=$_POST['HoraAtt_Sini'];


if(isset($_POST['preg1_1'])) $preg1_1=$_POST['preg1_1'];
if(isset($_POST['preg1_2'])) $preg1_2=$_POST['preg1_2'];
if(isset($_POST['preg2_1'])) $preg2_1=$_POST['preg2_1'];
if(isset($_POST['preg2_2'])) $preg2_2=$_POST['preg2_2'];
if(isset($_POST['preg3_1'])) $preg3_1=$_POST['preg3_1'];
if(isset($_POST['preg3_2'])) $preg3_2=$_POST['preg3_2'];
if(isset($_POST['preg4_1'])) $preg4_1=$_POST['preg4_1'];
if(isset($_POST['preg4_2'])) $preg4_2=$_POST['preg4_2'];
if(isset($_POST['preg5_1'])) $preg5_1=$_POST['preg5_1'];
if(isset($_POST['preg5_2'])) $preg5_2=$_POST['preg5_2'];
if(isset($_POST['preg6_1'])) $preg6_1=$_POST['preg6_1'];
if(isset($_POST['preg6_2'])) $preg6_2=$_POST['preg6_2'];
if(isset($_POST['preg7_1'])) $preg7_1=$_POST['preg7_1'];
if(isset($_POST['preg7_2'])) $preg7_2=$_POST['preg7_2'];
if(isset($_POST['preg8_1'])) $preg8_1=$_POST['preg8_1'];
if(isset($_POST['preg8_2'])) $preg8_2=$_POST['preg8_2'];
if(isset($_POST['preg9_1'])) $preg9_1=$_POST['preg9_1'];
if(isset($_POST['preg9_2'])) $preg9_2=$_POST['preg9_2'];
if(isset($_POST['preg10_1'])) $preg10_1=$_POST['preg10_1'];
if(isset($_POST['preg10_2'])) $preg10_2=$_POST['preg10_2'];
if(isset($_POST['preg11_1'])) $preg11_1=$_POST['preg11_1'];
if(isset($_POST['preg11_2'])) $preg11_2=$_POST['preg11_2'];
if(isset($_POST['preg12_1'])) $preg12_1=$_POST['preg12_1'];
if(isset($_POST['preg12_2'])) $preg12_2=$_POST['preg12_2'];
if(isset($_POST['preg13_1'])) $preg13_1=$_POST['preg13_1'];
if(isset($_POST['preg13_2'])) $preg13_2=$_POST['preg13_2'];
if(isset($_POST['preg14_1_desde'])) $preg14_1_desde=$_POST['preg14_1_desde'];
if(isset($_POST['preg14_1_hasta'])) $preg14_1_hasta=$_POST['preg14_1_hasta'];
if(isset($_POST['preg14_2'])) $preg14_2=$_POST['preg14_2'];
if(isset($_POST['preg15_1'])) $preg15_1=$_POST['preg15_1'];
if(isset($_POST['preg15_2'])) $preg15_2=$_POST['preg15_2'];
if(isset($_POST['preg16_1'])) $preg16_1=$_POST['preg16_1'];
if(isset($_POST['preg16_2'])) $preg16_2=$_POST['preg16_2'];
if(isset($_POST['preg17_1'])) $preg17_1=$_POST['preg17_1'];
if(isset($_POST['preg17_2'])) $preg17_2=$_POST['preg17_2'];
if(isset($_POST['preg18_1'])) $preg18_1=$_POST['preg18_1'];
if(isset($_POST['preg18_2'])) $preg18_2=$_POST['preg18_2'];
if(isset($_POST['preg19_1'])) $preg19_1=$_POST['preg19_1'];
if(isset($_POST['preg19_2'])) $preg19_2=$_POST['preg19_2'];
if(isset($_POST['preg20_1'])) $preg20_1=$_POST['preg20_1'];
if(isset($_POST['preg20_2'])) $preg20_2=$_POST['preg20_2'];
if(isset($_POST['preg21_1'])) $preg21_1=$_POST['preg21_1'];
if(isset($_POST['preg21_2'])) $preg21_2=$_POST['preg21_2'];
if(isset($_POST['preg22_1'])) $preg22_1=$_POST['preg22_1'];
if(isset($_POST['preg22_2'])) $preg22_2=$_POST['preg22_2'];
if(isset($_POST['preg23_1'])) $preg23_1=$_POST['preg23_1'];
if(isset($_POST['preg23_2'])) $preg23_2=$_POST['preg23_2'];

$StrSql="UPDATE qs_encuestascli_insitu set 
fec_termino = ADDDATE(NOW(),INTERVAL 1 HOUR)  
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_insitu where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_insitu set 
	preg1_1 = '".$preg1_1."', 
	preg1_2 = '".$preg1_2."', 
	preg2_1 = '".$preg2_1."', 
	preg2_2 = '".$preg2_2."', 
	preg3_1 = '".$preg3_1."', 
	preg3_2 = '".$preg3_2."', 
	preg4_1 = '".$preg4_1."', 
	preg4_2 = '".$preg4_2."', 
	preg5_1 = '".$preg5_1."', 
	preg5_2 = '".$preg5_2."', 
	preg6_1 = '".$preg6_1."', 
	preg6_2 = '".$preg6_2."', 
	preg7_1 = '".$preg7_1."', 
	preg7_2 = '".$preg7_2."', 
	preg8_1 = '".$preg8_1."', 
	preg8_2 = '".$preg8_2."', 
	preg9_1 = '".$preg9_1."', 
	preg9_2 = '".$preg9_2."', 
	preg10_1 = '".$preg10_1."', 
	preg10_2 = '".$preg10_2."', 
	preg11_1 = '".$preg11_1."', 
	preg11_2 = '".$preg11_2."', 
	preg12_1 = '".$preg12_1."', 
	preg12_2 = '".$preg12_2."', 
	preg13_1 = '".$preg13_1."', 
	preg13_2 = '".$preg13_2."', 
	preg14_1_desde = '".$preg14_1_desde."', 
	preg14_1_hasta = '".$preg14_1_hasta."', 
	preg14_2 = '".$preg14_2."', 
	preg15_1 = '".$preg15_1."', 
	preg15_2 = '".$preg15_2."', 
	preg16_1 = '".$preg16_1."', 
	preg16_2 = '".$preg16_2."', 
	preg17_1 = '".$preg17_1."', 
	preg17_2 = '".$preg17_2."', 
	preg18_1 = '".$preg18_1."', 
	preg18_2 = '".$preg18_2."', 
	preg19_1 = '".$preg19_1."', 
	preg19_2 = '".$preg19_2."', 
	preg20_1 = '".$preg20_1."', 
	preg20_2 = '".$preg20_2."', 
	preg21_1 = '".$preg21_1."', 
	preg21_2 = '".$preg21_2."', 
	preg22_1 = '".$preg22_1."', 
	preg22_2 = '".$preg22_2."', 
	preg23_1 = '".$preg23_1."', 
	preg23_2 = '".$preg23_2."'  
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_insitu(id_encuesta,
	preg1_1, preg1_2,
	preg2_1, preg2_2,
	preg3_1, preg3_2,
	preg4_1, preg4_2,
	preg5_1, preg5_2,
	preg6_1, preg6_2,
	preg7_1, preg7_2,
	preg8_1, preg8_2,
	preg9_1, preg9_2,
	preg10_1, preg10_2,
	preg11_1, preg11_2,
	preg12_1, preg12_2,
	preg13_1, preg13_2,
	preg14_1_desde, preg14_1_hasta, preg14_2,
	preg15_1, preg15_2,
	preg16_1, preg16_2,
	preg17_1, preg17_2,
	preg18_1, preg18_2,
	preg19_1, preg19_2,
	preg20_1, preg20_2,
	preg21_1, preg21_2,
	preg22_1, preg22_2,
	preg23_1, preg23_2 
) VALUES (
	'".$id_encuesta."',
	'".$preg1_1."', 
	'".$preg1_2."', 
	'".$preg2_1."', 
	'".$preg2_2."', 
	'".$preg3_1."', 
	'".$preg3_2."', 
	'".$preg4_1."', 
	'".$preg4_2."', 
	'".$preg5_1."', 
	'".$preg5_2."', 
	'".$preg6_1."', 
	'".$preg6_2."', 
	'".$preg7_1."', 
	'".$preg7_2."', 
	'".$preg8_1."', 
	'".$preg8_2."', 
	'".$preg9_1."', 
	'".$preg9_2."', 
	'".$preg10_1."', 
	'".$preg10_2."', 
	'".$preg11_1."', 
	'".$preg11_2."', 
	'".$preg12_1."', 
	'".$preg12_2."', 
	'".$preg13_1."', 
	'".$preg13_2."', 
	'".$preg14_1_desde."', 
	'".$preg14_1_hasta."', 
	'".$preg14_2."', 
	'".$preg15_1."', 
	'".$preg15_2."', 
	'".$preg16_1."', 
	'".$preg16_2."', 
	'".$preg17_1."', 
	'".$preg17_2."', 
	'".$preg18_1."', 
	'".$preg18_2."', 
	'".$preg19_1."', 
	'".$preg19_2."', 
	'".$preg20_1."', 
	'".$preg20_2."', 
	'".$preg21_1."', 
	'".$preg21_2."', 
	'".$preg22_1."', 
	'".$preg22_2."', 
	'".$preg23_1."', 
	'".$preg23_2."')";
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_insitu set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_insitu set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_insitu set num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

		
		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
 		$strsql="select * from qs_encuestascli_insitu 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaINSITU.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaINSITU.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>