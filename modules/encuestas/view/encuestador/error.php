<?PHP
session_start();
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
	<title>SIL - Sistema de Intermediacion Laboral</title>
	<script language="JavaScript" type="text/javascript">
	//none
	function pregunta()
	{
	    	if (confirm('¿Seguro desea confirmar el Ingreso?'))
		{
	       		document.ingreso.submit()
	    	}
	}  
	function ActRemun(estado)
	{
		if(estado==0)
		{
			//document.ingreso.DivActRemun.style.visibility='none';
			//document.getElementById('DivActRemun').style.visibility = 'hidden';
			document.getElementById('DivActRemun').style.display = 'none';
		}
		else
		{
			//document.ingreso.DivActRemun.style.visibility='inline';
			//document.getElementById('DivActRemun').style.visibility = 'visible';
			document.getElementById('DivActRemun').style.display = 'inline';
		}
	}
	function BuscoTrab(estado)
	{
		if(estado==0)
		{
			document.getElementById('DivBuscoTrab').style.display = 'none';
		}
		else
		{
			document.getElementById('DivBuscoTrab').style.display = 'inline';
		}
	}
	</script>
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
	<table border="0" cellpadding="0" cellspacing="0" align="center" id="menuTable" width="100%">
	<tr>
		<td width="161">
			<img name="header_r1_c1" src="../imagenes/header_r1_c1.png" width="161" height="44" border="0" id="header_r1_c1" alt="" />
		</td>
		<td background="../imagenes/header_r1_c2.png" width="100%" align="center">
			<table border="0" width="40%" align="center"><tr><td><div id="preloader"></div></td></tr></table>
		</td>
	    	<td width="44">
			<img name="header_r1_c3" src="../imagenes/header_r1_c3.png" width="32" height="44" border="0" id="header_r1_c3" alt="" />
		</td>
	  </tr>
	</table>
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
			<?PHP
			$error="";
			
			if(isset($_GET['error'])) $error=$_GET['error'];
			
			if($error<>"") 
			{
				echo $error."<br>";
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

