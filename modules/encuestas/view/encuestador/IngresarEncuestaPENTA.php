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
	$strsql="select * from qs_encuestascli_penta 
	where id_encuesta > '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. "
	order by id_encuesta";

	$result=consulta_bd($strsql);
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaPENTA.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaPENTA.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}

if ($estado2==7)
{
	$strsql="select * from qs_encuestascli_penta 
	where id_encuesta < '".$id_encuesta."' 
	and id_acceso = '".$_SESSION['s_id_acceso']."' 
	and id_formato = ".$id_formato." 
	and estado = ".$estado. " 
	order by id_encuesta desc";
	$result=consulta_bd($strsql);
	
	if ($result)
	{
		$row = mysql_fetch_array($result);
		$url="EditarEncuestaPENTA.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
	else
	{
		$url="EditarEncuestaPENTA.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
		Header("Location: $url");	
	}
}


if ($estado2==1 or $estado2==2 or $estado2==9 or $estado2==4 or $estado2==5)
{
$num_post="";
$observaciones="";
$status_historia="";

$ID="";
$NOMBRE_SUCURSAL="";
$SINIESTRO="";
$PAGADOR="";
$RUT_ASEGURADO="";
$NOMBRE_ASEGURADO="";
$FONO_ASEGURADO="";
$CELU_ASEGURADO="";
$MAIL_ASEGURADO="";
$NOMBRE_LIQUIDADOR="";
$RUT_LIQUIDADOR="";
$NOMBRE_CONSULTOR="";
$RUT_CONSULTOR="";
$DIA_DENUNCIO="";
$DIA_SINIESTRO="";
$NOMBRE_GARAGE="";
$RUT_SUCURSAL_TALLER="";
$DIA_RECIBO_CONFORME="";
$NOMBRE_CORREDOR="";
$DESC_ESTADO_SINIESTRO="";
$DESC_TIPO_DAÑO="";
$DIA_ACEPTACION_TALLER="";
$DIA_PAGO_TALLER="";

$status1_llamada="";
$status2_llamada="";
$status3_llamada="";
$status4_llamada="";
$status5_llamada="";

//$preg1="";
$preg1_2="";
$preg2="";
$preg2_a="";
$preg3="";
$preg4="";
$preg4_a="";
$preg5="";
$preg5_a="";
$preg5_a1="";
$preg5_a2="";
$preg5_a3="";
$preg5_b="";
$preg5_b1="";
$preg5_b2="";
$preg6="";
$preg7_a="";
$preg7_b="";
$preg7_c="";
$preg8_0="";
$preg8_a="";
$preg8_b="";
$preg8_b_motivo="";
$preg8_c="";
$preg8_d="";
$preg9="";
$preg10="";
$preg11_a="";
$preg11_b="";
$preg12="";
$preg13="";
$preg13_a="";
$preg13_b="";

$preg14new="";
$preg14new_a="";
$preg14new_b="";

$preg12_b="";
$preg14="";
$preg15_a="";
$preg15_b="";
$preg15_c="";
$preg16_a="";
$preg16_b="";
$preg16_c="";
$preg16_d="";
$preg16_e="";
$preg17_a="";
$preg17_b="";
$preg17_c="";
$preg17_d="";
$preg17_e="";
$preg18_a="";
$preg18_b="";
$preg18_c="";
$preg19_a="";
$preg19_b="";
$preg19_c="";
$preg19_d="";
$preg20="";
$preg21_a="";
$preg21_b="";
$preg21_c="";
$preg21_d="";
$preg21_d_1="";
$preg21_e="";
$preg21_f="";
$preg21_g="";
$preg21_h="";
$preg22="";
$preg23="";
$preg23_a="";
$preg24="";
$preg25="";
$preg25_a="";
$preg26="";
$preg26_1="";
$preg27="";
$preg28="";
$preg25_0="";
$preg25_0_a1="";
$preg25_0_c1="";
$preg25_0_a2="";
$preg25_0_c2="";
$preg25_0_a3="";
$preg25_0_c3="";
$preg29="";
$preg29_1="";
$preg30="";
$preg31="";
$preg32="";


if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];
if(isset($_POST['num_post'])) $num_post=$_POST['num_post'];
if(isset($_POST['observaciones'])) $observaciones=$_POST['observaciones'];

if(isset($_POST['ID'])) $ID=$_POST['ID'];
if(isset($_POST['NOMBRE_SUCURSAL'])) $NOMBRE_SUCURSAL=$_POST['NOMBRE_SUCURSAL'];
if(isset($_POST['SINIESTRO'])) $SINIESTRO=$_POST['SINIESTRO'];
if(isset($_POST['PAGADOR'])) $PAGADOR=$_POST['PAGADOR'];
if(isset($_POST['RUT_ASEGURADO'])) $RUT_ASEGURADO=$_POST['RUT_ASEGURADO'];
if(isset($_POST['NOMBRE_ASEGURADO'])) $NOMBRE_ASEGURADO=$_POST['NOMBRE_ASEGURADO'];
if(isset($_POST['FONO_ASEGURADO'])) $FONO_ASEGURADO=$_POST['FONO_ASEGURADO'];
if(isset($_POST['CELU_ASEGURADO'])) $CELU_ASEGURADO=$_POST['CELU_ASEGURADO'];
if(isset($_POST['MAIL_ASEGURADO'])) $MAIL_ASEGURADO=$_POST['MAIL_ASEGURADO'];
if(isset($_POST['NOMBRE_LIQUIDADOR'])) $NOMBRE_LIQUIDADOR=$_POST['NOMBRE_LIQUIDADOR'];
if(isset($_POST['RUT_LIQUIDADOR'])) $RUT_LIQUIDADOR=$_POST['RUT_LIQUIDADOR'];
if(isset($_POST['NOMBRE_CONSULTOR'])) $NOMBRE_CONSULTOR=$_POST['NOMBRE_CONSULTOR'];
if(isset($_POST['RUT_CONSULTOR'])) $RUT_CONSULTOR=$_POST['RUT_CONSULTOR'];
if(isset($_POST['DIA_DENUNCIO'])) $DIA_DENUNCIO=$_POST['DIA_DENUNCIO'];
if(isset($_POST['DIA_SINIESTRO'])) $DIA_SINIESTRO=$_POST['DIA_SINIESTRO'];
if(isset($_POST['NOMBRE_GARAGE'])) $NOMBRE_GARAGE=$_POST['NOMBRE_GARAGE'];
if(isset($_POST['RUT_SUCURSAL_TALLER'])) $RUT_SUCURSAL_TALLER=$_POST['RUT_SUCURSAL_TALLER'];
if(isset($_POST['DIA_RECIBO_CONFORME'])) $DIA_RECIBO_CONFORME=$_POST['DIA_RECIBO_CONFORME'];
if(isset($_POST['NOMBRE_CORREDOR'])) $NOMBRE_CORREDOR=$_POST['NOMBRE_CORREDOR'];
if(isset($_POST['DESC_ESTADO_SINIESTRO'])) $DESC_ESTADO_SINIESTRO=$_POST['DESC_ESTADO_SINIESTRO'];
if(isset($_POST['DESC_TIPO_DAÑO'])) $DESC_TIPO_DAÑO=$_POST['DESC_TIPO_DAÑO'];
if(isset($_POST['DIA_ACEPTACION_TALLER'])) $DIA_ACEPTACION_TALLER=$_POST['DIA_ACEPTACION_TALLER'];
if(isset($_POST['DIA_PAGO_TALLER'])) $DIA_PAGO_TALLER=$_POST['DIA_PAGO_TALLER'];

if(isset($_POST['status1_llamada'])) $status1_llamada=$_POST['status1_llamada'];
if(isset($_POST['status2_llamada'])) $status2_llamada=$_POST['status2_llamada'];
if(isset($_POST['status3_llamada'])) $status3_llamada=$_POST['status3_llamada'];
if(isset($_POST['status4_llamada'])) $status4_llamada=$_POST['status4_llamada'];
if(isset($_POST['status5_llamada'])) $status5_llamada=$_POST['status5_llamada'];
if(isset($_POST['status_historia'])) $status_historia=$_POST['status_historia'];
$status_historia = $status_historia.'**'.$status1_llamada.'-'.$status2_llamada.'-'.$status3_llamada.'-'.$status4_llamada.'-'.$status5_llamada.'||';

//if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg1_2'])) $preg1_2=$_POST['preg1_2'];
if(isset($_POST['preg2'])) $preg2=$_POST['preg2'];
if(isset($_POST['preg2_a'])) $preg2_a=$_POST['preg2_a'];
if(isset($_POST['preg3'])) $preg3=$_POST['preg3'];
if(isset($_POST['preg4'])) $preg4=$_POST['preg4'];
if(isset($_POST['preg4_a'])) $preg4_a=$_POST['preg4_a'];
if(isset($_POST['preg5'])) $preg5=$_POST['preg5'];
if(isset($_POST['preg5_a'])) $preg5_a=$_POST['preg5_a'];
if(isset($_POST['preg5_a1'])) $preg5_a1=$_POST['preg5_a1'];
if(isset($_POST['preg5_a2'])) $preg5_a2=$_POST['preg5_a2'];
if(isset($_POST['preg5_a3'])) $preg5_a3=$_POST['preg5_a3'];
if(isset($_POST['preg5_b'])) $preg5_b=$_POST['preg5_b'];
if(isset($_POST['preg5_b1'])) $preg5_b1=$_POST['preg5_b1'];
if(isset($_POST['preg5_b2'])) $preg5_b2=$_POST['preg5_b2'];
if(isset($_POST['preg5_c'])) $preg5_c=$_POST['preg5_c'];
if(isset($_POST['preg6'])) $preg6=$_POST['preg6'];
if(isset($_POST['preg7_a'])) $preg7_a=$_POST['preg7_a'];
if(isset($_POST['preg7_b'])) $preg7_b=$_POST['preg7_b'];
if(isset($_POST['preg7_c'])) $preg7_c=$_POST['preg7_c'];
if(isset($_POST['preg8_0'])) $preg8_0=$_POST['preg8_0'];
if(isset($_POST['preg8_a'])) $preg8_a=$_POST['preg8_a'];
if(isset($_POST['preg8_b'])) $preg8_b=$_POST['preg8_b'];
if(isset($_POST['preg8_b_motivo'])) $preg8_b_motivo=$_POST['preg8_b_motivo'];
if(isset($_POST['preg8_c'])) $preg8_c=$_POST['preg8_c'];
if(isset($_POST['preg8_d'])) $preg8_d=$_POST['preg8_d'];
if(isset($_POST['preg9'])) $preg9=$_POST['preg9'];
if(isset($_POST['preg10'])) $preg10=$_POST['preg10'];

if(isset($_POST['preg11_a'])) $preg11_a=$_POST['preg11_a'];
if(isset($_POST['preg11_b'])) $preg11_b=$_POST['preg11_b'];

if(isset($_POST['preg12'])) $preg12=$_POST['preg12'];

if(isset($_POST['preg13'])) $preg13=$_POST['preg13'];
if(isset($_POST['preg13_a'])) $preg13_a=$_POST['preg13_a'];
if(isset($_POST['preg13_b'])) $preg13_b=$_POST['preg13_b'];

if(isset($_POST['preg14new'])) $preg14new=$_POST['preg14new'];
if(isset($_POST['preg14new_a'])) $preg14new_a=$_POST['preg14new_a'];
if(isset($_POST['preg14new_b'])) $preg14new_b=$_POST['preg14new_b'];

if(isset($_POST['preg12_b'])) $preg12_b=$_POST['preg12_b'];

if(isset($_POST['preg14'])) $preg14=$_POST['preg14'];

if(isset($_POST['preg15_a'])) $preg15_a=$_POST['preg15_a'];
if(isset($_POST['preg15_b'])) $preg15_b=$_POST['preg15_b'];
if(isset($_POST['preg15_c'])) $preg15_c=$_POST['preg15_c'];

if(isset($_POST['preg16_a'])) $preg16_a=$_POST['preg16_a'];
if(isset($_POST['preg16_b'])) $preg16_b=$_POST['preg16_b'];
if(isset($_POST['preg16_c'])) $preg16_c=$_POST['preg16_c'];
//if(isset($_POST['preg16_d'])) $preg16_d=$_POST['preg16_d'];
if(isset($_POST['preg16_e'])) $preg16_e=$_POST['preg16_e'];

//if(isset($_POST['preg17_a'])) $preg17_a=$_POST['preg17_a'];
//if(isset($_POST['preg17_b'])) $preg17_b=$_POST['preg17_b'];
//if(isset($_POST['preg17_c'])) $preg17_c=$_POST['preg17_c'];
//if(isset($_POST['preg17_d'])) $preg17_d=$_POST['preg17_d'];
//if(isset($_POST['preg17_e'])) $preg17_e=$_POST['preg17_e'];
if(isset($_POST['preg18_a'])) $preg18_a=$_POST['preg18_a'];
if(isset($_POST['preg18_b'])) $preg18_b=$_POST['preg18_b'];
if(isset($_POST['preg18_c'])) $preg18_c=$_POST['preg18_c'];

if(isset($_POST['preg19_a'])) $preg19_a=$_POST['preg19_a'];
if(isset($_POST['preg19_b'])) $preg19_b=$_POST['preg19_b'];
if(isset($_POST['preg19_c'])) $preg19_c=$_POST['preg19_c'];
if(isset($_POST['preg19_d'])) $preg19_d=$_POST['preg19_d'];

//if(isset($_POST['preg20'])) $preg20=$_POST['preg20'];

if(isset($_POST['preg21_a'])) $preg21_a=$_POST['preg21_a'];
if(isset($_POST['preg21_b'])) $preg21_b=$_POST['preg21_b'];
if(isset($_POST['preg21_c'])) $preg21_c=$_POST['preg21_c'];
if(isset($_POST['preg21_d'])) $preg21_d=$_POST['preg21_d'];
if(isset($_POST['preg21_d_1'])) $preg21_d_1=$_POST['preg21_d_1'];
if(isset($_POST['preg21_e'])) $preg21_e=$_POST['preg21_e'];
if(isset($_POST['preg21_f'])) $preg21_f=$_POST['preg21_f'];
if(isset($_POST['preg21_g'])) $preg21_g=$_POST['preg21_g'];
if(isset($_POST['preg21_h'])) $preg21_h=$_POST['preg21_h'];

if(isset($_POST['preg22'])) $preg22=$_POST['preg22'];
if(isset($_POST['preg23'])) $preg23=$_POST['preg23'];
if(isset($_POST['preg23_a'])) $preg23_a=$_POST['preg23_a'];
if(isset($_POST['preg24'])) $preg24=$_POST['preg24'];
if(isset($_POST['preg25'])) $preg25=$_POST['preg25'];
if(isset($_POST['preg25_a'])) $preg25_a=$_POST['preg25_a'];

if(isset($_POST['preg26'])) $preg26=$_POST['preg26'];
//if(isset($_POST['preg26_1'])) $preg26_1=$_POST['preg26_1'];
if(isset($_POST['preg27'])) $preg27=$_POST['preg27'];
if(isset($_POST['preg28'])) $preg28=$_POST['preg28'];
if(isset($_POST['preg25_0'])) $preg25_0=$_POST['preg25_0'];
if(isset($_POST['preg25_0_a1'])) $preg25_0_a1=$_POST['preg25_0_a1'];
if(isset($_POST['preg25_0_c1'])) $preg25_0_c1=$_POST['preg25_0_c1'];
if(isset($_POST['preg25_0_a2'])) $preg25_0_a2=$_POST['preg25_0_a2'];
if(isset($_POST['preg25_0_c2'])) $preg25_0_c2=$_POST['preg25_0_c2'];
if(isset($_POST['preg25_0_a3'])) $preg25_0_a3=$_POST['preg25_0_a3'];
if(isset($_POST['preg25_0_c3'])) $preg25_0_c3=$_POST['preg25_0_c3'];

if(isset($_POST['preg29'])) $preg29=$_POST['preg29'];
if(isset($_POST['preg29_1'])) $preg29_1=$_POST['preg29_1'];
if(isset($_POST['preg30'])) $preg30=$_POST['preg30'];
if(isset($_POST['preg31'])) $preg31=$_POST['preg31'];
if(isset($_POST['preg32'])) $preg32=$_POST['preg32'];

//if(isset($_POST['preg13_a'])) $preg13_a=$_POST['preg13_a'];
//if(isset($_POST['preg13_b'])) $preg13_b=$_POST['preg13_b'];
//if(isset($_POST['preg13_c'])) $preg13_c=$_POST['preg13_c'];
//if(isset($_POST['preg12_d'])) $preg12_d=$_POST['preg12_d'];
//if(isset($_POST['preg13_e'])) $preg13_e=$_POST['preg13_e'];

//if(isset($_POST['preg18_a'])) $preg18_a=$_POST['preg18_a'];
//if(isset($_POST['preg18_b'])) $preg18_b=$_POST['preg18_b'];
//if(isset($_POST['preg18_c'])) $preg18_c=$_POST['preg18_c'];
//if(isset($_POST['preg18_d'])) $preg18_d=$_POST['preg18_d'];
//if(isset($_POST['preg18_e'])) $preg18_e=$_POST['preg18_e'];
//if(isset($_POST['preg18_f'])) $preg18_f=$_POST['preg18_f'];
//if(isset($_POST['preg18_g'])) $preg18_g=$_POST['preg18_g'];
//if(isset($_POST['preg18_h'])) $preg18_h=$_POST['preg18_h'];

//if(isset($_POST['preg19_a'])) $preg19_a=$_POST['preg19_a'];
//if(isset($_POST['preg19_b'])) $preg19_b=$_POST['preg19_b'];
//if(isset($_POST['preg19_c'])) $preg19_c=$_POST['preg19_c'];
//if(isset($_POST['preg19_d'])) $preg19_d=$_POST['preg19_d'];

//if(isset($_POST['preg20'])) $preg20=$_POST['preg20'];

//if(isset($_POST['preg21_a'])) $preg21_a=$_POST['preg21_a'];
//if(isset($_POST['preg21_b'])) $preg21_b=$_POST['preg21_b'];
//if(isset($_POST['preg21_c'])) $preg21_c=$_POST['preg21_c'];
//if(isset($_POST['preg21_d'])) $preg21_d=$_POST['preg21_d'];
//if(isset($_POST['preg21_e'])) $preg21_e=$_POST['preg21_e'];
//if(isset($_POST['preg21_f'])) $preg21_f=$_POST['preg21_f'];
//if(isset($_POST['preg21_g'])) $preg21_g=$_POST['preg21_g'];
//if(isset($_POST['preg21_h'])) $preg21_h=$_POST['preg21_h'];

//if(isset($_POST['preg22'])) $preg22=$_POST['preg22'];
//if(isset($_POST['preg23'])) $preg23=$_POST['preg23'];
//if(isset($_POST['preg23_a'])) $preg23_a=$_POST['preg23_a'];

//if(isset($_POST['preg24'])) $preg24=$_POST['preg24'];
//if(isset($_POST['preg25'])) $preg25=$_POST['preg25'];
//if(isset($_POST['preg25_a'])) $preg25_a=$_POST['preg25_a'];


//if(isset($_POST['preg26'])) $preg26=$_POST['preg26'];
//if(isset($_POST['preg27'])) $preg27=$_POST['preg27'];
//if(isset($_POST['preg28'])) $preg28=$_POST['preg28'];
//if(isset($_POST['preg29'])) $preg29=$_POST['preg29'];
//if(isset($_POST['preg30'])) $preg30=$_POST['preg30'];
//if(isset($_POST['preg31'])) $preg31=$_POST['preg31'];

$StrSql="UPDATE qs_encuestascli_penta set 
ID  = '".$ID."', 
NOMBRE_SUCURSAL  = '".$NOMBRE_SUCURSAL."', 
SINIESTRO  = '".$SINIESTRO."', 
PAGADOR  = '".$PAGADOR."', 
NOMBRE_ASEGURADO  = '".$NOMBRE_ASEGURADO."', 
FONO_ASEGURADO  = '".$FONO_ASEGURADO."', 
CELU_ASEGURADO  = '".$CELU_ASEGURADO."', 
MAIL_ASEGURADO  = '".$MAIL_ASEGURADO."', 
NOMBRE_LIQUIDADOR  = '".$NOMBRE_LIQUIDADOR."', 
RUT_LIQUIDADOR  = '".$RUT_LIQUIDADOR."', 
NOMBRE_CONSULTOR  = '".$NOMBRE_CONSULTOR."', 
RUT_CONSULTOR  = '".$RUT_CONSULTOR."', 
DIA_DENUNCIO  = '".$DIA_DENUNCIO."', 
DIA_SINIESTRO  = '".$DIA_SINIESTRO."', 
NOMBRE_GARAGE  = '".$NOMBRE_GARAGE."', 
RUT_SUCURSAL_TALLER  = '".$RUT_SUCURSAL_TALLER."', 
DIA_RECIBO_CONFORME  = '".$DIA_RECIBO_CONFORME."', 
NOMBRE_CORREDOR  = '".$NOMBRE_CORREDOR."', 
DESC_ESTADO_SINIESTRO  = '".$DESC_ESTADO_SINIESTRO."', 
DESC_TIPO_DAÑO  = '".$DESC_TIPO_DAÑO."', 
DIA_ACEPTACION_TALLER  = '".$DIA_ACEPTACION_TALLER."', 
DIA_PAGO_TALLER  = '".$DIA_PAGO_TALLER."', 

status1_llamada = '".$status1_llamada."', 
status2_llamada = '".$status2_llamada."', 
status3_llamada = '".$status3_llamada."', 
status4_llamada = '".$status4_llamada."', 
status5_llamada = '".$status5_llamada."', 

fec_termino = ADDDATE(NOW(),INTERVAL 1 HOUR)  
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_penta where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_penta set 
	preg1_2 = '".$preg1_2."', 
	preg2 = '".$preg2."', 
	preg2_a = '".$preg2_a."', 
	preg3 = '".$preg3."', 

	preg4 = '".$preg4."', 
	preg4_a = '".$preg4_a."', 

	preg5 = '".$preg5."', 
	preg5_a = '".$preg5_a."', 
	preg5_a1 = '".$preg5_a1."', 
	preg5_a2 = '".$preg5_a2."', 
	preg5_a3 = '".$preg5_a3."', 
	preg5_b = '".$preg5_b."', 
	preg5_b1 = '".$preg5_b1."', 
	preg5_b2 = '".$preg5_b2."', 
	
	preg6 = '".$preg6."', 
	preg7_a = '".$preg7_a."', 
	preg7_b = '".$preg7_b."', 
	preg7_c = '".$preg7_c."', 

	preg8_0 = '".$preg8_0."', 
	preg8_a = '".$preg8_a."', 
	preg8_b = '".$preg8_b."', 
	preg8_b_motivo = '".$preg8_b_motivo."', 
	preg8_c = '".$preg8_c."', 
	preg8_d = '".$preg8_d."', 

	preg9 = '".$preg9."', 
	preg10 = '".$preg10."', 
	
	preg11_a = '".$preg11_a."', 
	preg11_b = '".$preg11_b."', 
	preg12 = '".$preg12."', 
	
	preg13 = '".$preg13."', 
	preg13_a = '".$preg13_a."', 
	preg13_b = '".$preg13_b."', 

	preg14new = '".$preg14new."', 
	preg14new_a = '".$preg14new_a."', 
	preg14new_b = '".$preg14new_b."', 

	preg12_b = '".$preg12_b."', 

	preg14 = '".$preg14."', 

	preg15_a = '".$preg15_a."', 
	preg15_b = '".$preg15_b."', 
	preg15_c = '".$preg15_c."', 

	preg16_a = '".$preg16_a."', 
	preg16_b = '".$preg16_b."', 
	preg16_c = '".$preg16_c."', 
	preg16_d = '".$preg16_d."', 
	preg16_e = '".$preg16_e."', 

	preg17_a = '".$preg17_a."', 
	preg17_b = '".$preg17_b."', 
	preg17_c = '".$preg17_c."', 
	preg17_d = '".$preg17_d."', 
	preg17_e = '".$preg17_e."', 

	preg18_a = '".$preg18_a."', 
	preg18_b = '".$preg18_b."', 
	preg18_c = '".$preg18_c."', 

	preg19_a = '".$preg19_a."', 
	preg19_b = '".$preg19_b."', 
	preg19_c = '".$preg19_c."', 
	preg19_d = '".$preg19_d."', 

	preg20 = '".$preg20."', 

	preg21_a = '".$preg21_a."', 
	preg21_b = '".$preg21_b."', 
	preg21_c = '".$preg21_c."', 
	preg21_d = '".$preg21_d."', 
	preg21_d_1 = '".$preg21_d_1."', 
	preg21_e = '".$preg21_e."', 
	preg21_f = '".$preg21_f."', 
	preg21_g = '".$preg21_g."', 
	preg21_h = '".$preg21_h."', 

	preg22 = '".$preg22."', 
	preg23 = '".$preg23."', 
	preg23_a = '".$preg23_a."', 

	preg24 = '".$preg24."', 
	preg25 = '".$preg25."', 
	preg25_a = '".$preg25_a."', 

	preg26 = '".$preg26."', 
	preg26_1 = '".$preg26_1."', 
	preg27 = '".$preg27."', 
	preg28 = '".$preg28."', 
	preg25_0 = '".$preg25_0."', 
	preg25_0_a1 = '".$preg25_0_a1."', 
	preg25_0_c1 = '".$preg25_0_c1."', 
	preg25_0_a2 = '".$preg25_0_a2."', 
	preg25_0_c2 = '".$preg25_0_c2."', 
	preg25_0_a3 = '".$preg25_0_a3."', 
	preg25_0_c3 = '".$preg25_0_c3."', 

	preg29 = '".$preg29."', 
	preg29_1 = '".$preg29_1."', 
	preg30 = '".$preg30."', 
	preg31 = '".$preg31."', 
	preg32 = '".$preg32."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_penta(id_encuesta,
	preg1_2,
	preg2, preg2_a,
	preg3, 
	preg4, preg4_a,
	preg5, 
	preg5_a, preg5_a1, preg5_a2, preg5_a3, 
	preg5_b, preg5_b1, preg5_b2, 
	preg6,
	preg7_a, preg7_b,  preg7_c, 
	preg8_0,
	preg8_a, preg8_b,  preg8_b_motivo, preg8_c,  preg8_d, 
	preg9,
	preg10,
	preg11_a, preg11_b, 
	preg12,
	preg13, preg13_a, preg13_b, 
	preg14new, preg14new_a, preg14new_b, 
	preg12_b,
	preg14, 
	preg15_a, preg15_b, preg15_c, 
	preg16_a, preg16_b,  preg16_c,  preg16_d,  preg16_e, 
	preg17_a, preg17_b,  preg17_c,  preg17_d,  preg17_e, 
	preg18_a, preg18_b,  preg18_c,
	preg19_a, preg19_b,  preg19_c,  preg19_d,  
	preg20,
	preg21_a, preg21_b,  preg21_c,  preg21_d,  preg21_d_1, preg21_e,   preg21_f,   preg21_g,   preg21_h, 
	preg22,
	preg23, preg23_a,
	preg24,
	preg25, preg25_a,
	preg26, preg26_1, 
	preg27,
	preg28,
	preg25_0, preg25_0_a1, preg25_0_c1, preg25_0_a2, preg25_0_c2, preg25_0_a3, preg25_0_c3,
	preg29, preg29_1, 
	preg30,
	preg31,
	preg32
	) VALUES (
	'".$id_encuesta."',
	'".$preg1_2."', 
	'".$preg2."', 
	'".$preg2_a."', 
	'".$preg3."', 
	'".$preg4."', 
	'".$preg4_a."', 

	'".$preg5."', 
	'".$preg5_a."', 
	'".$preg5_a1."', 
	'".$preg5_a2."', 
	'".$preg5_a3."', 
	'".$preg5_b."', 
	'".$preg5_b1."', 
	'".$preg5_b2."', 
	'".$preg6."', 
	
	'".$preg7_a."', 
	'".$preg7_b."', 
	'".$preg7_c."', 

	'".$preg8_0."', 
	'".$preg8_a."', 
	'".$preg8_b."', 
	'".$preg8_b_motivo."', 
	'".$preg8_c."', 
	'".$preg8_d."', 

	'".$preg9."', 
	'".$preg10."', 
	'".$preg11_a."', 
	'".$preg11_b."', 

	'".$preg12."', 
	'".$preg13."', 
	'".$preg13_a."', 
	'".$preg13_b."', 

	'".$preg14new."', 
	'".$preg14new_a."', 
	'".$preg14new_b."', 

	'".$preg12_b."', 
	'".$preg14."', 

	'".$preg15_a."', 
	'".$preg15_b."', 
	'".$preg15_c."', 

	'".$preg16_a."', 
	'".$preg16_b."', 
	'".$preg16_c."', 
	'".$preg16_d."', 
	'".$preg16_e."', 

	'".$preg17_a."', 
	'".$preg17_b."', 
	'".$preg17_c."', 
	'".$preg17_d."', 
	'".$preg17_e."', 

	'".$preg18_a."', 
	'".$preg18_b."', 
	'".$preg18_c."', 

	'".$preg19_a."', 
	'".$preg19_b."', 
	'".$preg19_c."', 
	'".$preg19_d."', 

	'".$preg20."', 
	'".$preg21_a."', 
	'".$preg21_b."', 
	'".$preg21_c."', 
	'".$preg21_d."', 
	'".$preg21_d_1."', 
	'".$preg21_e."', 
	'".$preg21_f."', 
	'".$preg21_g."', 
	'".$preg21_h."', 

	'".$preg22."', 
	'".$preg23."', 
	'".$preg23_a."', 
	'".$preg24."', 
	'".$preg25."', 
	'".$preg25_a."', 
	'".$preg26."', 
	'".$preg26_1."', 
	'".$preg27."', 
	'".$preg28."', 
	'".$preg25_0."', 
	'".$preg25_0_a1."', 
	'".$preg25_0_c1."', 
	'".$preg25_0_a2."', 
	'".$preg25_0_c2."', 
	'".$preg25_0_a3."', 
	'".$preg25_0_c3."', 

	'".$preg29."', 
	'".$preg29_1."', 
	'".$preg30."', 
	'".$preg31."', 
	'".$preg32."')";
}

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestascli_penta set estado = ".$estado2." 
		,observaciones = '".$observaciones."'  
		,status_historia = '".$status_historia."'  
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		if ($_POST['enviar']=='POSTERGAR ENCUESTA') {
			if ($num_post >= 6) {
				$StrSql="UPDATE qs_encuestascli_penta set estado = 9, num_post = ".$num_post."  + 1  
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
			else
			{
				$StrSql="UPDATE qs_encuestascli_penta set fec_postergada = '".$fec_postergada_format."'  
				, num_post = ".$num_post."  + 1 
				where id_encuesta = ".$id_encuesta;
				query_bd($StrSql);
			}
		}

		// Inserta en qs_atenciones_HDI, como RECLAMO
		if ($estado2=="9" and $preg29_1 == "SI") {	
			$destinatario="carlos.rios@qsservicios.cl";
			$asunto="Nuevo Reclamo en Encuestas de Calidad de Siniestros | ".$nom_cliente;
			$fecha=date("Y-m-d H:i:s");
			$mensaje='Fecha Reclamo: ' .$fecha. "\r\n\r\n" .
			'Rut Cliente: ' .$RUT_ASEGURADO. "\r\n" .
			'Nombre Cliente: ' .$NOMBRE_ASEGURADO. "\r\n".
			'Fono Contacto Cliente: ' .$FONO_ASEGURADO. "\r\n".
			'Celular Cliente: ' .$CELU_ASEGURADO. "\r\n".
			'E-Mail Cliente: ' .$MAIL_ASEGURADO. "\r\n\r\n".
			'Reclamo y a quien lo dirige: ' .$preg29. "\r\n";
			
			$encabezados = 'To: carlos.rios@qsservicios.cl' . "\r\n" .
			'From: carlos.rios@qsservicios.cl' . "\r\n" .
//			'Reply-To: jcabrera@asinco.cl' . "\r\n".
//			'Cc: supervisortmk@hdi.cl, carlos.rios@qsservicios.cl' . "\r\n";
			'Cc: jotacabrera@gmail.com' . "\r\n";
//			'Bcc: jotacabrera@gmail.com' . "\r\n";
			
			// mail($destinatario, $asunto, $mensaje, $encabezados);

		}
		
		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
 		$strsql="select * from qs_encuestascli_penta 
		where id_encuesta > '".$id_encuesta."' 
		and id_acceso = '".$_SESSION['s_id_acceso']."' 
		and id_formato = ".$id_formato." 
		and estado = ".$estado. " 
		order by id_encuesta";
		
		$result=consulta_bd($strsql);
		if ($result)
		{
		
			$row = mysql_fetch_array($result);
			$url="EditarEncuestaPENTA.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");	
		}
		else
		{		
			$url="EditarEncuestaPENTA.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
			Header("Location: $url");
		}
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}

}
?>