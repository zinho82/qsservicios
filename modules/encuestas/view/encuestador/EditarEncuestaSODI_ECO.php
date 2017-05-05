<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

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
			$("#preg4_area1").change(function(event){
				var id = $("#preg4_area1").find(':selected').val();
				$("#preg4_causa1").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg4_area2").change(function(event){
				var id = $("#preg4_area2").find(':selected').val();
				$("#preg4_causa2").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg4_area3").change(function(event){
				var id = $("#preg4_area3").find(':selected').val();
				$("#preg4_causa3").load('causas.php?id='+id);
			});
		});

		$(document).ready(function(){
			$("#preg6_area1").change(function(event){
				var id = $("#preg6_area1").find(':selected').val();
				$("#preg6_causa1").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg6_area2").change(function(event){
				var id = $("#preg6_area2").find(':selected').val();
				$("#preg6_causa2").load('causas.php?id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg6_area3").change(function(event){
				var id = $("#preg6_area3").find(':selected').val();
				$("#preg6_causa3").load('causas.php?id='+id);
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
			from qs_encuestascli_sodimac_eco e 
			left join qs_encuesta_sodimac_eco pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuesta_sodimac_eco set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR)  	
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<form name="ingreso" action="IngresarEncuestaSODI_ECO.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">

			<INPUT type="hidden" name="TIPO_CLIENTE" id="TIPO_CLIENTE" value="<?PHP echo $row['TIPO_CLIENTE']; ?>">
			<INPUT type="hidden" name="Nombre" id="Nombre" value="<?PHP echo $row['Nombre']; ?>">
			
			<div class="field">
				<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
				<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
				<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
				* Seleccione Fecha si Posterga--><INPUT type="text" name="fec_postergada" id="fec_postergada" size="20" class="date">
				<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			</div>

 			<table>
			<tr><td colspan="2"><h2>Inicio Encuesta SODIMAC INDIVIDUO</h2></td></tr>
			<tr><td>Id1</td><td><INPUT size="45" type="text" name="Id1" value="<?PHP echo $row['Id1']; ?>"></td><td>TIPO_CLIENTE</td><td><INPUT size="45" type="text" name="TIPO_CLIENTE" value="<?PHP echo $row['TIPO_CLIENTE']; ?>"></td></tr>			
			<tr><td>Nombre</td><td><INPUT size="45" type="text" name="Nombre" value="<?PHP echo $row['Nombre']; ?>"></td><td>Direccion</td><td><INPUT size="60" type="text" name="Direccion" value="<?PHP echo $row['Direccion']; ?>"></td></tr>
			<tr><td>Comuna</td><td><INPUT size="45" type="text" name="Comuna" value="<?PHP echo $row['Comuna']; ?>"></td><td>CUIDAD</td><td><INPUT size="45" type="text" name="CUIDAD" value="<?PHP echo $row['CUIDAD']; ?>"></td></tr>
			<tr><td>REGION</td><td><INPUT size="45" type="text" name="REGION" value="<?PHP echo $row['REGION']; ?>"></td><td>FechaNacimiento</td><td><INPUT size="45" type="text" name="FechaNacimiento" value="<?PHP echo $row['FechaNacimiento']; ?>"></td></tr>
			<tr><td>EDAD</td><td><INPUT size="2" type="text" name="EDAD" value="<?PHP echo $row['EDAD']; ?>">Especialidad: <INPUT size="21" type="text" name="Sexo" value="<?PHP echo $row['Sexo']; ?>"></td><td>TARJETA</td><td><INPUT size="10" type="text" name="TARJETA" value="<?PHP echo $row['TARJETA']; ?>"></td></tr>
			<tr><td>DISC_AT1</td><td><INPUT size="45" type="text" name="DISC_AT1" value="<?PHP echo $row['DISC_AT1']; ?>"></td><td>FONO_AT1</td><td><INPUT size="45" type="text" name="FONO_AT1" value="<?PHP echo $row['FONO_AT1']; ?>"></td></tr>
			<tr><td>DISC_AT2</td><td><INPUT size="45" type="text" name="DISC_AT2" value="<?PHP echo $row['DISC_AT2']; ?>"></td><td>FONO_AT2</td><td><INPUT size="45" type="text" name="FONO_AT2" value="<?PHP echo $row['FONO_AT2']; ?>"></td></tr>
			<tr><td>DISC_AT3</td><td><INPUT size="45" type="text" name="DISC_AT3" value="<?PHP echo $row['DISC_AT3']; ?>"></td><td>FONO_AT3</td><td><INPUT size="45" type="text" name="FONO_AT3" value="<?PHP echo $row['FONO_AT3']; ?>"></td></tr>
			<tr><td>DISC_AT4</td><td><INPUT size="45" type="text" name="DISC_AT4" value="<?PHP echo $row['DISC_AT4']; ?>"></td><td>FONO_AT4</td><td><INPUT size="45" type="text" name="FONO_AT4" value="<?PHP echo $row['FONO_AT4']; ?>"></td></tr>
			<tr><td>DISC_AT5</td><td><INPUT size="45" type="text" name="DISC_AT5" value="<?PHP echo $row['DISC_AT5']; ?>"></td><td>FONO_AT5</td><td><INPUT size="45" type="text" name="FONO_AT5" value="<?PHP echo $row['FONO_AT5']; ?>"></td></tr>
			<tr><td>ddd_Cel</td><td><INPUT size="45" type="text" name="ddd_Cel" value="<?PHP echo $row['ddd_Cel']; ?>"></td><td>Num_Celular</td><td><INPUT size="45" type="text" name="Num_Celular" value="<?PHP echo $row['Num_Celular']; ?>"></td></tr>
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
<!-- 					
					<option value="1.a.vii. No recuerda haber tenido siniestro/ servicio" >1.a.vii. No recuerda haber tenido siniestro/ servicio</option>
					<option value="1.a.viii. Renuncio al seguro" >1.a.viii. Renuncio al seguro</option>
 -->				
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
			<tr><td colspan="1"><h3>Buenos días\buenas tardes\buenas noches. Mi nombre es <?PHP echo $nombre_acceso; ?> y estamos interesados en conocer su nivel de satisfacción con las tiendas de mejoramiento del hogar.</h3></td></tr>
			<tr><td colspan="1"><h3>Y para ello queremos entender sus opiniones acerca de este tipo de tiendas.<br /> 
			¿Tiene disponibilidad para responder algunas preguntas durante los próximos 2 minutos? <br />
			Tenga en consideración que toda la información se mantendrá confidencial y anónima, y que no será contactado(a) en el futuro como resultado de esta encuesta.</h3></td></tr>
			</table>

 			<table>
			<tr><td><h2>I.- Encuesta General</h2></td></tr>
			<tr><td colspan="1"><h3>Nos gustaría consultar, particularmente, su relación con <span class="Estilo1">HOMECENTER.</span></h3></td></tr>
			<tr><td colspan="2">1. Antes que nada, quisiera confirmar que usted es <?PHP echo $row['Nombre']; ?></td><tr>
			<tr><td><INPUT type="radio" name="preg1" value="SI" <?PHP if ($row['preg1'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="NO" <?PHP if ($row['preg1'] == 'NO') echo 'checked';?>>NO <span class="Estilo1">pedir hablar con el contacto; en caso de no ser posible, terminar</span> </td>
			</tr>
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">2. En una escala de 0 a 10, donde “0” significa “no recomendaría en lo absoluto” y “10” significa “definitivamente recomendaría”, ¿qué tanto recomendaría a Homecenter a un familiar o amigo?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg2" value="0" <?PHP if ($row['preg2'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg2" value="1" <?PHP if ($row['preg2'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg2" value="2" <?PHP if ($row['preg2'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg2" value="3" <?PHP if ($row['preg2'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg2" value="4" <?PHP if ($row['preg2'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg2" value="5" <?PHP if ($row['preg2'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg2" value="6" <?PHP if ($row['preg2'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg2" value="7" <?PHP if ($row['preg2'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg2" value="8" <?PHP if ($row['preg2'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg2" value="9" <?PHP if ($row['preg2'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg2" value="10" <?PHP if ($row['preg2'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg2" value="99" <?PHP if ($row['preg2'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2"><span class="Estilo1">Si responde con nota: 7, 8, 9 o 10</span></td><tr>
			
			<tr><td colspan="2">3. ¿Cuántas veces, aproximadamente, ha hablado positivamente de Homecenter a un colega o amigo durante el último año? </td><tr>
			<tr><td><INPUT size="30" type="text" name="preg3" value="<?PHP echo $row['preg3']; ?>"> 
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">4. ¿Cuántas veces, aproximadamente, ha hablado positivamente de Homecenter a través de redes sociales, como Facebook o Twitter, durante el último año?</td><tr>
			<tr><td><INPUT size="30" type="text" name="preg4" value="<?PHP echo $row['preg4']; ?>"> 
			<tr><td colspan="2"><br /></td></tr>
						
			<tr><td colspan="2"><span class="Estilo1">Si responde con nota: 0 a 6</span></td><tr>

			<tr><td colspan="2">5. ¿Cuántas veces, aproximadamente, ha hablado positivamente de Homecenter a un colega o amigo durante el último año? </td><tr>
			<tr><td><INPUT size="30" type="text" name="preg5" value="<?PHP echo $row['preg5']; ?>"> 
			<tr><td colspan="2"><br /></td></tr>

			<tr><td colspan="2">6. ¿Cuántas veces, aproximadamente, ha hablado positivamente de Homecenter a través de redes sociales, como Facebook o Twitter, durante el último año?</td><tr>
			<tr><td><INPUT size="30" type="text" name="preg6" value="<?PHP echo $row['preg6']; ?>"> 
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
