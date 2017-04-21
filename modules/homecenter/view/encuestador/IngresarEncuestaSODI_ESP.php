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
	$strsql="select * from qs_encuestascli_sodimac_esp 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_sodimac_esp 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";
$status_historia="";

$Id1="";
$TIPO_CLIENTE="";
$Nombre="";
$Direccion="";
$Comuna="";
$CUIDAD="";
$REGION="";
$FechaNacimiento="";
$EDAD="";
$Sexo="";
$DISC_AT1="";
$FONO_AT1="";
$DISC_AT2="";
$FONO_AT2="";
$DISC_AT3="";
$FONO_AT3="";
$DISC_AT4="";
$FONO_AT4="";
$DISC_AT5="";
$FONO_AT5="";
$ddd_Cel="";
$Num_Celular="";

$status1_llamada="";
$status2_llamada="";
$status3_llamada="";
$status4_llamada="";
$status5_llamada="";

$preg1="";
$preg2_1="";
$preg2_2="";
$preg3="";
$preg4="";
$preg4_area1="";
$preg4_causa1="";
$preg4_area2="";
$preg4_causa2="";
$preg4_area3="";
$preg4_causa3="";
$preg5="";
$preg6="";
$preg6_area1="";
$preg6_causa1="";
$preg6_area2="";
$preg6_causa2="";
$preg6_area3="";
$preg6_causa3="";
$preg7="";
$preg8="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

if(isset($_POST['Id1'])) $Id1=$_POST['Id1'];
if(isset($_POST['TIPO_CLIENTE'])) $TIPO_CLIENTE=$_POST['TIPO_CLIENTE'];
if(isset($_POST['Nombre'])) $Nombre=$_POST['Nombre'];
if(isset($_POST['Direccion'])) $Direccion=$_POST['Direccion'];
if(isset($_POST['Comuna'])) $Comuna=$_POST['Comuna'];
if(isset($_POST['CUIDAD'])) $CUIDAD=$_POST['CUIDAD'];
if(isset($_POST['REGION'])) $REGION=$_POST['REGION'];
if(isset($_POST['FechaNacimiento'])) $FechaNacimiento=$_POST['FechaNacimiento'];
if(isset($_POST['EDAD'])) $EDAD=$_POST['EDAD'];
if(isset($_POST['Sexo'])) $Sexo=$_POST['Sexo'];
if(isset($_POST['DISC_AT1'])) $DISC_AT1=$_POST['DISC_AT1'];
if(isset($_POST['FONO_AT1'])) $FONO_AT1=$_POST['FONO_AT1'];
if(isset($_POST['DISC_AT2'])) $DISC_AT2=$_POST['DISC_AT2'];
if(isset($_POST['FONO_AT2'])) $FONO_AT2=$_POST['FONO_AT2'];
if(isset($_POST['DISC_AT3'])) $DISC_AT3=$_POST['DISC_AT3'];
if(isset($_POST['FONO_AT3'])) $FONO_AT3=$_POST['FONO_AT3'];
if(isset($_POST['DISC_AT4'])) $DISC_AT4=$_POST['DISC_AT4'];
if(isset($_POST['FONO_AT4'])) $FONO_AT4=$_POST['FONO_AT4'];
if(isset($_POST['DISC_AT5'])) $DISC_AT5=$_POST['DISC_AT5'];
if(isset($_POST['FONO_AT5'])) $FONO_AT5=$_POST['FONO_AT5'];
if(isset($_POST['ddd_Cel'])) $ddd_Cel=$_POST['ddd_Cel'];
if(isset($_POST['Num_Celular'])) $Num_Celular=$_POST['Num_Celular'];

if(isset($_POST['status1_llamada'])) $status1_llamada=$_POST['status1_llamada'];
if(isset($_POST['status2_llamada'])) $status2_llamada=$_POST['status2_llamada'];
if(isset($_POST['status3_llamada'])) $status3_llamada=$_POST['status3_llamada'];
if(isset($_POST['status4_llamada'])) $status4_llamada=$_POST['status4_llamada'];
if(isset($_POST['status5_llamada'])) $status5_llamada=$_POST['status5_llamada'];
if(isset($_POST['status_historia'])) $status_historia=$_POST['status_historia'];
$status_historia = $status_historia.'**'.$status1_llamada.'-'.$status2_llamada.'-'.$status3_llamada.'-'.$status4_llamada.'-'.$status5_llamada.'||';

if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg3_0_1'])) $preg3_0_1=$_POST['preg3_0_1'];
if(isset($_POST['preg3_0_2'])) $preg3_0_2=$_POST['preg3_0_2'];
if(isset($_POST['preg2_1'])) $preg2_1=$_POST['preg2_1'];
if(isset($_POST['preg2_2'])) $preg2_2=$_POST['preg2_2'];
if(isset($_POST['preg3'])) $preg3=$_POST['preg3'];
if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];
if(isset($_POST['preg4_area1'])) $preg4_area1=$_POST['preg4_area1'];
if(isset($_POST['preg4_causa1'])) $preg4_causa1=$_POST['preg4_causa1'];
if(isset($_POST['preg4_area2'])) $preg4_area2=$_POST['preg4_area2'];
if(isset($_POST['preg4_causa2'])) $preg4_causa2=$_POST['preg4_causa2'];
if(isset($_POST['preg4_area3'])) $preg4_area3=$_POST['preg4_area3'];
if(isset($_POST['preg4_causa3'])) $preg4_causa3=$_POST['preg4_causa3'];

if(isset($_POST['preg5'])) $preg5=$_POST['preg5'];
if(isset($_POST['preg6'])) $preg6=$_POST['preg6'];
if(isset($_POST['preg6_area1'])) $preg6_area1=$_POST['preg6_area1'];
if(isset($_POST['preg6_causa1'])) $preg6_causa1=$_POST['preg6_causa1'];
if(isset($_POST['preg6_area2'])) $preg6_area2=$_POST['preg6_area2'];
if(isset($_POST['preg6_causa2'])) $preg6_causa2=$_POST['preg6_causa2'];
if(isset($_POST['preg6_area3'])) $preg6_area3=$_POST['preg6_area3'];
if(isset($_POST['preg6_causa3'])) $preg6_causa3=$_POST['preg6_causa3'];

if(isset($_POST['preg7'])) $preg7=$_POST['preg7'];
if(isset($_POST['preg8'])) $preg8=$_POST['preg8'];

$StrSql="UPDATE qs_encuestascli_sodimac_esp set 
Id1  = '".$Id1."', 
TIPO_CLIENTE  = '".$TIPO_CLIENTE."', 
Nombre  = '".$Nombre."', 
Direccion  = '".$Direccion."', 
Comuna  = '".$Comuna."', 
CUIDAD  = '".$CUIDAD."', 
REGION  = '".$REGION."', 
FechaNacimiento  = '".$FechaNacimiento."', 
EDAD  = '".$EDAD."', 
Sexo  = '".$Sexo."', 
DISC_AT1  = '".$DISC_AT1."', 
FONO_AT1  = '".$FONO_AT1."', 
DISC_AT2  = '".$DISC_AT2."', 
FONO_AT2  = '".$FONO_AT2."', 
DISC_AT3  = '".$DISC_AT3."', 
FONO_AT3  = '".$FONO_AT3."', 
DISC_AT4  = '".$DISC_AT4."', 
FONO_AT4  = '".$FONO_AT4."', 
DISC_AT5  = '".$DISC_AT5."', 
FONO_AT5  = '".$FONO_AT5."', 
ddd_Cel  = '".$ddd_Cel."', 
Num_Celular  = '".$Num_Celular."', 

status1_llamada = '".$status1_llamada."', 
status2_llamada = '".$status2_llamada."', 
status3_llamada = '".$status3_llamada."', 
status4_llamada = '".$status4_llamada."', 
status5_llamada = '".$status5_llamada."', 
fec_termino = NOW()  
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_sodimac_esp where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_sodimac_esp set 
	preg1 = '".$preg1."', 
	preg3_0_1 = '".$preg3_0_1."', 
	preg3_0_2 = '".$preg3_0_2."', 
	preg2_1 = '".$preg2_1."', 
	preg2_2 = '".$preg2_2."', 
	preg3 = '".$preg3."', 
	preg4 = '".$preg4."', 
	preg4_area1 = '".$preg4_area1."', 
	preg4_causa1 = '".$preg4_causa1."', 
	preg4_area2 = '".$preg4_area2."', 
	preg4_causa2 = '".$preg4_causa2."', 
	preg4_area3 = '".$preg4_area3."', 
	preg4_causa3 = '".$preg4_causa3."', 
	preg5 = '".$preg5."', 
	preg6 = '".$preg6."', 
	preg6_area1 = '".$preg6_area1."', 
	preg6_causa1 = '".$preg6_causa1."', 
	preg6_area2 = '".$preg6_area2."', 
	preg6_causa2 = '".$preg6_causa2."', 
	preg6_area3 = '".$preg6_area3."', 
	preg6_causa3 = '".$preg6_causa3."', 
	preg7 = '".$preg7."', 
	preg8 = '".$preg8."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_sodimac_esp (id_encuesta,
	preg1,
	preg3_0_1, preg3_0_2,
	preg2_1, preg2_2,
	preg3,
	preg4,
	preg4_area1,
	preg4_causa1,
	preg4_area2,
	preg4_causa2,
	preg4_area3,
	preg4_causa3,
	preg5,
	preg6,
	preg6_area1,
	preg6_causa1,
	preg6_area2,
	preg6_causa2,
	preg6_area3,
	preg6_causa3,
	preg7,
	preg8 
) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg3_0_1."', 
	'".$preg3_0_2."', 
	'".$preg2_1."', 
	'".$preg2_2."', 
	'".$preg3."', 
	'".$preg4."', 
	'".$preg4_area1."', 
	'".$preg4_causa1."', 
	'".$preg4_area2."', 
	'".$preg4_causa2."', 
	'".$preg4_area3."', 
	'".$preg4_causa3."', 
	'".$preg5."', 
	'".$preg6."', 
	'".$preg6_area1."', 
	'".$preg6_causa1."', 
	'".$preg6_area2."', 
	'".$preg6_causa2."', 
	'".$preg6_area3."', 
	'".$preg6_causa3."', 
	'".$preg7."', 
	'".$preg8."')";
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_sodimac_esp set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_sodimac_esp set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_sodimac_esp set fec_postergada = '".$fec_postergada_format."'  
				, num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

		
		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", NOW() , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
 		$strsql="select * from qs_encuestascli_sodimac_esp 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaSODI_ESP.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>