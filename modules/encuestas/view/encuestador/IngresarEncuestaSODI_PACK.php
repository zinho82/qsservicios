<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

date_default_timezone_set('America/Santiago');
//date_default_timezone_set('America/Buenos_Aires');

$id_encuesta="";
$id_formato="";
$estado="";
$fec_postergada="";
$fec_postergada_format="";
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['fec_postergada'])) $fec_postergada=$_POST['fec_postergada'];
if ($fec_postergada <> "") 
	$fec_postergada_format=substr($fec_postergada,6,4)."-".substr($fec_postergada,3,2)."-".substr($fec_postergada,0,2)." ".substr($fec_postergada,11,8);

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
	$strsql="select * from qs_encuestascli_sodimac_pack 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_sodimac_pack 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";
$status_historia="";

$Tienda="";
$Proyecto="";
$FecPago="";
$NombreCliente="";
$Rut="";
$Fono="";
$Calle="";
$Numero="";
$Comuna="";
$Ciudad="";
$MesPagoPack="";
$Year="";

$status1_llamada="";
$status2_llamada="";
$status3_llamada="";
$status4_llamada="";
$status5_llamada="";

$preg1="";
$preg2="";
$preg2_area1="";
$preg2_causa1="";
$preg2_area2="";
$preg2_causa2="";
$preg2_area3="";
$preg2_causa3="";
$preg3a="";
$preg3b="";
$preg3c="";
$preg3d="";
$preg3e="";
$preg3f="";
$preg3g="";
$preg3h="";
$preg4="";
$preg4_mot="";
$preg5="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

if(isset($_POST['Tienda'])) $Tienda=$_POST['Tienda'];
if(isset($_POST['Proyecto'])) $Proyecto=$_POST['Proyecto'];
if(isset($_POST['FecPago'])) $FecPago=$_POST['FecPago'];
if(isset($_POST['NombreCliente'])) $NombreCliente=$_POST['NombreCliente'];
if(isset($_POST['Rut'])) $Rut=$_POST['Rut'];
if(isset($_POST['Fono'])) $Fono=$_POST['Fono'];
if(isset($_POST['Calle'])) $Calle=$_POST['Calle'];
if(isset($_POST['Numero'])) $Numero=$_POST['Numero'];
if(isset($_POST['Comuna'])) $Comuna=$_POST['Comuna'];
if(isset($_POST['Ciudad'])) $Ciudad=$_POST['Ciudad'];
if(isset($_POST['MesPagoPack'])) $MesPagoPack=$_POST['MesPagoPack'];
if(isset($_POST['Year'])) $Year=$_POST['Year'];

if(isset($_POST['status1_llamada'])) $status1_llamada=$_POST['status1_llamada'];
if(isset($_POST['status2_llamada'])) $status2_llamada=$_POST['status2_llamada'];
if(isset($_POST['status3_llamada'])) $status3_llamada=$_POST['status3_llamada'];
if(isset($_POST['status4_llamada'])) $status4_llamada=$_POST['status4_llamada'];
if(isset($_POST['status5_llamada'])) $status5_llamada=$_POST['status5_llamada'];
if(isset($_POST['status_historia'])) $status_historia=$_POST['status_historia'];
$status_historia = $status_historia.'**'.$status1_llamada.'-'.$status2_llamada.'-'.$status3_llamada.'-'.$status4_llamada.'-'.$status5_llamada.'||';

if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg2'])) $preg2=$_POST['preg2'];
if(isset($_POST['preg2_area1'])) $preg2_area1=$_POST['preg2_area1'];
if(isset($_POST['preg2_causa1'])) $preg2_causa1=$_POST['preg2_causa1'];
if(isset($_POST['preg2_area2'])) $preg2_area2=$_POST['preg2_area2'];
if(isset($_POST['preg2_causa2'])) $preg2_causa2=$_POST['preg2_causa2'];
if(isset($_POST['preg2_area3'])) $preg2_area3=$_POST['preg2_area3'];
if(isset($_POST['preg2_causa3'])) $preg2_causa3=$_POST['preg2_causa3'];
if(isset($_POST['preg3a'])) $preg3a=$_POST['preg3a'];
if(isset($_POST['preg3b'])) $preg3b=$_POST['preg3b'];
if(isset($_POST['preg3c'])) $preg3c=$_POST['preg3c'];
if(isset($_POST['preg3d'])) $preg3d=$_POST['preg3d'];
if(isset($_POST['preg3e'])) $preg3e=$_POST['preg3e'];
if(isset($_POST['preg3f'])) $preg3f=$_POST['preg3f'];
if(isset($_POST['preg3g'])) $preg3g=$_POST['preg3g'];
if(isset($_POST['preg3h'])) $preg3h=$_POST['preg3h'];
if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];
if(isset($_POST['preg4_mot'])) $preg4_mot=$_POST['preg4_mot'];
if(isset($_POST['preg5'])) $preg5=$_POST['preg5'];

$StrSql="UPDATE qs_encuestascli_sodimac_pack set 
Tienda  = '".$Tienda."', 
Proyecto  = '".$Proyecto."', 
FecPago  = '".$FecPago."', 
NombreCliente  = '".$NombreCliente."', 
Rut  = '".$Rut."', 
Fono  = '".$Fono."', 
Calle  = '".$Calle."', 
Numero  = '".$Numero."', 
Comuna  = '".$Comuna."', 
Ciudad  = '".$Ciudad."', 
MesPagoPack  = '".$MesPagoPack."', 
Year  = '".$Year."', 

status1_llamada = '".$status1_llamada."', 
status2_llamada = '".$status2_llamada."', 
status3_llamada = '".$status3_llamada."', 
status4_llamada = '".$status4_llamada."', 
status5_llamada = '".$status5_llamada."', 
fec_termino = NOW()   
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_sodimac_pack where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_sodimac_pack set 
	preg1 = '".$preg1."', 
	preg2 = '".$preg2."', 
	preg2_area1 = '".$preg2_area1."', 
	preg2_causa1 = '".$preg2_causa1."', 
	preg2_area2 = '".$preg2_area2."', 
	preg2_causa2 = '".$preg2_causa2."', 
	preg2_area3 = '".$preg2_area3."', 
	preg2_causa3 = '".$preg2_causa3."', 
	preg3a = '".$preg3a."', 
	preg3b = '".$preg3b."', 
	preg3c = '".$preg3c."', 
	preg3d = '".$preg3d."', 
	preg3e = '".$preg3e."', 
	preg3f = '".$preg3f."', 
	preg3g = '".$preg3g."', 
	preg3h = '".$preg3h."', 
	preg4 = '".$preg4."', 
	preg4_mot = '".$preg4_mot."', 
	preg5 = '".$preg5."'  
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_sodimac_pack (id_encuesta,
	preg1,
	preg2,
	preg2_area1,
	preg2_causa1,
	preg2_area2,
	preg2_causa2,
	preg2_area3,
	preg2_causa3,
	preg3a,
	preg3b,
	preg3c,
	preg3d,
	preg3e,
	preg3f,
	preg3g,
	preg3h,
	preg4,
	preg4_mot,
	preg5
) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg2."', 
	'".$preg2_area1."', 
	'".$preg2_causa1."', 
	'".$preg2_area2."', 
	'".$preg2_causa2."', 
	'".$preg2_area3."', 
	'".$preg2_causa3."', 
	'".$preg3a."', 
	'".$preg3b."', 
	'".$preg3c."', 
	'".$preg3d."', 
	'".$preg3e."', 
	'".$preg3f."', 
	'".$preg3g."', 
	'".$preg3h."', 
	'".$preg4."', 
	'".$preg4_mot."', 
	'".$preg5."')";
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_sodimac_pack set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_sodimac_pack set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_sodimac_pack set fec_postergada = '".$fec_postergada_format."'  
				, num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

 		$strsql="select * from qs_encuestascli_sodimac_pack 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaSODI_PACK.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>