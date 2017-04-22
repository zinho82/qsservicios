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

			$strsql="select * 
			from qs_encuestascli_hdi_seguim e 
			left join qs_encuesta_hdi_seguim pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuestascli_hdi_seguim set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR) 
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta Seguimiento Siniestros - HDI Seguros</h1>
			<h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaHDI_seguim.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">

			<INPUT type="hidden" name="rut_cliente" id="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>">
			<INPUT type="hidden" name="nom_cliente" id="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>">
			<INPUT type="hidden" name="patente" id="patente" value="<?PHP echo $row['patente']; ?>">
			<INPUT type="hidden" name="siniestro" id="siniestro" value="<?PHP echo $row['siniestro']; ?>">
			
 			<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
			<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
			
 			<table>
			<tr><td colspan="2"><h2>Inicio Encuesta HDI Seguimiento Siniestros</h2></td></tr>
			<tr><td>Rut Aseg</td><td><INPUT size="10" type="text" name="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>"></td><td>Patente</td><td><INPUT size="10" type="text" name="patente" value="<?PHP echo $row['patente']; ?>"></td></tr>			
			<tr><td>Nombre Asegurado</td><td><INPUT size="45" type="text" name="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>"></td><td>Inicio Vig.</td><td><INPUT size="10" type="text" name="vigencia_ini" value="<?PHP echo $row['vigencia_ini']; ?>"></td></tr>
			<tr><td>Dirección Asegurado</td><td><INPUT size="45" type="text" name="direccion" value="<?PHP echo $row['direccion']; ?>"></td><td>Fin Vigencia</td><td><INPUT size="10" type="text" name="vigencia_fin" value="<?PHP echo $row['vigencia_fin']; ?>"></td></tr>
			<tr><td>Desc.Comuna</td><td><INPUT size="45" type="text" name="desc_comuna" value="<?PHP echo $row['desc_comuna']; ?>"></td><td>Siniestro</td><td><INPUT size="45" type="text" name="siniestro" value="<?PHP echo $row['siniestro']; ?>"></td></tr>
			<tr><td>Código Area</td><td><INPUT size="45" type="text" name="area" value="<?PHP echo $row['area']; ?>"></td><td>Fecha Denuncia</td><td><INPUT size="10" type="text" name="fec_denuncia" value="<?PHP echo $row['fec_denuncia']; ?>"></td></tr>
			<tr><td>Nº Teléfono</td><td><INPUT size="45" type="text" name="telefono" value="<?PHP echo $row['telefono']; ?>"></td><td>Nombre Liquidador</td><td><INPUT size="45" type="text" name="nom_liquidador" value="<?PHP echo $row['nom_liquidador']; ?>"></td></tr>
			<tr><td>Email Partic.Aseg</td><td><INPUT size="45" type="text" name="email_particular" value="<?PHP echo $row['email_particular']; ?>"></td><td>Nombre Taller</td><td><INPUT size="45" type="text" name="nom_taller" value="<?PHP echo $row['nom_taller']; ?>"></td></tr>
			<tr><td>Email Oficina Aseg</td><td><INPUT size="45" type="text" name="email_oficina" value="<?PHP echo $row['email_oficina']; ?>"></td><td>Desc.Estado</td><td><INPUT size="45" type="text" name="desc_estado" value="<?PHP echo $row['desc_estado']; ?>"></td></tr>
			<tr><td>F.Nacim.Aseg</td><td><INPUT size="45" type="text" name="fec_nac" value="<?PHP echo $row['fec_nac']; ?>"></td><td>Nombre Intermediario</td><td><INPUT size="45" type="text" name="nom_intermed" value="<?PHP echo $row['nom_intermed']; ?>"></td></tr>
			<tr><td>Desc.Ramo</td><td><INPUT size="45" type="text" name="desc_ramo" value="<?PHP echo $row['desc_ramo']; ?>"></td><td>Email Part. Intermediario</td><td><INPUT size="45" type="text" name="email_part_intermed" value="<?PHP echo $row['email_part_intermed']; ?>"></td></tr>
			<tr><td>Deducible</td><td><INPUT size="10" type="text" name="deducible" value="<?PHP echo $row['deducible']; ?>"></td><td>Email Ofic. Intermediario</td><td><INPUT size="45" type="text" name="email_ofi_intermed" value="<?PHP echo $row['email_ofi_intermed']; ?>"></td></tr>

			<tr><td>Siniestro Adicional 1</td><td><INPUT size="10" type="text" name="siniestro_adic1" value="<?PHP echo $row['siniestro_adic1']; ?>"></td><td>Siniestro Adicional 2</td><td><INPUT size="45" type="text" name="siniestro_adic2" value="<?PHP echo $row['siniestro_adic2']; ?>"></td></tr>
			<tr><td>Fecha Sin. Adic. 1</td><td><INPUT size="10" type="text" name="fec_siniestro_adic1" value="<?PHP echo $row['fec_siniestro_adic1']; ?>"></td><td>Fecha Sin. Adic. 2</td><td><INPUT size="45" type="text" name="fec_siniestro_adic2" value="<?PHP echo $row['fec_siniestro_adic2']; ?>"></td></tr>
			<tr><td>Patente S. Adic.1</td><td><INPUT size="10" type="text" name="patente_siniestro_adic1" value="<?PHP echo $row['patente_siniestro_adic1']; ?>"></td><td>Patente S. Adic.2</td><td><INPUT size="45" type="text" name="patente_siniestro_adic2" value="<?PHP echo $row['patente_siniestro_adic2']; ?>"></td></tr>

<!-- 			<tr><td>Rut Liquidador</td><td><INPUT size="10" type="text" name="rut_liquidador" value="<?PHP echo $row['rut_liquidador']; ?>"></td><td>Rut Taller</td><td><INPUT size="10" type="text" name="rut_taller" value="<?PHP echo $row['rut_taller']; ?>"></td></tr>
 -->
			</table>

 			<table>
			<tr><td colspan="2"><h2>PUNTO 1 - SALUDO CORPORATIVO</h2></td></tr>
			<tr><td colspan="2">Buenos días / Tardes, Ud. habla con <b><?PHP echo $_SESSION['s_nombre_acceso']; ?></b>, lo estamos llamando de HDI SEGUROS? Hablo con <b><?PHP echo $row['nom_cliente']; ?></b>?</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">Sr. / Sra. <b><?PHP echo $row['nom_cliente']; ?></b>,  El motivo de esta llamada es para conocer su opinión sobre la calidad del servicio recibido desde que hizo su denuncia de siniestro, solicitamos que dedique un momento para completar esta pequeña encuesta y nos gustaría verificar los datos que tenemos disponibles en nuestras bases.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
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

 			<table>
			<h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2>
			<tr><td colspan="2"><h2>PUNTO 2 – ACTUALIZACIÓN DE DATOS</h2></td></tr>
			<tr><td colspan="2">a.	Sr. / Sra. <b><?PHP echo $row['nom_cliente']; ?></b>, Su dirección sigue siendo <INPUT size="45" type="text" name="direccion" value="<?PHP echo $row['direccion']; ?>">?</td></tr>
			<tr><td colspan="2">b.	Su teléfono es el <INPUT size="2" type="text" name="area" value="<?PHP echo $row['area']; ?>"> - <INPUT size="45" type="text" name="telefono" value="<?PHP echo $row['telefono']; ?>"></td></tr>
			<tr><td colspan="2">c.	Por último su teléfono móvil es el <INPUT size="45" type="text" name="celular" value="<?PHP echo $row['celular']; ?>"> y el e-mail <INPUT size="50" type="text" name="email_particular" value="<?PHP echo $row['email_particular']; ?>"></td></tr>
			<tr><td colspan="2">Llamada <INPUT size="45" type="text" name="llamada" value="<?PHP echo $row['llamada']; ?>"></td></tr>

			<tr><td colspan="2"><h3>Sus respuestas serán tratadas de forma confidencial y no serán utilizadas para ningún propósito distinto al mencionado. <br>Por favor contesta las preguntas considerando una escala de 1 a 7, donde 1 es muy malo y 7 excelente</h3></td></tr>
			</table>

			<table>
			<tr><td><h2>PUNTO 3 – ENCUESTA </h2></td></tr>

			<tr><td colspan="2">1.- ¿Qué medio usó para notificar su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Teléfono" <?PHP if ($row['preg1'] == 'Teléfono') echo 'checked';?>>Teléfono</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Corredor" <?PHP if ($row['preg1'] == 'Corredor') echo 'checked';?>>Corredor</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Página Web" <?PHP if ($row['preg1'] == 'Página Web') echo 'checked';?>>Página Web</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Mail" <?PHP if ($row['preg1'] == 'Mail') echo 'checked';?>>Mail</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="En Sucursal HDI" <?PHP if ($row['preg1'] == 'En Sucursal HDI') echo 'checked';?>>En Sucursal HDI. ¿Cual?:<INPUT type="text" name="preg1_5" size="50" value="<?PHP echo $row['preg1_5']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">2.- ¿Cómo calificaría al liquidador asignado?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg2" value="1" <?PHP if ($row['preg2'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg2" value="2" <?PHP if ($row['preg2'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg2" value="3" <?PHP if ($row['preg2'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg2" value="4" <?PHP if ($row['preg2'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg2" value="5" <?PHP if ($row['preg2'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg2" value="6" <?PHP if ($row['preg2'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg2" value="7" <?PHP if ($row['preg2'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>3.- ¿Cómo calificaría el taller asignado?</td><tr>
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
			
			<tr><td colspan="8">4.- ¿Cómo calificaría a la ejecutiva (o) quién realizó el seguimiento de su siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg4" value="1" <?PHP if ($row['preg4'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg4" value="2" <?PHP if ($row['preg4'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg4" value="3" <?PHP if ($row['preg4'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg4" value="4" <?PHP if ($row['preg4'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg4" value="5" <?PHP if ($row['preg4'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg4" value="6" <?PHP if ($row['preg4'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg4" value="7" <?PHP if ($row['preg4'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>5. ¿Utilió el vehículo de reemplazo?</td><tr>
			<tr><td><INPUT type="radio" name="preg5" value="SI" <?PHP if ($row['preg5'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="NO" <?PHP if ($row['preg5'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>6.- ¿Cómo calificaría su experiencia de servicio?</td><tr>
			<tr><td><INPUT type="radio" name="preg6" value="MUY BUENO" <?PHP if ($row['preg6'] == 'MUY BUENO') echo 'checked';?>>MUY BUENO</td></tr>
			<tr><td><INPUT type="radio" name="preg6" value="BUENO" <?PHP if ($row['preg6'] == 'BUENO') echo 'checked';?>>BUENO</td></tr>
			<tr><td><INPUT type="radio" name="preg6" value="REGULAR" <?PHP if ($row['preg6'] == 'REGULAR') echo 'checked';?>>REGULAR</td></tr>
			<tr><td><INPUT type="radio" name="preg6" value="MALO" <?PHP if ($row['preg6'] == 'MALO') echo 'checked';?>>MALO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>7.- ¿Renovaría su seguro con nosotros?</td><tr>
			<tr><td><INPUT type="radio" name="preg7" value="SI" <?PHP if ($row['preg7'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg7" value="NO" <?PHP if ($row['preg7'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>8.- ¿Recomendaría nuestra Compañía?</td><tr>
			<tr><td><INPUT type="radio" name="preg8" value="SI" <?PHP if ($row['preg8'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg8" value="NO" <?PHP if ($row['preg8'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">9.- ¿Alguna sugerencia o recomedación?</td><tr>
			<tr><td><textarea name="preg9" cols="100" rows="5"><?PHP echo $row['preg9']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
	
			<tr><td colspan="2">10.- Verificar datos: (dirección, email, teléfonos)</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="SI" <?PHP if ($row['preg10'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="NO" <?PHP if ($row['preg10'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">¿Lo usó?</td></tr>
			<tr><td><INPUT type="radio" name="preg10_a" value="SI" <?PHP if ($row['preg10_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10_a" value="NO" <?PHP if ($row['preg10_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>


 			</table>

			<table>
			<tr><td colspan="2"><h3>Término de encuesta</h3></td></tr>

			<tr><td colspan="2"><h3><?PHP echo $row['nom_cliente']; ?>, la encuesta ha concluido, muchas gracias por su colaboración y tiempo.</h3></td></tr>

			<tr><td colspan="2">.</td><td></td></tr>

<?PHP 
			require_once("../funciones/conectar.php");
			$strsql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
			VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR), 'Comienza Ingreso Encuesta 1. Encuestador ".$_SESSION['s_id_acceso']."')";			
			query_bd($strsql);
?> 			

			<tr><td colspan="2">.</td></tr>
			<tr><td colspan="2">

			</td></tr>

			</table>
 			<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
			<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >

			<tr><td colspan="2">.</td><td></td></tr>

			</form>
			
<?PHP
				}
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
