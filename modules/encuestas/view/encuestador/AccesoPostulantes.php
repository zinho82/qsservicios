<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$v_correo="";
$v_clave="";

$error="";

if(isset($_GET['g_correo'])) $v_correo=$_GET['g_correo'];
if(isset($_GET['g_clave'])) $v_clave=$_GET['g_clave'];

if($v_correo=="") $error.="Debe ingresar un correo<br>";

if($v_clave=="") $error.="Debe Ingresar una clave<br>";

?>
<h1>Acceso a Postulantes</h1>
<form>
<table>
<tr><td>Correo</td><td><INPUT type="text" id="correo" value="<?PHP echo $v_correo; ?>"></td></tr>
<tr><td>Clave</td><td><INPUT type="password" id="clave"></td></tr>
<tr><td></td><td></td></tr>
<tr><td colspan="2"><INPUT type="button" name="Enviar" value="Enviar" onclick="javascript:Cargar('Postulantes/RegistroPostulantes.php?g_enviar='+this.value+'&g_correo='+correo.value+ '&g_clave='+clave.value);"></td></tr>
</table>
</form>
<?PHP
if(isset($_GET['g_enviar']))
{
	if($error<>"") 
	{
		echo "Debe completar los siguientes datos:<br>".$error;
	}
	else
	{
		require_once("../funciones/conectar.php");
		$StrSql="select * From cv_postulantes where correo='".$v_correo."'";

		$result=consulta_bd($StrSql);

		if($result=="")
		{
			echo "Error";
		}
		else
		{
			if ($row = mysql_fetch_array($result))
			{
				if($row['clave']==$v_clave)
				{
					$_SESSION['s_postulante']=$row['id_postulante'];
					$_SESSION['s_nombre']=$row['Nombres'];
					$_SESSION['s_contacto']=$row['contacto'];
					$_SESSION['s_correo']=$row['correo'];
					$url="RegistroPostulantes.php";
					Header("Location: $url");
				}
				else
				{
					echo "Erro usuario y/o clave no existe";
				}
			}
		}
	}
}
?>
<h1><a href="#" onclick="javascript:Cargar('Postulantes/NuevoPostulante.php');">Nuevo Postulante</a></h1>
