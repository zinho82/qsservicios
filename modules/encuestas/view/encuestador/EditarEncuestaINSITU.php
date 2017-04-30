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
			from qs_encuestascli_insitu e 
			left join qs_encuesta_insitu pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuestascli_insitu set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR)  	
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<form name="ingreso" action="IngresarEncuestaINSITU.php" method="POST" id="ingreso" enctype="multipart/form-data">
			<INPUT type="hidden" name="id_formato" id="id_formato" value="<?PHP echo $_GET['id_formato']; ?>">
			<INPUT type="hidden" name="id_encuesta" id="id_encuesta" value="<?PHP echo $_GET['id_encuesta']; ?>">
			<INPUT type="hidden" name="estado" id="estado" value="<?PHP echo $_GET['estado']; ?>">

			<INPUT type="hidden" name="Rut_cli" id="Rut_cli" value="<?PHP echo $row['Rut_cli']; ?>">
			<INPUT type="hidden" name="Nombre_cli" id="Nombre_cli" value="<?PHP echo $row['Nombre_cli']; ?>">
			
			<INPUT type="submit" class="boton" name="enviar" value="Anterior" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="Proxima" id="enviar">
			<INPUT type="submit" class="boton" name="enviar" value="POSTERGAR ENCUESTA" id="enviar"> 
			<INPUT type="submit" class="boton" name="enviar" value="FINALIZAR ENCUESTA" id="enviar" >

 			<table>
			<tr><td colspan="4"><h2>Pauta de Auditoría Prestadores Asistencia Vehicular</h2></td></tr>

<!-- 			<tr><td>Expediente</td><td><INPUT size="10" type="text" name="id_servicio" value="<?PHP echo $row['id_servicio']; ?>"></td></tr>			
			<tr><td>N_Visit</td><td><INPUT size="10" type="text" name="N_Visit" value="<?PHP echo $row['N_Visit']; ?>"></td><td>N_Enc</td><td><INPUT size="10" type="text" name="N_Enc" value="<?PHP echo $row['N_Enc']; ?>"></td></tr>			
			<tr><td>Nombre_cli</td><td><INPUT size="45" type="text" name="Nombre_cli" value="<?PHP echo $row['Nombre_cli']; ?>"></td><td>Rut_cli</td><td><INPUT size="10" type="text" name="Rut_cli" value="<?PHP echo $row['Rut_cli']; ?>"></td></tr>
			<tr><td>Telefono_1</td><td><INPUT size="45" type="text" name="Telefono_1" value="<?PHP echo $row['Telefono_1']; ?>"></td><td>Telefono_2</td><td><INPUT size="10" type="text" name="Telefono_2" value="<?PHP echo $row['Telefono_2']; ?>"></td></tr>
			<tr><td>Patente_cli</td><td><INPUT size="45" type="text" name="Patente_cli" value="<?PHP echo $row['Patente_cli']; ?>"></td><td>Ciudad_cli</td><td><INPUT size="45" type="text" name="Ciudad_cli" value="<?PHP echo $row['Ciudad_cli']; ?>"></td></tr>
			<tr><td>CiaSeg_cli</td><td><INPUT size="45" type="text" name="CiaSeg_cli" value="<?PHP echo $row['CiaSeg_cli']; ?>"></td><td>Ramseg_cli</td><td><INPUT size="10" type="text" name="Ramseg_cli" value="<?PHP echo $row['Ramseg_cli']; ?>"></td></tr>
			<tr><td>FechaSin_cli</td><td><INPUT size="45" type="text" name="FechaSin_cli" value="<?PHP echo $row['FechaSin_cli']; ?>"></td><td>HoraSin_cli</td><td><INPUT size="45" type="text" name="HoraSin_cli" value="<?PHP echo $row['HoraSin_cli']; ?>"></td></tr>
			<tr><td>Ciudad_Sini</td><td><INPUT size="45" type="text" name="Ciudad_Sini" value="<?PHP echo $row['Ciudad_Sini']; ?>"></td><td>Servicio_Sini</td><td><INPUT size="45" type="text" name="Servicio_Sini" value="<?PHP echo $row['Servicio_Sini']; ?>"></td></tr>
			<tr><td>CobApl_Sini</td><td><INPUT size="45" type="text" name="CobApl_Sini" value="<?PHP echo $row['CobApl_Sini']; ?>"></td><td>Provee_Sini</td><td><INPUT size="45" type="text" name="Provee_Sini" value="<?PHP echo $row['Provee_Sini']; ?>"></td></tr>
			<tr><td>FechaAtt_Sini</td><td><INPUT size="45" type="text" name="FechaAtt_Sini" value="<?PHP echo $row['FechaAtt_Sini']; ?>"></td><td>HoraAtt_Sini</td><td><INPUT size="45" type="text" name="HoraAtt_Sini" value="<?PHP echo $row['HoraAtt_Sini']; ?>"></td></tr>
			 -->
			 </table>

 			<table>
			<tr><td colspan="4"><h3>Buenos días/tardes, vengo a realizar una auditoría de los casos realizados a clientes de las Compañías de Seguro Chilena Consolidada y Penta Security, que han sido encargados por Europ Assistance.
Nosotros somos una empresa independiente, pero encargada por las Compañías de Seguros para realizar esta confirmación de los casos.</h3></td></tr>
			</table>
 			<table>
			<tr>
				<td>.</td>
				<td>.</td>
				<td>Si</td>
				<td>No</td>
			</tr>
			<tr>
				<td>Expediente</td>
				<td><?PHP echo $row['N_Enc']; ?></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Fecha Siniestro</td>
				<td><?PHP echo $row['FechaAtt_Sini']; ?></td>
				<td><INPUT type="radio" name="preg2_2" value="SI" <?PHP if ($row['preg2_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg2_2" value="NO" <?PHP if ($row['preg2_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Hora Siniestro</td>
				<td><?PHP echo $row['HoraAtt_Sini']; ?></td>
				<td><INPUT type="radio" name="preg3_2" value="SI" <?PHP if ($row['preg3_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg3_2" value="NO" <?PHP if ($row['preg3_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Ciudad Siniestro</td>
				<td><?PHP echo $row['Ciudad_Sini']; ?></td>
				<td><INPUT type="radio" name="preg4_2" value="SI" <?PHP if ($row['preg4_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg4_2" value="NO" <?PHP if ($row['preg4_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
			<tr>
				<td>Nombre Cliente</td>
				<td><?PHP echo $row['Nombre_cli']; ?></td>
				<td><INPUT type="radio" name="preg5_2" value="SI" <?PHP if ($row['preg5_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg5_2" value="NO" <?PHP if ($row['preg5_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Rut Cliente</td>
				<td><?PHP echo $row['Rut_cli']; ?></td>
				<td><INPUT type="radio" name="preg6_2" value="SI" <?PHP if ($row['preg6_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg6_2" value="NO" <?PHP if ($row['preg6_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
			<tr>
				<td>Patente</td>
				<td><?PHP echo $row['Patente_cli']; ?></td>
				<td><INPUT type="radio" name="preg7_2" value="SI" <?PHP if ($row['preg7_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg7_2" value="NO" <?PHP if ($row['preg7_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Compañía Seguros</td>
				<td><?PHP echo $row['CiaSeg_cli']; ?></td>
				<td><INPUT type="radio" name="preg8_2" value="SI" <?PHP if ($row['preg8_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg8_2" value="NO" <?PHP if ($row['preg8_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
			<tr>
				<td>Cobertura</td>
				<td><?PHP echo $row['CobApl_Sini']; ?></td>
				<td><INPUT type="radio" name="preg9_2" value="SI" <?PHP if ($row['preg9_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg9_2" value="NO" <?PHP if ($row['preg9_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Servicio</td>
				<td><?PHP echo $row['Servicio_Sini']; ?></td>
				<td><INPUT type="radio" name="preg10_2" value="SI" <?PHP if ($row['preg10_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg10_2" value="NO" <?PHP if ($row['preg10_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
			<tr>
				<td>Proveedor</td>
				<td><?PHP echo $row['Provee_Sini']; ?></td>
				<td><INPUT type="radio" name="preg11_2" value="SI" <?PHP if ($row['preg11_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg11_2" value="NO" <?PHP if ($row['preg11_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Fecha Proveedor</td>
				<td><INPUT size="10" type="text" name="preg12_2" value="<?PHP echo $row['preg12_2']; ?>"></td>
				<td></td>
				<td></td>
			</tr>			
			<tr>
				<td>VDR</td>
				<td></td>
				<td><INPUT type="radio" name="preg13_2" value="SI" <?PHP if ($row['preg13_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg13_2" value="NO" <?PHP if ($row['preg13_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Período</td>
				<td>
				Desde: <INPUT size="10" type="text" name="preg14_1_desde" value="<?PHP echo $row['preg14_1_desde']; ?>">
				Hasta: <INPUT size="10" type="text" name="preg14_1_hasta" value="<?PHP echo $row['preg14_1_hasta']; ?>"></td>
				<td><INPUT type="radio" name="preg14_2" value="SI" <?PHP if ($row['preg14_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg14_2" value="NO" <?PHP if ($row['preg14_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
 			</table>
 			<table>
			<tr>
				<td>Ubicación Remolque</td>
				<td><textarea name="preg15_2" cols="50" rows="1"><?PHP echo $row['preg15_2']; ?></textarea></td>
				<td></td>
				<td></td>
			</tr>
 			</table>
 			<table>
			<tr>
				<td>Costos Adic. Cobrados</td>
				<td></td>
				<td><INPUT type="radio" name="preg16_2" value="SI" <?PHP if ($row['preg16_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg16_2" value="NO" <?PHP if ($row['preg16_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
 			</table>
 			<table>
			<tr>
				<td>Observaciones</td>
				<td><textarea name="preg17_2" cols="80" rows="5"><?PHP echo $row['preg17_2']; ?></textarea></td>
				<td></td>
				<td></td>
			</tr>
 			</table>
 			<table>
			<tr>
				<td>Información Sistema</td>
				<td></td>
				<td><INPUT type="radio" name="preg18_2" value="SI" <?PHP if ($row['preg18_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg18_2" value="NO" <?PHP if ($row['preg18_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>			
			<tr>
				<td>Información Física</td>
				<td></td>
				<td><INPUT type="radio" name="preg19_2" value="SI" <?PHP if ($row['preg19_2'] == 'SI') echo 'checked';?>>SI</td>
				<td><INPUT type="radio" name="preg19_2" value="NO" <?PHP if ($row['preg19_2'] == 'NO') echo 'checked';?>>NO</td>
			</tr>
			<tr>
				<td>Status Final</td>
				<td>
				<INPUT type="radio" name="preg20_2" value="APROBADO" <?PHP if ($row['preg20_2'] == 'APROBADO') echo 'checked';?>>APROBADO
				<INPUT type="radio" name="preg20_2" value="RECHAZADO" <?PHP if ($row['preg20_2'] == 'RECHAZADO') echo 'checked';?>>RECHAZADO
				</td>
				<td></td>
				<td></td>
			</tr>			
 			</table>
 			<table>
			<tr>
				<td>Observaciones</td>
				<td><textarea name="preg21_2" cols="80" rows="5"><?PHP echo $row['preg21_2']; ?></textarea></td>
				<td></td>
				<td></td>
			</tr>
 			</table>
<!-- 			<tr>
				<td>Fecha de Control</td>
				<td><INPUT size="50" type="text" name="preg22_1" value="<?PHP echo $row['preg22_1']; ?>"></td>
				<td></td>
				<td></td>
			</tr>			
 -->		
 			<table>
 			<tr>
				<td>Nombre quién entrega Información</td>
				<td><textarea name="preg23_2" cols="50" rows="1"><?PHP echo $row['preg23_2']; ?></textarea></td>
				<td></td>
				<td></td>

			</tr>

			</table>

			<table>
			<tr><td colspan="2"><h3>Término de Encuesta</h3></td></tr>

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
