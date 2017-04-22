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
			from qs_encuestascli_hdi_2 e 
			left join qs_encuesta_hdi_2 pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuestascli_hdi_2 set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR) 
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta de Fidelización de Siniestros - HDI Seguros</h1>
			<h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaHDI_2.php" method="POST" id="ingreso" enctype="multipart/form-data">
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
			<tr><td colspan="2"><h2>Inicio Encuesta HDI</h2></td></tr>
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

			<tr><td colspan="2">1. ¿Cómo realizo la denuncia de su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Teléfono" <?PHP if ($row['preg1'] == 'Teléfono') echo 'checked';?>>Teléfono</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Corredor" <?PHP if ($row['preg1'] == 'Corredor') echo 'checked';?>>Corredor</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Página Web" <?PHP if ($row['preg1'] == 'Página Web') echo 'checked';?>>Página Web</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="Mail" <?PHP if ($row['preg1'] == 'Mail') echo 'checked';?>>Mail</td></tr>
			<tr><td><INPUT type="radio" name="preg1" value="En Sucursal HDI" <?PHP if ($row['preg1'] == 'En Sucursal HDI') echo 'checked';?>>En Sucursal HDI. ¿Cual?:<INPUT type="text" name="preg1_5" size="50" value="<?PHP echo $row['preg1_5']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">2.	Cómo evalúa los siguientes aspectos al momento de realizar el denuncio?</td><tr>
			<tr><td>a. La agilidad en la atención</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg2_a" value="1" <?PHP if ($row['preg2_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg2_a" value="2" <?PHP if ($row['preg2_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg2_a" value="3" <?PHP if ($row['preg2_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg2_a" value="4" <?PHP if ($row['preg2_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg2_a" value="5" <?PHP if ($row['preg2_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg2_a" value="6" <?PHP if ($row['preg2_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg2_a" value="7" <?PHP if ($row['preg2_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>b. La facilidad para realizar el denuncio</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg2_b" value="1" <?PHP if ($row['preg2_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg2_b" value="2" <?PHP if ($row['preg2_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg2_b" value="3" <?PHP if ($row['preg2_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg2_b" value="4" <?PHP if ($row['preg2_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg2_b" value="5" <?PHP if ($row['preg2_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg2_b" value="6" <?PHP if ($row['preg2_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg2_b" value="7" <?PHP if ($row['preg2_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			
			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="2"><h2>I.	CUMPLIMIENTO PROTOCOLO DE ATENCIÓN EN LIQUIDACIÓN</h2></td></tr>

			<tr><td>3. Respecto de la atención brindad por el liquidador, ¿Cómo evalúa los siguientes aspectos?:</td><tr>
			<tr><td>a. El tiempo que tomó en contactarse con usted el liquidador:</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3_a" value="1" <?PHP if ($row['preg3_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3_a" value="2" <?PHP if ($row['preg3_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3_a" value="3" <?PHP if ($row['preg3_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3_a" value="4" <?PHP if ($row['preg3_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3_a" value="5" <?PHP if ($row['preg3_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3_a" value="6" <?PHP if ($row['preg3_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3_a" value="7" <?PHP if ($row['preg3_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td>i.	Cuanto demoró el liquidador en contactarse con usted:<INPUT type="text" name="preg3_a_2" size="50" value="<?PHP echo $row['preg3_a_2']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>b. Cumplimiento de los plazos (Atención en día y hora citado)</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3_b" value="1" <?PHP if ($row['preg3_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3_b" value="2" <?PHP if ($row['preg3_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3_b" value="3" <?PHP if ($row['preg3_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3_b" value="4" <?PHP if ($row['preg3_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3_b" value="5" <?PHP if ($row['preg3_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3_b" value="6" <?PHP if ($row['preg3_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3_b" value="7" <?PHP if ($row['preg3_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>c.	Información referente al estado, lugar y plazo de entrega de su vehículo</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg3_c" value="1" <?PHP if ($row['preg3_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg3_c" value="2" <?PHP if ($row['preg3_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg3_c" value="3" <?PHP if ($row['preg3_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg3_c" value="4" <?PHP if ($row['preg3_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg3_c" value="5" <?PHP if ($row['preg3_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg3_c" value="6" <?PHP if ($row['preg3_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg3_c" value="7" <?PHP if ($row['preg3_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">4. ¿Qué tendría que mejorar el liquidador para calificarlo con Nota 7?</td></tr>
			<tr><td><textarea name="preg4" cols="100" rows="5"><?PHP echo $row['preg4']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>


			</table>
			
		
			<table>
			
			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="2"><h2>II. EVALUACIÓN TALLER</h2></td></tr>

			<tr><td>5.	¿Cuánto tiempo estuvo su vehículo en el taller?</td><tr>
			<tr><td><INPUT type="radio" name="preg5" value="1-10 DIAS" <?PHP if ($row['preg5'] == '1-10 DIAS') echo 'checked';?>>1-10 dias</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="11 – 20 DIAS" <?PHP if ($row['preg5'] == '11 – 20 DIAS') echo 'checked';?>>11 – 20 días</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="21 – 30 DIAS" <?PHP if ($row['preg5'] == '21 – 30 DIAS') echo 'checked';?>>21 – 30 días</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="MAS DE 30 DIAS" <?PHP if ($row['preg5'] == 'MAS DE 30 DIAS') echo 'checked';?>>Más de 30 días</td></tr>
			<tr><td>¿Porque razón estuvo tanto tiempo?:<INPUT type="text" name="preg5_a" size="50" value="<?PHP echo $row['preg5_a']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>


			<tr><td>6.	Cómo evalúa  los siguientes aspectos (en escala de 1 a 7):</td><tr>
			<tr><td>a.	Demora el taller en atenderlo?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_a" value="1" <?PHP if ($row['preg6_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_a" value="2" <?PHP if ($row['preg6_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_a" value="3" <?PHP if ($row['preg6_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_a" value="4" <?PHP if ($row['preg6_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_a" value="5" <?PHP if ($row['preg6_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_a" value="6" <?PHP if ($row['preg6_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_a" value="7" <?PHP if ($row['preg6_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>b. El estado de limpieza de entrega del vehículo por parte del taller</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_b" value="1" <?PHP if ($row['preg6_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_b" value="2" <?PHP if ($row['preg6_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_b" value="3" <?PHP if ($row['preg6_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_b" value="4" <?PHP if ($row['preg6_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_b" value="5" <?PHP if ($row['preg6_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_b" value="6" <?PHP if ($row['preg6_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_b" value="7" <?PHP if ($row['preg6_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>c.	Atención del personal del taller</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_c" value="1" <?PHP if ($row['preg6_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_c" value="2" <?PHP if ($row['preg6_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_c" value="3" <?PHP if ($row['preg6_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_c" value="4" <?PHP if ($row['preg6_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_c" value="5" <?PHP if ($row['preg6_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_c" value="6" <?PHP if ($row['preg6_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_c" value="7" <?PHP if ($row['preg6_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>d.	Información entregada por el taller</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_d" value="1" <?PHP if ($row['preg6_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_d" value="2" <?PHP if ($row['preg6_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_d" value="3" <?PHP if ($row['preg6_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_d" value="4" <?PHP if ($row['preg6_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_d" value="5" <?PHP if ($row['preg6_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_d" value="6" <?PHP if ($row['preg6_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_d" value="7" <?PHP if ($row['preg6_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>e.	Facilidad para contactarse con el taller</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_e" value="1" <?PHP if ($row['preg6_e'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_e" value="2" <?PHP if ($row['preg6_e'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_e" value="3" <?PHP if ($row['preg6_e'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_e" value="4" <?PHP if ($row['preg6_e'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_e" value="5" <?PHP if ($row['preg6_e'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_e" value="6" <?PHP if ($row['preg6_e'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_e" value="7" <?PHP if ($row['preg6_e'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>f.	Supervisión del liquidador al trabajo del taller. </td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_f" value="1" <?PHP if ($row['preg6_f'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6_f" value="2" <?PHP if ($row['preg6_f'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6_f" value="3" <?PHP if ($row['preg6_f'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6_f" value="4" <?PHP if ($row['preg6_f'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6_f" value="5" <?PHP if ($row['preg6_f'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6_f" value="6" <?PHP if ($row['preg6_f'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6_f" value="7" <?PHP if ($row['preg6_f'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>7.	Después de evaluar los atributos, ¿con qué nota califica al taller, de 1 a 7?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg7" value="1" <?PHP if ($row['preg7'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7" value="2" <?PHP if ($row['preg7'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7" value="3" <?PHP if ($row['preg7'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7" value="4" <?PHP if ($row['preg7'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7" value="5" <?PHP if ($row['preg7'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7" value="6" <?PHP if ($row['preg7'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7" value="7" <?PHP if ($row['preg7'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>8.	¿Qué tendría que mejorar el Taller para calificarlo con Nota 7?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg8" value="1" <?PHP if ($row['preg8'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8" value="2" <?PHP if ($row['preg8'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8" value="3" <?PHP if ($row['preg8'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8" value="4" <?PHP if ($row['preg8'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8" value="5" <?PHP if ($row['preg8'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8" value="6" <?PHP if ($row['preg8'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8" value="7" <?PHP if ($row['preg8'] == '7') echo 'checked';?>>7 ...
			</td><tr>


			<tr><td colspan="2">9.	Siempre consultando por el taller ¿Qué observaciones y/o comentarios nos podría indicar?</td><tr>
			<tr><td><textarea name="preg9" cols="100" rows="5"><?PHP echo $row['preg9']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			</table>
			
			<table>
			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="2"><h2>III.	AUTO DE REEMPLAZO </h2></td></tr>
			
			<tr><td colspan="2">10. ¿Usted sabe que tiene derecho a utilizar un Vehículo de Reemplazo en caso de siniestros?</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="SI" <?PHP if ($row['preg10'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10" value="NO" <?PHP if ($row['preg10'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">¿Hizo uso de este beneficio? si/No.</td></tr>
			<tr><td><INPUT type="radio" name="preg10_a" value="SI" <?PHP if ($row['preg10_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10_a" value="NO" <?PHP if ($row['preg10_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">¿Cómo accedió a este beneficio?</td></tr>
			<tr><td><INPUT type="radio" name="preg10_1" value="A TRAVES DEL LIQUIDADOR" <?PHP if ($row['preg10_1'] == 'A TRAVES DEL LIQUIDADOR') echo 'checked';?>>A TRAVES DEL LIQUIDADOR</td></tr>
			<tr><td><INPUT type="radio" name="preg10_1" value="POR SUCURSAL" <?PHP if ($row['preg10_1'] == 'POR SUCURSAL') echo 'checked';?>>POR SUCURSAL</td></tr>
			<tr><td><INPUT type="radio" name="preg10_1" value="DIRECTO POR ASISTENCIA" <?PHP if ($row['preg10_1'] == 'DIRECTO POR ASISTENCIA') echo 'checked';?>>DIRECTO POR ASISTENCIA</td></tr>
			<tr><td><INPUT type="radio" name="preg10_1" value="SOLICITA A CONTACT CENTER" <?PHP if ($row['preg10_1'] == 'SOLICITA A CONTACT CENTER') echo 'checked';?>>SOLICITA A CONTACT CENTER</td></tr>

			<tr><td colspan="2">11.	¿Recuerda qué Rent a Car utilizó?</td><tr>
			<tr><td><textarea name="preg11" cols="50" rows="1"><?PHP echo $row['preg11']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="7">12. Considerando una escala de 1 a 7, ¿Qué nota le pondría a la atención en el Rent a car?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg12" value="1" <?PHP if ($row['preg12'] == '1') echo 'checked';?>> 1 ...
				<INPUT type="radio" name="preg12" value="2" <?PHP if ($row['preg12'] == '2') echo 'checked';?>> 2 ...
				<INPUT type="radio" name="preg12" value="3" <?PHP if ($row['preg12'] == '3') echo 'checked';?>> 3 ...
				<INPUT type="radio" name="preg12" value="4" <?PHP if ($row['preg12'] == '4') echo 'checked';?>> 4 ...
				<INPUT type="radio" name="preg12" value="5" <?PHP if ($row['preg12'] == '5') echo 'checked';?>> 5 ...
				<INPUT type="radio" name="preg12" value="6" <?PHP if ($row['preg12'] == '6') echo 'checked';?>> 6 ...
				<INPUT type="radio" name="preg12" value="7" <?PHP if ($row['preg12'] == '7') echo 'checked';?>> 7 ...
			</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>13. Cómo evalúa  los siguientes aspectos (en escala de 1 a 7):</td><tr>

			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>a.	El Tiempo de Auto de reemplazo brindado. </td><tr>
			<tr><td>
				<INPUT type="radio" name="preg13_a" value="1" <?PHP if ($row['preg13_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_a" value="2" <?PHP if ($row['preg13_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_a" value="3" <?PHP if ($row['preg13_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_a" value="4" <?PHP if ($row['preg13_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_a" value="5" <?PHP if ($row['preg13_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_a" value="6" <?PHP if ($row['preg13_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_a" value="7" <?PHP if ($row['preg13_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td>b.	Calidad del vehículo entregado</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg13_b" value="1" <?PHP if ($row['preg13_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_b" value="2" <?PHP if ($row['preg13_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_b" value="3" <?PHP if ($row['preg13_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_b" value="4" <?PHP if ($row['preg13_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_b" value="5" <?PHP if ($row['preg13_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_b" value="6" <?PHP if ($row['preg13_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_b" value="7" <?PHP if ($row['preg13_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			</table>

			<table>
			<tr><td colspan="2"><h2>IV.	ASISTENCIA (solo para casos que la ocuparon)</h2></td></tr>			
			<tr><td colspan="2">14.	¿Necesito hacer uso del servicio de Asistencia en Ruta de su Seguro?</td></tr>
			<tr><td><INPUT type="radio" name="preg14" value="SI" <?PHP if ($row['preg14'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg14" value="NO" <?PHP if ($row['preg14'] == 'NO') echo 'checked';?>>NO</td></tr>

			<tr><td>15. Considerando una escala de 1 a 7, ¿Qué nota le pondría a la atención entregada en el servicio de asistencia?</td><tr>
			<tr><td>a. Facilidad en contactarse con Asistencia</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg15_a" value="1" <?PHP if ($row['preg15_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_a" value="2" <?PHP if ($row['preg15_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_a" value="3" <?PHP if ($row['preg15_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_a" value="4" <?PHP if ($row['preg15_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_a" value="5" <?PHP if ($row['preg15_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_a" value="6" <?PHP if ($row['preg15_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_a" value="7" <?PHP if ($row['preg15_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>b.	Calidad de la atención entregada por sus ejecutivos en ese momento</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg15_b" value="1" <?PHP if ($row['preg15_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_b" value="2" <?PHP if ($row['preg15_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_b" value="3" <?PHP if ($row['preg15_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_b" value="4" <?PHP if ($row['preg15_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_b" value="5" <?PHP if ($row['preg15_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_b" value="6" <?PHP if ($row['preg15_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_b" value="7" <?PHP if ($row['preg15_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>c.	Tiempo de la gestión que solicita a asistencia</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg15_c" value="1" <?PHP if ($row['preg15_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg15_c" value="2" <?PHP if ($row['preg15_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg15_c" value="3" <?PHP if ($row['preg15_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg15_c" value="4" <?PHP if ($row['preg15_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg15_c" value="5" <?PHP if ($row['preg15_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg15_c" value="6" <?PHP if ($row['preg15_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg15_c" value="7" <?PHP if ($row['preg15_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>d.	¿Qué tipo de servicio ocupó?</td></tr>
			<tr><td><INPUT type="radio" name="preg15_d" value="GRUA" <?PHP if ($row['preg15_d'] == 'GRUA') echo 'checked';?>>GRUA</td></tr>
			<tr><td><INPUT type="radio" name="preg15_d" value="BATERIA" <?PHP if ($row['preg15_d'] == 'BATERIA') echo 'checked';?>>BATERIA</td></tr>
			<tr><td><INPUT type="radio" name="preg15_d" value="TRASLADO" <?PHP if ($row['preg15_d'] == 'TRASLADO') echo 'checked';?>>TRASLADO</td></tr>
			<tr><td><INPUT type="radio" name="preg15_d" value="CUSTODIA" <?PHP if ($row['preg15_d'] == 'CUSTODIA') echo 'checked';?>>CUSTODIA</td></tr>
			<tr><td><INPUT type="radio" name="preg15_d" value="OTROS" <?PHP if ($row['preg15_d'] == 'OTROS') echo 'checked';?>>OTROS. ¿Cual?:<INPUT type="text" name="preg15_d_1" size="100" value="<?PHP echo $row['preg15_d_1']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			</table>

			<table>

			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="2"><h2>V.	EVALUACIÓN GENERAL DE LA COMPAÑÍA, SUGERENCIAS Y RECLAMOS</h2></td></tr>

			<tr><td colspan="2">16.	 ¿Qué nota le pondría a la atención general recibida por la compañía en su siniestro?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg16" value="1" <?PHP if ($row['preg16'] == '1') echo 'checked';?>> 1 ...
				<INPUT type="radio" name="preg16" value="2" <?PHP if ($row['preg16'] == '2') echo 'checked';?>> 2 ...
				<INPUT type="radio" name="preg16" value="3" <?PHP if ($row['preg16'] == '3') echo 'checked';?>> 3 ...
				<INPUT type="radio" name="preg16" value="4" <?PHP if ($row['preg16'] == '4') echo 'checked';?>> 4 ...
				<INPUT type="radio" name="preg16" value="5" <?PHP if ($row['preg16'] == '5') echo 'checked';?>> 5 ...
				<INPUT type="radio" name="preg16" value="6" <?PHP if ($row['preg16'] == '6') echo 'checked';?>> 6 ...
				<INPUT type="radio" name="preg16" value="7" <?PHP if ($row['preg16'] == '7') echo 'checked';?>> 7 ...
			</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">17.	¿Qué tendría que mejorar la Compañía para calificarla con Nota 7?</td><tr>
			<tr><td><textarea name="preg17" cols="100" rows="5"><?PHP echo $row['preg17']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">18. ¿Recomendaría la Compañía a sus familiares o amigos?</td></tr>
			<tr><td><INPUT type="radio" name="preg18" value="SI" <?PHP if ($row['preg18'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg18" value="NO" <?PHP if ($row['preg18'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">19. ¿Tiene algún comentario, reclamo, sugerencia o felicitaciones que desee indicarnos?</td></tr>
			<tr><td><INPUT type="radio" name="preg19" value="SI" <?PHP if ($row['preg19'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg19" value="NO" <?PHP if ($row['preg19'] == 'NO' or $row['preg19'] == '') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">Si Responde SI, indicar si corresponde a categoría:</td></tr>
			<tr><td><INPUT type="radio" name="preg19_1" value="RECLAMO" <?PHP if ($row['preg19_1'] == 'RECLAMO') echo 'checked';?>>RECLAMO</td></tr>
			<tr><td><INPUT type="radio" name="preg19_1" value="COMENTARIO" <?PHP if ($row['preg19_1'] == 'COMENTARIO') echo 'checked';?>>COMENTARIO</td></tr>
			<tr><td><INPUT type="radio" name="preg19_1" value="SUGERENCIA" <?PHP if ($row['preg19_1'] == 'SUGERENCIA') echo 'checked';?>>SUGERENCIA</td></tr>
			<tr><td><INPUT type="radio" name="preg19_1" value="FELICITACION" <?PHP if ($row['preg19_1'] == 'FELICITACION') echo 'checked';?>>FELICITACION</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h2>Cliente <?PHP echo $row['rut_cliente']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="2"><h3>Solo para el caso de Reclamo, Sugerencia o Felicitaciones</h3></td></tr>
 			<table>
			<tr><td colspan="2">20. ¿A quién va dirigido su reclamo ó sugerencia?</td><tr>
			<tr><td>
			<INPUT type="radio" name="preg20" value="HDI" <?PHP if ($row['preg20'] == 'HDI') echo 'checked';?>>HDI
				<INPUT type="radio" name="preg20" value="TALLER" <?PHP if ($row['preg20'] == 'TALLER') echo 'checked';?>>TALLER
				<INPUT type="radio" name="preg20" value="LIQUIDADOR" <?PHP if ($row['preg20'] == 'LIQUIDADOR') echo 'checked';?>>LIQUIDADOR
				<INPUT type="radio" name="preg20" value="CALL CENTER" <?PHP if ($row['preg20'] == 'CALL CENTER') echo 'checked';?>>CALL CENTER
			</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td>21. Tipo de Reclamo</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg21" value="Atencion" <?PHP if ($row['preg21'] == 'Atencion') echo 'checked';?>>Atencion
				<INPUT type="radio" name="preg21" value="Gestión" <?PHP if ($row['preg21'] == 'Gestión') echo 'checked';?>>Gestión
				<INPUT type="radio" name="preg21" value="Reparación" <?PHP if ($row['preg21'] == 'Reparación') echo 'checked';?>>Reparación
				<INPUT type="radio" name="preg21" value="Información No Entregada" <?PHP if ($row['preg21'] == 'Información No Entregada') echo 'checked';?>>Información No Entregada
				<INPUT type="radio" name="preg21" value="Tiempos de Entrega y Recepción" <?PHP if ($row['preg21'] == 'Tiempos de Entrega y Recepción') echo 'checked';?>>Tiempos de Entrega y Recepción
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">22. Motivo del Reclamo</td><tr>
			<tr><td><textarea name="preg22" cols="100" rows="5"><?PHP echo $row['preg22']; ?></textarea></td></tr>
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
