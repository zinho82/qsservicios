<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

date_default_timezone_set('America/Santiago');
//date_default_timezone_set('America/Buenos_Aires');

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
	$strsql="select * from qs_encuestascli_hdi 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaHDI.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaHDI.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_hdi 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaHDI.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaHDI.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
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
//$rut_liquidador="";
$nom_liquidador="";
//$rut_taller="";
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
$preg1_5="";
$preg2_a="";
$preg2_b="";
$preg2_c="";
$preg3_a="";
$preg3_a_2="";
$preg3_b="";
$preg3_c="";
$preg3_d="";
$preg3_e="";
$preg3_e_1="";
$preg4="";

$preg5_a="";
$preg5_b="";
$preg5_c="";
$preg6_a="";
$preg6_a_1="";
$preg6_b="";

$preg7="";
$preg8_a="";
$preg8_b="";
$preg8_c="";
$preg8_d="";
$preg8_e="";
$preg8_f="";
$preg8_g="";
$preg8_h="";
$preg9="";
$preg10="";
$preg10_a="";
$preg10_1="";

$preg11="";
$preg12_a="";
$preg12_b="";
$preg12_c="";
$preg12_d="";
$preg12_e="";
$preg12_f="";
$preg13="";

$preg14_a="";
$preg14_b="";
$preg14_c="";
$preg14_d="";
$preg14_d_1="";
$preg15="";
$preg16="";
$preg17="";
$preg17_1="";
$preg18="";
$preg19="";
$preg20="";

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
if(isset($_POST['preg1_5'])) $preg1_5=$_POST['preg1_5'];

if(isset($_POST['preg2_a'])) $preg2_a=$_POST['preg2_a'];
if(isset($_POST['preg2_b'])) $preg2_b=$_POST['preg2_b'];
if(isset($_POST['preg2_c'])) $preg2_c=$_POST['preg2_c'];

if(isset($_POST['preg3_a'])) $preg3_a=$_POST['preg3_a'];
if(isset($_POST['preg3_a_2'])) $preg3_a_2=$_POST['preg3_a_2'];
if(isset($_POST['preg3_b'])) $preg3_b=$_POST['preg3_b'];
if(isset($_POST['preg3_c'])) $preg3_c=$_POST['preg3_c'];
if(isset($_POST['preg3_d'])) $preg3_d=$_POST['preg3_d'];
if(isset($_POST['preg3_e'])) $preg3_e=$_POST['preg3_e'];
if(isset($_POST['preg3_e_1'])) $preg3_e_1=$_POST['preg3_e_1'];

if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];

if(isset($_POST['preg5_a'])) $preg5_a=$_POST['preg5_a'];
if(isset($_POST['preg5_b'])) $preg5_b=$_POST['preg5_b'];
if(isset($_POST['preg5_c'])) $preg5_c=$_POST['preg5_c'];

if(isset($_POST['preg6_a'])) $preg6_a=$_POST['preg6_a'];
if(isset($_POST['preg6_a_1'])) $preg6_a_1=$_POST['preg6_a_1'];
if(isset($_POST['preg6_b'])) $preg6_b=$_POST['preg6_b'];

if(isset($_POST['preg7'])) $preg7=$_POST['preg7'];
if(isset($_POST['preg8_a'])) $preg8_a=$_POST['preg8_a'];
if(isset($_POST['preg8_b'])) $preg8_b=$_POST['preg8_b'];
if(isset($_POST['preg8_c'])) $preg8_c=$_POST['preg8_c'];
if(isset($_POST['preg8_d'])) $preg8_d=$_POST['preg8_d'];
if(isset($_POST['preg8_e'])) $preg8_e=$_POST['preg8_e'];
if(isset($_POST['preg8_f'])) $preg8_f=$_POST['preg8_f'];
if(isset($_POST['preg8_g'])) $preg8_g=$_POST['preg8_g'];
if(isset($_POST['preg8_h'])) $preg8_h=$_POST['preg8_h'];

if(isset($_POST['preg9'])) $preg9=$_POST['preg9'];

if(isset($_POST['preg10'])) $preg10=$_POST['preg10'];
if(isset($_POST['preg10_a'])) $preg10_a=$_POST['preg10_a'];
if(isset($_POST['preg10_1'])) $preg10_1=$_POST['preg10_1'];
if(isset($_POST['preg11'])) $preg11=$_POST['preg11'];

if(isset($_POST['preg12_a'])) $preg12_a=$_POST['preg12_a'];
if(isset($_POST['preg12_b'])) $preg12_b=$_POST['preg12_b'];
if(isset($_POST['preg12_c'])) $preg12_c=$_POST['preg12_c'];
if(isset($_POST['preg12_d'])) $preg12_d=$_POST['preg12_d'];
if(isset($_POST['preg12_e'])) $preg12_e=$_POST['preg12_e'];
if(isset($_POST['preg12_f'])) $preg12_f=$_POST['preg12_f'];

if(isset($_POST['preg13'])) $preg13=$_POST['preg13'];
if(isset($_POST['preg14_a'])) $preg14_a=$_POST['preg14_a'];
if(isset($_POST['preg14_b'])) $preg14_b=$_POST['preg14_b'];
if(isset($_POST['preg14_c'])) $preg14_c=$_POST['preg14_c'];
if(isset($_POST['preg14_d'])) $preg14_d=$_POST['preg14_d'];
if(isset($_POST['preg14_d_1'])) $preg14_d_1=$_POST['preg14_d_1'];
if(isset($_POST['preg15'])) $preg15=$_POST['preg15'];
if(isset($_POST['preg16'])) $preg16=$_POST['preg16'];
if(isset($_POST['preg17'])) $preg17=$_POST['preg17'];
if(isset($_POST['preg17_1'])) $preg17_1=$_POST['preg17_1'];
if(isset($_POST['preg18'])) $preg18=$_POST['preg18'];
if(isset($_POST['preg19'])) $preg19=$_POST['preg19'];
if(isset($_POST['preg20'])) $preg20=$_POST['preg20'];

$StrSql="UPDATE qs_encuestascli_hdi set 
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

$strsql="select * from qs_encuesta_hdi where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_hdi set 
	preg1 = '".$preg1."', 
	preg1_5 = '".$preg1_5."', 
	preg2_a = '".$preg2_a."', 
	preg2_b = '".$preg2_b."', 
	preg2_c = '".$preg2_c."', 
	preg3_a = '".$preg3_a."', 
	preg3_a_2 = '".$preg3_a_2."', 
	preg3_b = '".$preg3_b."', 
	preg3_c = '".$preg3_c."', 
	preg3_d = '".$preg3_d."', 
	preg3_e = '".$preg3_e."', 
	preg3_e_1 = '".$preg3_e_1."', 
	preg4 = '".$preg4."', 
	preg5_a = '".$preg5_a."', 
	preg5_b = '".$preg5_b."', 
	preg5_c = '".$preg5_c."', 
	preg6_a = '".$preg6_a."', 
	preg6_a_1 = '".$preg6_a_1."', 
	preg6_b = '".$preg6_b."', 
	preg7 = '".$preg7."', 
	preg8_a = '".$preg8_a."', 
	preg8_b = '".$preg8_b."', 
	preg8_c = '".$preg8_c."', 
	preg8_d = '".$preg8_d."', 
	preg8_e = '".$preg8_e."', 
	preg8_f = '".$preg8_f."', 
	preg8_g = '".$preg8_g."', 
	preg8_h = '".$preg8_h."', 
	preg9 = '".$preg9."', 
	preg10 = '".$preg10."', 
	preg10_a = '".$preg10_a."', 
	preg10_1 = '".$preg10_1."', 
	preg11 = '".$preg11."', 
	preg12_a = '".$preg12_a."', 
	preg12_b = '".$preg12_b."', 
	preg12_c = '".$preg12_c."', 
	preg12_d = '".$preg12_d."', 
	preg12_e = '".$preg12_e."', 
	preg12_f = '".$preg12_f."', 
	preg13 = '".$preg13."', 
	preg14_a = '".$preg14_a."', 
	preg14_b = '".$preg14_b."', 
	preg14_c = '".$preg14_c."', 
	preg14_d = '".$preg14_d."', 
	preg14_d_1 = '".$preg14_d_1."', 
	preg15 = '".$preg15."', 
	preg16 = '".$preg16."', 
	preg17 = '".$preg17."', 
	preg17_1 = '".$preg17_1."', 
	preg18 = '".$preg18."', 
	preg19 = '".$preg19."', 
	preg20 = '".$preg20."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_hdi(id_encuesta,
	preg1,preg1_5,preg2_a,preg2_b,preg2_c,
	preg3_a, preg3_a_2, preg3_b, preg3_c, preg3_d, preg3_e, preg3_e_1,
	preg4, preg5_a, preg5_b, preg5_c, preg6_a, preg6_a_1, preg6_b, preg7,
	preg8_a, preg8_b, preg8_c, preg8_d, preg8_e, preg8_f, preg8_g, preg8_h, 
	preg9, 
	preg10, preg10_a, preg10_1, preg11,
	preg12_a, preg12_b, preg12_c, preg12_d, preg12_e, preg12_f, 
	preg13,
	preg14_a, preg14_b, preg14_c, preg14_d, preg14_d_1, 
	preg15,preg16,preg17,preg17_1,preg18, preg19, preg20 
	) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg1_5."', 
	'".$preg2_a."', 
	'".$preg2_b."', 
	'".$preg2_c."', 
	'".$preg3_a."', 
	'".$preg3_a_2."', 
	'".$preg3_b."', 
	'".$preg3_c."', 
	'".$preg3_d."', 
	'".$preg3_e."', 
	'".$preg3_e_1."', 
	'".$preg4."', 
	'".$preg5_a."', 
	'".$preg5_b."', 
	'".$preg5_c."', 
	'".$preg6_a."', 
	'".$preg6_a_1."', 
	'".$preg6_b."', 
	'".$preg7."', 
	'".$preg8_a."', 
	'".$preg8_b."', 
	'".$preg8_c."', 
	'".$preg8_d."', 
	'".$preg8_e."', 
	'".$preg8_f."', 
	'".$preg8_g."', 
	'".$preg8_h."', 
	'".$preg9."', 
	'".$preg10."', 
	'".$preg10_a."', 
	'".$preg10_1."', 
	'".$preg11."', 
	'".$preg12_a."', 
	'".$preg12_b."', 
	'".$preg12_c."', 
	'".$preg12_d."', 
	'".$preg12_e."', 
	'".$preg12_f."', 
	'".$preg13."', 
	'".$preg14_a."', 
	'".$preg14_b."', 
	'".$preg14_c."', 
	'".$preg14_d."', 
	'".$preg14_d_1."', 
	'".$preg15."', 
	'".$preg16."', 
	'".$preg17."', 
	'".$preg17_1."', 
	'".$preg18."', 
	'".$preg19."', 
	'".$preg20."')";
	
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_hdi set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
//		print $StrSql;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_hdi set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_hdi set num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

		// Inserta en qs_atenciones_HDI, como RECLAMO
		if ($estado2=="9" and $preg17 == "SI") {
			$StrSql="insert into qs_atenciones_hdi (fec_atencion, tipo_atencion, rut, nombres, fono1, fono2, email, patente_reclamo, siniestro_reclamo, a_quien_reclamo, tipo_reclamo, motivo_reclamo 
			) VALUES (
			ADDDATE(NOW(),INTERVAL 1 HOUR),
			'ENCUESTA', 
			'".$rut_cliente."', 
			'".$nom_cliente."', 
			'".$area."-".$telefono."', 
			'".$celular."', 
			'".$email_particular."', 
			'".$patente."', 
			'".$siniestro."', 
			'".$preg18."', 
			'".$preg19."', 
			'".$preg20."')";
//			echo $StrSql;
			query_bd($StrSql);
			
			$destinatario="servicioalcliente@hdi.cl";
			$asunto="Nuevo Reclamo en Encuestas de Calidad de Siniestros | ".$nom_cliente;
			$fecha=date("Y-m-d H:i:s");
			$mensaje='Fecha Reclamo: ' .$fecha. "\r\n\r\n" .
			'Rut Cliente: ' .$rut_cliente. "\r\n" .
			'Nombre Cliente: ' .$nom_cliente. "\r\n".
			'Fono Contacto Cliente: ' .$area. '-' .$telefono. "\r\n".
			'Celular Cliente: ' .$celular. "\r\n".
			'E-Mail Cliente: ' .$email_particular. "\r\n\r\n".
			'Patente: ' .$patente. "\r\n".
			'N° Siniestro: ' .$siniestro. "\r\n\r\n".
			'A quien dirige el Reclamo: ' .$preg18. "\r\n\r\n".
			'Tipo de Reclamo: ' .$preg19. "\r\n\r\n".
			'Motivo del Reclamo: ' .$preg20. "\r\n";
			
			$encabezados = 'To: servicioalcliente@hdi.cl' . "\r\n" .
			'From: carlos.rios@qsservicios.cl' . "\r\n" .
//			'Reply-To: jcabrera@asinco.cl' . "\r\n".
			'Cc: telemarketing@hdi.cl, carlos.rios@qsservicios.cl' . "\r\n";
//			'Bcc: jotacabrera@gmail.com' . "\r\n";
			
			mail($destinatario, $asunto, $mensaje, $encabezados);

		}

		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
 		$strsql="select * from qs_encuestascli_hdi 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaHDI.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaHDI.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>