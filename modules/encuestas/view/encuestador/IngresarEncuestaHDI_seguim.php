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
	$strsql="select * from qs_encuestascli_hdi_seguim  
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_hdi_seguim  
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";
$status_historia="";

$rut_cliente="";
$nom_cliente="";
$direccion="";
$desc_comuna="";
$area="";
$telefono="";
$celular="";
$llamada="";
$email_particular="";
$email_oficina="";
$desc_ramo="";
$deducible="";
$patente="";
$vigencia_ini="";
$vigencia_fin="";
$siniestro="";
$fec_denuncia="";
$nom_liquidador="";
$nom_taller="";
$desc_estado="";
$fec_nac="";
$nom_intermed="";
$email_part_intermed="";
$email_ofi_intermed="";

$siniestro_adic1="";
$fec_siniestro_adic1="";
$patente_siniestro_adic1="";
$siniestro_adic2="";
$fec_siniestro_adic2="";
$patente_siniestro_adic2="";

$status1_llamada="";
$status2_llamada="";
$status3_llamada="";
$status4_llamada="";
$status5_llamada="";

$preg1="";
$preg2="";
$preg3="";
$preg4="";
$preg5="";
$preg6="";
$preg7="";
$preg8="";
$preg9="";
$preg10="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

if(isset($_POST['rut_cliente'])) $rut_cliente=$_POST['rut_cliente'];
if(isset($_POST['nom_cliente'])) $nom_cliente=$_POST['nom_cliente'];
if(isset($_POST['direccion'])) $direccion=$_POST['direccion'];
if(isset($_POST['desc_comuna'])) $desc_comuna=$_POST['desc_comuna'];
if(isset($_POST['area'])) $area=$_POST['area'];
if(isset($_POST['telefono'])) $telefono=$_POST['telefono'];
if(isset($_POST['celular'])) $celular=$_POST['celular'];
if(isset($_POST['llamada'])) $llamada=$_POST['llamada'];
if(isset($_POST['email_particular'])) $email_particular=$_POST['email_particular'];
if(isset($_POST['email_oficina'])) $email_oficina=$_POST['email_oficina'];
if(isset($_POST['desc_ramo'])) $desc_ramo=$_POST['desc_ramo'];
if(isset($_POST['deducible'])) $deducible=$_POST['deducible'];
if(isset($_POST['patente'])) $patente=$_POST['patente'];
if(isset($_POST['vigencia_ini'])) $vigencia_ini=$_POST['vigencia_ini'];
if(isset($_POST['vigencia_fin'])) $vigencia_fin=$_POST['vigencia_fin'];
if(isset($_POST['siniestro'])) $siniestro=$_POST['siniestro'];
if(isset($_POST['fec_denuncia'])) $fec_denuncia=$_POST['fec_denuncia'];
//if(isset($_POST['rut_liquidador'])) $rut_liquidador=$_POST['rut_liquidador'];
if(isset($_POST['nom_liquidador'])) $nom_liquidador=$_POST['nom_liquidador'];
//if(isset($_POST['rut_taller'])) $rut_taller=$_POST['rut_taller'];
if(isset($_POST['nom_taller'])) $nom_taller=$_POST['nom_taller'];
if(isset($_POST['desc_estado'])) $desc_estado=$_POST['desc_estado'];
if(isset($_POST['fec_nac'])) $fec_nac=$_POST['fec_nac'];
if(isset($_POST['nom_intermed'])) $nom_intermed=$_POST['nom_intermed'];
if(isset($_POST['email_part_intermed'])) $email_part_intermed=$_POST['email_part_intermed'];
if(isset($_POST['email_ofi_intermed'])) $email_ofi_intermed=$_POST['email_ofi_intermed'];

if(isset($_POST['siniestro_adic1'])) $siniestro_adic1=$_POST['siniestro_adic1'];
if(isset($_POST['fec_siniestro_adic1'])) $fec_siniestro_adic1=$_POST['fec_siniestro_adic1'];
if(isset($_POST['patente_siniestro_adic1'])) $patente_siniestro_adic1=$_POST['patente_siniestro_adic1'];
if(isset($_POST['siniestro_adic2'])) $siniestro_adic2=$_POST['siniestro_adic2'];
if(isset($_POST['fec_siniestro_adic2'])) $fec_siniestro_adic2=$_POST['fec_siniestro_adic2'];
if(isset($_POST['patente_siniestro_adic2'])) $patente_siniestro_adic2=$_POST['patente_siniestro_adic2'];

if(isset($_POST['status1_llamada'])) $status1_llamada=$_POST['status1_llamada'];
if(isset($_POST['status2_llamada'])) $status2_llamada=$_POST['status2_llamada'];
if(isset($_POST['status3_llamada'])) $status3_llamada=$_POST['status3_llamada'];
if(isset($_POST['status4_llamada'])) $status4_llamada=$_POST['status4_llamada'];
if(isset($_POST['status5_llamada'])) $status5_llamada=$_POST['status5_llamada'];
if(isset($_POST['status_historia'])) $status_historia=$_POST['status_historia'];
$status_historia = $status_historia.'**'.$status1_llamada.'-'.$status2_llamada.'-'.$status3_llamada.'-'.$status4_llamada.'-'.$status5_llamada.'||';

if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg2'])) $preg2=$_POST['preg2'];
if(isset($_POST['preg3'])) $preg3=$_POST['preg3'];
if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];
if(isset($_POST['preg5'])) $preg5=$_POST['preg5'];
if(isset($_POST['preg6'])) $preg6=$_POST['preg6'];
if(isset($_POST['preg7'])) $preg7=$_POST['preg7'];
if(isset($_POST['preg8'])) $preg8=$_POST['preg8'];
if(isset($_POST['preg9'])) $preg9=$_POST['preg9'];
if(isset($_POST['preg10'])) $preg10=$_POST['preg10'];

$StrSql="UPDATE qs_encuestascli_hdi_seguim set 
nom_cliente  = '".$nom_cliente."', 
direccion1 = '".$direccion."', 
desc_comuna  = '".$desc_comuna."', 
area1 = '".$area."', 
telefono1 = '".$telefono."', 
celular1 = '".$celular."', 
llamada = '".$llamada."', 
email_particular1 = '".$email_particular."', 
email_oficina  = '".$email_oficina."', 
deducible = '".$deducible."', 
patente = '".$patente."', 
vigencia_ini = '".$vigencia_ini."', 
vigencia_fin = '".$vigencia_fin."', 
siniestro = '".$siniestro."', 
fec_denuncia = '".$fec_denuncia."', 
nom_liquidador = '".$nom_liquidador."', 
nom_taller = '".$nom_taller."', 
desc_estado = '".$desc_estado."', 
fec_nac = '".$fec_nac."', 
nom_intermed = '".$nom_intermed."', 
email_part_intermed = '".$email_part_intermed."', 
email_ofi_intermed = '".$email_ofi_intermed."', 

siniestro_adic1 = '".$siniestro_adic1."', 
fec_siniestro_adic1 = '".$fec_siniestro_adic1."', 
patente_siniestro_adic1 = '".$patente_siniestro_adic1."', 
siniestro_adic2 = '".$siniestro_adic2."', 
fec_siniestro_adic2 = '".$fec_siniestro_adic2."', 
patente_siniestro_adic2 = '".$patente_siniestro_adic2."', 

status1_llamada = '".$status1_llamada."', 
status2_llamada = '".$status2_llamada."', 
status3_llamada = '".$status3_llamada."', 
status4_llamada = '".$status4_llamada."', 
status5_llamada = '".$status5_llamada."', 

fec_termino = ADDDATE(NOW(),INTERVAL 1 HOUR) 
where id_encuesta = ".$id_encuesta."";
query_bd($StrSql);

$strsql="select * from qs_encuesta_hdi_seguim where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_hdi_seguim set 
	preg1 = '".$preg1."', 
	preg2 = '".$preg2."', 
	preg3 = '".$preg3."', 
	preg4 = '".$preg4."', 
	preg5 = '".$preg5."', 
	preg6 = '".$preg6."', 
	preg7 = '".$preg7."', 
	preg8 = '".$preg8."', 
	preg9 = '".$preg9."', 
	preg10 = '".$preg20."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_hdi_seguim(id_encuesta,
	preg1, preg2, preg3, preg4, preg5,
	preg6, preg7, preg8, preg8, preg9, preg10  
	) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg2."', 
	'".$preg3."', 
	'".$preg4."', 
	'".$preg5."', 
	'".$preg6."', 
	'".$preg7."', 
	'".$preg8."', 
	'".$preg9."', 
	'".$preg10."')";
	
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_hdi_seguim set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
//		print $StrSql;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_hdi_seguim set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_hdi_seguim set num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

 
 		$strsql="select * from qs_encuestascli_hdi_seguim  
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaHDI_seguim.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>