<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

if(isset($_SESSION['s_perfil_acceso'])==false)
{
	Header("Location: acceso.php");
}
elseif($_SESSION['s_perfil_acceso']<>1 and $_SESSION['s_perfil_acceso']<>99)
{
	Header("Location: acceso.php");
}
else
{
$estado = "1";
$estado = $_GET['estado']
?>
	<!DOCTYPE html PUBLIC
		  "-//W3C//DTD XHTML 1.0 Transitional//EN"
		  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
	<head>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link href="../css/Style_menu.css" rel="stylesheet" type="text/css" />
	<link type="image/x-icon" href="../imagenes/favicon.ico" rel="icon" />
	<link type="image/x-icon" href="../imagenes/favicon.ico" rel="shortcut icon" />
	<title>SIE - Sistema Ingreso de Encuestas</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="../ddaccordion.js">
	</script>
	<script type="text/javascript">
	//Initialize Arrow Side Menu:
	ddaccordion.init({
		headerclass: "menuheaders", //Shared CSS class name of headers group
		contentclass: "menucontents", //Shared CSS class name of contents group
		revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
		defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
		onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["unselected", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: 500, //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})
	</script>
	</head>
	
	<body>
<!-- background -->
<div id="pagina">
<!-- Esquinas redondas superiores superiores -->
<div style="clear:both"></div>
<div class="borde" style="float:left;background-position:left top"> &nbsp;</div>
<div class="borde" style="float:right;background-position:right top"> &nbsp;</div>
<div style="clear:both;background-color:white;padding:5px">
	<a href="http://www.qsservicios.cl/ingreso-clientes.html"><img id="logo" src="../img/logo-quality-servicios-web0.gif" alt="Logo Quality Servicios" height="80" style="width: 225px;"/></a>
	<img src="../img/contacto3.jpg" width="629"/>
	<img src="../img/encuesta_calidad0.jpg" width="125" height="100"/>
<hr/>
	
	<?PHP
	include("../funciones/tablas_estilos_n1.php");
	?>
	<table border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="220">
			<?PHP 
			tabla_superior(220,"profile");
			if ($_SESSION['s_perfil_acceso'] == 99) {
				include("../admin/menu.php");		
			}
			else
			{
				include("menu.php");		
			}
			tabla_inferior("profile");
			?>
		</td>
		<td valign="top" align="center">
		<h2>Encuestas Pendientes de Ingreso MAS GARANTIA v2014</h2>

		<?PHP 
		if ($estado == 1)
		{
		?>		
			<h3>Encuestas Pendientes</h3>
		<?PHP 
		}
		?>		

		<?PHP 
		if ($estado == 2)
		{
		?>		
			<h3>Encuestas Postergadas</h3>
		<?PHP 
		}
		?>		

		<?PHP 
		if ($estado == 9)
		{
		?>		
			<h3>Encuestas Finalizadas</h3>
		<?PHP 
		}
		?>		

		<?PHP 
		if ($estado == 4)
		{
		?>		
			<h3>Encuestas Pendientes de Enviar por Mail</h3>
		<?PHP 
		}
		?>		

		<?PHP 
		if ($estado == 5)
		{
		?>		
			<h3>Encuestas Enviadas por Mail</h3>
		<?PHP 
		}
		?>		

		<?PHP
		require_once("../funciones/conectar.php");

//		$strsql="select id_postulante,Nombres,ape_paterno,ape_materno from cv_postulantes where estado=1 order by Nombres";

		$strsql="select distinct cod_carga, a.id_formato, formato, id_encuesta, date_format(a.fec_ingreso,'%d-%m-%Y') as fec_ingreso, 
				rut_cliente, dv, nom_cliente,  
				e.estado 
				from qs_encuestascli_masgarantia_v2014 a
				left join qs_formatos f on a.id_formato = f.id_formato
				left join qs_estadosencuestas e on a.estado = e.id_estado
				where a.estado > 0 ";			
		if ($_SESSION['s_id_acceso'] <> '')
		{
			$strsql.="and a.id_acceso = '".$_SESSION['s_id_acceso']."' ";
		}
		if ($estado <> 99)
		{
			$strsql.="and a.estado = ".$estado." ";
		}
		if ($estado==2) 
			$strsql.="order by date_format(fec_postergada,'%Y-%m-%d %H:%i:%S')";
		else
			$strsql.="order by id_encuesta";

//		print $strsql;
		
		$result=consulta_bd($strsql);
		if ($result)
		{
			echo "<table border=\"0\"id=\"rounded-corner\"><thead>";
			echo "<th align=\"center\" scope=\"col\" class=\"rounded-company\">Seleccionar</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Campaña</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Plantilla</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Nro</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Fecha</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Rut</th>";
			echo "<th align=\"center\" class=\"texto_normal\">Nombre</th>";
			echo "<th align=\"center\" class=\"rounded-q4\">Estado</th></thead></tr><tbody>";
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>";
				echo "<td align=\"center\"><a href=\"EditarEncuestaMAS_v2014.php?id_encuesta=".$row['id_encuesta']."&id_formato=".$row['id_formato']."&estado=".$estado."\"><img src=\"../imagenes/lupa.jpg\" border=\"0\" width=\"30\" /></a></td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['cod_carga']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['formato']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['id_encuesta']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['fec_ingreso']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['rut_cliente']."-".$row['dv']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['nom_cliente']."</td>";
				echo "<td align=\"center\" class=\"texto_normal\">".$row['estado']."</td></tr>";			}
			echo "<tfoot><tr><td colspan=\"7\" class=\"rounded-foot-left\"></td><td class=\"rounded-foot-right\">&nbsp;</td></tr></tfoot>";
			echo "</tbody></table>";
		}
		?>
		</td>
	</tr>
	</table>
	</body>
	</html>
<?PHP
}
?>
