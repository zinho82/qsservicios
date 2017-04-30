<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

date_default_timezone_set('America/Santiago');

if(isset($_SESSION['s_perfil_acceso'])==false)
{
	Header("Location: acceso.php");
}
elseif ($_SESSION['s_perfil_acceso']!="1" and $_SESSION['s_perfil_acceso']!="99")
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
	<script type="text/javascript" src="../js/FunEdiPostulantes.js"></script>
	<title>SIE - Sistema Ingreso de Encuestas</title>
    <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script language="JavaScript" type="text/JavaScript">	
		$(document).ready(function(){
			$("#preg28_a1").change(function(event){
				var id = $("#preg28_a1").find(':selected').val();
				$("#preg28_c1").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg28_a2").change(function(event){
				var id = $("#preg28_a2").find(':selected').val();
				$("#preg28_c2").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg28_a3").change(function(event){
				var id = $("#preg28_a3").find(':selected').val();
				$("#preg28_c3").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});

    </script>
	
<script language="JavaScript" type="text/javascript">
function val_get(url,valor1,valor2)
{
	Cargar(url + ".php?g_valor1=" + valor1 + "&g_valor2=" + valor2);
}

function Cargar_Select(url,valor1)
{
	Cargar(url+valor1.value);
}
</script>

<SCRIPT> 
function getKey(keyStroke) {  
isNetscape=(document.layers); 
eventChooser = (isNetscape) ? keyStroke.which : event.keyCode;    
if (eventChooser==13) {      
   return false; 
   }  
} 
document.onkeypress = getKey;   
</script> 

<script language="javascript" type="text/javascript">
function NuevoAjax()
{
        var xmlhttp=false;
        try
	{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
	catch(e)
	{
                try
		{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
		catch(E)
		{
                        xmlhttp = false;
                }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined')
	{
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}

function Cargar(url)
{
        var contenido, preloader;
        contenido = document.getElementById('contenido');
        preloader = document.getElementById('preloader');

        //creamos el objeto XMLHttpRequest
        ajax=NuevoAjax();

        //peticionamos los datos, le damos la url enviada desde el link
        ajax.open("GET", url,true);

	//prototipo que sirve para tratar la respuesta:
	String.prototype.tratarResponseText = function() {
		
		var pat=/<script[^>]*>([\S\s]*?)<\/script[^>]*>/ig;
		var pat2=/\b\s+src=[^>\s]+\b/g;
		var elementos = this.match(pat) || [];
		
		for (i = 0; i < elementos.length; i++) {
			
			var nuevoScript = document.createElement('script');
			nuevoScript.type = 'text/javascript';
			var tienesrc=elementos[i].match(pat2) || [];
			
			if (tienesrc.length) {
				nuevoScript.src=tienesrc[0].split("'").join('').split('"').join('').split('src=').join('').split(' ').join('');
			}
			else {
				
				var elemento = elementos[i].replace(pat,'$1');
				nuevoScript.text = elemento;
				
			}
			
			document.getElementsByTagName('body')[0].appendChild(nuevoScript);
			
		}
		
		return this.replace(pat,'');
	} 

        ajax.onreadystatechange=function()
	{
                if(ajax.readyState==1)
		{
                        preloader.innerHTML = ".";
                        //modificamos el estilo de la div, mostrando una imagen de fondo
                        preloader.style.background = "url('ajax-loader-2.gif') no-repeat";
                }
		else if(ajax.readyState==4)
		{
                        if(ajax.status==200)
			{
                                //mostramos los datos dentro de la div
                                contenido.innerHTML = ajax.responseText;
                                preloader.innerHTML = "";
                                preloader.style.background = "url('loaded.gif') no-repeat";
                        }
			else if(ajax.status==404)
			{
                                preloader.innerHTML = "La pagina no existe";
                        }
			else
			{
                                //mostramos el posible error
                                preloader.innerHTML = "Error:".ajax.status;
                        }
                }
        }
        ajax.send(null);

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
	
	<style type="text/css">
	<!--
	.EnRojo {
		color: #FF0000;
		font-weight: bold;
	}
	-->
	</style>

	<!-- Imports General CSS and jQuery CSS -->
	<link href="../css/screencall.css" rel="stylesheet" media="screen" type="text/css" />
	
	<!-- jQuery thats loaded before document ready to prevent flickering - Rest are found at the bottom -->
	<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery.cookie.js"></script>
	<script type="text/javascript" src="../js/jquery.styleswitcher.js"></script>
	<script type="text/javascript" src="../js/jquery.visualize.js"></script>

    <script type="text/javascript" src="../js/fancybox/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="../js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

    <link rel="stylesheet" href="../js/fancybox/jquery.fancybox.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/fancybox/jquery.fancybox.pack.js"></script>
	
	</head>

	<script type="text/javascript">
function validar(){

	
if(	document.getElementById('status1_llamada_id1').selected  ||
	document.getElementById('status1_llamada_id2').selected ) {
	alert('Sin Validaciones por Status Llamado');
	document.ingreso.submit();		
	return 0;
}
	
/*	preg1	*/
	if(	!document.getElementById('preg1_id1').checked && 
		!document.getElementById('preg1_id2').checked &&
		!document.getElementById('preg1_id3').checked &&
		!document.getElementById('preg1_id4').checked &&
		!document.getElementById('preg1_id5').checked &&
		!document.getElementById('preg1_id6').checked &&
		!document.getElementById('preg1_id7').checked ) {
	alert('DEBE RESPONDER PREGUNTA 1');
	document.ingreso.preg1_id1.focus();
	return 0;
	}

/*	preg2	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg3	*/
	if(	!document.getElementById('preg3_id1').checked && 
		!document.getElementById('preg3_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 3');
	document.ingreso.preg3_id1.focus();
	return 0;
	}

	/*	preg3. Si respuesta en SI*/
	if(	document.getElementById('preg3_id1').checked  &&
		!document.getElementById('preg3_a_id1').checked  &&
		!document.getElementById('preg3_a_id2').checked  &&	
		!document.getElementById('preg3_a_id3').checked  &&	
		!document.getElementById('preg3_a_id4').checked  &&	
		!document.getElementById('preg3_a_id5').checked  &&	
		!document.getElementById('preg3_a_id6').checked  &&	
		!document.getElementById('preg3_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 3_a. Si Respuesta es SI');
		document.ingreso.preg3_a_id1.focus();
		return 0;
	}
	
/*	preg4	*/
	if(	!document.getElementById('preg4_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg4_id1.focus();
	return 0;
	}

/*	preg5	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg6	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg7	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg8	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg9	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}

/*	preg10	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}
	
	/*	preg27. */
	if(	!document.getElementById('preg29_id1').checked  && 
		!document.getElementById('preg29_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 27.');
		document.ingreso.preg29_id1.focus();
		return 0;
	}
	
	/*	preg27. */
	if(	!document.getElementById('preg29_id1').checked  && 
		!document.getElementById('preg29_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 27.');
		document.ingreso.preg29_id1.focus();
		return 0;
	}
	
	/*	preg27. Si respuesta en SI*/
	if(	document.getElementById('preg29_id1').checked  &&
		!document.getElementById('preg29_1_id1').checked  &&
		!document.getElementById('preg29_1_id2').checked  &&	
		!document.getElementById('preg29_1_id3').checked  &&	
		!document.getElementById('preg29_1_id4').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 27. Si Respuesta es SI');
		document.ingreso.preg29_1_id1.focus();
		return 0;
	}
	
	alert('Validaciones OK');
	document.ingreso.submit();
}
</script>	

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
			if ($_SESSION['s_perfil_acceso'] == "99") {
				include("../admin/menu.php");		
			}
			else
			{
				include("menu.php");		
			}
			tabla_inferior("profile");
			?>
		</td>
		<td valign="top">
			<?PHP
			require_once("../funciones/conectar.php");

			$strsql="select * 
			from qs_encuestascli_liberty_siniestros e 
			left join qs_encuesta_liberty_siniestros pe on e.id_encuesta = pe.id_encuesta 
			inner join qs_estadosencuestas est on e.estado = est.id_estado
			where e.estado in (1,2) 
			and id_acceso = '".$_SESSION['s_id_acceso']."' 
			and id_formato = '".$_GET['id_formato']."' and e.id_encuesta = '".$_GET['id_encuesta']."' 
			order by e.id_encuesta";

			$result=consulta_bd($strsql);
			if ($result)
			{
				if($row = mysql_fetch_array($result))
				{

				$StrSql="UPDATE qs_encuestascli_liberty_siniestros set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR)  	
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta de Satisfacción de Clientes - LIBERTY SINIESTROS</h1>
			<h2>Cliente <?PHP echo $row['RUT_ASEGURADO']; ?> | <?PHP echo $row['NOMBRE_ASEGURADO']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaLIBERTY_SINIESTROS.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">

			<INPUT type="hidden" name="rut_cliente" id="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>">
			<INPUT type="hidden" name="nom_cliente" id="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>">
			<INPUT type="hidden" name="patente" id="patente" value="<?PHP echo $row['patente']; ?>">
			<INPUT type="hidden" name="siniestro" id="siniestro" value="<?PHP echo $row['siniestro']; ?>">
			
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="button" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" onclick="validar()">
				* Seleccione Fecha si Posterga--><INPUT type="text" name="fec_postergada" id="fec_postergada" size="20" class="date">
				<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			</div>
		
 			<table>
			<tr><td colspan="2"><h2>Inicio Encuesta LIBERTY SINIESTROS</h2></td></tr>
			<tr><td>ID</td><td><INPUT size="10" type="text" name="ID" value="<?PHP echo $row['ID']; ?>"></td><td>NOMBRE_CONSULTOR</td><td><INPUT size="45" type="text" name="NOMBRE_CONSULTOR" value="<?PHP echo $row['NOMBRE_CONSULTOR']; ?>"></td></tr>			
			<tr><td>RUT_LIQUIDADOR</td><td><INPUT size="45" type="text" name="RUT_LIQUIDADOR" value="<?PHP echo $row['RUT_LIQUIDADOR']; ?>"></td><td>RUT_CONSULTOR</td><td><INPUT size="10" type="text" name="RUT_CONSULTOR" value="<?PHP echo $row['RUT_CONSULTOR']; ?>"></td></tr>
			<tr><td>NOMBRE_SUCURSAL</td><td><INPUT size="45" type="text" name="NOMBRE_SUCURSAL" value="<?PHP echo $row['NOMBRE_SUCURSAL']; ?>"></td><td>DIA_DENUNCIO</td><td><INPUT size="10" type="text" name="DIA_DENUNCIO" value="<?PHP echo $row['DIA_DENUNCIO']; ?>"></td></tr>
			<tr><td>SINIESTRO</td><td><INPUT size="45" type="text" name="SINIESTRO" value="<?PHP echo $row['SINIESTRO']; ?>"></td><td>DIA_SINIESTRO</td><td><INPUT size="45" type="text" name="DIA_SINIESTRO" value="<?PHP echo $row['DIA_SINIESTRO']; ?>"></td></tr>
			<tr><td>PAGADOR</td><td><INPUT size="45" type="text" name="PAGADOR" value="<?PHP echo $row['PAGADOR']; ?>"></td><td>SINIESTRO</td><td><INPUT size="10" type="text" name="SINIESTRO" value="<?PHP echo $row['SINIESTRO']; ?>"></td></tr>
			<tr><td>RUT_ASEGURADO</td><td><INPUT size="45" type="text" name="RUT_ASEGURADO" value="<?PHP echo $row['RUT_ASEGURADO']; ?>"></td><td>NOMBRE_GARAGE</td><td><INPUT size="45" type="text" name="NOMBRE_GARAGE" value="<?PHP echo $row['NOMBRE_GARAGE']; ?>"></td></tr>
			<tr><td>NOMBRE_ASEGURADO</td><td><INPUT size="45" type="text" name="NOMBRE_ASEGURADO" value="<?PHP echo $row['NOMBRE_ASEGURADO']; ?>"></td><td>RUT_SUCURSAL_TALLER</td><td><INPUT size="45" type="text" name="RUT_SUCURSAL_TALLER" value="<?PHP echo $row['RUT_SUCURSAL_TALLER']; ?>"></td></tr>
			<tr><td>FONO_ASEGURADO</td><td><INPUT size="45" type="text" name="FONO_ASEGURADO" value="<?PHP echo $row['FONO_ASEGURADO']; ?>"></td><td>DIA_RECIBO_CONFORME</td><td><INPUT size="45" type="text" name="DIA_RECIBO_CONFORME" value="<?PHP echo $row['DIA_RECIBO_CONFORME']; ?>"></td></tr>
			<tr><td>CELU_ASEGURADO</td><td><INPUT size="45" type="text" name="CELU_ASEGURADO" value="<?PHP echo $row['CELU_ASEGURADO']; ?>"></td><td>NOMBRE_CORREDOR</td><td><INPUT size="45" type="text" name="NOMBRE_CORREDOR" value="<?PHP echo $row['NOMBRE_CORREDOR']; ?>"></td></tr>
			<tr><td>MAIL_ASEGURADO</td><td><INPUT size="45" type="text" name="MAIL_ASEGURADO" value="<?PHP echo $row['MAIL_ASEGURADO']; ?>"></td><td>DESC_ESTADO_SINIESTRO</td><td><INPUT size="45" type="text" name="DESC_ESTADO_SINIESTRO" value="<?PHP echo $row['DESC_ESTADO_SINIESTRO']; ?>"></td></tr>
			<tr><td>NOMBRE_LIQUIDADOR</td><td><INPUT size="10" type="text" name="NOMBRE_LIQUIDADOR" value="<?PHP echo $row['NOMBRE_LIQUIDADOR']; ?>"></td><td>DESC_TIPO_DAÑO</td><td><INPUT size="45" type="text" name="DESC_TIPO_DAÑO" value="<?PHP echo $row['DESC_TIPO_DAÑO']; ?>"></td></tr>
			<tr><td>RUT_LIQUIDADOR</td><td><INPUT size="10" type="text" name="RUT_LIQUIDADOR" value="<?PHP echo $row['RUT_LIQUIDADOR']; ?>"></td><td>DIA_ACEPTACION_TALLER</td><td><INPUT size="45" type="text" name="DIA_ACEPTACION_TALLER" value="<?PHP echo $row['DIA_ACEPTACION_TALLER']; ?>"></td></tr>
			<tr><td>.</td><td></td><td>DIA_PAGO_TALLER</td><td><INPUT size="45" type="text" name="DIA_PAGO_TALLER" value="<?PHP echo $row['DIA_PAGO_TALLER']; ?>"></td></tr>
			<tr><td>.</td><td></td><td>MARCA_VEHICULO</td><td><INPUT size="45" type="text" name="MARCA_VEHICULO" value="<?PHP echo $row['MARCA_VEHICULO']; ?>"></td></tr>
			<tr><td>.</td><td></td><td>MODELO_VEHICULO</td><td><INPUT size="45" type="text" name="MODELO_VEHICULO" value="<?PHP echo $row['MODELO_VEHICULO']; ?>"></td></tr>
			<tr><td>.</td><td></td><td>AÑO_FABRICACION</td><td><INPUT size="45" type="text" name="AÑO_FABRICACION" value="<?PHP echo $row['AÑO_FABRICACION']; ?>"></td></tr>
			<tr><td>.</td><td></td><td>PATENTE</td><td><INPUT size="45" type="text" name="PATENTE" value="<?PHP echo $row['PATENTE']; ?>"></td></tr>

			</table>

			<table>
			<tr><td>Status Llamado</td>
				<td>Status Contacto</td>
				<td>Status Contacto Efectivo</td>
				<td>Status Contacto No Efectivo</td>
				<td>Status No Contacto</td>
			</tr>
			<tr>
				<td>
				<select name="status1_llamada" size="15">
					<option value="1. Contacto" id="status1_llamada_id1" >1. Contacto</option>
					<option value="2. No Contacto" id="status1_llamada_id2"  >2. No Contacto</option>
				</select>
				</td>
				<td>
				<select name="status2_llamada" size="15">
					<option value="1.a. Efectivo" >1.a. Efectivo</option>
					<option value="1.b. No Efectivo" >1.b. No Efectivo</option>
				</select>
				</td>
				<td>
				<select name="status3_llamada" size="15" >
					<option value="1.a.i. Aún NO ingresa a Taller" >1.a.i. Aún NO ingresa a Taller</option>
					<option value="1.a.ii. Cliente Molesto" >1.a.ii. Cliente Molesto</option>
					<option value="1.a.iii. Contesta encuesta">1.a.iii. Contesta encuesta</option>
					<option value="1.a.iv. Desiste de siniestro / servicio" >1.a.iv. Desiste de siniestro / servicio</option>
					<option value="1.a.vi. NO contesta encuesta">1.a.vi. NO contesta encuesta</option>
					<option value="1.a.vii. No recuerda haber tenido siniestro/ servicio" >1.a.vii. No recuerda haber tenido siniestro/ servicio</option>
					<option value="1.a.viii. Renuncio al seguro" >1.a.viii. Renuncio al seguro</option>
					<option value="1.a.ix. Cliente molesto con Corredor" >1.a.ix. Cliente molesto con Corredor</option>
					<option value="1.a.x. Servicio No realizado" >1.a.x. Servicio No realizado</option>
					<option value="1.a.xi. Volver a Llamar" >1.a.xi. Volver a Llamar</option>
				</select>
				</td>
				<td>
				<select name="status4_llamada" size="15">
					<option value="1.b.i. Número equivocado" >1.b.i. Número equivocado</option>
					<option value="1.b.ii. Inubicable por Horario" >1.b.ii. Inubicable por Horario</option>
					<option value="1.b.iii. Cliente de Viaje" >1.b.iii. Cliente de Viaje</option>
					<option value="1.b.iv. Volver a Llamar" >1.b.iv. Volver a Llamar</option>
				</select>
				</td>
				<td>
				<select name="status5_llamada" size="15">
  					<option value="2.a. Congestionado" >2.a. Congestionado</option>
					<option value="2.b. Sin teléfono" >2.b. Sin teléfono</option>
					<option value="2.c. Ocupado" >2.c. Ocupado</option>
					<option value="2.d. Fuera de servicio" >2.d. Fuera de servicio</option>
					<option value="2.e. Conectado a Fax" >2.e. Conectado a Fax</option>
					<option value="2.f. Grabadora o buzón de voz" >2.f. Grabadora o buzón de voz</option>
					<option value="2.g. Fuera de área o apagado (celular)">2.g. Fuera de área o apagado (celular)</option>
					<option value="2.h. No contesta" >2.h. No contesta</option>
					<option value="2.i. Número no válido" >2.i. Número no válido</option>
					<option value="2.j. Cliente Fallecido" >2.j. Cliente Fallecido</option>
 				</select>
				</td>
			</tr>
			</table>

 			<table>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Número de veces que ha sido Postergada: <INPUT type="text" name="num_post" size="10" value="<?PHP echo $row['num_post']; ?>"></td><tr>
			<tr><td colspan="2"><b>Historia Status</b></td><tr>
			<tr><td><textarea name="status_historia" cols="100" rows="5"><?PHP echo $row['status_historia']; ?></textarea></td></tr>
			<tr><td colspan="2"><b>Observaciones</b></td><tr>
			<tr><td><textarea name="observaciones" cols="100" rows="2"><?PHP echo $row['observaciones']; ?></textarea></td></tr>
			</table>

 			<table>
			<h2>Cliente <?PHP echo $row['RUT_ASEGURADO']; ?> | <?PHP echo $row['NOMBRE_ASEGURADO']; ?> | <?PHP echo $row['estado']; ?></h2>
			
			<tr><td colspan="2"><h3>Señor(a) <?PHP echo $row['NOMBRE_ASEGURADO']; ?>, usted tuvo recientemente un siniestros y requirió utilizar su póliza de seguros de Liberty, y nos gustaría comprobar su nivel de satisfacción con nuestra atención.</h3></td></tr>
			<tr><td colspan="2"><h3>Por favor, les solicitamos que dedique un momento para completar esta pequeña encuesta, cuyo objetivo es mejorar la calidad de servicio que le otorgamos. </h3></td></tr>
			<tr><td colspan="2"><h3>Sus respuestas serán tratadas de forma confidencial y no serán utilizadas para ningún propósito distinto al mencionado.</h3></td></tr>
			<tr><td colspan="2"><h2>Por favor, le pedimos contestar las preguntas considerando una escala de 1 a 7, donde 1 es muy malo y 7 excelente.</h2></td></tr>
			</table>

 			<table>
			<tr><td colspan="2"><h2>I.	Denuncio de Siniestro</h2></td></tr>				
				
			<tr><td colspan="2">1.	¿Con qué nota evalúa la atención general recibida de parte de la compañía al realizar el denuncio de su siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg1" id="preg1_id1" value="1" <?PHP if ($row['preg1'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg1" id="preg1_id2" value="2" <?PHP if ($row['preg1'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg1" id="preg1_id3" value="3" <?PHP if ($row['preg1'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg1" id="preg1_id4" value="4" <?PHP if ($row['preg1'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg1" id="preg1_id5" value="5" <?PHP if ($row['preg1'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg1" id="preg1_id6" value="6" <?PHP if ($row['preg1'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg1" id="preg1_id7" value="7" <?PHP if ($row['preg1'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">2.	¿Cómo realizo la denuncia de su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg2" id="preg2_id1" value="CALL CENTER" <?PHP if ($row['preg2'] == 'CALL CENTER') echo 'checked';?>>CALL CENTER, - Pasar a Pregunta 4</td></tr>
			<tr><td><INPUT type="radio" name="preg2" id="preg2_id2" value="CORREDOR" <?PHP if ($row['preg2'] == 'CORREDOR') echo 'checked';?>>CORREDOR, - Pasar a Pregunta 7</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">3.	Posterior al denuncio de su siniestro, ¿recibió una confirmación de su denuncia vía e-mail o SMS?</td></tr>
			<tr><td><INPUT type="radio" name="preg3" id="preg3_id1" value="SI" <?PHP if ($row['preg3'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td colspan="2">¿Cómo evalúa el sistema de mensajería de la compañía? </td></tr>
			<tr><td>
				<INPUT type="radio" name="preg3_a" id="preg3_a_id1" value="1" <?PHP if ($row['preg3_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id2" value="2" <?PHP if ($row['preg3_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id3" value="3" <?PHP if ($row['preg3_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id4" value="4" <?PHP if ($row['preg3_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id5" value="5" <?PHP if ($row['preg3_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id6" value="6" <?PHP if ($row['preg3_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3_a" id="preg3_a_id7" value="7" <?PHP if ($row['preg3_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td><INPUT type="radio" name="preg3" id="preg3_id1" value="NO" <?PHP if ($row['preg3'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">4.	Cuando denuncio en el call center: </td></tr>
			<tr><td colspan="2">¿Le entregaron?: </td></tr>
			<tr><td>N° Siniestro :
						<INPUT type="radio" name="preg4_a" id="preg4_a_id1" value="SI" <?PHP if ($row['preg4_a'] == 'SI') echo 'checked';?>>SI
						<INPUT type="radio" name="preg4_a" id="preg4_a_id2" value="NO" <?PHP if ($row['preg4_a'] == 'NO') echo 'checked';?>>NO
			</td></tr>
			<tr><td>Nombre taller asignado para atender su siniestro :
						<INPUT type="radio" name="preg4_b" id="preg4_b_id1" value="SI" <?PHP if ($row['preg4_b'] == 'SI') echo 'checked';?>>SI
						<INPUT type="radio" name="preg4_b" id="preg4_b_id2" value="NO" <?PHP if ($row['preg4_b'] == 'NO') echo 'checked';?>>NO
			</td></tr>
			<tr><td>Nombre del Liquidador? :
						<INPUT type="radio" name="preg4_c" id="preg4_c_id1" value="SI" <?PHP if ($row['preg4_c'] == 'SI') echo 'checked';?>>SI
						<INPUT type="radio" name="preg4_c" id="preg4_c_id2" value="NO" <?PHP if ($row['preg4_c'] == 'NO') echo 'checked';?>>NO
			</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

 			<tr><td colspan="2">5.	Le informaron los documentos necesarios para continuar con el proceso de liquidación de su siniestro y a donde enviarlos?</td></tr>
			<tr><td><INPUT type="radio" name="preg5" id="preg5_id1" value="SI" <?PHP if ($row['preg5'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg5" id="preg5_id2" value="NO" <?PHP if ($row['preg5'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">6.	Cómo evalúa, los siguientes aspectos relacionados con la toma del denuncio de siniestro :</td></tr>
			<tr><td colspan="2">a.	La facilidad de comunicación con la compañía</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_a" id="preg6_a_id1" value="1" <?PHP if ($row['preg6_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id2" value="2" <?PHP if ($row['preg6_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id3" value="3" <?PHP if ($row['preg6_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id4" value="4" <?PHP if ($row['preg6_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id5" value="5" <?PHP if ($row['preg6_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id6" value="6" <?PHP if ($row['preg6_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_a" id="preg6_a_id7" value="7" <?PHP if ($row['preg6_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La calidad de la información entregada por la operadora</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_b" id="preg6_b_id1" value="1" <?PHP if ($row['preg6_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id2" value="2" <?PHP if ($row['preg6_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id3" value="3" <?PHP if ($row['preg6_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id4" value="4" <?PHP if ($row['preg6_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id5" value="5" <?PHP if ($row['preg6_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id6" value="6" <?PHP if ($row['preg6_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_b" id="preg6_b_id7" value="7" <?PHP if ($row['preg6_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">Si la nota es igual o menor a 5, preguntar: ¿A qué se debe estar nota?</td><tr>
			<tr><td><textarea name="preg9" id="preg9_id1" cols="100" rows="3"><?PHP echo $row['preg9']; ?></textarea></td></tr>
			<tr><td colspan="2">c.	Los conocimientos de la operadora</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_c" id="preg6_c_id1" value="1" <?PHP if ($row['preg6_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id2" value="2" <?PHP if ($row['preg6_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id3" value="3" <?PHP if ($row['preg6_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id4" value="4" <?PHP if ($row['preg6_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id5" value="5" <?PHP if ($row['preg6_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id6" value="6" <?PHP if ($row['preg6_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_c" id="preg6_c_id7" value="7" <?PHP if ($row['preg6_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	La cordialidad de la operadora</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_d" id="preg6_d_id1" value="1" <?PHP if ($row['preg6_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id2" value="2" <?PHP if ($row['preg6_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id3" value="3" <?PHP if ($row['preg6_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id4" value="4" <?PHP if ($row['preg6_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id5" value="5" <?PHP if ($row['preg6_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id6" value="6" <?PHP if ($row['preg6_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_d" id="preg6_d_id7" value="7" <?PHP if ($row['preg6_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">e.	El tiempo que demoró la operadora en ingresar su siniestro hasta finalizar el proceso</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_e" id="preg6_e_id1" value="1" <?PHP if ($row['preg6_e'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id2" value="2" <?PHP if ($row['preg6_e'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id3" value="3" <?PHP if ($row['preg6_e'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id4" value="4" <?PHP if ($row['preg6_e'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id5" value="5" <?PHP if ($row['preg6_e'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id6" value="6" <?PHP if ($row['preg6_e'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_e" id="preg6_e_id7" value="7" <?PHP if ($row['preg6_e'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">f.	La Atención de la Compañía en el denuncio del Siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg6_f" id="preg6_f_id1" value="1" <?PHP if ($row['preg6_f'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id2" value="2" <?PHP if ($row['preg6_f'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id3" value="3" <?PHP if ($row['preg6_f'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id4" value="4" <?PHP if ($row['preg6_f'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id5" value="5" <?PHP if ($row['preg6_f'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id6" value="6" <?PHP if ($row['preg6_f'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_f" id="preg6_f_id7" value="7" <?PHP if ($row['preg6_f'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 9</h3></td></tr>


			<tr><td colspan="2">7.	Cómo evalúa, los siguientes aspectos :</td></tr>
			<tr><td colspan="2">a.	La demora del Corredor en contactarlo desde que realizó el denuncio</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_a" id="preg7_a_id1" value="1" <?PHP if ($row['preg7_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id2" value="2" <?PHP if ($row['preg7_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id3" value="3" <?PHP if ($row['preg7_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id4" value="4" <?PHP if ($row['preg7_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id5" value="5" <?PHP if ($row['preg7_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id6" value="6" <?PHP if ($row['preg7_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id7" value="7" <?PHP if ($row['preg7_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La atención del Corredor en el denuncio del siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_b" id="preg7_b_id1" value="1" <?PHP if ($row['preg7_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id2" value="2" <?PHP if ($row['preg7_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id3" value="3" <?PHP if ($row['preg7_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id4" value="4" <?PHP if ($row['preg7_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id5" value="5" <?PHP if ($row['preg7_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id6" value="6" <?PHP if ($row['preg7_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id7" value="7" <?PHP if ($row['preg7_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2">c.	La calidad de la información entregada por el Corredor</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_c" id="preg7_c_id1" value="1" <?PHP if ($row['preg7_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id2" value="2" <?PHP if ($row['preg7_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id3" value="3" <?PHP if ($row['preg7_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id4" value="4" <?PHP if ($row['preg7_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id5" value="5" <?PHP if ($row['preg7_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id6" value="6" <?PHP if ($row['preg7_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id7" value="7" <?PHP if ($row['preg7_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">8.	¿Al momento de ser contactado por el Corredor, le entregaron los datos del liquidador y del taller asignado en forma clara?</td></tr>
			<tr><td><INPUT type="radio" name="preg8" id="preg8_c_id1" value="SI" <?PHP if ($row['preg8'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg8" id="preg8_c_id2" value="NO" <?PHP if ($row['preg8'] == 'NO') echo 'checked';?>>NO</td></tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 9</h3></td></tr>


			<tr><td colspan="2"><h2>II.	Cumplimiento Protocolo Atención y Liquidación</h2></td></tr>

			<tr><td colspan="2">9.	¿Recibió el Informe de Liquidación de su Siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg9" id="preg9_id1" value="SI" <?PHP if ($row['preg9'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg9" id="preg9_id2" value="NO" <?PHP if ($row['preg9'] == 'NO') echo 'checked';?>>NO</td></tr>			
			
			<tr><td colspan="2"><h3><span class="EnRojo">SI EL CLIENTE NO ES DE SANTIAGO PREGUNTAR - NOMBRE SUCURSAL: <?PHP echo $row['NOMBRE_SUCURSAL']; ?></span></h3></td></tr>

			<tr><td colspan="2">10.	¿El liquidador se contacto con usted para solicitar mayor información o documentación adicional para liquidar su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg10" id="preg10_id1" value="SI" <?PHP if ($row['preg10'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10" id="preg10_id2" value="NO" <?PHP if ($row['preg10'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">11.	Respecto de la información solicitada por el liquidador, éste ¿Le solicito claramente la información necesaria?	</td></tr>
			<tr><td><INPUT type="radio" name="preg11" id="preg11_id1" value="SI" <?PHP if ($row['preg11'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg11" id="preg11_id2" value="NO" <?PHP if ($row['preg11'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">12.	La forma de indemnización de su siniestro fue mediante:</td></tr>
			<tr><td><INPUT type="radio" name="preg12" id="preg12_id1" value="a. Reparación del vehículo" <?PHP if ($row['preg12'] == 'a. Reparación del vehículo') echo 'checked';?>>a.	Reparación del vehículo</td></tr>
			<tr><td><INPUT type="radio" name="preg12" id="preg12_id2" value="b.	Pago en dinero" <?PHP if ($row['preg12'] == 'b. Pago en dinero') echo 'checked';?>>b. Pago en dinero</td></tr>
			<tr><td colspan="2">i.	Si fue pago en dinero, ¿con qué nota calificaría, en escala de 1 a 7, el proceso de pago del siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg12_a" id="preg12_a_id1" value="1" <?PHP if ($row['preg12_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id2" value="2" <?PHP if ($row['preg12_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id3" value="3" <?PHP if ($row['preg12_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id4" value="4" <?PHP if ($row['preg12_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id5" value="5" <?PHP if ($row['preg12_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id6" value="6" <?PHP if ($row['preg12_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg12_a" id="preg12_a_id7" value="7" <?PHP if ($row['preg12_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>


			<tr><td colspan="2"><h3>Sólo Para Casos de Pérdida Total</h3></td></tr>

			<tr><td colspan="2">13.	¿Qué nota le colocaría al Liquidador de su siniestro en los siguientes aspectos?: </td></tr>
			<tr><td colspan="2">a.	Claridad para solicitar la documentación necesaria para la liquidación </td></tr>
			<tr><td>
				<INPUT type="radio" name="preg13_a" id="preg13_a_id1" value="1" <?PHP if ($row['preg13_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id2" value="2" <?PHP if ($row['preg13_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id3" value="3" <?PHP if ($row['preg13_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id4" value="4" <?PHP if ($row['preg13_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id5" value="5" <?PHP if ($row['preg13_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id6" value="6" <?PHP if ($row['preg13_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_a" id="preg13_a_id7" value="7" <?PHP if ($row['preg13_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	Entrega de la información de los descuentos que debe asumir por el siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg13_b" id="preg13_b_id1" value="1" <?PHP if ($row['preg13_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id2" value="2" <?PHP if ($row['preg13_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id3" value="3" <?PHP if ($row['preg13_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id4" value="4" <?PHP if ($row['preg13_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id5" value="5" <?PHP if ($row['preg13_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id6" value="6" <?PHP if ($row['preg13_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_b" id="preg13_b_id7" value="7" <?PHP if ($row['preg13_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	Cumplimiento de los plazos de pago</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg13_c" id="preg3_c_id1" value="1" <?PHP if ($row['preg13_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id2" value="2" <?PHP if ($row['preg13_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id3" value="3" <?PHP if ($row['preg13_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id4" value="4" <?PHP if ($row['preg13_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id5" value="5" <?PHP if ($row['preg13_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id6" value="6" <?PHP if ($row['preg13_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_c" id="preg3_c_id7" value="7" <?PHP if ($row['preg13_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	Proceso de negociación de la liquidación del siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg13_d" id="preg13_d_id1" value="1" <?PHP if ($row['preg13_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id2" value="2" <?PHP if ($row['preg13_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id3" value="3" <?PHP if ($row['preg13_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id4" value="4" <?PHP if ($row['preg13_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id5" value="5" <?PHP if ($row['preg13_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id6" value="6" <?PHP if ($row['preg13_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_d" id="preg13_d_id7" value="7" <?PHP if ($row['preg13_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 17</h3></td></tr>

			<tr><td colspan="2"><h2>III.	Evaluación Taller</h2></td></tr>

			<tr><td colspan="2">14.	¿En qué fecha fue a dejar su vehículo al taller? </td></tr>
			<tr><td>
				<INPUT type="text" name="preg14" id="preg14_id1" value="<?PHP echo $row['preg14'];?>" >
			</td><tr>			
			<tr><td colspan="2">a.	¿le informaron la fecha en que sería entregado?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg14_a" id="preg14_a_id1" value="SI" <?PHP if ($row['preg14_a'] == 'SI') echo 'checked';?>>SI ...
				<INPUT type="radio" name="preg14_a" id="preg14_a_id2" value="NO" <?PHP if ($row['preg14_a'] == 'NO') echo 'checked';?>>NO ...
			</td><tr>
			<tr><td colspan="2">b.	Se cumplió</td></tr>
			<tr><td><INPUT type="radio" name="preg14_b" id="preg14_b_id1" value="SI" <?PHP if ($row['preg14_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg14_b" id="preg14_b_id2" value="NO" <?PHP if ($row['preg14_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">15.	Cómo evalúa  en una escala de 1 a 7, donde 1 es pésimo y 7 excelente, los siguientes aspectos del taller:</td></tr>
			<tr><td colspan="2">a.	La ubicación del taller asignado por la compañía</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_a" id="preg15_a_id1" value="1" <?PHP if ($row['preg15_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id2" value="2" <?PHP if ($row['preg15_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id3" value="3" <?PHP if ($row['preg15_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id4" value="4" <?PHP if ($row['preg15_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id5" value="5" <?PHP if ($row['preg15_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id6" value="6" <?PHP if ($row['preg15_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_a" id="preg15_a_id7" value="7" <?PHP if ($row['preg15_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La demora del taller para ser atendido</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_b" id="preg15_b_id1" value="1" <?PHP if ($row['preg15_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id2" value="2" <?PHP if ($row['preg15_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id3" value="3" <?PHP if ($row['preg15_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id4" value="4" <?PHP if ($row['preg15_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id5" value="5" <?PHP if ($row['preg15_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id6" value="6" <?PHP if ($row['preg15_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_b" id="preg15_b_id7" value="7" <?PHP if ($row['preg15_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	El estado de limpieza de entrega del vehículo por parte del taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_c" id="preg15_c_id1" value="1" <?PHP if ($row['preg15_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_c" id="preg15_c_id2" value="2" <?PHP if ($row['preg15_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_c" id="preg15_c_id3" value="3" <?PHP if ($row['preg15_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_c" id="preg15_c_id4" value="5" <?PHP if ($row['preg15_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_c" id="preg15_c_id5" value="6" <?PHP if ($row['preg15_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_c" id="preg15_c_id6" value="7" <?PHP if ($row['preg15_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	El plazo de entrega de su vehículo</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_d" id="preg15_d_id1" value="1" <?PHP if ($row['preg15_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id2" value="2" <?PHP if ($row['preg15_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id3" value="3" <?PHP if ($row['preg15_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id4" value="4" <?PHP if ($row['preg15_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id5" value="5" <?PHP if ($row['preg15_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id6" value="6" <?PHP if ($row['preg15_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_d" id="preg15_d_id7" value="7" <?PHP if ($row['preg15_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">Si la nota es igual o menor a 5, preguntar: ¿A qué se debe estar nota?</td><tr>
			<tr><td><textarea name="preg15_d_1" id="preg15_d_1_id1" cols="100" rows="3"><?PHP echo $row['preg15_d_1']; ?></textarea></td></tr>

			<tr><td colspan="2">e.	Si la en respuesta anterior un argumento es que los repuestos se demoraron, preguntar:</td></tr>
			<tr><td colspan="2">i.	Se contactó con usted la Compañía para informarle retraso en la entrega de los repuestos</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_e_1" id="preg15_e_1_id1" value="SI" <?PHP if ($row['preg15_e_1'] == 'SI') echo 'checked';?>>SI ...
				<INPUT type="radio" name="preg15_e_1" id="preg15_e_1_id2" value="NO" <?PHP if ($row['preg15_e_1'] == 'NO') echo 'checked';?>>NO ...
			</td><tr>
			<tr><td colspan="2">ii.	Le ofrecieron las alternativas de indemnizarlo en el valor del repuesto ó continuar con la importación</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_e_2" id="preg15_e_2_id1" value="SI" <?PHP if ($row['preg15_e_2'] == 'SI') echo 'checked';?>>SI ...
				<INPUT type="radio" name="preg15_e_2" id="preg15_e_2_id2" value="NO" <?PHP if ($row['preg15_e_2'] == 'NO') echo 'checked';?>>NO ...
			</td><tr>
			<tr><td colspan="2">iii. Cómo avalúa el trato de de la persona que lo llamó?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id1" value="1" <?PHP if ($row['preg15_e_3'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id2" value="2" <?PHP if ($row['preg15_e_3'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id3" value="3" <?PHP if ($row['preg15_e_3'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id4" value="4" <?PHP if ($row['preg15_e_3'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id5" value="5" <?PHP if ($row['preg15_e_3'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id6" value="6" <?PHP if ($row['preg15_e_3'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_e_3" id="preg15_e_3_id7" value="7" <?PHP if ($row['preg15_e_3'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">f.	El trato de de la persona que lo atendió en el taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_f" id="preg15_f_id1" value="1" <?PHP if ($row['preg15_f'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id2" value="2" <?PHP if ($row['preg15_f'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id3" value="3" <?PHP if ($row['preg15_f'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id4" value="4" <?PHP if ($row['preg15_f'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id5" value="5" <?PHP if ($row['preg15_f'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id6" value="6" <?PHP if ($row['preg15_f'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_f" id="preg15_f_id7" value="7" <?PHP if ($row['preg15_f'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">g.	Calidad de la información del proceso de reparación de su vehículo</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_g" id="preg15_g_id1" value="1" <?PHP if ($row['preg15_g'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id2" value="2" <?PHP if ($row['preg15_g'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id3" value="3" <?PHP if ($row['preg15_g'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id4" value="4" <?PHP if ($row['preg15_g'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id5" value="5" <?PHP if ($row['preg15_g'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id6" value="6" <?PHP if ($row['preg15_g'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_g" id="preg15_g_id7" value="7" <?PHP if ($row['preg15_g'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">h.	Facilidad para contactarse con el taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_h" id="preg15_h_id1" value="1" <?PHP if ($row['preg15_h'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id2" value="2" <?PHP if ($row['preg15_h'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id3" value="3" <?PHP if ($row['preg15_h'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id4" value="4" <?PHP if ($row['preg15_h'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id5" value="5" <?PHP if ($row['preg15_h'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id6" value="6" <?PHP if ($row['preg15_h'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_h" id="preg15_h_id7" value="7" <?PHP if ($row['preg15_h'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">i.	La respuesta en caso de reclamar por la garantía de la reparación</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg15_i" id="preg15_i_id1" value="1" <?PHP if ($row['preg15_i'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id2" value="2" <?PHP if ($row['preg15_i'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id3" value="3" <?PHP if ($row['preg15_i'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id4" value="4" <?PHP if ($row['preg15_i'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id5" value="5" <?PHP if ($row['preg15_i'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id6" value="6" <?PHP if ($row['preg15_i'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_i" id="preg15_i_id7" value="7" <?PHP if ($row['preg15_i'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">16.	¿Qué nota le colocaría al taller en qué se reparó su vehículo?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg16" id="preg16_id1" value="1" <?PHP if ($row['preg16'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg16" id="preg16_id2" value="2" <?PHP if ($row['preg16'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg16" id="preg16_id3" value="3" <?PHP if ($row['preg16'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg16" id="preg16_id4" value="4" <?PHP if ($row['preg16'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg16" id="preg16_id5" value="5" <?PHP if ($row['preg16'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg16" id="preg16_id6" value="6" <?PHP if ($row['preg16'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg16" id="preg16_id7" value="7" <?PHP if ($row['preg16'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h2>IV.	Asistencia, Auto de Reemplazo y Evaluación General de la Compañía </h2></td></tr>
			<tr><td colspan="2">17.	Cuando sufrió su siniestro, ¿hizo uso del servicio de grúa de la Compañía?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg17" id="preg17_id1" value="SI" <?PHP if ($row['preg17'] == 'SI') echo 'checked';?>>SI ...
				<INPUT type="radio" name="preg17" id="preg17_id2" value="NO" <?PHP if ($row['preg17'] == 'NO') echo 'checked';?>>NO ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">18.	Cómo evalúa  en una escala de 1 a 7, donde 1 es pésimo y 7 excelente, los siguientes aspectos del servicio de asistencia de la Compañía:</td></tr>
			<tr><td colspan="2">a.	¿ Qué nota le colocaría a la primera comunicación para solicitar el servicio de grúa?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg18_a" id="preg18_a_id1" value="1" <?PHP if ($row['preg18_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id2" value="2" <?PHP if ($row['preg18_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id3" value="3" <?PHP if ($row['preg18_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id4" value="4" <?PHP if ($row['preg18_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id5" value="5" <?PHP if ($row['preg18_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id6" value="6" <?PHP if ($row['preg18_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id7" value="7" <?PHP if ($row['preg18_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">Si la nota es igual o menor a 5, preguntar: ¿A qué se debe estar nota?</td><tr>
			<tr><td><textarea name="preg18_a_1" id="preg18_a_1_id1" cols="100" rows="3"><?PHP echo $row['preg18_a_1']; ?></textarea></td></tr>
			<tr><td colspan="2">b.	¿ Qué nota le colocaría a la atención del servicio de grúa que utilizó? </td></tr>
			<tr><td>
				<INPUT type="radio" name="preg18_b" id="preg18_b_id1" value="1" <?PHP if ($row['preg18_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id2" value="2" <?PHP if ($row['preg18_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id3" value="3" <?PHP if ($row['preg18_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id4" value="4" <?PHP if ($row['preg18_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id5" value="5" <?PHP if ($row['preg18_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id6" value="6" <?PHP if ($row['preg18_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id7" value="7" <?PHP if ($row['preg18_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	¿ Qué nota le colocaría al trato de la persona que prestó el servicio de grúa?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg18_c" id="preg18_c_id1" value="1" <?PHP if ($row['preg18_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id2" value="2" <?PHP if ($row['preg18_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id3" value="3" <?PHP if ($row['preg18_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id4" value="4" <?PHP if ($row['preg18_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id5" value="5" <?PHP if ($row['preg18_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id6" value="6" <?PHP if ($row['preg18_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg18_c" id="preg18_c_id7" value="7" <?PHP if ($row['preg18_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">19.	¿Usó el servicio de Vehículo de Reemplazo a que tiene derecho según su póliza? </td></tr>
			<tr><td><INPUT type="radio" name="preg19" id="preg19_id1" value="SI" <?PHP if ($row['preg19'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg19" id="preg19_id2" value="NO" <?PHP if ($row['preg19'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">20.	¿Qué nota le colocaría a la atención en el rent a car?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg20" id="preg20_id1" value="1" <?PHP if ($row['preg20'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg20" id="preg20_id2" value="2" <?PHP if ($row['preg20'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg20" id="preg20_id3" value="3" <?PHP if ($row['preg20'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg20" id="preg20_id4" value="4" <?PHP if ($row['preg20'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg20" id="preg20_id5" value="5" <?PHP if ($row['preg20'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg20" id="preg20_id6" value="6" <?PHP if ($row['preg20'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg20" id="preg20_id7" value="7" <?PHP if ($row['preg20'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">21.	¿Tuvo usted algún problema con el auto reemplazo?</td></tr>
			<tr><td><INPUT type="radio" name="preg21" id="preg21_id1" value="SI" <?PHP if ($row['preg21'] == 'SI') echo 'checked';?>>SI 
			¿Cual? :<INPUT type="text" name="preg21_a" id="preg21_a_id1" size="50" value="<?PHP echo $row['preg21_a']; ?>"></td></tr>
			<tr><td><INPUT type="radio" name="preg21" id="preg21_id2" value="NO" <?PHP if ($row['preg21'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h2>V.	Sugerencias y Reclamos</h2></td></tr>

			<tr><td colspan="2">22.	¿Qué nota le colocaría a la atención general recibida por la compañía en su siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg22" id="preg22_id1" value="1" <?PHP if ($row['preg22'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg22" id="preg22_id2" value="2" <?PHP if ($row['preg22'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg22" id="preg22_id3" value="3" <?PHP if ($row['preg22'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg22" id="preg22_id4" value="4" <?PHP if ($row['preg22'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg22" id="preg22_id5" value="5" <?PHP if ($row['preg22'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg22" id="preg22_id6" value="6" <?PHP if ($row['preg22'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg22" id="preg22_id7" value="7" <?PHP if ($row['preg22'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">23.	En una escala de 0 a 10, donde “0” significa “no recomendaría en lo absoluto” y “10” significa “definitivamente recomendaría”, ¿qué tanto recomendaría a LIBERTY SEGUROS a un amigo o colega?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg27" id="preg27_id0" value="0" <?PHP if ($row['preg27'] == '0') echo 'checked';?>>0 No recomendaría en absoluto
				<INPUT type="radio" name="preg27" id="preg27_id1" value="1" <?PHP if ($row['preg27'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg27" id="preg27_id2" value="2" <?PHP if ($row['preg27'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg27" id="preg27_id3" value="3" <?PHP if ($row['preg27'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg27" id="preg27_id4" value="4" <?PHP if ($row['preg27'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg27" id="preg27_id5" value="5" <?PHP if ($row['preg27'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg27" id="preg27_id6" value="6" <?PHP if ($row['preg27'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg27" id="preg27_id7" value="7" <?PHP if ($row['preg27'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg27" id="preg27_id8" value="8" <?PHP if ($row['preg27'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg27" id="preg27_id9" value="9" <?PHP if ($row['preg27'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg27" id="preg27_id10" value="10" <?PHP if ($row['preg27'] == '10') echo 'checked';?>>10 Definitivamente recomendaria
				<INPUT type="radio" name="preg27" id="preg27_id99" value="99" <?PHP if ($row['preg27'] == '99') echo 'checked';?>>99 No sabe
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">24.	¿Cuáles son las razones de esta nota? [escribir respuesta textual] [si responde 0 a 8 y da razones positivas, preguntar qué falta para que esa nota sea 9 o 10]</td></tr>
			<tr><td><textarea name="preg28" id="preg28_id1" cols="100" rows="5"><?PHP echo $row['preg28']; ?></textarea></td></tr>
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg28_a1" id ="preg28_a1" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas_encuestas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg28_c1" id="preg28_c1" size="1">

 				</select>			
			</td></tr>
			
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg28_a2" id ="preg28_a2" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas_encuestas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg28_c2" id="preg28_c2" size="1">

 				</select>			
			</td></tr>
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg28_a3" id ="preg28_a3" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas_encuestas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg28_c3" id="preg28_c3" size="1">

 				</select>			
			</td></tr>
						
			<tr><td colspan="2"><br></td><td></td></tr>

			
			
			<tr><td colspan="2">25.	¿Tiene algún comentario, reclamo, sugerencia o felicitaciones que desee indicarnos?</td></tr>
			<tr><td><INPUT type="radio" name="preg23" id="preg23_id1" value="SI" <?PHP if ($row['preg23'] == 'SI') echo 'checked';?>>SI
			</td></tr>
			<tr><td><INPUT type="radio" name="preg23" id="preg23_id1" value="NO" <?PHP if ($row['preg23'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">Si la respuesta es SI, el encuestador debe poder clasificar la respuesta en:</td></tr>
			<tr><td><INPUT type="radio" name="preg23_a" id="preg23_a_id1" value="COMENTARIO" <?PHP if ($row['preg23_a'] == 'COMENTARIO') echo 'checked';?>>COMENTARIO</td></tr>
			<tr><td><INPUT type="radio" name="preg23_a" id="preg23_a_id2" value="SUGERENCIA" <?PHP if ($row['preg23_a'] == 'SUGERENCIA') echo 'checked';?>>SUGERENCIA</td></tr>
			<tr><td><INPUT type="radio" name="preg23_a" id="preg23_a_id3" value="FELICITACIONES" <?PHP if ($row['preg23_a'] == 'FELICITACIONES') echo 'checked';?>>FELICITACIONES</td></tr>
			<tr><td><INPUT type="radio" name="preg23_a" id="preg23_a_id4" value="RECLAMO" <?PHP if ($row['preg23_a'] == 'RECLAMO') echo 'checked';?>>RECLAMO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h3>Solo para el caso de reclamo, sugerencia o felicitaciones</h3></td></tr>
			<tr><td colspan="2">26.	¿Cuál?, ¿A quién va dirigido su reclamo ó sugerencia?</td></tr>
			<tr><td><textarea name="preg24" id="preg24_id1" cols="100" rows="5"><?PHP echo $row['preg24']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">27.	¿Hace cuanto tiempo es cliente de la Compañía?</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id1" value="Menos de 1 mes" <?PHP if ($row['preg25'] == 'Menos de 1 mes') echo 'checked';?>>Menos de 1 mes</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id2" value="Entre 1 – 6 meses" <?PHP if ($row['preg25'] == 'Entre 1 – 6 meses') echo 'checked';?>>Entre 1 – 6 meses</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id3" value="Entre 6 meses - 1 años" <?PHP if ($row['preg25'] == 'Entre 6 meses - 1 años') echo 'checked';?>>Entre 6 meses - 1 años</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id4" value="Entre 1 - 3 años" <?PHP if ($row['preg25'] == 'Entre 1 - 3 años') echo 'checked';?>>Entre 1 - 3 años</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id5" value="Más de 3 años" <?PHP if ($row['preg25'] == 'Más de 3 años') echo 'checked';?>>Más de 3 años</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>						

 			<tr><td colspan="2">28.	¿Nos podría decir cuál es su edad?<INPUT size="10" type="text" name="preg26" value="<?PHP echo $row['preg26']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>	
									
			<table>
			<tr><td colspan="2"><h3>Término de encuesta</h3></td></tr>

			<tr><td colspan="2"><h3><?PHP echo $row['NOMBRE_ASEGURADO']; ?>, la encuesta ha concluido, muchas gracias por su colaboración y tiempo.</h3></td></tr>

			<tr><td colspan="2">.</td><td></td></tr>

<?PHP 
			require_once("../funciones/conectar.php");
			$strsql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
			VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Comienza Ingreso Encuesta 1. Encuestador ".$_SESSION['s_id_acceso']."')";			
			query_bd($strsql);
?> 			

			<tr><td colspan="2">.</td></tr>
			<tr><td colspan="2">

			</td></tr>

			</table>
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="button" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" onclick="validar()">
			</div>
			
			<tr><td colspan="2">.</td><td></td></tr>

			</form>
			
<?PHP
				}
			}
?>
		</td>
	</tr>
	</table>

	<!-- jQuery libs - Rest are found in the head section (at top) -->
	<script type="text/javascript" src="../js/jquery.visualize-tooltip.js"></script>
	<script type="text/javascript" src="../js/jquery-animate-css-rotate-scale.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="../js/jquery.poshytip.min.js"></script>
	<script type="text/javascript" src="../js/jquery.quicksand.js"></script>
	<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/jquery.facebox.js"></script>
	<script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="../js/syntaxHighlighter/shCore.js"></script>
	<script type="text/javascript" src="../js/syntaxHighlighter/shBrushXml.js"></script>
	<script type="text/javascript" src="../js/syntaxHighlighter/shBrushJScript.js"></script>
	<script type="text/javascript" src="../js/syntaxHighlighter/shBrushCss.js"></script>
	<script type="text/javascript" src="../js/syntaxHighlighter/shBrushPhp.js"></script>
	<script type="text/javascript" src="../js/fileTree/jqueryFileTree.js"></script> <!-- Added in 1.2 -->
	
	<!-- jQuery Customization -->
	<script type="text/javascript" src="../js/custom.js"></script>
	
	</body>
	</html>
<?PHP
}
?>
