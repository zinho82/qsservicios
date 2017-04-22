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

$rut="";
$dv="";
$nombre="";
$apaterno="";
$amaterno="";
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
$unidadcl1="";
$experiencia1=0;
$motivacion1=0;
$renta1=0;
$otraregion1=0;
$otraprovincia1=0;
$otracomuna1=0;

$seccion2="";
$subseccion2="";
$perfiles2="";
$unidadcl2="";
$experiencia2=0;
$motivacion2=0;
$renta2=0;
$otraregion2=0;
$otraprovincia2=0;
$otracomuna2=0;

$disponibilidad=0;
$personalidad=0;

if(isset($_POST['rut'])) $rut=$_POST['rut'];
if(isset($_POST['dv'])) $dv=$_POST['dv'];
if(isset($_POST['nombre'])) $nombre=$_POST['nombre'];
if(isset($_POST['apaterno'])) $apaterno=$_POST['apaterno'];
if(isset($_POST['amaterno'])) $amaterno=$_POST['amaterno'];
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

require_once("../funciones/conectar.php");

//$StrSql="select * From cv_postulantes where	rut='".$rut."' and estado > 0";
//$result=consulta_bd($StrSql);
//$row = mysql_fetch_array($result);
//if($rut==$row['rut']) 
//{
//	$url="error_jc.php?error=<p><h2>Rut ".$row['rut']."-".$row['dv']." asociado a ".$row['Nombres']." ".$row['ape_paterno']." ".$row['ape_materno']." ya existe en la Base de Datos</h2>";
//	Header("Location: $url");
//}
//else
//{
//	$dvaux=ValidaDVRut($rut);
//	if($dvaux<>$dv) 
//	{
//		$url="error_jc.php?error=<p><h2>Digito Verificador incorrecto para Rut ".$rut."-".$dv." / Digito debe ser ".$dvaux."</h2>";
//		Header("Location: $url");
//	}
//	else
//	{
	if($unidadcl1[0]=="") 
		$unidadcl11=0;
	else 
		$unidadcl11=$unidadcl1[0];
	
	if($unidadcl1[1]=="") 
		$unidadcl12=0;
	else 
		$unidadcl12=$unidadcl1[1];
	
	if($unidadcl2[0]=="") 
		$unidadcl21=0;
	else 
		$unidadcl21=$unidadcl2[0];
	
	if($unidadcl2[1]=="") 
		$unidadcl22=0;
	else 
		$unidadcl22=$unidadcl2[1];

	$dvaux=ValidaDVRut($rut);
	if($dvaux<>$dv) $dv=$dvaux;
	
	$StrSql="INSERT INTO cv_postulantes (
	Nombres ,
	ape_paterno ,
	ape_materno ,
	rut ,
	dv ,
	sexo ,
	edad ,
	correo ,
	telefono ,
	celular ,
	direccion, 
	
	region ,
	provincia ,
	comuna ,
	niveleducacional ,
	
	sence ,
	fecha_ingreso,
	estado ,
	fecha_estado,
	
	CodSector1 ,
	CodSubSector1 ,
	CodPerfil1 ,
	ucp1a ,
	ucp1b ,
	experiencia1 ,
	motivacion1 ,
	renta1 ,
	
	mismaregion1 ,
	mismaprovincia1 ,
	mismacomuna1 ,
	
	CodSector2 ,
	CodSubSector2 ,
	CodPerfil2 ,
	ucp2a ,
	ucp2b ,
	experiencia2 ,
	motivacion2 ,
	renta2 ,
	
	disponibilidad ,
	personalidad ,
	id_acceso
	)
	VALUES (UPPER('".$nombre."'),UPPER('".$apaterno."'),UPPER('".$amaterno."'),'".$rut."','".$dv."','".$sexo."','".$edad."','".$correo."','".$telefono."','".$celular."',UPPER('".$direccion."'),'".$region."','".$provincia."','".$comuna."','".$niveleducacional."','".$sence."', ADDDATE(NOW(),INTERVAL 1 HOUR) ,'1', ADDDATE(NOW(),INTERVAL 1 HOUR) ,'".$seccion1."','".$subseccion1."','".$perfiles1."','".$unidadcl11."','".$unidadcl12."','".$experiencia1."','".$motivacion1."','".$renta1."','".$otraregion1."','".$otraprovincia1."','".$otracomuna1."','".$seccion2."','".$subseccion2."','".$perfiles2."','".$unidadcl21."','".$unidadcl22."','".$experiencia2."','".$motivacion2."','".$renta2."','".$disponibilidad."','".$personalidad."','".$_SESSION['s_id_acceso']."')";
	
	if(query_bd($StrSql))
	{
		$cv='0';
		$cartareferencia='0';
		$certificadocurso='0';
		$certificadosence='0';
		$otro='0';
	
		$id=$_SESSION['ultimo_id'];
		$_SESSION['s_id_postulante']=$id;
	
		$archivo_cv = $_FILES['file_cv']['name'];
		if($archivo_cv<>"")
		{
			$ext = strrchr($archivo_cv,'.');
			$archivo=$id.$ext;
			if (move_uploaded_file($_FILES['file_cv']['tmp_name'], "../archivos/cv/".$archivo))
			{
				$cv=$archivo;
			}
		}
		$archivo_cartareferencia = $_FILES['file_cartareferencia']['name'];
		if($archivo_cv<>"")
		{
			$ext = strrchr($archivo_cartareferencia,'.');
			$archivo=$id.$ext;
			if (move_uploaded_file($_FILES['file_cartareferencia']['tmp_name'], "../archivos/cartareferencia/".$archivo))
			{
				$cartareferencia=$archivo;
			}
		}
	
		$archivo_certificadocurso = $_FILES['file_certificadocurso']['name'];
		if($archivo_cv<>"")
		{
			$ext = strrchr($archivo_certificadocurso,'.');
			$archivo=$id.$ext;
			if (move_uploaded_file($_FILES['file_certificadocurso']['tmp_name'], "../archivos/certificadocurso/".$archivo))
			{
				$certificadocurso=$archivo;
			}
		}
	
		$archivo_certificadosence = $_FILES['file_certificadosence']['name'];
		if($archivo_cv<>"")
		{
			$ext = strrchr($archivo_certificadosence,'.');
			$archivo=$id.$ext;
			if (move_uploaded_file($_FILES['file_certificadosence']['tmp_name'], "../archivos/certificadosence/".$archivo))
			{
				$certificadosence=$archivo;
			}
		}
	
		$archivo_otro = $_FILES['file_otro']['name'];
		if($archivo_cv<>"")
		{
			$ext = strrchr($archivo_otro,'.');
			$archivo=$id.$ext;
			if (move_uploaded_file($_FILES['file_otro']['tmp_name'], "../archivos/otro/".$archivo))
			{
				$otro=$archivo;
			}
		}
		
		$StrSql="UPDATE cv_postulantes SET cv = '".$cv."',
		cartareferencia = '".$cartareferencia."',
		certificadocurso = '".$certificadocurso."',
		certificadosence = '".$certificadosence."',
		otro = '".$otro."' WHERE cv_postulantes.id_postulante =".$id."";
	
		query_bd($StrSql);

		$StrSql="insert into cv_eventos (id_acceso, id_postulante, fec_evento, gls_evento) 
		VALUES ('".$_SESSION['s_id_acceso']."','".$id."', ADDDATE(NOW(),INTERVAL 1 HOUR), 'Crea Postulante Rut:".$rut."-Reclutador')";
		query_bd($StrSql);
			
		$StrSql="INSERT INTO cv_encuesta (id_postulante, id_acceso) VALUES ('".$id."', '".$_SESSION['s_id_acceso']."')";
		if(query_bd($StrSql))
		{
			$url="EncuestaI.php";
			Header("Location: $url");
		}
		else
		{
			echo "<p>Error al grabar los datos".$StrSql."</p>";
		}
		
	}
	else
	{
		echo "<p>Error al grabar los datos".$StrSql."</p>";
	}
//	}
//}
?>
