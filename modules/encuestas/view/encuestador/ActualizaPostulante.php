<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

function ValidaDVRut($rut) {
 
    $tur = strrev($rut);
    $mult = 2;
	$suma=0;
 
    for ($i = 0; $i <= strlen($tur); $i++) { 
       if ($mult > 7) $mult = 2; 
 
       $suma = $mult * substr($tur, $i, 1) + $suma;
       $mult = $mult + 1;
    }
 
    $valor = 11 - ($suma % 11);
 
    if ($valor == 11) { 
        $codigo_veri = "0";
      } elseif ($valor == 10) {
        $codigo_veri = "k";
      } else { 
        $codigo_veri = $valor;
    }
  return $codigo_veri;
}

$idpostulante="";
$nombre="";
$apaterno="";
$amaterno="";
$rut="";
$dv="";
$sexo="";
$edad=0;
$telefono="";
$celular="";
$correo="";
$direccion="";
$region=0;
$comuna=0;
$provincia=0;
$niveleducacional=0;

$sence="";
$seccion1="";
$subseccion1="";
$perfiles1="";

$experiencia1=0;
$motivacion1=0;
$renta1=0;
$otraregion1=0;
$otraprovincia1=0;
$otracomuna1=0;

$seccion2="";
$subseccion2="";
$perfiles2="";

$experiencia2=0;
$motivacion2=0;
$renta2=0;
$otraregion2=0;
$otraprovincia2=0;
$otracomuna2=0;

$disponibilidad=0;
$personalidad=0;

echo "region:".$_POST['otraregion1'];

if(isset($_POST['idpostulante'])) $idpostulante=$_POST['idpostulante'];

$_SESSION['s_id_postulante']=$idpostulante;

if(isset($_POST['nombre'])) $nombre=$_POST['nombre'];
if(isset($_POST['apaterno'])) $apaterno=$_POST['apaterno'];
if(isset($_POST['amaterno'])) $amaterno=$_POST['amaterno'];
if(isset($_POST['rut'])) $rut=$_POST['rut'];
if(isset($_POST['dv'])) $dv=$_POST['dv'];
if(isset($_POST['sexo'])) $sexo=$_POST['sexo'];
if(isset($_POST['edad'])) $edad=$_POST['edad'];
if(isset($_POST['contacto'])) $telefono=$_POST['contacto'];
if(isset($_POST['celular'])) $celular=$_POST['celular'];
if(isset($_POST['correo'])) $correo=$_POST['correo'];
if(isset($_POST['direccion'])) $direccion=$_POST['direccion'];
if(isset($_POST['region'])) $region=$_POST['region'];
if(isset($_POST['comuna'])) $comuna=$_POST['comuna'];
if(isset($_POST['provincia'])) $provincia=$_POST['provincia'];
if(isset($_POST['niveleducacional'])) $niveleducacional=$_POST['niveleducacional'];

if(isset($_POST['sence'])) $sence=$_POST['sence'];
if(isset($_POST['seccion1'])) $seccion1=$_POST['seccion1'];
if(isset($_POST['subseccion1'])) $subseccion1=$_POST['subseccion1'];
if(isset($_POST['perfiles1'])) $perfiles1=$_POST['perfiles1'];
if(isset($_POST['unidadcl1'])) $unidadcl1=$_POST['unidadcl1'];
if(isset($_POST['experiencia1'])) $experiencia1=$_POST['experiencia1'];
if(isset($_POST['motivacion1'])) $motivacion1=$_POST['motivacion1'];
if(isset($_POST['renta1'])) $renta1=$_POST['renta1'];
if(isset($_POST['otraregion1'])) $otraregion1=$_POST['otraregion1'];
if(isset($_POST['otraprovincia1'])) $otraprovincia1=$_POST['otraprovincia1'];
if(isset($_POST['otracomuna1'])) $otracomuna1=$_POST['otracomuna1'];

if(isset($_POST['seccion2'])) $seccion2=$_POST['seccion2'];
if(isset($_POST['subseccion2'])) $subseccion2=$_POST['subseccion2'];
if(isset($_POST['perfiles2'])) $perfiles2=$_POST['perfiles2'];
if(isset($_POST['unidadcl2'])) $unidadcl2=$_POST['unidadcl2'];
if(isset($_POST['experiencia2'])) $experiencia2=$_POST['experiencia2'];
if(isset($_POST['motivacion2'])) $motivacion2=$_POST['motivacion2'];
if(isset($_POST['renta2'])) $renta2=$_POST['renta2'];
if(isset($_POST['otraregion2'])) $otraregion2=$_POST['otraregion2'];
if(isset($_POST['otraprovincia2'])) $otraprovincia2=$_POST['otraprovincia2'];
if(isset($_POST['otracomuna2'])) $otracomuna2=$_POST['otracomuna2'];

if(isset($_POST['disponibilidad'])) $disponibilidad=$_POST['disponibilidad'];
if(isset($_POST['personalidad'])) $personalidad=$_POST['personalidad'];

if($unidadcl1[0]=="") 
	$unidadcl11=0;
else 
	$unidadcl11=$unidadcl1[0];

if($unidadcl1[1]=="") 
	$unidadcl12=0;
else 
	$unidadcl12=$unidadcl1[1];

if($unidadcl1[2]=="") 
	$unidadcl13=0;
else 
	$unidadcl13=$unidadcl1[2];

if($unidadcl1[3]=="") 
	$unidadcl14=0;
else 
	$unidadcl14=$unidadcl1[3];

if($unidadcl1[4]=="") 
	$unidadcl15=0;
else 
	$unidadcl15=$unidadcl1[4];

if($unidadcl2[0]=="") 
	$unidadcl21=0;
else 
	$unidadcl21=$unidadcl2[0];

if($unidadcl2[1]=="") 
	$unidadcl22=0;
else 
	$unidadcl22=$unidadcl2[1];

if($unidadcl2[2]=="") 
	$unidadcl23=0;
else 
	$unidadcl23=$unidadcl2[2];

if($unidadcl2[3]=="") 
	$unidadcl24=0;
else 
	$unidadcl24=$unidadcl2[3];

if($unidadcl2[4]=="") 
	$unidadcl25=0;
else 
	$unidadcl25=$unidadcl2[4];	
//ucp1a='".$unidadcl11."',

$dvaux=ValidaDVRut($rut);
if($dvaux<>$dv) $dv=$dvaux;
	
$StrSql="update cv_postulantes set 
Nombres=UPPER('".$nombre."'),
ape_paterno=UPPER('".$apaterno."'),
ape_materno=UPPER('".$amaterno."'),
rut='".$rut."',
dv='".$dv."',
sexo='".$sexo."',
edad='".$edad."',
telefono='".$telefono."',
celular='".$celular."',
correo='".$correo."',
direccion=UPPER('".$direccion."'),
region='".$region."',
provincia='".$provincia."',
comuna='".$comuna."',
niveleducacional='".$niveleducacional."',

sence='".$sence."',

CodSector1='".$seccion1."',
CodSubSector1='".$subseccion1."',
CodPerfil1='".$perfiles1."',
ucp1a='".$unidadcl11."',
ucp1b='".$unidadcl12."',
ucp1c='".$unidadcl13."',
ucp1d='".$unidadcl14."',
ucp1e='".$unidadcl15."',
experiencia1='".$experiencia1."',
motivacion1='".$motivacion1."',
renta1='".$renta1."',

mismaregion1='".$otraregion1."',
mismaprovincia1='".$otraprovincia1."',
mismacomuna1='".$otracomuna1."',

CodSector2='".$seccion2."',
CodSubSector2='".$subseccion2."',
CodPerfil2='".$perfiles2."',
ucp2a='".$unidadcl21."',
ucp2b='".$unidadcl22."',
ucp2c='".$unidadcl23."',
ucp2d='".$unidadcl24."',
ucp2e='".$unidadcl25."',
experiencia2='".$experiencia2."',
motivacion2='".$motivacion2."',
renta2='".$renta2."',
disponibilidad='".$disponibilidad."',

personalidad='".$personalidad."' where id_postulante='".$idpostulante."'";

//alert($StrSql);

require_once("../funciones/conectar.php");

if(query_bd($StrSql))
{
	//echo $StrSql;

	$id=$idpostulante;

	$archivo_cv = $_FILES['file_cv']['name'];
	echo "<br>archivo:".$archivo_cv;
	if($archivo_cv<>"")
	{
		$ext = strrchr($archivo_cv,'.');
		$archivo=$id.$ext;
		if (move_uploaded_file($_FILES['file_cv']['tmp_name'], "../archivos/cv/".$archivo))
		{
			$StrSql="UPDATE cv_postulantes SET 
			cv = '".$archivo."'
			WHERE cv_postulantes.id_postulante =".$id."";

			query_bd($StrSql);
		}
	}
	$archivo_cartareferencia = $_FILES['file_cartareferencia']['name'];
	if($archivo_cv<>"")
	{
		$ext = strrchr($archivo_cartareferencia,'.');
		$archivo=$id.$ext;
		if (move_uploaded_file($_FILES['file_cartareferencia']['tmp_name'], "../archivos/cartareferencia/".$archivo))
		{
			$StrSql="UPDATE cv_postulantes SET
			cartareferencia = '".$archivo."'
			WHERE cv_postulantes.id_postulante =".$id."";

			query_bd($StrSql);
		}
	}

	$archivo_certificadocurso = $_FILES['file_certificadocurso']['name'];
	if($archivo_cv<>"")
	{
		$ext = strrchr($archivo_certificadocurso,'.');
		$archivo=$id.$ext;
		if (move_uploaded_file($_FILES['file_certificadocurso']['tmp_name'], "../archivos/certificadocurso/".$archivo))
		{
			$StrSql="UPDATE cv_postulantes SET
			certificadocurso = '".$archivo."'
			WHERE cv_postulantes.id_postulante =".$id."";

			query_bd($StrSql);
		}
	}

	$archivo_certificadosence = $_FILES['file_certificadosence']['name'];
	if($archivo_cv<>"")
	{
		$ext = strrchr($archivo_certificadosence,'.');
		$archivo=$id.$ext;
		if (move_uploaded_file($_FILES['file_certificadosence']['tmp_name'], "../archivos/certificadosence/".$archivo))
		{
			$StrSql="UPDATE cv_postulantes SET
			certificadosence = '".$archivo."'
			WHERE cv_postulantes.id_postulante =".$id."";

			query_bd($StrSql);
		}
	}

	$archivo_otro = $_FILES['file_otro']['name'];
	if($archivo_cv<>"")
	{
		$ext = strrchr($archivo_otro,'.');
		$archivo=$id.$ext;
		if (move_uploaded_file($_FILES['file_otro']['tmp_name'], "../archivos/otro/".$archivo))
		{
			$StrSql="UPDATE cv_postulantes SET 
			otro = '".$archivo."'
			WHERE cv_postulantes.id_postulante =".$id."";

			query_bd($StrSql);
		}
	}

	$StrSql="insert into cv_eventos (id_acceso, id_postulante, fec_evento, gls_evento) 
	VALUES (".$_SESSION['s_id_acceso'].",".$id.", ADDDATE(NOW(),INTERVAL 1 HOUR), 'Graba Datos Postulante Rut:".$rut."')";
	query_bd($StrSql);
	echo $StrSql;
	
	$url="EncuestaI.php";
	Header("Location: $url");
}
else
{
	echo "<p>Error al grabar los datos".$StrSql."</p>";
}
?>
