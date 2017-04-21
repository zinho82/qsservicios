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
			$("#preg2_area1").change(function(event){
				var id = $("#preg2_area1").find(':selected').val();
				var preg2_area1 = $("#preg2_area1").find(':selected').val();
				$("#preg2_causa1").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg2_area2").change(function(event){
				var id = $("#preg2_area2").find(':selected').val();
				var preg2_area2 = $("#preg2_area2").find(':selected').val();
				$("#preg2_causa2").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg2_area3").change(function(event){
				var id = $("#preg2_area3").find(':selected').val();
				var preg2_area3 = $("#preg2_area3").find(':selected').val();
				$("#preg2_causa3").load('causas.php?id='+id);
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
.Estilo1 {
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

			$StrSql="select * From qs_acceso where	id_acceso='".$_SESSION['s_id_acceso']."'";
			$result=consulta_bd($StrSql);
			$row = mysql_fetch_array($result);
			$nombre_acceso = $row['nombre_acceso'];

			$strsql="select * 
			from qs_encuestascli_sodimac_pack e 
			left join qs_encuesta_sodimac_pack pe on e.id_encuesta = pe.id_encuesta 
			inner join qs_estadosencuestas est on e.estado = est.id_estado
			where e.estado in (1,2) 
			and id_acceso = '".$_SESSION['s_id_acceso']."' 
			and id_formato = '".$_GET['id_formato']."' and e.id_encuesta = '".$_GET['id_encuesta']."' 
			order by e.id_encuesta";
			
//			print $strsql;

			$result=consulta_bd($strsql);
			if ($result)
			{
				if($row = mysql_fetch_array($result))
				{

				$StrSql="UPDATE qs_encuesta_sodimac_pack set 
				fec_inicio = NOW() 
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<form name="ingreso" action="IngresarEncuestaSODI_PACK.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">

			<INPUT type="hidden" name="Rut" id="Rut" value="<?PHP echo $row['Rut']; ?>">
			<INPUT type="hidden" name="NombreCliente" id="NombreCliente" value="<?PHP echo $row['NombreCliente']; ?>">
			
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
				* Seleccione Fecha si Posterga--><INPUT type="text" name="fec_postergada" id="fec_postergada" size="20" class="date">
				<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			</div>

 			<table>
			<tr><td colspan="2"><h2>Inicio Encuesta SODIMAC PACK</h2></td></tr>
			<tr><td>Tienda</td><td><INPUT size="45" type="text" name="Tienda" value="<?PHP echo $row['Tienda']; ?>"></td><td>Proyecto</td><td><INPUT size="45" type="text" name="Proyecto" value="<?PHP echo $row['Proyecto']; ?>"></td></tr>			
			<tr><td>FecPago</td><td><INPUT size="45" type="text" name="FecPago" value="<?PHP echo $row['FecPago']; ?>"></td><td>NombreCliente</td><td><INPUT size="60" type="text" name="NombreCliente" value="<?PHP echo $row['NombreCliente']; ?>"></td></tr>
			<tr><td>Rut</td><td><INPUT size="45" type="text" name="Rut" value="<?PHP echo $row['Rut']; ?>"></td><td>Fono</td><td><INPUT size="45" type="text" name="Fono" value="<?PHP echo $row['Fono']; ?>"></td></tr>
			<tr><td>Calle</td><td><INPUT size="45" type="text" name="Calle" value="<?PHP echo $row['Calle']; ?>"></td><td>Numero</td><td><INPUT size="45" type="text" name="Numero" value="<?PHP echo $row['Numero']; ?>"></td></tr>
			<tr><td>Comuna</td><td><INPUT size="45" type="text" name="Comuna" value="<?PHP echo $row['Comuna']; ?>"></td><td>Ciudad</td><td><INPUT size="45" type="text" name="Ciudad" value="<?PHP echo $row['Ciudad']; ?>"></td></tr>
			<tr><td>MesPagoPack</td><td><INPUT size="45" type="text" name="MesPagoPack" value="<?PHP echo $row['MesPagoPack']; ?>"></td><td>Year</td><td><INPUT size="45" type="text" name="Year" value="<?PHP echo $row['Year']; ?>"></td></tr>
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
					<option value="1.a.i. NO ha ido a una tienda en los últimos 6 meses" >1.a.i. NO ha ido a una tienda en los últimos 6 meses</option>
					<option value="1.a.ii. Cliente Molesto" >1.a.ii. Cliente Molesto</option>
					<option value="1.a.iii. Contesta encuesta">1.a.iii. Contesta encuesta</option>
					<option value="1.a.iv. Tuvo un problema" >1.a.iv. Tuvo un problema</option>
					<option value="1.a.vi. NO contesta encuesta">1.a.vi. NO contesta encuesta</option>
 					<option value="1.a.ix. Cliente molesto con Llamada" >1.a.ix. Cliente molesto con Llamada</option>
					<option value="1.a.xi. Volver a Llamar" >1.a.xi. Volver a Llamar</option>
				</select>
				</td>
				<td>
				<select name="status4_llamada" size="15">
					<option value="1.b.i. Número equivocado" >1.b.i. Número equivocado</option>
					<option value="1.b.ii. Inubicable por Horario" >1.b.ii. Inubicable por Horario</option>
					<option value="1.b.iii. Cliente de Viaje" >1.b.iii. Cliente de Viaje</option>
					<option value="1.b.iv. Volver a LLamar" >1.b.iv. Volver a LLamar</option>
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
			<tr><td colspan="1"><h3>Buenos días\buenas tardes\buenas noches. Mi nombre es <?PHP echo $nombre_acceso; ?> y represento a una empresa de estudios de mercado.</h3></td></tr>
			<tr><td colspan="1"><h3>Estamos interesados en saber su opinión acerca del Servicio de Remodelación baños y cocinas  de Homecenter.<br /> 
			¿Tiene disponibilidad para responder algunas preguntas durante los próximos 2 minutos? <br />
			Tenga en consideración que toda la información se mantendrá confidencial y anónima, y que no será contactado(a) en el futuro como resultado de esta encuesta.</h3></td></tr>
			</table>

 			<table>
			<tr><td><h2>I.- Encuesta General</h2></td></tr>
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">1.	Basado en su experiencia con el Servicio de Remodelación baños y cocinas  de Homecenter, ¿Qué tanto recomendaría el servicio a un amigo o un familiar?  Donde 0 es por ningún motivo y 10 absolutamente lo recomendaría.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg1" value="0" <?PHP if ($row['preg1'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg1" value="1" <?PHP if ($row['preg1'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg1" value="2" <?PHP if ($row['preg1'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg1" value="3" <?PHP if ($row['preg1'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg1" value="4" <?PHP if ($row['preg1'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg1" value="5" <?PHP if ($row['preg1'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg1" value="6" <?PHP if ($row['preg1'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg1" value="7" <?PHP if ($row['preg1'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg1" value="8" <?PHP if ($row['preg1'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg1" value="9" <?PHP if ($row['preg1'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg1" value="10" <?PHP if ($row['preg1'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg1" value="99" <?PHP if ($row['preg1'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
		
			<tr><td colspan="2">2.	¿Nos podría indicar las razones de esta nota? <br />[escribir respuesta textual] [si responde 0 a 8 y da razones positivas, preguntar qué falta para que esa nota sea 9 o 10]</td><tr>
			<tr><td><textarea name="preg2" cols="100" rows="5"><?PHP echo $row['preg2']; ?></textarea> 

			<tr><td><strong>AREA:</strong>
				<select name="preg2_area1" id ="preg2_area1" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodArea']; ?>" <?PHP if($fila['CodArea']==$row['preg2_area1']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Area']; ?></option>
				<?php
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg2_causa1" id="preg2_causa1" size="1">
				<?php
				$consulta = "SELECT * from qs_causas where CodArea = '".$row['preg2_area1']."'";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodCausa']; ?>" <?PHP if($fila['CodCausa']==$row['preg2_causa1']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Causa']; ?></option>
				<?php
				};
				?>
 				</select>

			<tr><td><strong>AREA:</strong>
				<select name="preg2_area2" id ="preg2_area2" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodArea']; ?>" <?PHP if($fila['CodArea']==$row['preg2_area2']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Area']; ?></option>
				<?php
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg2_causa2" id="preg2_causa2" size="1">
				<?php
				$consulta = "SELECT * from qs_causas where CodArea = '".$row['preg2_area2']."'";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodCausa']; ?>" <?PHP if($fila['CodCausa']==$row['preg2_causa2']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Causa']; ?></option>
				<?php
				};
				?>
 				</select>

			<tr><td><strong>AREA:</strong>
				<select name="preg2_area3" id ="preg2_area3" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_areas";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodArea']; ?>" <?PHP if($fila['CodArea']==$row['preg2_area3']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Area']; ?></option>
				<?php
				};
				?>
				</select>
				<strong>CAUSA:</strong>
				<select name="preg2_causa3" id="preg2_causa3" size="1">
				<?php
				$consulta = "SELECT * from qs_causas where CodArea = '".$row['preg2_area3']."'";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['CodCausa']; ?>" <?PHP if($fila['CodCausa']==$row['preg2_causa3']) echo "selected=\"selected\""; ?> ><?PHP echo $fila['Causa']; ?></option>
				<?php
				};
				?>
 				</select>
				
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">3.	A Continuación le solicitamos calificar el nivel de satisfacción, para una escala de 0 al 10, donde 0 es totalmente insatisfecho y 10 absolutamente satisfecho, para los siguientes atributos?</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.a. La atención y asesoría que recibió en tienda</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3a" value="0" <?PHP if ($row['preg3a'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3a" value="1" <?PHP if ($row['preg3a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3a" value="2" <?PHP if ($row['preg3a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3a" value="3" <?PHP if ($row['preg3a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3a" value="4" <?PHP if ($row['preg3a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3a" value="5" <?PHP if ($row['preg3a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3a" value="6" <?PHP if ($row['preg3a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3a" value="7" <?PHP if ($row['preg3a'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3a" value="8" <?PHP if ($row['preg3a'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3a" value="9" <?PHP if ($row['preg3a'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3a" value="10" <?PHP if ($row['preg3a'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3a" value="99" <?PHP if ($row['preg3a'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.b. Los tiempos en que se le entregó su propuesta de diseño</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3b" value="0" <?PHP if ($row['preg3b'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3b" value="1" <?PHP if ($row['preg3b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3b" value="2" <?PHP if ($row['preg3b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3b" value="3" <?PHP if ($row['preg3b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3b" value="4" <?PHP if ($row['preg3b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3b" value="5" <?PHP if ($row['preg3b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3b" value="6" <?PHP if ($row['preg3b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3b" value="7" <?PHP if ($row['preg3b'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3b" value="8" <?PHP if ($row['preg3b'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3b" value="9" <?PHP if ($row['preg3b'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3b" value="10" <?PHP if ($row['preg3b'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3b" value="99" <?PHP if ($row['preg3b'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.c. La propuesta de diseño presentada</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3c" value="0" <?PHP if ($row['preg3c'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3c" value="1" <?PHP if ($row['preg3c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3c" value="2" <?PHP if ($row['preg3c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3c" value="3" <?PHP if ($row['preg3c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3c" value="4" <?PHP if ($row['preg3c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3c" value="5" <?PHP if ($row['preg3c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3c" value="6" <?PHP if ($row['preg3c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3c" value="7" <?PHP if ($row['preg3c'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3c" value="8" <?PHP if ($row['preg3c'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3c" value="9" <?PHP if ($row['preg3c'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3c" value="10" <?PHP if ($row['preg3c'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3c" value="99" <?PHP if ($row['preg3c'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.d. El presupuesto de producto presentado es acorde con lo que tenía en mente respecto al valor de su proyecto</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3d" value="0" <?PHP if ($row['preg3d'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3d" value="1" <?PHP if ($row['preg3d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3d" value="2" <?PHP if ($row['preg3d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3d" value="3" <?PHP if ($row['preg3d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3d" value="4" <?PHP if ($row['preg3d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3d" value="5" <?PHP if ($row['preg3d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3d" value="6" <?PHP if ($row['preg3d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3d" value="7" <?PHP if ($row['preg3d'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3d" value="8" <?PHP if ($row['preg3d'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3d" value="9" <?PHP if ($row['preg3d'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3d" value="10" <?PHP if ($row['preg3d'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3d" value="99" <?PHP if ($row['preg3d'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.e. El presupuesto de mano de obra presentado es acorde con lo que tenía en mente respecto al valor de instalación de su  proyecto</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3e" value="0" <?PHP if ($row['preg3e'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3e" value="1" <?PHP if ($row['preg3e'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3e" value="2" <?PHP if ($row['preg3e'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3e" value="3" <?PHP if ($row['preg3e'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3e" value="4" <?PHP if ($row['preg3e'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3e" value="5" <?PHP if ($row['preg3e'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3e" value="6" <?PHP if ($row['preg3e'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3e" value="7" <?PHP if ($row['preg3e'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3e" value="8" <?PHP if ($row['preg3e'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3e" value="9" <?PHP if ($row['preg3e'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3e" value="10" <?PHP if ($row['preg3e'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3e" value="99" <?PHP if ($row['preg3e'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.f. La variedad de productos para elegir</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3f" value="0" <?PHP if ($row['preg3f'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3f" value="1" <?PHP if ($row['preg3f'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3f" value="2" <?PHP if ($row['preg3f'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3f" value="3" <?PHP if ($row['preg3f'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3f" value="4" <?PHP if ($row['preg3f'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3f" value="5" <?PHP if ($row['preg3f'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3f" value="6" <?PHP if ($row['preg3f'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3f" value="7" <?PHP if ($row['preg3f'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3f" value="8" <?PHP if ($row['preg3f'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3f" value="9" <?PHP if ($row['preg3f'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3f" value="10" <?PHP if ($row['preg3f'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3f" value="99" <?PHP if ($row['preg3f'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.g. Los tiempos entregados para comenzar con la obra.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3g" value="0" <?PHP if ($row['preg3g'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3g" value="1" <?PHP if ($row['preg3g'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3g" value="2" <?PHP if ($row['preg3g'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3g" value="3" <?PHP if ($row['preg3g'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3g" value="4" <?PHP if ($row['preg3g'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3g" value="5" <?PHP if ($row['preg3g'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3g" value="6" <?PHP if ($row['preg3g'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3g" value="7" <?PHP if ($row['preg3g'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3g" value="8" <?PHP if ($row['preg3g'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3g" value="9" <?PHP if ($row['preg3g'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3g" value="10" <?PHP if ($row['preg3g'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3g" value="99" <?PHP if ($row['preg3g'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
			<tr><td colspan="2">3.h. Formas de financiamiento para su proyecto</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3h" value="0" <?PHP if ($row['preg3h'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg3h" value="1" <?PHP if ($row['preg3h'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3h" value="2" <?PHP if ($row['preg3h'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3h" value="3" <?PHP if ($row['preg3h'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3h" value="4" <?PHP if ($row['preg3h'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3h" value="5" <?PHP if ($row['preg3h'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3h" value="6" <?PHP if ($row['preg3h'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3h" value="7" <?PHP if ($row['preg3h'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg3h" value="8" <?PHP if ($row['preg3h'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg3h" value="9" <?PHP if ($row['preg3h'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg3h" value="10" <?PHP if ($row['preg3h'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg3h" value="99" <?PHP if ($row['preg3h'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>
						
			<tr><td colspan="2">4.	¿Por qué no compró o no ha comprado el proyecto?</td><tr>
			<tr><td><textarea name="preg4" cols="100" rows="5"><?PHP echo $row['preg4']; ?></textarea> 
			<tr><td><strong>MOTIVO :</strong>
				<select name="preg4_mot" id ="preg4_mot" size="1">
	            <option value="">Selecciona</option>
				<?php
				$consulta = "SELECT * from qs_motivos order by id";
				$query=consulta_bd($consulta);
				while ($fila = mysql_fetch_array($query)) {
				?>
					<option value="<?PHP echo $fila['id']; ?>" <?PHP if($fila['id']==$row['preg4_mot']) echo "selected=\"selected\"";?>><?PHP echo $fila['Motivo']; ?></option>'
				<?php
				};
				?>
				</select>
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">5.	¿ Compró el proyecto en otra parte?</td><tr>
			<tr><td>a.	¿Dónde? :<INPUT size="60" type="text" name="preg5" value="<?PHP echo $row['preg5']; ?>"> 
			<tr><td colspan="2"><br /></td></tr>

			</table>			

			<table>
			<tr><td colspan="2"><h3>Término de Encuesta</h3></td></tr>

			<tr><td colspan="2">.</td></tr>
			<tr><td colspan="2">

			</td></tr>

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
