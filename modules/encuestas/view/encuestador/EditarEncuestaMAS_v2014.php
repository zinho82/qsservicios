<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

date_default_timezone_set('America/Santiago');

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
	<title>SIE - Sistema Ingreso de Encuestas</title>

    <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script language="JavaScript" type="text/JavaScript">	
		$(document).ready(function(){
			$("#preg13_area1").change(function(event){
				var id = $("#preg13_area1").find(':selected').val();
				$("#preg13_causa1").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg13_area2").change(function(event){
				var id = $("#preg13_area2").find(':selected').val();
				$("#preg13_causa2").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg13_area3").change(function(event){
				var id = $("#preg13_area3").find(':selected').val();
				$("#preg13_causa3").load('causas.php?id='+id);
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
		<td valign="top">
			<?PHP
//			include_once("../funciones/combos.php");
			require_once("../funciones/conectar.php");

			$strsql="select * 
			from qs_encuestascli_masgarantia_v2014 e 
			left join qs_encuesta_masgarantia_v2014 pe on e.id_encuesta = pe.id_encuesta 
			inner join qs_estadosencuestas est on e.estado = est.id_estado
			where e.estado in (1,2) 
			and id_acceso = '".$_SESSION['s_id_acceso']."' 
			and id_formato = '".$_GET['id_formato']."' and e.id_encuesta >= '".$_GET['id_encuesta']."' 
			order by e.id_encuesta";

			//print $strsql;
			$result=consulta_bd($strsql);
			if ($result)
			{
				if($row = mysql_fetch_array($result))
				{

				$StrSql="UPDATE qs_encuestascli_masgarantia_v2014 set 
				fec_inicio = NOW() 
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta de Satisfacción de Servicio y Asistencia</h1>
			<h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaMAS_v2014.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">
			
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
				* Seleccione Fecha si Posterga--><INPUT type="text" name="fec_postergada" id="fec_postergada" size="20" class="date">
				<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			</div>
		
 			<table>
			<tr><td colspan="2"><h2>Datos del Asegurado</h2></td></tr>
			<tr><td>Cod. Servicio</td><td><INPUT size="17" type="text" name="cod_servicio" value="<?PHP echo $row['cod_servicio']; ?>"></td></tr>
			<tr><td>Nombre Cliente</td><td><INPUT size="50" type="text" name="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>"></td></tr>
			<tr><td>Apellido Cliente</td><td><INPUT size="50" type="text" name="ape_cliente" value="<?PHP echo $row['ape_cliente']; ?>"></td></tr>
			<tr><td>Rut Cliente</td><td><INPUT size="10" type="text" name="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>"> - <INPUT size="1" type="text" name="dv" value="<?PHP echo $row['dv']; ?>"></td></tr>
			<tr><td>Teléfono Contacto 1</td><td><INPUT size="50" type="text" name="fono1" value="<?PHP echo $row['fono1']; ?>"></td></tr>
			<tr><td>Teléfono Contacto 2</td><td><INPUT size="50" type="text" name="fono2" value="<?PHP echo $row['fono2']; ?>"></td></tr>
			<tr><td>Patente</td><td><INPUT size="17" type="text" name="patente" value="<?PHP echo $row['patente']; ?>"></td></tr>
			<tr><td>Comuna Cliente</td><td><INPUT size="50" type="text" name="com_cliente" value="<?PHP echo $row['com_cliente']; ?>"></td></tr>
			<tr><td>Compañia de Seguros</td><td><INPUT size="50" type="text" name="compania" value="<?PHP echo $row['compania']; ?>"></td></tr>
			<tr><td>Ramo</td><td><INPUT size="17" type="text" name="ramo" value="<?PHP echo $row['ramo']; ?>"></td></tr>
			<tr><td>Fecha Siniestro</td><td><INPUT size="17" type="text" name="fec_siniestro" value="<?PHP echo $row['fec_siniestro']; ?>"></td></tr>
			<tr><td>Hora Siniestro</td><td><INPUT size="17" type="text" name="hor_siniestro" value="<?PHP echo $row['hor_siniestro']; ?>"></td></tr>
			<tr><td>Ciudad Siniestro</td><td><INPUT size="50" type="text" name="ciu_siniestro" value="<?PHP echo $row['ciu_siniestro']; ?>"></td></tr>
			<tr><td>Región Siniestro</td><td><INPUT size="50" type="text" name="region" value="<?PHP echo $row['region']; ?>"></td></tr>
			<tr><td>Tipo Siniestro</td><td><INPUT size="50" type="text" name="tip_siniestro" value="<?PHP echo $row['tip_siniestro']; ?>"></td></tr>
			<tr><td>Servicio</td><td><INPUT size="50" type="text" name="servicio" value="<?PHP echo $row['servicio']; ?>"></td></tr>
			<tr><td>Cobertura</td><td><INPUT size="50" type="text" name="cobertura" value="<?PHP echo $row['cobertura']; ?>"></td></tr>
		</table>

			
			<table>
			<tr><td><h2>A.- Ayúdenos a mejorar</h2></td></tr>
			<tr><td>Señor(a) <b><?PHP echo $row['nom_cliente'];?></b>, usted requirió recientemente nuestro servicio de asistencia, con el servicio de <b><?PHP echo $row['servicio'];?></b> y nos gustaría comprobar su nivel de satisfacción.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Por favor, les solicitamos que dedique un momento para completar esta pequeña encuesta, cuyo objetivo es mejorar la calidad de servicio que le otorgamos.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Sus respuestas serán tratadas de forma confidencial y no serán utilizadas para ningún propósito distinto al mencionado.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Esta encuesta dura aproximadamente 3 minutos.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="3">
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
					<option value="1. Contacto">1. Contacto</option>
					<option value="2. No Contacto" >2. No Contacto</option>
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
				</select>
				</td>
				<td>
				<select name="status4_llamada" size="15">
					<option value="1.b.i. Número equivocado" >1.b.i. Número equivocado</option>
					<option value="1.b.ii. Inubicable por Horario" >1.b.ii. Inubicable por Horario</option>
					<option value="1.b.iii. Cliente de Viaje" >1.b.iii. Cliente de Viaje</option>
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

			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="8">1. a.¿Recuerda que servicio fué el que solicitó ?</td><tr>
			<tr><td>
			<tr><td><INPUT size="150" type="text" name="preg1_a" value="<?PHP echo $row['preg1_a']; ?>"></td></tr>
			</td><tr>
			<tr><td colspan="2"><h3><b>Si el cliente indica que fué grúa, se debe preguntar:</b></h3></td><tr>
			<tr><td colspan="2">b.	El servicio solicitado, ¿fue por un siniestro?</td><tr>
			<tr><td><INPUT type="radio" name="preg1_b" value="SI" <?PHP if ($row['preg1_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg1_b" value="NO" <?PHP if ($row['preg1_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">c. Si la respuesta anterior es SI: ¿Que nota le colocaría a la atención del Liquidador?. </td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg1_c" value="1" <?PHP if ($row['preg1_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg1_c" value="2" <?PHP if ($row['preg1_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg1_c" value="3" <?PHP if ($row['preg1_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg1_c" value="4" <?PHP if ($row['preg1_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg1_c" value="5" <?PHP if ($row['preg1_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg1_c" value="6" <?PHP if ($row['preg1_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg1_c" value="7" <?PHP if ($row['preg1_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="8">2. ¿Con qué frecuencia ha utilizado los servicios que brinda la póliza de seguros de su compañía?</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg2" value="1 vez a la semana" <?PHP if ($row['preg2'] == '1 vez a la semana') echo 'checked';?>>1 vez a la semana</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="1 vez al mes" <?PHP if ($row['preg2'] == '1 vez al mes') echo 'checked';?>>1 vez al mes</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Más de 1 vez al mes" <?PHP if ($row['preg2'] == 'Más de 1 vez al mes') echo 'checked';?>>Más de 1 vez al mes</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="1 vez cada 6 meses" <?PHP if ($row['preg2'] == '1 vez cada 6 meses') echo 'checked';?>>1 vez cada 6 meses</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="1 vez al año" <?PHP if ($row['preg2'] == '1 vez al año') echo 'checked';?>>1 vez al año</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Más de una vez al año" <?PHP if ($row['preg2'] == 'Más de una vez al año') echo 'checked';?>>Más de una vez al año</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Primera vez" <?PHP if ($row['preg2'] == 'Primera vez') echo 'checked';?>>Primera vez</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>B.- Satisfacción General</h2></td></tr>
			<tr><td colspan="2">3.	¿Cuál es el grado de satisfacción general del servicio de <b><?PHP echo $row['servicio'];?></b> entregado?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3" value="1" <?PHP if ($row['preg3'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3" value="2" <?PHP if ($row['preg3'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3" value="3" <?PHP if ($row['preg3'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3" value="4" <?PHP if ($row['preg3'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3" value="5" <?PHP if ($row['preg3'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3" value="6" <?PHP if ($row['preg3'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3" value="7" <?PHP if ($row['preg3'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="8">4. Considerando que es un servicio de emergencia y considerando su expectativa de respuesta, usted diría que la asistencia brindada fué:</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg4" value="Excelente" <?PHP if ($row['preg4'] == 'Excelente') echo 'checked';?>>Excelente</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="Mucho mejor a lo esperado" <?PHP if ($row['preg4'] == 'Mucho mejor a lo esperado') echo 'checked';?>>Mucho mejor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="Algo mejor a lo esperado" <?PHP if ($row['preg4'] == 'Algo mejor a lo esperado') echo 'checked';?>>Algo mejor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="Más o menos igual a lo esperado" <?PHP if ($row['preg4'] == 'Más o menos igual a lo esperado') echo 'checked';?>>Más o menos igual a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="Algo peor a lo esperado" <?PHP if ($row['preg4'] == 'Algo peor a lo esperado') echo 'checked';?>>Algo peor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="Mucho peor a lo esperado" <?PHP if ($row['preg4'] == 'Mucho peor a lo esperado') echo 'checked';?>>Mucho peor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg4" value="No lo sé" <?PHP if ($row['preg4'] == 'No lo sé') echo 'checked';?>>No lo sé</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">5. ¿Qué nota le colocaría a la Facilidad de comunicación al momento de solicitar el servicio de <?PHP echo $row['servicio']; ?>?</td><tr>
 			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg5" value="1" <?PHP if ($row['preg5'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg5" value="2" <?PHP if ($row['preg5'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg5" value="3" <?PHP if ($row['preg5'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg5" value="4" <?PHP if ($row['preg5'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg5" value="5" <?PHP if ($row['preg5'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg5" value="6" <?PHP if ($row['preg5'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg5" value="7" <?PHP if ($row['preg5'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="8">Si la nota es igual o menor a 5 preguntar, ¿Qué tendría que mejorar para ser calificado con nota 7?</td><tr>
			<tr><td>
			<tr><td><textarea name="preg5_1" cols="100" rows="5"><?PHP echo $row['preg5_1']; ?></textarea></td></tr>
			<tr><td>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>C.- Satisfacción Atributos</h2></td></tr>
			<tr><td><h2>NO APLICA ESTA PREGUNTA SI EL SERVICIO BRINDADO ES VEHÍCULO DE REEMPLAZO</h2></td></tr>
			<tr><td colspan="2">6.	En relación al tiempo de espera del servicio:</td><tr>
			<tr><td colspan="2">a. Fue adecuado el tiempos de espera para la llegada del servicio de <?PHP echo $row['servicio']; ?>, entregado por la telefonista? </td><tr>
			<tr><td><INPUT type="radio" name="preg6_a" value="SI" <?PHP if ($row['preg6_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg6_a" value="NO" <?PHP if ($row['preg6_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">b. ¿Se cumplió el tiempo de espera entregados por parte del operador?</td><tr>
			<tr><td><INPUT type="radio" name="preg6_b" value="SI" <?PHP if ($row['preg6_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg6_b" value="NO" <?PHP if ($row['preg6_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h3>APLICA ESTA PREGUNTA SOLO SI ES SERVICIO BRINDADO ES VEHÍCULO DE REEMPLAZO</h3></td></tr>
			<tr><td colspan="2">7.	En relación al vehículo entregado, califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td colspan="2">a.	Antigüedad del Vehículo</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg7_a" value="1" <?PHP if ($row['preg7_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_a" value="2" <?PHP if ($row['preg7_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_a" value="3" <?PHP if ($row['preg7_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_a" value="4" <?PHP if ($row['preg7_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_a" value="5" <?PHP if ($row['preg7_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_a" value="6" <?PHP if ($row['preg7_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_a" value="7" <?PHP if ($row['preg7_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	Limpieza del Vehículo</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg7_b" value="1" <?PHP if ($row['preg7_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_b" value="2" <?PHP if ($row['preg7_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_b" value="3" <?PHP if ($row['preg7_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_b" value="4" <?PHP if ($row['preg7_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_b" value="5" <?PHP if ($row['preg7_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_b" value="6" <?PHP if ($row['preg7_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_b" value="7" <?PHP if ($row['preg7_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	Estado del Vehículo</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg7_c" value="1" <?PHP if ($row['preg7_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_c" value="2" <?PHP if ($row['preg7_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_c" value="3" <?PHP if ($row['preg7_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_c" value="4" <?PHP if ($row['preg7_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_c" value="5" <?PHP if ($row['preg7_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_c" value="6" <?PHP if ($row['preg7_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_c" value="7" <?PHP if ($row['preg7_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	Período de días del beneficio</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg7_d" value="1" <?PHP if ($row['preg7_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_d" value="2" <?PHP if ($row['preg7_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_d" value="3" <?PHP if ($row['preg7_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_d" value="4" <?PHP if ($row['preg7_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_d" value="5" <?PHP if ($row['preg7_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_d" value="6" <?PHP if ($row['preg7_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_d" value="7" <?PHP if ($row['preg7_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2">8.	En relación al personal que fue a brindar el servicio de <b><?PHP echo $row['servicio'];?></b>, ¿cómo <b>fue el trato del personal</b> que concurrió a asistirlo?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg8" value="1" <?PHP if ($row['preg8'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8" value="2" <?PHP if ($row['preg8'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8" value="3" <?PHP if ($row['preg8'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8" value="4" <?PHP if ($row['preg8'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8" value="5" <?PHP if ($row['preg8'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8" value="6" <?PHP if ($row['preg8'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8" value="7" <?PHP if ($row['preg8'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="8">Si la nota es igual o menor a 5 preguntar, ¿Qué tendría que mejorar para ser calificado con nota 7?</td><tr>
			<tr><td>
			<tr><td><textarea name="preg8_1" cols="100" rows="5"><?PHP echo $row['preg8_1']; ?></textarea></td></tr>
			<tr><td>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">9.	En relación a la presentación del personal que fue a brindar el servicio de <b><?PHP echo $row['servicio'];?></b>, ¿cómo calificaría la presentación del personal que concurrió a asistirlo?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg9" value="1" <?PHP if ($row['preg9'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg9" value="2" <?PHP if ($row['preg9'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg9" value="3" <?PHP if ($row['preg9'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg9" value="4" <?PHP if ($row['preg9'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg9" value="5" <?PHP if ($row['preg9'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg9" value="6" <?PHP if ($row['preg9'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg9" value="7" <?PHP if ($row['preg9'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="8">Si la nota es igual o menor a 5 preguntar, ¿Qué tendría que mejorar para ser calificado con nota 7?</td><tr>
			<tr><td>
			<tr><td><textarea name="preg9_1" cols="100" rows="5"><?PHP echo $row['preg9_1']; ?></textarea></td></tr>
			<tr><td>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>D.- Valoración del Servicio</h2></td></tr>
			<tr><td colspan="2">Teniendo en cuenta su experiencia reciente con el servicio de <b><?PHP echo $row['servicio'];?></b> de Compañia de Seguros <b><?PHP echo $row['compania'];?></b>:</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="8">10.	El servicio brindado, ¿es un atributo positivo como parte de su póliza de seguro <b><?PHP echo $row['ramo'];?></b>?</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg10" value="Totalmente de acuerdo" <?PHP if ($row['preg10'] == 'Totalmente de acuerdo') echo 'checked';?>>Totalmente de acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="De acuerdo" <?PHP if ($row['preg10'] == 'De acuerdo') echo 'checked';?>>De acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="En desacuerdo" <?PHP if ($row['preg10'] == 'En desacuerdo') echo 'checked';?>>En desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="Más o menos igual" <?PHP if ($row['preg10'] == 'Más o menos igual') echo 'checked';?>>Más o menos igual</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="Totalmente en desacuerdo" <?PHP if ($row['preg10'] == 'Totalmente en desacuerdo') echo 'checked';?>>Totalmente en desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="No se aplica" <?PHP if ($row['preg10'] == 'No se aplica') echo 'checked';?>>No se aplica</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="8">11.	Al servicio, ¿Qué nota le colocaría respecto a si atendió bien sus necesidades?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg11" value="1" <?PHP if ($row['preg11'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg11" value="2" <?PHP if ($row['preg11'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg11" value="3" <?PHP if ($row['preg11'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg11" value="4" <?PHP if ($row['preg11'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg11" value="5" <?PHP if ($row['preg11'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg11" value="6" <?PHP if ($row['preg11'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg11" value="7" <?PHP if ($row['preg11'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>E.- Recomendación y Sugerencias</h2></td></tr>
			<tr><td colspan="2">12.	En una escala de 0 a 10, donde "0” significa “no recomendaría en lo absoluto” y “10” significa “definitivamente recomendaría”,</td><tr>
			<tr><td colspan="2">”, ¿qué tanto recomendaría la Compañía de Seguros <b><?PHP echo $row['compania'];?></b> por su Servicio de Asistencia <b><?PHP echo $row['servicio'];?></b> a un Amigo o Familiar ?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg12" value="1" <?PHP if ($row['preg12'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg12" value="2" <?PHP if ($row['preg12'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg12" value="3" <?PHP if ($row['preg12'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg12" value="4" <?PHP if ($row['preg12'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg12" value="5" <?PHP if ($row['preg12'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg12" value="6" <?PHP if ($row['preg12'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg12" value="7" <?PHP if ($row['preg12'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg12" value="8" <?PHP if ($row['preg12'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg12" value="9" <?PHP if ($row['preg12'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg12" value="10" <?PHP if ($row['preg12'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg12" value="99" <?PHP if ($row['preg12'] == '99') echo 'checked';?>>99 No Sabe
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">13.	¿Cuáles son las razones de esta nota? [escribir respuesta textual]</td><tr>
			<tr><td colspan="2">[si responde 0 a 8 y da razones positivas, preguntar qué falta para que esa nota sea 9 o 10. Si la nota es 9 ó 10, pregunta por qué tan buena nota]</td><tr>
			<tr><td><textarea name="preg13" cols="100" rows="5"><?PHP echo $row['preg13']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><strong>AREA:</strong>
				<select name="preg13_area1" id ="preg13_area1" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg13_causa1" id="preg13_causa1" size="1">

 				</select>

			<tr><td><strong>AREA:</strong>
				<select name="preg13_area2" id ="preg13_area2" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg13_causa2" id="preg13_causa2" size="1">

 				</select>

			<tr><td><strong>AREA:</strong>
				<select name="preg13_area3" id ="preg13_area3" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg13_causa3" id="preg13_causa3" size="1">

 				</select>

			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">14.	Basándose en su experiencia, ¿Qué tan satisfecho se encuentra Usted, con el servicio y atención entregado por la Compañía de Seguros en el servicio de <b><?PHP echo $row['servicio'];?></b>?.</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg14" value="1" <?PHP if ($row['preg14'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg14" value="2" <?PHP if ($row['preg14'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg14" value="3" <?PHP if ($row['preg14'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg14" value="4" <?PHP if ($row['preg14'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg14" value="5" <?PHP if ($row['preg14'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg14" value="6" <?PHP if ($row['preg14'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg14" value="7" <?PHP if ($row['preg14'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">15.	¿Qué tendría que mejorar el servicio de asistencia de <?PHP echo $row['servicio']; ?> para calificarlo con Nota 7?</td><tr>
			<tr><td><textarea name="preg15" cols="100" rows="5"><?PHP echo $row['preg15']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">16.	Hay alguna cosa que le gustaría decirle a Compañía de Seguros <b><?PHP echo $row['compania'];?></b> sobre su servicio de asistencia, que no le hayamos preguntado?</td><tr>
			<tr><td colspan="2">Si es así, por favor díganos de qué se trata.</td><tr>
			<tr><td><textarea name="preg16" cols="100" rows="5"><?PHP echo $row['preg16']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

 			<tr><td colspan="2">17.	¿Hace Cuánto tiempo es cliente de Compañía de Seguros <b><?PHP echo $row['compania'];?></b> ?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg17" value="Menos de 1 mes" <?PHP if ($row['preg17'] == 'Menos de 1 mes') echo 'checked';?>>Menos de 1 mes
				<INPUT type="radio" name="preg17" value="Entre 1 – 6 meses" <?PHP if ($row['preg17'] == 'Entre 1 – 6 meses') echo 'checked';?>>Entre 1 – 6 meses
				<INPUT type="radio" name="preg17" value="Entre 6 meses – 1 años" <?PHP if ($row['preg17'] == 'Entre 6 meses – 1 años') echo 'checked';?>>Entre 6 meses – 1 años
				<INPUT type="radio" name="preg17" value="Entre 1 – 3 años" <?PHP if ($row['preg17'] == 'Entre 1 – 3 años') echo 'checked';?>>Entre 1 – 3 años
				<INPUT type="radio" name="preg17" value="Más de 3 años" <?PHP if ($row['preg17'] == 'Más de 3 años') echo 'checked';?>>Más de 3 años
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

 			<tr><td colspan="2">18.	¿Nos podría decir en cuál de los siguientes rangos de edad se encuentra usted?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg18" value="18 a 25 años" <?PHP if ($row['preg18'] == '18 a 25 años') echo 'checked';?>>18 a 25 años 
				<INPUT type="radio" name="preg18" value="26 a 35 años" <?PHP if ($row['preg18'] == '26 a 35 años') echo 'checked';?>>26 a 35 años
				<INPUT type="radio" name="preg18" value="36 a 45 años" <?PHP if ($row['preg18'] == '36 a 45 años') echo 'checked';?>>36 a 45 años
				<INPUT type="radio" name="preg18" value="46 a 55 años" <?PHP if ($row['preg18'] == '46 a 55 años') echo 'checked';?>>46 a 55 años
				<INPUT type="radio" name="preg18" value="56 a 65 años" <?PHP if ($row['preg18'] == '56 a 65 años') echo 'checked';?>>56 a 65 años
				<INPUT type="radio" name="preg18" value="66 años y +" <?PHP if ($row['preg18'] == '66 años y +') echo 'checked';?>>66 años y +
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
		

			<tr><td colspan="2"><h3>La encuesta ha concluido.</h3></td></tr>
			<tr><td colspan="2"><h3>Muchas gracias por su colaboración y tiempo.</h3></td></tr>

			<tr><td colspan="2">.</td><td></td></tr>


<?PHP 
			require_once("../funciones/conectar.php");
			$strsql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
			VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", NOW() , 'Comienza Ingreso Encuesta MAS GARANTIA v2014|. Encuestador ".$_SESSION['s_id_acceso']."')";			
			query_bd($strsql);
?> 			

			</table>
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
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
