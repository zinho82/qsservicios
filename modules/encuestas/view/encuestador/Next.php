<?PHP
session_start();
$id_encuesta="";
$id_formato="";
$estado="";

$estado=9;
if($_POST['enviar']=='Guardar') $estado=1;

if(isset($_POST['id_encuesta'])) $id_encuesta=$_POST['id_encuesta'];
if(isset($_POST['id_formato'])) $id_formato=$_POST['id_formato'];
if(isset($_POST['estado'])) $estado=$_POST['estado'];

$strsql="select * from qs_encuestas 
where id_encuesta > '".$id_encuesta."' and 
id_formato = ".$id_formato." and 
estado = ".$estado. "
order by id_encuesta";
$result=consulta_bd($strsql);

if ($result)
{
	$url="EditarEncuesta.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$id_formato."&estado=".$estado;
	Header("Location: $url");	
}
else
{
	$url="EditarEncuesta.php?id_encuesta=".$id_encuesta."&id_formato=".$id_formato."&estado=".$estado;
	Header("Location: $url");	
}
?>
