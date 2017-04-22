<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$id_formato="";
$id_encuesta="";
$estado="";

$rut_cliente="";
$dv="";

$preg1="";
$preg2="";
$preg3="";
$preg3_1="";
$preg4_a="";
$preg4_b="";
$preg4_c="";
$preg4_d="";

$preg5_a="";
$preg5_b="";
$preg5_c="";
$preg5_d="";
$preg6_a="";
$preg6_b="";
$preg6_c="";

$preg7="";
$preg8="";
$preg9_a="";
$preg9_b="";
$preg9_c="";
$preg9_d="";
$preg9_e="";
$preg9_f="";
$preg9_g="";
$preg9_h="";
$preg10="";

$preg11="";
$preg12="";
$preg13="";
$preg13_1="";

$preg14="";
$preg15="";
$preg16="";

$preg17="";
$preg18="";

if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];

if(isset($_POST['rut_cliente'])) $rut_cliente=$_POST['rut_cliente'];
if(isset($_POST['dv'])) $dv=$_POST['dv'];

if(isset($_POST['preg1'])) $preg1=$_POST['preg1'];
if(isset($_POST['preg2'])) $preg2=$_POST['preg2'];
if(isset($_POST['preg3'])) $preg3=$_POST['preg3'];
if(isset($_POST['preg3_1'])) $preg3_1=$_POST['preg3_1'];
if(isset($_POST['preg4_a'])) $preg4_a=$_POST['preg4_a'];
if(isset($_POST['preg4_b'])) $preg4_b=$_POST['preg4_b'];
if(isset($_POST['preg4_c'])) $preg4_c=$_POST['preg4_c'];
if(isset($_POST['preg4_d'])) $preg4_d=$_POST['preg4_d'];
if(isset($_POST['preg5_a'])) $preg5_a=$_POST['preg5_a'];
if(isset($_POST['preg5_b'])) $preg5_b=$_POST['preg5_b'];
if(isset($_POST['preg5_c'])) $preg5_c=$_POST['preg5_c'];
if(isset($_POST['preg5_d'])) $preg5_d=$_POST['preg5_d'];
if(isset($_POST['preg6_a'])) $preg6_a=$_POST['preg6_a'];
if(isset($_POST['preg6_b'])) $preg6_b=$_POST['preg6_b'];
if(isset($_POST['preg6_c'])) $preg6_c=$_POST['preg6_c'];
if(isset($_POST['preg7'])) $preg7=$_POST['preg7'];
if(isset($_POST['preg8'])) $preg8=$_POST['preg8'];

if(isset($_POST['preg9_a'])) $preg9_a=$_POST['preg9_a'];
if(isset($_POST['preg9_b'])) $preg9_b=$_POST['preg9_b'];
if(isset($_POST['preg9_c'])) $preg9_c=$_POST['preg9_c'];
if(isset($_POST['preg9_d'])) $preg9_d=$_POST['preg9_d'];
if(isset($_POST['preg9_e'])) $preg9_e=$_POST['preg9_e'];
if(isset($_POST['preg9_f'])) $preg9_f=$_POST['preg9_f'];
if(isset($_POST['preg9_g'])) $preg9_g=$_POST['preg9_g'];
if(isset($_POST['preg9_h'])) $preg9_h=$_POST['preg9_h'];

if(isset($_POST['preg10'])) $preg10=$_POST['preg10'];
if(isset($_POST['preg11'])) $preg11=$_POST['preg11'];
if(isset($_POST['preg12'])) $preg12=$_POST['preg12'];
if(isset($_POST['preg13'])) $preg13=$_POST['preg13'];
if(isset($_POST['preg13_1'])) $preg13_1=$_POST['preg13_1'];
if(isset($_POST['preg14'])) $preg14=$_POST['preg14'];
if(isset($_POST['preg15'])) $preg15=$_POST['preg15'];
if(isset($_POST['preg16'])) $preg16=$_POST['preg16'];
if(isset($_POST['preg17'])) $preg17=$_POST['preg17'];
if(isset($_POST['preg18'])) $preg18=$_POST['preg18'];

require_once("../funciones/conectar.php");

$StrSql="UPDATE qs_encuestas set 
rut_cliente = ".$rut_cliente. ",
dv = ".$dv. ",
fec_termino = ADDDATE(NOW(),INTERVAL 1 HOUR),
id_acceso = ".$_SESSION['s_id_acceso']." 
where id_encuesta = ".$id_encuesta;
query_bd($StrSql);

$strsql="select * from qs_encuesta_1 where id_encuesta = '".$id_encuesta."'";
$result=consulta_bd($strsql);

if ($result)
{
	$StrSql="UPDATE qs_encuesta_1 set 
	preg1 = '".$preg1."', 
	preg2 = '".$preg2."', 
	preg3 = '".$preg3."', 
	preg3_1 = '".$preg3_1."', 
	preg4_a = '".$preg4_a."', 
	preg4_b = '".$preg4_b."', 
	preg4_c = '".$preg4_c."', 
	preg4_d = '".$preg4_d."', 
	preg5_a = '".$preg5_a."', 
	preg5_b = '".$preg5_b."', 
	preg5_c = '".$preg5_c."', 
	preg5_d = '".$preg5_d."', 
	preg6_a = '".$preg6_a."', 
	preg6_b = '".$preg6_b."', 
	preg6_c = '".$preg6_c."', 
	preg7 = '".$preg7."', 
	preg8 = '".$preg8."', 
	preg9_a = '".$preg9_a."', 
	preg9_b = '".$preg9_b."', 
	preg9_c = '".$preg9_c."', 
	preg9_d = '".$preg9_d."', 
	preg9_e = '".$preg9_e."', 
	preg9_f = '".$preg9_f."', 
	preg9_g = '".$preg9_g."', 
	preg9_h = '".$preg9_h."', 
	preg10 = '".$preg10."', 
	preg11 = '".$preg11."', 
	preg12 = '".$preg12."', 
	preg13 = '".$preg13."', 
	preg13_1 = '".$preg13_1."', 
	preg14 = '".$preg14."', 
	preg15 = '".$preg15."', 
	preg16 = '".$preg16."', 
	preg17 = '".$preg17."', 
	preg18 = '".$preg18."' 
	where id_encuesta = ".$id_encuesta;
}
else
{
	$StrSql="INSERT INTO qs_encuesta_1(id_encuesta,
	preg1,preg2,preg3, preg3_1, preg4_a, preg4_b, preg4_c, preg4_d,preg5_a, preg5_b, preg5_c, preg5_d, preg6_a, preg6_b, preg6_c,preg7,preg8, 
	preg9_a, preg9_b, preg9_c, preg9_d, preg9_e, preg9_f, preg9_g, preg9_h,
	preg10,preg11,preg12,preg13,preg13_1,preg14,preg15,preg16,preg17,preg18
	) VALUES (
	'".$id_encuesta."',
	'".$preg1."', 
	'".$preg2."', 
	'".$preg3."', 
	'".$preg3_1."', 
	'".$preg4_a."', 
	'".$preg4_b."', 
	'".$preg4_c."', 
	'".$preg4_d."', 
	'".$preg5_a."', 
	'".$preg5_b."', 
	'".$preg5_c."', 
	'".$preg5_d."', 
	'".$preg6_a."', 
	'".$preg6_b."', 
	'".$preg6_c."', 
	'".$preg7."', 
	'".$preg8."', 
	'".$preg9_a."', 
	'".$preg9_b."', 
	'".$preg9_c."', 
	'".$preg9_d."', 
	'".$preg9_e."', 
	'".$preg9_f."', 
	'".$preg9_g."', 
	'".$preg9_h."', 
	'".$preg10."', 
	'".$preg11."', 
	'".$preg12."', 
	'".$preg13."', 
	'".$preg13_1."', 
	'".$preg14."', 
	'".$preg15."', 
	'".$preg16."', 
	'".$preg17."', 
	'".$preg18."')";
}

echo $StrSql;

if(query_bd($StrSql))
{
		$StrSql="UPDATE qs_encuestas set estado = 9 
		where id_encuesta = ".$id_encuesta;
		query_bd($StrSql);

		$StrSql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
		VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Encuesta Ingresada por encuestador ".$_SESSION['s_id_acceso']."')";
		query_bd($StrSql);
 
		$url="EditarEncuesta.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=1";
		Header("Location: $url");	
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}
?>
