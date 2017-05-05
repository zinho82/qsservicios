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
			from qs_encuestascli_masgarantia e 
			left join qs_encuesta_masgarantia pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuestascli_masgarantia set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR) 
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta de Satisfacci�n de Servicio y Asistencia</h1>
			<h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaMAS.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">
			
			<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
			<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >

 			<table>
			<tr><td colspan="2"><h2>Datos del Asegurado</h2></td></tr>
			<tr><td>Cod. Servicio</td><td><INPUT size="17" type="text" name="cod_servicio" value="<?PHP echo $row['cod_servicio']; ?>"></td></tr>
			<tr><td>Nombre Cliente</td><td><INPUT size="50" type="text" name="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>"></td></tr>
			<tr><td>Apellido Cliente</td><td><INPUT size="50" type="text" name="ape_cliente" value="<?PHP echo $row['ape_cliente']; ?>"></td></tr>
			<tr><td>Rut Cliente</td><td><INPUT size="10" type="text" name="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>"> - <INPUT size="1" type="text" name="dv" value="<?PHP echo $row['dv']; ?>"></td></tr>
			<tr><td>Tel�fono Contacto 1</td><td><INPUT size="50" type="text" name="fono1" value="<?PHP echo $row['fono1']; ?>"></td></tr>
			<tr><td>Tel�fono Contacto 2</td><td><INPUT size="50" type="text" name="fono2" value="<?PHP echo $row['fono2']; ?>"></td></tr>
			<tr><td>Patente</td><td><INPUT size="17" type="text" name="patente" value="<?PHP echo $row['patente']; ?>"></td></tr>
			<tr><td>Comuna Cliente</td><td><INPUT size="50" type="text" name="com_cliente" value="<?PHP echo $row['com_cliente']; ?>"></td></tr>
			<tr><td>Compa�ia de Seguros</td><td><INPUT size="50" type="text" name="compania" value="<?PHP echo $row['compania']; ?>"></td></tr>
			<tr><td>Ramo</td><td><INPUT size="17" type="text" name="ramo" value="<?PHP echo $row['ramo']; ?>"></td></tr>
			<tr><td>Fecha Siniestro</td><td><INPUT size="17" type="text" name="fec_siniestro" value="<?PHP echo $row['fec_siniestro']; ?>"></td></tr>
			<tr><td>Hora Siniestro</td><td><INPUT size="17" type="text" name="hor_siniestro" value="<?PHP echo $row['hor_siniestro']; ?>"></td></tr>
			<tr><td>Ciudad Siniestro</td><td><INPUT size="50" type="text" name="ciu_siniestro" value="<?PHP echo $row['ciu_siniestro']; ?>"></td></tr>
			<tr><td>Regi�n Siniestro</td><td><INPUT size="50" type="text" name="region" value="<?PHP echo $row['region']; ?>"></td></tr>
			<tr><td>Tipo Siniestro</td><td><INPUT size="50" type="text" name="tip_siniestro" value="<?PHP echo $row['tip_siniestro']; ?>"></td></tr>
			<tr><td>Servicio</td><td><INPUT size="50" type="text" name="servicio" value="<?PHP echo $row['servicio']; ?>"></td></tr>
			<tr><td>Cobertura</td><td><INPUT size="50" type="text" name="cobertura" value="<?PHP echo $row['cobertura']; ?>"></td></tr>

<!-- 			<td>Direcci�n Asegurado</td><td><INPUT size="45" type="text" name="direccion" value="<?PHP echo $row['direccion']; ?>"></td>
			<tr><td>Rut Aseg</td><td><INPUT size="8" type="text" name="rut_cliente" value="<?PHP echo $row['rut_cliente']; ?>">-<INPUT size="1" type="text" name="dv" value="<?PHP echo $row['dv']; ?>"></td><td>Direcci�n Asegurado</td><td><INPUT size="45" type="text" name="direccion" value="<?PHP echo $row['direccion']; ?>"></td></tr>
			<tr><td>Nombre Asegurado</td><td><INPUT size="45" type="text" name="nom_cliente" value="<?PHP echo $row['nom_cliente']; ?>"></td><td>Comuna</td><td><INPUT size="45" type="text" name="desc_comuna" value="<?PHP echo $row['desc_comuna']; ?>"></td></tr>
			<tr><td>N� Tel�fono</td><td><INPUT size="45" type="text" name="telefono" value="<?PHP echo $row['telefono']; ?>"></td><td>Area</td><td><INPUT size="45" type="text" name="area" value="<?PHP echo $row['area']; ?>"></td></tr>
			<tr><td>Email Partic.Aseg</td><td><INPUT size="45" type="text" name="email_particular" value="<?PHP echo $row['email_particular']; ?>"></td><td>Ramo</td><td><INPUT size="45" type="text" name="desc_ramo" value="<?PHP echo $row['desc_ramo']; ?>"></td></tr>
			<tr><td>Email Oficina Aseg</td><td><INPUT size="45" type="text" name="email_oficina" value="<?PHP echo $row['email_oficina']; ?>"></td><td>Deducible</td><td><INPUT size="10" type="text" name="deducible" value="<?PHP echo $row['deducible']; ?>"></td></tr>
			<tr><td>Inicio Vig.</td><td><INPUT size="10" type="text" name="vigencia_ini" value="<?PHP echo $row['vigencia_ini']; ?>"></td><td>Patente</td><td><INPUT size="10" type="text" name="patente" value="<?PHP echo $row['patente']; ?>"></td></tr>
			<tr><td>Fin Vigencia</td><td><INPUT size="10" type="text" name="vigencia_fin" value="<?PHP echo $row['vigencia_fin']; ?>"></td><td>Fecha Denuncia</td><td><INPUT size="10" type="text" name="fec_denuncia" value="<?PHP echo $row['fec_denuncia']; ?>"></td></tr>
			<tr><td>Siniestro</td><td><INPUT size="45" type="text" name="siniestro" value="<?PHP echo $row['siniestro']; ?>"></td><td>Estado Siniestro</td><td><INPUT size="45" type="text" name="desc_estado" value="<?PHP echo $row['desc_estado']; ?>"></td></tr>
 			<tr><td>Rut Liquidador</td><td><INPUT size="10" type="text" name="rut_liquidador" value="<?PHP echo $row['rut_liquidador']; ?>"></td><td>Rut Taller</td><td><INPUT size="10" type="text" name="rut_taller" value="<?PHP echo $row['rut_taller']; ?>"></td></tr>
			<tr><td>Nombre Liquidador</td><td><INPUT size="45" type="text" name="nom_liquidador" value="<?PHP echo $row['nom_liquidador']; ?>"></td><td>Nombre Taller</td><td><INPUT size="45" type="text" name="nom_taller" value="<?PHP echo $row['nom_taller']; ?>"></td></tr>
			<tr><td>Nombre Intermediario</td><td><INPUT size="45" type="text" name="compania" value="<?PHP echo $row['compania']; ?>"></td><td>Email Part. Intermediario</td><td><INPUT size="45" type="text" name="email_part_intermed" value="<?PHP echo $row['email_part_intermed']; ?>"></td></tr>
			<tr><td>Servicio Entregado</td><td><INPUT size="45" type="text" name="servicio" value="<?PHP echo $row['servicio']; ?>"></td><td>Email Ofic. Intermediario</td><td><INPUT size="45" type="text" name="email_ofi_intermed" value="<?PHP echo $row['email_ofi_intermed']; ?>"></td></tr>
 -->			</table>

			
			<table>
			<tr><td><h2>A.- Ay�denos a mejorar</h2></td></tr>
			<tr><td>Se�or(a) <b><?PHP echo $row['nom_cliente'];?></b>, usted requiri� recientemente nuestro servicio de asistencia, con el servicio de <b><?PHP echo $row['servicio'];?></b> y nos gustar�a comprobar su nivel de satisfacci�n.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Por favor, les solicitamos que dedique un momento para completar esta peque�a encuesta, cuyo objetivo es mejorar la calidad de servicio que le otorgamos.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>Sus respuestas ser�n tratadas de forma confidencial y no ser�n utilizadas para ning�n prop�sito distinto al mencionado.</td></tr>
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
					<option value="1.a.i. A�n NO ingresa a Taller" >1.a.i. A�n NO ingresa a Taller</option>
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
					<option value="1.b.i. N�mero equivocado" >1.b.i. N�mero equivocado</option>
					<option value="1.b.ii. Inubicable por Horario" >1.b.ii. Inubicable por Horario</option>
					<option value="1.b.iii. Cliente de Viaje" >1.b.iii. Cliente de Viaje</option>
				</select>
				</td>
				<td>
				<select name="status5_llamada" size="15">
  					<option value="2.a. Congestionado" >2.a. Congestionado</option>
					<option value="2.b. Sin tel�fono" >2.b. Sin tel�fono</option>
					<option value="2.c. Ocupado" >2.c. Ocupado</option>
					<option value="2.d. Fuera de servicio" >2.d. Fuera de servicio</option>
					<option value="2.e. Conectado a Fax" >2.e. Conectado a Fax</option>
					<option value="2.f. Grabadora o buz�n de voz" >2.f. Grabadora o buz�n de voz</option>
					<option value="2.g. Fuera de �rea o apagado (celular)">2.g. Fuera de �rea o apagado (celular)</option>
					<option value="2.h. No contesta" >2.h. No contesta</option>
					<option value="2.i. N�mero no v�lido" >2.i. N�mero no v�lido</option>
					<option value="2.j. Cliente Fallecido" >2.j. Cliente Fallecido</option>
 				</select>
				</td>
			</tr>
			</table>

 			<table>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td>N�mero de veces que ha sido Postergada: <INPUT type="text" name="num_post" size="10" value="<?PHP echo $row['num_post']; ?>"></td><tr>
			<tr><td colspan="2"><b>Historia Status</b></td><tr>
			<tr><td><textarea name="status_historia" cols="100" rows="5"><?PHP echo $row['status_historia']; ?></textarea></td></tr>
			<tr><td colspan="2"><b>Observaciones</b></td><tr>
			<tr><td><textarea name="observaciones" cols="100" rows="2"><?PHP echo $row['observaciones']; ?></textarea></td></tr>
			</table>

			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td colspan="8">1. a.�Recuerda que servicio fu� el que solicit� ?</td><tr>
			<tr><td>
			<tr><td><INPUT size="150" type="text" name="preg1_a" value="<?PHP echo $row['preg1_a']; ?>"></td></tr>
			</td><tr>
			<tr><td colspan="2"><h3><b>Si el cliente indica que fu� gr�a, se debe preguntar:</b></h3></td><tr>
			<tr><td colspan="2">b.	El servicio solicitado, �fue por un siniestro?</td><tr>
			<tr><td><INPUT type="radio" name="preg1_b" value="SI" <?PHP if ($row['preg1_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg1_b" value="NO" <?PHP if ($row['preg1_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">c. Si la respuesta anterior es SI: �Que nota le colocar�a a la atenci�n del Liquidador?. </td><tr>
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

			<tr><td colspan="8">2. �Hace cu�nto tiempo es cliente de Compa��a de Seguros <b><?PHP echo $row['compania'];?></b>?</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg2" value="Menos de 1 mes" <?PHP if ($row['preg2'] == 'Menos de 1 mes') echo 'checked';?>>Menos de 1 mes</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Entre 1 Y 6 meses" <?PHP if ($row['preg2'] == 'Entre 1 Y 6 meses') echo 'checked';?>>Entre 1 Y 6 meses</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Entre 6 meses Y 1 a�o" <?PHP if ($row['preg2'] == 'Entre 6 meses Y 1 a�o') echo 'checked';?>>Entre 6 meses Y 1 a�o</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="Entre 1 Y 3 a�os" <?PHP if ($row['preg2'] == 'Entre 1 Y 3 a�os') echo 'checked';?>>Entre 1 Y 3 a�os</td></tr>
			<tr><td><INPUT type="radio" name="preg2" value="M�s de 3 a�os" <?PHP if ($row['preg2'] == 'M�s de 3 a�os') echo 'checked';?>>M�s de 3 a�os</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="8">3. �Con qu� frecuencia ha utilizado los servicios que brinda la p�liza de seguros de su compa��a?</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg3" value="1 vez a la semana" <?PHP if ($row['preg3'] == '1 vez a la semana') echo 'checked';?>>1 vez a la semana</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="1 vez al mes" <?PHP if ($row['preg3'] == '1 vez al mes') echo 'checked';?>>1 vez al mes</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="M�s de 1 vez al mes" <?PHP if ($row['preg3'] == 'M�s de 1 vez al mes') echo 'checked';?>>M�s de 1 vez al mes</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="1 vez cada 6 meses" <?PHP if ($row['preg3'] == '1 vez cada 6 meses') echo 'checked';?>>1 vez cada 6 meses</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="1 vez al a�o" <?PHP if ($row['preg3'] == '1 vez al a�o') echo 'checked';?>>1 vez al a�o</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="M�s de una vez al a�o" <?PHP if ($row['preg3'] == 'M�s de una vez al a�o') echo 'checked';?>>M�s de una vez al a�o</td></tr>
			<tr><td><INPUT type="radio" name="preg3" value="Primera vez" <?PHP if ($row['preg3'] == 'Primera vez') echo 'checked';?>>Primera vez</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>B.- Satisfacci�n General</h2></td></tr>
			<tr><td colspan="2">4.	�Cu�l es el grado de satisfacci�n general del servicio de <b><?PHP echo $row['servicio'];?></b> entregado?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
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

			<tr><td colspan="8">5. Considerando que es un servicio de emergencia y considerando su expectativa de respuesta, usted dir�a que la asistencia brindada fu�:</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg5" value="Excelente" <?PHP if ($row['preg5'] == 'Excelente') echo 'checked';?>>Excelente</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="Mucho mejor a lo esperado" <?PHP if ($row['preg5'] == 'Mucho mejor a lo esperado') echo 'checked';?>>Mucho mejor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="Algo mejor a lo esperado" <?PHP if ($row['preg5'] == 'Algo mejor a lo esperado') echo 'checked';?>>Algo mejor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="M�s o menos igual a lo esperado" <?PHP if ($row['preg5'] == 'M�s o menos igual a lo esperado') echo 'checked';?>>M�s o menos igual a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="Algo peor a lo esperado" <?PHP if ($row['preg5'] == 'Algo peor a lo esperado') echo 'checked';?>>Algo peor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="Mucho peor a lo esperado" <?PHP if ($row['preg5'] == 'Mucho peor a lo esperado') echo 'checked';?>>Mucho peor a lo esperado</td></tr>
			<tr><td><INPUT type="radio" name="preg5" value="No lo s�" <?PHP if ($row['preg5'] == 'No lo s�') echo 'checked';?>>No lo s�</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">6. �Qu� nota le colocar�a a la Facilidad de comunicaci�n al momento de solicitar el servicio de <?PHP echo $row['servicio']; ?>?</td><tr>
<!-- 			<tr><td colspan="2">6. �Qu� nota le colocar�a a lo expedita de la comunicaci�n con la central de asistencias?</td><tr>
 -->			
 			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6" value="1" <?PHP if ($row['preg6'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg6" value="2" <?PHP if ($row['preg6'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg6" value="3" <?PHP if ($row['preg6'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg6" value="4" <?PHP if ($row['preg6'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg6" value="5" <?PHP if ($row['preg6'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg6" value="6" <?PHP if ($row['preg6'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg6" value="7" <?PHP if ($row['preg6'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg6_a" value="No Aplica" <?PHP if ($row['preg6_a'] == 'No Aplica') echo 'checked';?>>No Aplica
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>C.- Satisfacci�n Atributos</h2></td></tr>
			<tr><td><h2>NO APLICA ESTA PREGUNTA SI EL SERVICIO BRINDADO ES VEH�CULO DE REEMPLAZO</h2></td></tr>
			<tr><td colspan="2">7.	En relaci�n al tiempo de espera del servicio:</td><tr>
<!-- 			<tr><td colspan="2">a. �Fu� adecuado el tiempo de espera entregado por la cenral de asistencia?</td><tr> -->
			<tr><td colspan="2">a. Fue adecuado el tiempos de espera para la llegada del servicio de <?PHP echo $row['servicio']; ?>, entregado por la telefonista? </td><tr>
			<tr><td><INPUT type="radio" name="preg7_a" value="SI" <?PHP if ($row['preg7_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg7_a" value="NO" <?PHP if ($row['preg7_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">b. �Se cumpli� el tiempo de espera entregados por parte del operador?</td><tr>
			<tr><td><INPUT type="radio" name="preg7_b" value="SI" <?PHP if ($row['preg7_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg7_b" value="NO" <?PHP if ($row['preg7_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h3>APLICA ESTA PREGUNTA SOLO SI ES SERVICIO BRINDADO ES VEH�CULO DE REEMPLAZO</h3></td></tr>
			<tr><td colspan="2">8.	En relaci�n al veh�culo entregado, califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente, el Estado del Veh�culo </td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente el Estado del Veh�culo:</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg8" value="1" <?PHP if ($row['preg8'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8" value="2" <?PHP if ($row['preg8'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8" value="3" <?PHP if ($row['preg8'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8" value="4" <?PHP if ($row['preg8'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8" value="5" <?PHP if ($row['preg8'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8" value="6" <?PHP if ($row['preg8'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8" value="7" <?PHP if ($row['preg8'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td><h3>CONTINUAR CON LA ENCUESTA EN FORMA NORMAL</h3></td></tr>

			<tr><td colspan="2">9.	En relaci�n al trato del prestador del servicio de <b><?PHP echo $row['servicio'];?></b>, �C�mo fue el trato del personal que concurri� a asistirlo?</td><tr>
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
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">10.	En relaci�n a la presentaci�n del prestador del servicio de <b><?PHP echo $row['servicio'];?></b>, �C�mo calificar�a la presentaci�n del personal que concurri� a asistirlo?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg10" value="1" <?PHP if ($row['preg10'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg10" value="2" <?PHP if ($row['preg10'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg10" value="3" <?PHP if ($row['preg10'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg10" value="4" <?PHP if ($row['preg10'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg10" value="5" <?PHP if ($row['preg10'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg10" value="6" <?PHP if ($row['preg10'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg10" value="7" <?PHP if ($row['preg10'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>D.- Valoraci�n del Servicio</h2></td></tr>
			<tr><td colspan="2">Teniendo en cuenta su experiencia reciente con el servicio de asistencia de Compa��a de Seguros <b><?PHP echo $row['compania'];?></b>:</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="8">11.	El servicio brindado, �es un atributo positivo como parte de su p�liza de seguro <b><?PHP echo $row['ramo'];?></b>?</td><tr>
			<tr><td>
			<tr><td><INPUT type="radio" name="preg11" value="Totalmente de acuerdo" <?PHP if ($row['preg11'] == 'Totalmente de acuerdo') echo 'checked';?>>Totalmente de acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg11" value="De acuerdo" <?PHP if ($row['preg11'] == 'De acuerdo') echo 'checked';?>>De acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg11" value="En desacuerdo" <?PHP if ($row['preg11'] == 'En desacuerdo') echo 'checked';?>>En desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg11" value="M�s o menos igual" <?PHP if ($row['preg11'] == 'M�s o menos igual') echo 'checked';?>>M�s o menos igual</td></tr>
			<tr><td><INPUT type="radio" name="preg11" value="Totalmente en desacuerdo" <?PHP if ($row['preg11'] == 'Totalmente en desacuerdo') echo 'checked';?>>Totalmente en desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg11" value="No se aplica" <?PHP if ($row['preg11'] == 'No se aplica') echo 'checked';?>>No se aplica</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="8">12.	Al servicio, �Qu� nota le colocar�a respecto a si atendi� bien sus necesidades?</td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg12" value="1" <?PHP if ($row['preg12'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg12" value="2" <?PHP if ($row['preg12'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg12" value="3" <?PHP if ($row['preg12'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg12" value="4" <?PHP if ($row['preg12'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg12" value="5" <?PHP if ($row['preg12'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg12" value="6" <?PHP if ($row['preg12'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg12" value="7" <?PHP if ($row['preg12'] == '7') echo 'checked';?>>7 ...

<!-- 			<tr><td><INPUT type="radio" name="preg13" value="Totalmente de acuerdo" <?PHP if ($row['preg13'] == 'Totalmente de acuerdo') echo 'checked';?>>Totalmente de acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg13" value="De acuerdo" <?PHP if ($row['preg13'] == 'De acuerdo') echo 'checked';?>>De acuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg13" value="En desacuerdo" <?PHP if ($row['preg13'] == 'En desacuerdo') echo 'checked';?>>En desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg13" value="M�s o menos igual" <?PHP if ($row['preg13'] == 'M�s o menos igual') echo 'checked';?>>M�s o menos igual</td></tr>
			<tr><td><INPUT type="radio" name="preg13" value="Totalmente en desacuerdo" <?PHP if ($row['preg13'] == 'Totalmente en desacuerdo') echo 'checked';?>>Totalmente en desacuerdo</td></tr>
			<tr><td><INPUT type="radio" name="preg13" value="No se aplica" <?PHP if ($row['preg13'] == 'No se aplica') echo 'checked';?>>No se aplica</td></tr>
 -->			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td><h2>Cliente <?PHP echo $row['rut_cliente'].'-'.$row['dv']; ?> | <?PHP echo $row['nom_cliente']; ?> | <?PHP echo $row['estado']; ?></h2></td></tr>
			<tr><td><h2>E.- Recomendaci�n y Sugerencias</h2></td></tr>
			<tr><td colspan="2">13.	Bas�ndose en su experiencia, </td><tr>
			<tr><td colspan="2">a. �Usted recomendar�a a Compa��a de Seguros <b><?PHP echo $row['cod_intermed'];?></b> por su servicio?</td></tr>
			<tr><td><INPUT type="radio" name="preg13_a" value="SI" <?PHP if ($row['preg13_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg13_a" value="NO" <?PHP if ($row['preg13_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">b.	�Que nota le colocar�a en general Compa�ia de Seguros? </td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
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

<!-- 			<tr><td colspan="2">c.	�Que nota le colocar�a a la Compa�ia de Seguros en el servicio de asistencia brindado? </td><tr> -->
			<tr><td colspan="2">c.	c.	�Qu� nota le colocar�a a la Compa��a de Seguros en el servicio de <?PHP echo $row['servicio']; ?>?, </td><tr>
			<tr><td colspan="2">Califique con nota de 1 a 7, donde 1 es muy malo y 7 excelente.</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg13_c" value="1" <?PHP if ($row['preg13_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg13_c" value="2" <?PHP if ($row['preg13_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg13_c" value="3" <?PHP if ($row['preg13_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg13_c" value="4" <?PHP if ($row['preg13_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg13_c" value="5" <?PHP if ($row['preg13_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg13_c" value="6" <?PHP if ($row['preg13_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg13_c" value="7" <?PHP if ($row['preg13_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">14.	�Que tendr�a que mejorar la Compa��a para calificar con Nota 7?</td><tr>
			<tr><td><textarea name="preg14" cols="100" rows="5"><?PHP echo $row['preg14']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">15.	Hay alguna cosa que le gustar�a decirle a Compa��a de Seguros <b><?PHP echo $row['compania'];?></b> sobre su servicio de asistencia, que no le hayamos preguntado?</td><tr>
			<tr><td colspan="2">Si es as�, por favor d�ganos de qu� se trata.</td><tr>
			<tr><td><textarea name="preg15" cols="100" rows="5"><?PHP echo $row['preg15']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

 			<tr><td colspan="2">16.	�Nos podr�a decir en cu�l de los siguientes rangos de edad se encuentra usted?</td><tr>
			<tr><td>
				<INPUT type="radio" name="preg16" value="18 a 25 a�os" <?PHP if ($row['preg16'] == '18 a 25 a�os') echo 'checked';?>>18 a 25 a�os 
				<INPUT type="radio" name="preg16" value="26 a 35 a�os" <?PHP if ($row['preg16'] == '26 a 35 a�os') echo 'checked';?>>26 a 35 a�os
				<INPUT type="radio" name="preg16" value="36 a 45 a�os" <?PHP if ($row['preg16'] == '36 a 45 a�os') echo 'checked';?>>36 a 45 a�os
				<INPUT type="radio" name="preg16" value="46 a 55 a�os" <?PHP if ($row['preg16'] == '46 a 55 a�os') echo 'checked';?>>46 a 55 a�os
				<INPUT type="radio" name="preg16" value="56 a 65 a�os" <?PHP if ($row['preg16'] == '56 a 65 a�os') echo 'checked';?>>56 a 65 a�os
				<INPUT type="radio" name="preg16" value="66 a�os y +" <?PHP if ($row['preg16'] == '66 a�os y +') echo 'checked';?>>66 a�os y +
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
		

			<tr><td colspan="2"><h3>La encuesta ha concluido.</h3></td></tr>
			<tr><td colspan="2"><h3>Muchas gracias por su colaboraci�n y tiempo.</h3></td></tr>

			<tr><td colspan="2">.</td><td></td></tr>


<?PHP 
			require_once("../funciones/conectar.php");
			$strsql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 
			VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Comienza Ingreso Encuesta |Servicio y Asistencia|. Encuestador ".$_SESSION['s_id_acceso']."')";			
			query_bd($strsql);
?> 			

			</table>
			<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
			<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >
			<tr><td colspan="2">.</td><td></td></tr>
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
