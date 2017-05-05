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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
			$("#preg25_0_a1").change(function(event){
				var id = $("#preg25_0_a1").find(':selected').val();
				$("#preg25_0_c1").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg25_0_a2").change(function(event){
				var id = $("#preg25_0_a2").find(':selected').val();
				$("#preg25_0_c2").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg25_0_a3").change(function(event){
				var id = $("#preg25_0_a3").find(':selected').val();
				$("#preg25_0_c3").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});

		$(document).ready(function(){
			$("#preg6_area1").change(function(event){
				var id = $("#preg6_area1").find(':selected').val();
				$("#preg6_causa1").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg6_area2").change(function(event){
				var id = $("#preg6_area2").find(':selected').val();
				$("#preg6_causa2").load('causas_encuestas.php?encuesta=PENTA&id='+id);
			});
		});
		$(document).ready(function(){
			$("#preg6_area3").change(function(event){
				var id = $("#preg6_area3").find(':selected').val();
				$("#preg6_causa3").load('causas_encuestas.php?encuesta=PENTA&id='+id);
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
	if(	!document.getElementById('preg1_2_id1').checked && 
		!document.getElementById('preg1_2_id2').checked &&
		!document.getElementById('preg1_2_id3').checked &&
		!document.getElementById('preg1_2_id4').checked &&
		!document.getElementById('preg1_2_id5').checked &&
		!document.getElementById('preg1_2_id6').checked &&
		!document.getElementById('preg1_2_id7').checked ) {
	alert('DEBE RESPONDER PREGUNTA 1');
	document.ingreso.preg1_2_id1.focus();
	return 0;
	}

/*	preg2	*/
	if(	!document.getElementById('preg2_id1').checked && 
		!document.getElementById('preg2_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2');
	document.ingreso.preg2_id1.focus();
	return 0;
	}
	
/*	preg2_a	*/
	if(	document.getElementById('preg2_id1').checked &&
		!document.getElementById('preg2_a_id1').checked && 
		!document.getElementById('preg2_a_id2').checked &&
		!document.getElementById('preg2_a_id3').checked &&
		!document.getElementById('preg2_a_id4').checked &&
		!document.getElementById('preg2_a_id5').checked &&
		!document.getElementById('preg2_a_id6').checked &&
		!document.getElementById('preg2_a_id7').checked ) {
	alert('DEBE RESPONDER PREGUNTA 2 a');
	document.ingreso.preg2_a_id1.focus();
	return 0;
	}

/*	preg3	*/
	if(	!document.getElementById('preg3_id1').checked && 
		!document.getElementById('preg3_id2').checked ) {
	alert('DEBE RESPONDER PREGUNTA 3');
	document.ingreso.preg3_id1.focus();
	return 0;
	}

/*	preg4	*/
	if(	!document.getElementById('preg4_id1').checked  && 
		!document.getElementById('preg4_id2').checked && 
		!document.getElementById('preg4_id3').checked && 
		!document.getElementById('preg4_id4').checked && 
		!document.getElementById('preg4_id5').checked ) {
	alert('DEBE RESPONDER PREGUNTA 4');
	document.ingreso.preg4_id1.focus();
	return 0;
	}
	
/*	preg4_a	*/
	if(	document.getElementById('preg4_id1').checked && 
		!document.getElementById('preg4_a_id1').selected && 
		!document.getElementById('preg4_a_id2').selected && 
		!document.getElementById('preg4_a_id3').selected && 
		!document.getElementById('preg4_a_id4').selected && 
		!document.getElementById('preg4_a_id5').selected && 
		!document.getElementById('preg4_a_id6').selected && 
		!document.getElementById('preg4_a_id7').selected && 
		!document.getElementById('preg4_a_id8').selected && 
		!document.getElementById('preg4_a_id9').selected && 
		!document.getElementById('preg4_a_id10').selected && 
		!document.getElementById('preg4_a_id11').selected && 
		!document.getElementById('preg4_a_id12').selected && 
		!document.getElementById('preg4_a_id13').selected && 
		!document.getElementById('preg4_a_id14').selected && 
		!document.getElementById('preg4_a_id15').selected && 
		!document.getElementById('preg4_a_id16').selected && 
		!document.getElementById('preg4_a_id17').selected && 
		!document.getElementById('preg4_a_id18').selected && 
		!document.getElementById('preg4_a_id19').selected && 
		!document.getElementById('preg4_a_id20').selected && 
		!document.getElementById('preg4_a_id21').selected && 
		!document.getElementById('preg4_a_id22').selected && 
		!document.getElementById('preg4_a_id23').selected && 
		!document.getElementById('preg4_a_id24').selected && 
		!document.getElementById('preg4_a_id25').selected && 
		!document.getElementById('preg4_a_id26').selected && 
		!document.getElementById('preg4_a_id27').selected && 
		!document.getElementById('preg4_a_id28').selected && 
		!document.getElementById('preg4_a_id29').selected && 
		!document.getElementById('preg4_a_id30').selected && 
		!document.getElementById('preg4_a_id31').selected && 
		!document.getElementById('preg4_a_id32').selected && 
		!document.getElementById('preg4_a_id33').selected && 
		!document.getElementById('preg4_a_id34').selected ) {
	alert('DEBE RESPONDER Sucursal de PREGUNTA 4');
	document.ingreso.preg4_id1.focus();
	return 0;
	}
	
/*	preg5	*/
	if(	document.getElementById('preg4_id1').checked &&
		!document.getElementById('preg5_id1').checked  && 
		!document.getElementById('preg5_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 5');
		document.ingreso.preg5_id1.focus();
		return 0;
	}

	/*	preg6	*/
	if(	document.getElementById('preg4_id1').checked &&
		!document.getElementById('preg6_id1').checked  && 
		!document.getElementById('preg6_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 6');
		document.ingreso.preg6_id1.focus();
		return 0;
	}

	/*	preg7_a	*/
	if(	document.getElementById('preg4_id1').checked &&
		!document.getElementById('preg7_a_id1').checked &&
		!document.getElementById('preg7_a_id2').checked &&
		!document.getElementById('preg7_a_id3').checked &&
		!document.getElementById('preg7_a_id4').checked &&
		!document.getElementById('preg7_a_id5').checked &&
		!document.getElementById('preg7_a_id6').checked &&
		!document.getElementById('preg7_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 7 a.');  
		document.ingreso.preg7_a_id1.focus();
		return 0;
	}

	/*	preg7_b	*/
	if(	document.getElementById('preg4_id1').checked &&
		!document.getElementById('preg7_b_id1').checked &&
		!document.getElementById('preg7_b_id2').checked &&
		!document.getElementById('preg7_b_id3').checked &&
		!document.getElementById('preg7_b_id4').checked &&
		!document.getElementById('preg7_b_id5').checked &&
		!document.getElementById('preg7_b_id6').checked &&
		!document.getElementById('preg7_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 7 b.');  
		document.ingreso.preg7_b_id1.focus();
		return 0;
	}

	/*	preg7_c	*/
	if(	document.getElementById('preg4_id1').checked &&
		!document.getElementById('preg7_c_id1').checked &&
		!document.getElementById('preg7_c_id2').checked &&
		!document.getElementById('preg7_c_id3').checked &&
		!document.getElementById('preg7_c_id4').checked &&
		!document.getElementById('preg7_c_id5').checked &&
		!document.getElementById('preg7_c_id6').checked &&
		!document.getElementById('preg7_c_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 7 c.');  
		document.ingreso.preg7_c_id1.focus();
		return 0;
	}	

	/*	preg9 a.	*/
	if(	document.getElementById('preg4_id2').checked &&
		!document.getElementById('preg8_a_id1').checked &&
		!document.getElementById('preg8_a_id2').checked &&
		!document.getElementById('preg8_a_id3').checked &&
		!document.getElementById('preg8_a_id4').checked &&
		!document.getElementById('preg8_a_id5').checked &&
		!document.getElementById('preg8_a_id6').checked &&
		!document.getElementById('preg8_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 9 a.');  
		document.ingreso.preg8_a_id1.focus();
		return 0;
	}		

	/*	preg9 b.	*/
	if(	document.getElementById('preg4_id2').checked &&
		!document.getElementById('preg8_b_id1').checked &&
		!document.getElementById('preg8_b_id2').checked &&
		!document.getElementById('preg8_b_id3').checked &&
		!document.getElementById('preg8_b_id4').checked &&
		!document.getElementById('preg8_b_id5').checked &&
		!document.getElementById('preg8_b_id6').checked &&
		!document.getElementById('preg8_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 9 b.');  
		document.ingreso.preg8_b_id1.focus();
		return 0;
	}		

	/*	preg9 c.	*/
	if(	document.getElementById('preg4_id2').checked &&
		!document.getElementById('preg8_c_id1').checked &&
		!document.getElementById('preg8_c_id2').checked &&
		!document.getElementById('preg8_c_id3').checked &&
		!document.getElementById('preg8_c_id4').checked &&
		!document.getElementById('preg8_c_id5').checked &&
		!document.getElementById('preg8_c_id6').checked &&
		!document.getElementById('preg8_c_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 9 c.');  
		document.ingreso.preg8_c_id1.focus();
		return 0;
	}		

	/*	preg9 d.	*/
	if(	document.getElementById('preg4_id2').checked &&
		!document.getElementById('preg8_d_id1').checked &&
		!document.getElementById('preg8_d_id2').checked &&
		!document.getElementById('preg8_d_id3').checked &&
		!document.getElementById('preg8_d_id4').checked &&
		!document.getElementById('preg8_d_id5').checked &&
		!document.getElementById('preg8_d_id6').checked &&
		!document.getElementById('preg8_d_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 9 d.');  
		document.ingreso.preg8_d_id1.focus();
		return 0;
	}		

	/*	preg10 a. */
	if(	document.getElementById('preg4_id3').checked &&
		!document.getElementById('preg9_id1').checked  && 
		!document.getElementById('preg9_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 10 a.');
		document.ingreso.preg9_id1.focus();
		return 0;
	}

	/*	preg10 b. */
	if(	document.getElementById('preg4_id3').checked &&
		!document.getElementById('preg10_id1').checked  && 
		!document.getElementById('preg10_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 10 b.');
		document.ingreso.preg10_id1.focus();
		return 0;
	}

	/*	preg11 a.	*/
	if(	document.getElementById('preg4_id3').checked &&
		!document.getElementById('preg11_a_id1').checked &&
		!document.getElementById('preg11_a_id2').checked &&
		!document.getElementById('preg11_a_id3').checked &&
		!document.getElementById('preg11_a_id4').checked &&
		!document.getElementById('preg11_a_id5').checked &&
		!document.getElementById('preg11_a_id6').checked &&
		!document.getElementById('preg11_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 11 a.');  
		document.ingreso.preg11_a_id1.focus();
		return 0;
	}		
	
	/*	preg11 b.	*/
	if(	document.getElementById('preg4_id3').checked &&
		!document.getElementById('preg11_b_id1').checked &&
		!document.getElementById('preg11_b_id2').checked &&
		!document.getElementById('preg11_b_id3').checked &&
		!document.getElementById('preg11_b_id4').checked &&
		!document.getElementById('preg11_b_id5').checked &&
		!document.getElementById('preg11_b_id6').checked &&
		!document.getElementById('preg11_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 11 b.');  
		document.ingreso.preg11_b_id1.focus();
		return 0;
	}		

	/*	preg12. */
	if(	!document.getElementById('preg12_id1').checked  && 
		!document.getElementById('preg12_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 12.');
		document.ingreso.preg12_id1.focus();
		return 0;
	}

	/*	preg13. */
	if(	!document.getElementById('preg13_id1').checked  && 
		!document.getElementById('preg13_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 13.');
		document.ingreso.preg13_id1.focus();
		return 0;
	}

	/*	preg14. */
	if(	document.getElementById('preg13_id1').checked &&
		!document.getElementById('preg14new_id1').checked  && 
		!document.getElementById('preg14new_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 14.');
		document.ingreso.preg14new_id1.focus();
		return 0;
	}

	/*	preg14 a. */
	if(	document.getElementById('preg13_id1').checked &&
		!document.getElementById('preg14new_a_id1').checked  && 
		!document.getElementById('preg14new_a_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 14 a.');
		document.ingreso.preg14new_a_id1.focus();
		return 0;
	}

	/*	preg14 b.	*/
	if(	document.getElementById('preg13_id1').checked &&
		!document.getElementById('preg14new_b_id1').checked &&
		!document.getElementById('preg14new_b_id2').checked &&
		!document.getElementById('preg14new_b_id3').checked &&
		!document.getElementById('preg14new_b_id4').checked &&
		!document.getElementById('preg14new_b_id5').checked &&
		!document.getElementById('preg14new_b_id6').checked &&
		!document.getElementById('preg14new_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 14 b.');  
		document.ingreso.preg14new_b_id1.focus();
		return 0;
	}		

	/*	pregII b). */
	if(	!document.getElementById('preg12_b_id1').checked  && 
		!document.getElementById('preg12_b_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA II b.');
		document.ingreso.preg12_b_id1.focus();
		return 0;
	}

	/*	preg15). */
	if(	!document.getElementById('preg14_id1').checked  && 
		!document.getElementById('preg14_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 15.');
		document.ingreso.preg14_id1.focus();
		return 0;
	}

	/*	preg16 a. */
	if(	!document.getElementById('preg15_a_id1').checked  && 
		!document.getElementById('preg15_a_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 a.');
		document.ingreso.preg15_a_id1.focus();
		return 0;
	}

	/*	preg16 b. */
	if(	!document.getElementById('preg15_b_id1').checked  && 
		!document.getElementById('preg15_b_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 b.');
		document.ingreso.preg15_b_id1.focus();
		return 0;
	}

	/*	preg16 c. */
	if(	!document.getElementById('preg15_c_id1').checked  && 
		!document.getElementById('preg15_c_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 c.');
		document.ingreso.preg15_c_id1.focus();
		return 0;
	}

	/*	preg16 d.	*/
	if(	!document.getElementById('preg16_a_id1').checked &&
		!document.getElementById('preg16_a_id2').checked &&
		!document.getElementById('preg16_a_id3').checked &&
		!document.getElementById('preg16_a_id4').checked &&
		!document.getElementById('preg16_a_id5').checked &&
		!document.getElementById('preg16_a_id6').checked &&
		!document.getElementById('preg16_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 d.');  
		document.ingreso.preg16_a_id1.focus();
		return 0;
	}		

	/*	preg16 e.	*/
	if(	!document.getElementById('preg16_b_id1').checked &&
		!document.getElementById('preg16_b_id2').checked &&
		!document.getElementById('preg16_b_id3').checked &&
		!document.getElementById('preg16_b_id4').checked &&
		!document.getElementById('preg16_b_id5').checked &&
		!document.getElementById('preg16_b_id6').checked &&
		!document.getElementById('preg16_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 e.');  
		document.ingreso.preg16_b_id1.focus();
		return 0;
	}		

	/*	preg16 f.	*/
	if(	!document.getElementById('preg16_c_id1').checked &&
		!document.getElementById('preg16_c_id2').checked &&
		!document.getElementById('preg16_c_id3').checked &&
		!document.getElementById('preg16_c_id4').checked &&
		!document.getElementById('preg16_c_id5').checked &&
		!document.getElementById('preg16_c_id6').checked &&
		!document.getElementById('preg16_c_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 f.');  
		document.ingreso.preg16_c_id1.focus();
		return 0;
	}		

	/*	preg16 g.	*/
	if(	!document.getElementById('preg16_e_id1').checked &&
		!document.getElementById('preg16_e_id2').checked &&
		!document.getElementById('preg16_e_id3').checked &&
		!document.getElementById('preg16_e_id4').checked &&
		!document.getElementById('preg16_e_id5').checked &&
		!document.getElementById('preg16_e_id6').checked &&
		!document.getElementById('preg16_e_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 16 g.');  
		document.ingreso.preg16_e_id1.focus();
		return 0;
	}		

	/*	preg17 a.	*/
	if(	!document.getElementById('preg18_a_id1').checked &&
		!document.getElementById('preg18_a_id2').checked &&
		!document.getElementById('preg18_a_id3').checked &&
		!document.getElementById('preg18_a_id4').checked &&
		!document.getElementById('preg18_a_id5').checked &&
		!document.getElementById('preg18_a_id6').checked &&
		!document.getElementById('preg18_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 17 a.');  
		document.ingreso.preg18_a_id1.focus();
		return 0;
	}		

	/*	preg17 b.	*/
	if(	!document.getElementById('preg18_b_id1').checked &&
		!document.getElementById('preg18_b_id2').checked &&
		!document.getElementById('preg18_b_id3').checked &&
		!document.getElementById('preg18_b_id4').checked &&
		!document.getElementById('preg18_b_id5').checked &&
		!document.getElementById('preg18_b_id6').checked &&
		!document.getElementById('preg18_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 17 b.');  
		document.ingreso.preg18_b_id1.focus();
		return 0;
	}		

	/*	preg17 c.	*/
	if(	!document.getElementById('preg18_c_id1').checked &&
		!document.getElementById('preg18_c_id2').checked &&
		!document.getElementById('preg18_c_id3').checked &&
		!document.getElementById('preg18_c_id4').checked &&
		!document.getElementById('preg18_c_id5').checked &&
		!document.getElementById('preg18_c_id6').checked &&
		!document.getElementById('preg18_c_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 17 c.');  
		document.ingreso.preg18_c_id1.focus();
		return 0;
	}		

	/* SOLO PERDIDA TOTAL */
	/*	preg18 a.	*/
	if(	document.getElementById('preg3_id2').checked &&
		!document.getElementById('preg19_a_id1').checked &&
		!document.getElementById('preg19_a_id2').checked &&
		!document.getElementById('preg19_a_id3').checked &&
		!document.getElementById('preg19_a_id4').checked &&
		!document.getElementById('preg19_a_id5').checked &&
		!document.getElementById('preg19_a_id6').checked &&
		!document.getElementById('preg19_a_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 18 a.');  
		document.ingreso.preg19_a_id1.focus();
		return 0;
	}		

	/*	preg18 b.	*/
	if(	document.getElementById('preg3_id2').checked &&
		!document.getElementById('preg19_b_id1').checked &&
		!document.getElementById('preg19_b_id2').checked &&
		!document.getElementById('preg19_b_id3').checked &&
		!document.getElementById('preg19_b_id4').checked &&
		!document.getElementById('preg19_b_id5').checked &&
		!document.getElementById('preg19_b_id6').checked &&
		!document.getElementById('preg19_b_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 18 b.');  
		document.ingreso.preg19_b_id1.focus();
		return 0;
	}		

	/*	preg18 c.	*/
	if(	document.getElementById('preg3_id2').checked &&
		!document.getElementById('preg19_c_id1').checked &&
		!document.getElementById('preg19_c_id2').checked &&
		!document.getElementById('preg19_c_id3').checked &&
		!document.getElementById('preg19_c_id4').checked &&
		!document.getElementById('preg19_c_id5').checked &&
		!document.getElementById('preg19_c_id6').checked &&
		!document.getElementById('preg19_c_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 18 c.');  
		document.ingreso.preg19_c_id1.focus();
		return 0;
	}		
	/*	preg18 d.	*/
	if(	document.getElementById('preg3_id2').checked &&
		!document.getElementById('preg19_d_id1').checked &&
		!document.getElementById('preg19_d_id2').checked &&
		!document.getElementById('preg19_d_id3').checked &&
		!document.getElementById('preg19_d_id4').checked &&
		!document.getElementById('preg19_d_id5').checked &&
		!document.getElementById('preg19_d_id6').checked &&
		!document.getElementById('preg19_d_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 18 d.');  
		document.ingreso.preg19_d_id1.focus();
		return 0;
	}		
	/* FIN SOLO PERDIDA TOTAL */


	/*	preg21. */
	if(	!document.getElementById('preg23_id1').checked  && 
		!document.getElementById('preg23_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 21.');
		document.ingreso.preg23_id1.focus();
		return 0;
	}

	/*	preg22.	*/
	if(	document.getElementById('preg23_id1').checked && 
		!document.getElementById('preg24_id1').checked &&
		!document.getElementById('preg24_id2').checked &&
		!document.getElementById('preg24_id3').checked &&
		!document.getElementById('preg24_id4').checked &&
		!document.getElementById('preg24_id5').checked &&
		!document.getElementById('preg24_id6').checked &&
		!document.getElementById('preg24_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 22.');  
		document.ingreso.preg24_id1.focus();
		return 0;
	}		
	
	/*	preg23. */
	if(	document.getElementById('preg23_id1').checked && 
		!document.getElementById('preg25_id1').checked  && 
		!document.getElementById('preg25_id2').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 23.');
		document.ingreso.preg25_id1.focus();
		return 0;
	}
	
	/*	preg24.	*/
	if(	!document.getElementById('preg27_id1').checked &&
		!document.getElementById('preg27_id2').checked &&
		!document.getElementById('preg27_id3').checked &&
		!document.getElementById('preg27_id4').checked &&
		!document.getElementById('preg27_id5').checked &&
		!document.getElementById('preg27_id6').checked &&
		!document.getElementById('preg27_id7').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 24.');  
		document.ingreso.preg27_id1.focus();
		return 0;
	}		
	
	/*	preg25.	*/
	if(	!document.getElementById('preg28_id0').checked &&
		!document.getElementById('preg28_id1').checked &&
		!document.getElementById('preg28_id2').checked &&
		!document.getElementById('preg28_id3').checked &&
		!document.getElementById('preg28_id4').checked &&
		!document.getElementById('preg28_id5').checked &&
		!document.getElementById('preg28_id6').checked &&
		!document.getElementById('preg28_id7').checked &&
		!document.getElementById('preg28_id8').checked &&
		!document.getElementById('preg28_id9').checked &&
		!document.getElementById('preg28_id10').checked &&
		!document.getElementById('preg28_id99').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 25.');  
		document.ingreso.preg28_id0.focus();
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

	/*	preg29.*/
	if(	!document.getElementById('preg31_id1').checked  &&
		!document.getElementById('preg31_id2').checked  &&	
		!document.getElementById('preg31_id3').checked  &&	
		!document.getElementById('preg31_id4').checked  &&	
		!document.getElementById('preg31_id5').checked ) 
	{
		alert('DEBE RESPONDER PREGUNTA 29.');
		document.ingreso.preg31_id1.focus();
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
			from qs_encuestascli_penta e 
			left join qs_encuesta_penta pe on e.id_encuesta = pe.id_encuesta 
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

				$StrSql="UPDATE qs_encuestascli_penta set 
				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR)  	
				where id_encuesta = ".$_GET['id_encuesta']." 
				and fec_termino is null";
				
				query_bd($StrSql);

			?>
			<h1>Encuesta de Fidelización de Siniestros - Penta Seguros</h1>
			<h2>Cliente <?PHP echo $row['RUT_ASEGURADO']; ?> | <?PHP echo $row['NOMBRE_ASEGURADO']; ?> | <?PHP echo $row['estado']; ?></h2>
			<form name="ingreso" action="IngresarEncuestaPENTA.php" method="POST" id="ingreso" enctype="multipart/form-data">
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
			<tr><td colspan="2"><h2>Inicio Encuesta Penta Seguros</h2></td></tr>
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

<!-- 			<tr><td>Rut Liquidador</td><td><INPUT size="10" type="text" name="rut_liquidador" value="<?PHP echo $row['rut_liquidador']; ?>"></td><td>Rut Taller</td><td><INPUT size="10" type="text" name="rut_taller" value="<?PHP echo $row['rut_taller']; ?>"></td></tr>
 -->
			</table>

<!--  			<table>
			<tr><td colspan="2"><h2>PUNTO 1 - SALUDO CORPORATIVO</h2></td></tr>
			<tr><td colspan="2">Buenos días / Tardes, Ud. habla con <b><?PHP echo $_SESSION['s_nombre_acceso']; ?></b>, lo estamos llamando de Penta SEGUROS? Hablo con <b><?PHP echo $row['nom_cliente']; ?></b>?</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td colspan="2">Sr. / Sra. <b><?PHP echo $row['nom_cliente']; ?></b>,  El motivo de esta llamada es para conocer su opinión sobre la calidad del servicio recibido desde que hizo su denuncia de siniestro, solicitamos que dedique un momento para completar esta pequeña encuesta y nos gustaría verificar los datos que tenemos disponibles en nuestras bases.</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			</table> -->

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
					<option value="2. No Contacto" id="status1_llamada_id2" >2. No Contacto</option>
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
			
			<tr><td colspan="2"><h3>Señor(a) <?PHP echo $row['NOMBRE_ASEGURADO']; ?>, usted tuvo recientemente un siniestros y requirió utilizar su póliza de seguros de Penta Security, y nos gustaría comprobar su nivel de satisfacción con nuestra atención.</h3></td></tr>
			<tr><td colspan="2"><h3>Por favor, les solicitamos que dedique un momento para completar esta pequeña encuesta, cuyo objetivo es mejorar la calidad de servicio que le otorgamos. </h3></td></tr>
			<tr><td colspan="2"><h3>Sus respuestas serán tratadas de forma confidencial y no serán utilizadas para ningún propósito distinto al mencionado.</h3></td></tr>
			<tr><td colspan="2"><h2>Por favor, le pedimos contestar las preguntas considerando una escala de 1 a 7, donde 1 es muy malo y 7 excelente.</h2></td></tr>
			</table>

 			<table>
			<tr><td colspan="2"><h2>I.	Denuncio de Siniestro</h2></td></tr>				

 			<tr><td colspan="2">a)	Corredor <?PHP echo $row['NOMBRE_CORREDOR'];?></td></tr>
			<tr><td colspan="2">Si el corredor es MARSH, preguntar: ¿Tomó el seguro en DERCO?</td></tr>
			<tr><td><INPUT type="radio" name="preg8_0" value="SI" <?PHP if ($row['preg8_0'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg8_0" value="NO" <?PHP if ($row['preg8_0'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
						
			<tr><td colspan="2">1.	¿Con qué nota evalúa la atención general recibida de parte de la compañía al realizar el denuncio de su siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg1_2" id="preg1_2_id1" value="1" <?PHP if ($row['preg1_2'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id2" value="2" <?PHP if ($row['preg1_2'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id3" value="3" <?PHP if ($row['preg1_2'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id4" value="4" <?PHP if ($row['preg1_2'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id5" value="5" <?PHP if ($row['preg1_2'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id6" value="6" <?PHP if ($row['preg1_2'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg1_2" id="preg1_2_id7" value="7" <?PHP if ($row['preg1_2'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">2.	Posterior al denuncio de su siniestro, ¿recibió una confirmación de su denuncia vía e-mail o SMS?</td></tr>
			<tr><td><INPUT type="radio" name="preg2" id="preg2_id1" value="SI" <?PHP if ($row['preg2'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td colspan="2">¿Cómo evalúa el sistema de mensajería de la compañía? </td></tr>
			<tr><td>
				<INPUT type="radio" name="preg2_a" id="preg2_a_id1" value="1" <?PHP if ($row['preg2_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id2" value="2" <?PHP if ($row['preg2_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id3" value="3" <?PHP if ($row['preg2_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id4" value="4" <?PHP if ($row['preg2_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id5" value="5" <?PHP if ($row['preg2_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id6" value="6" <?PHP if ($row['preg2_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg2_a" id="preg2_a_id7" value="7" <?PHP if ($row['preg2_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td><INPUT type="radio" name="preg2" id="preg2_id2" value="NO" <?PHP if ($row['preg2'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">3.	Su vehículo, ¿sufrió daños parciales o fue pérdida total?</td></tr>
			<tr><td><INPUT type="radio" name="preg3" id="preg3_id1" value="Daños Parciales" <?PHP if ($row['preg3'] == 'Daños Parciales') echo 'checked';?>>Daños Parciales</td></tr>
			<tr><td><INPUT type="radio" name="preg3" id="preg3_id2" value="Pérdida Total" <?PHP if ($row['preg3'] == 'Pérdida Total') echo 'checked';?>>Pérdida Total</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">4.	¿Cómo realizo la denuncia de su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg4" id="preg4_id1" value="SUCURSAL" onchange="mostrar()" <?PHP if ($row['preg4'] == 'SUCURSAL') echo 'checked';?>>SUCURSAL 
		<div id="preg4_div" style="display:none">
			Cual? :
				<select name="preg4_a" size="1">
					<option value="Arica" id="preg4_a_id1" <?PHP if ($row['preg4_a'] == 'Arica') echo 'selected';?>>Arica</option>
					<option value="Iquique" id="preg4_a_id2" <?PHP if ($row['preg4_a'] == 'Iquique') echo 'selected';?>>Iquique</option>
					<option value="Calama" id="preg4_a_id3" <?PHP if ($row['preg4_a'] == 'Calama') echo 'selected';?>>Calama</option>
					<option value="Vallenar" id="preg4_a_id4" <?PHP if ($row['preg4_a'] == 'Vallenar') echo 'selected';?>>Vallenar</option>
					<option value="Antofagasta" id="preg4_a_id5" <?PHP if ($row['preg4_a'] == 'Antofagasta') echo 'selected';?>>Antofagasta</option>
					<option value="Copiapó" id="preg4_a_id6" <?PHP if ($row['preg4_a'] == 'Copiapó') echo 'selected';?>>Copiapó</option>
					<option value="Ovalle" id="preg4_a_id7" <?PHP if ($row['preg4_a'] == 'Ovalle') echo 'selected';?>>Ovalle</option>
					<option value="La Serena" id="preg4_a_id8" <?PHP if ($row['preg4_a'] == 'La Serena') echo 'selected';?>>La Serena</option>
					<option value="San Felipe" id="preg4_a_id9" <?PHP if ($row['preg4_a'] == 'San Felipe') echo 'selected';?>>San Felipe</option>
					<option value="Los Andes" id="preg4_a_id10" <?PHP if ($row['preg4_a'] == 'Los Andes') echo 'selected';?>>Los Andes</option>
					<option value="Viña del Mar" id="preg4_a_id11" <?PHP if ($row['preg4_a'] == 'Viña del Mar') echo 'selected';?>>Viña del Mar</option>
					<option value="Cabildo" id="preg4_a_id12" <?PHP if ($row['preg4_a'] == 'Cabildo') echo 'selected';?>>Cabildo</option>
					<option value="Quillota" id="preg4_a_id13" <?PHP if ($row['preg4_a'] == 'Quillota') echo 'selected';?>>Quillota</option>
					<option value="San Antonio" id="preg4_a_id14" <?PHP if ($row['preg4_a'] == 'San Antonio') echo 'selected';?>>San Antonio</option>
					<option value="Stgo Manquehue" id="preg4_a_id15" <?PHP if ($row['preg4_a'] == 'Stgo Manquehue') echo 'selected';?>>Stgo Manquehue</option>
					<option value="Stgo La Florida" id="preg4_a_id16" <?PHP if ($row['preg4_a'] == 'Stgo La Florida') echo 'selected';?>>Stgo La Florida</option>
					<option value="Stgo Centro" id="preg4_a_id17" <?PHP if ($row['preg4_a'] == 'Stgo Centro') echo 'selected';?>>Stgo Centro</option>
					<option value="Stgo Vitacura" id="preg4_a_id18" <?PHP if ($row['preg4_a'] == 'Stgo Vitacura') echo 'selected';?>>Stgo Vitacura</option>
					<option value="Rancagua" id="preg4_a_id19" <?PHP if ($row['preg4_a'] == 'Rancagua') echo 'selected';?>>Rancagua</option>
					<option value="Curicó" id="preg4_a_id20" <?PHP if ($row['preg4_a'] == 'Curicó') echo 'selected';?>>Curicó</option>
					<option value="Talca" id="preg4_a_id21" <?PHP if ($row['preg4_a'] == 'Talca') echo 'selected';?>>Talca</option>
					<option value="Linares" id="preg4_a_id22" <?PHP if ($row['preg4_a'] == 'Linares') echo 'selected';?>>Linares</option>
					<option value="Chillán" id="preg4_a_id23" <?PHP if ($row['preg4_a'] == 'Chillán') echo 'selected';?>>Chillán</option>
					<option value="Concepción" id="preg4_a_id24" <?PHP if ($row['preg4_a'] == 'Concepción') echo 'selected';?>>Concepción</option>
					<option value="Los Angeles" id="preg4_a_id25" <?PHP if ($row['preg4_a'] == 'Los Angeles') echo 'selected';?>>Los Angeles</option>
					<option value="Temuco" id="preg4_a_id26" <?PHP if ($row['preg4_a'] == 'Temuco') echo 'selected';?>>Temuco</option>
					<option value="Villarica" id="preg4_a_id27" <?PHP if ($row['preg4_a'] == 'Villarica') echo 'selected';?>>Villarica</option>
					<option value="Valdivia" id="preg4_a_id28" <?PHP if ($row['preg4_a'] == 'Valdivia') echo 'selected';?>>Valdivia</option>
					<option value="La Unión" id="preg4_a_id29" <?PHP if ($row['preg4_a'] == 'La Unión') echo 'selected';?>>La Unión</option>
					<option value="Osorno" id="preg4_a_id30" <?PHP if ($row['preg4_a'] == 'Osorno') echo 'selected';?>>Osorno</option>
					<option value="Puerto Varas" id="preg4_a_id31" <?PHP if ($row['preg4_a'] == 'Puerto Varas') echo 'selected';?>>Puerto Varas</option>
					<option value="Puerto Montt" id="preg4_a_id32" <?PHP if ($row['preg4_a'] == 'Puerto Montt') echo 'selected';?>>Puerto Montt</option>
					<option value="Castro" id="preg4_a_id33" <?PHP if ($row['preg4_a'] == 'Castro') echo 'selected';?>>Castro</option>
					<option value="Punta Arenas" id="preg4_a_id34" <?PHP if ($row['preg4_a'] == 'Punta Arenas') echo 'selected';?>>Punta Arenas</option>
				</select>
		</div>
			<tr><td><INPUT type="radio" name="preg4" id="preg4_id2" value="CALL CENTER" onchange="mostrar()" <?PHP if ($row['preg4'] == 'CALL CENTER') echo 'checked';?>>CALL CENTER, - Pasar a Pregunta 9</td></tr>
			<tr><td><INPUT type="radio" name="preg4" id="preg4_id3" value="CORREDOR" onchange="mostrar()" <?PHP if ($row['preg4'] == 'CORREDOR') echo 'checked';?>>CORREDOR, - Pasar a Pregunta 10</td></tr>
			<tr><td><INPUT type="radio" name="preg4" id="preg4_id4" value="INTERNET" onchange="mostrar()" <?PHP if ($row['preg4'] == 'INTERNET') echo 'checked';?>>INTERNET, - Pasar a Pregunta 13</td></tr>
			<tr><td><INPUT type="radio" name="preg4" id="preg4_id5" value="E-MAIL" onchange="mostrar()" <?PHP if ($row['preg4'] == 'E-MAIL') echo 'checked';?>>E-MAIL, - Pasar a Pregunta 13</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">5.	Cuando fue a la sucursal, ¿fue con su auto?</td></tr>
			<tr><td>
			<INPUT type="radio" name="preg5" id="preg5_id1" value="SI" <?PHP if ($row['preg5'] == 'SI') echo 'checked';?>>SI
			</td></tr>
			<tr><td colspan="2">¿Le entregaron?: </td></tr>
			<tr><td><INPUT type="checkbox" name="preg5_a1" id="preg5_a1_id1" value="N° Siniestro" <?PHP if ($row['preg5_a1'] == 'N° Siniestro') echo 'checked';?>>N° Siniestro</td></tr>
			<tr><td><INPUT type="checkbox" name="preg5_a2" id="preg5_a2_id1" value="Los datos del Liquidador" <?PHP if ($row['preg5_a2'] == 'Los datos del Liquidador') echo 'checked';?>>Los datos del Liquidador</td></tr>
			<tr><td><INPUT type="checkbox" name="preg5_a3" id="preg5_a3_id1" value="La orden de atención para el taller" <?PHP if ($row['preg5_a3'] == 'La orden de atención para el taller') echo 'checked';?>>La orden de atención para el taller</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td><INPUT type="radio" name="preg5" id="preg5_id2" value="NO" <?PHP if ($row['preg5'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">¿Le entregaron?: </td></tr>
			<tr><td><INPUT type="checkbox" name="preg5_b1" id="preg5_b1_id1" value="N° Siniestro" <?PHP if ($row['preg5_b1'] == 'N° Siniestro') echo 'checked';?>>N° Siniestro</td></tr>
			<tr><td><INPUT type="checkbox" name="preg5_b2" id="preg5_b2_id1" value="Los datos del Liquidador" <?PHP if ($row['preg5_b2'] == 'Los datos del Liquidador') echo 'checked';?>>Los datos del Liquidador</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

 			<tr><td colspan="2">6.	¿Le informaron a qué taller se habían asignado su siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg6" id="preg6_id1" value="SI" <?PHP if ($row['preg6'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg6" id="preg6_id2" value="NO" <?PHP if ($row['preg6'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">7.	Cómo evalúa, los siguientes aspectos:</td></tr>
			<tr><td colspan="2">a.	La agilidad en la atención en la sucursal</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_a" id="preg7_a_id1" value="1" <?PHP if ($row['preg7_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id2" value="2" <?PHP if ($row['preg7_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id3" value="3" <?PHP if ($row['preg7_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id4" value="4" <?PHP if ($row['preg7_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id5" value="5" <?PHP if ($row['preg7_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id6" value="6" <?PHP if ($row['preg7_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_a" id="preg7_a_id7" value="7" <?PHP if ($row['preg7_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La claridad de la información entregada en la sucursal</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_b" id="preg7_b_id1" value="1" <?PHP if ($row['preg7_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id2" value="2" <?PHP if ($row['preg7_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id3" value="3" <?PHP if ($row['preg7_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id4" value="4" <?PHP if ($row['preg7_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id5" value="5" <?PHP if ($row['preg7_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id6" value="6" <?PHP if ($row['preg7_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_b" id="preg7_b_id7" value="7" <?PHP if ($row['preg7_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	La Atención de la Compañía en el denuncio del Siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg7_c" id="preg7_c_id1" value="1" <?PHP if ($row['preg7_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id2" value="2" <?PHP if ($row['preg7_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id3" value="3" <?PHP if ($row['preg7_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id4" value="4" <?PHP if ($row['preg7_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id5" value="5" <?PHP if ($row['preg7_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id6" value="6" <?PHP if ($row['preg7_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg7_c" id="preg7_c_id7" value="7" <?PHP if ($row['preg7_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 12</h3></td></tr>


			<tr><td colspan="2">9.	Cómo evalúa, los siguientes aspectos relacionados con la toma del denuncio de siniestro :</td></tr>
			<tr><td colspan="2">a.	La facilidad de comunicación con la compañía</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg8_a" id="preg8_a_id1" value="1" <?PHP if ($row['preg8_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id2" value="2" <?PHP if ($row['preg8_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id3" value="3" <?PHP if ($row['preg8_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id4" value="4" <?PHP if ($row['preg8_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id5" value="5" <?PHP if ($row['preg8_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id6" value="6" <?PHP if ($row['preg8_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8_a" id="preg8_a_id7" value="7" <?PHP if ($row['preg8_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La calidad de la información entregada por la operadora</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg8_b" id="preg8_b_id1" value="1" <?PHP if ($row['preg8_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id2" value="2" <?PHP if ($row['preg8_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id3" value="3" <?PHP if ($row['preg8_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id4" value="4" <?PHP if ($row['preg8_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id5" value="5" <?PHP if ($row['preg8_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id6" value="6" <?PHP if ($row['preg8_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8_b" id="preg8_b_id7" value="7" <?PHP if ($row['preg8_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2">b_motivo. Si la nota es igual o menor a 5, preguntar: ¿A qué se debe estar nota?</td></tr>
			<tr><td>
				<textarea name="preg8_b_motivo" cols="100" rows="5"><?PHP echo $row['preg8_b_motivo']; ?></textarea>
			</td><tr>

			<tr><td colspan="2">c.	Los conocimientos de la operadora</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg8_c" id="preg8_c_id1" value="1" <?PHP if ($row['preg8_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id2" value="2" <?PHP if ($row['preg8_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id3" value="3" <?PHP if ($row['preg8_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id4" value="4" <?PHP if ($row['preg8_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id5" value="5" <?PHP if ($row['preg8_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id6" value="6" <?PHP if ($row['preg8_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8_c" id="preg8_c_id7" value="7" <?PHP if ($row['preg8_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	La Atención de la Compañía en el denuncio del Siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg8_d" id="preg8_d_id1" value="1" <?PHP if ($row['preg8_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id2" value="2" <?PHP if ($row['preg8_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id3" value="3" <?PHP if ($row['preg8_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id4" value="4" <?PHP if ($row['preg8_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id5" value="5" <?PHP if ($row['preg8_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id6" value="6" <?PHP if ($row['preg8_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg8_d" id="preg8_d_id7" value="7" <?PHP if ($row['preg8_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">10.	¿Al momento de realizar la denuncia, la operadora fue clara en la entrega de los datos del liquidador y del taller asignado?</td></tr>
			<tr><td colspan="2">a. ¿La operadora fue clara en la entrega de los datos del liquidador y del taller asignado?</td></tr>
			<tr><td><INPUT type="radio" name="preg9" id="preg9_id1" value="SI" <?PHP if ($row['preg9'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg9" id="preg9_id2" value="NO" <?PHP if ($row['preg9'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">b. ¿La operadora le indicó claramente los pasos a seguir? </td></tr>
			<tr><td><INPUT type="radio" name="preg10" id="preg10_id1" value="SI" <?PHP if ($row['preg10'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg10" id="preg10_id2" value="NO" <?PHP if ($row['preg10'] == 'NO') echo 'checked';?>>NO</td></tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 12</h3></td></tr>

			<tr><td colspan="2">11.	Cómo evalúa, los siguientes aspectos: </td></tr>
			<tr><td colspan="2">a.	La demora del Corredor en contactarlo desde que realizó el denuncio</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg11_a" id="preg11_a_id1" value="1" <?PHP if ($row['preg11_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id2" value="2" <?PHP if ($row['preg11_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id3" value="3" <?PHP if ($row['preg11_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id4" value="4" <?PHP if ($row['preg11_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id5" value="5" <?PHP if ($row['preg11_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id6" value="6" <?PHP if ($row['preg11_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg11_a" id="preg11_a_id7" value="7" <?PHP if ($row['preg11_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La atención del Corredor en el denuncio del siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg11_b" id="preg11_b_id1" value="1" <?PHP if ($row['preg11_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id2" value="2" <?PHP if ($row['preg11_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id3" value="3" <?PHP if ($row['preg11_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id4" value="4" <?PHP if ($row['preg11_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id5" value="5" <?PHP if ($row['preg11_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id6" value="6" <?PHP if ($row['preg11_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg11_b" id="preg11_b_id7" value="7" <?PHP if ($row['preg11_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
		</div>

			<tr><td colspan="2">12.	¿Al momento de ser contactado por el Corredor, le entregaron los datos del liquidador y del taller asignado en forma clara?</td></tr>
			<tr><td><INPUT type="radio" name="preg12" id="preg12_id1" value="SI" <?PHP if ($row['preg12'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg12" id="preg12_id2" value="NO" <?PHP if ($row['preg12'] == 'NO') echo 'checked';?>>NO</td></tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 12</h3></td></tr>

			<tr><td colspan="2">13.	En su siniestro, ¿hay un tercero involucrado y responsable del choque?</td></tr>
			<tr><td><INPUT type="radio" name="preg13" id="preg13_id1" value="SI" <?PHP if ($row['preg13'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td colspan="2">¿Le fueron solicitados expresamente los datos del tercero involucrado?</td></tr>
			<tr><td><INPUT type="radio" name="preg13_a" id="preg13_a_id1" value="SI" <?PHP if ($row['preg13_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg13_a" id="preg13_a_id1" value="NO" <?PHP if ($row['preg13_a'] == 'NO') echo 'checked';?>>NO ¿Por quien? :<INPUT type="text" name="preg13_b" size="50" value="<?PHP echo $row['preg13_b']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			<tr><td><INPUT type="radio" name="preg13" id="preg13_id2" value="NO" <?PHP if ($row['preg13'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>


			<tr><td colspan="2"><h3>Preguntas relacionadas con el Apoyo Legal de la Compañía</h3></td></tr>
			<tr><td colspan="2">14.	¿Tomó contacto con usted un abogado de parte de la Compañía?</td></tr>
			<tr><td><INPUT type="radio" name="preg14new" id="preg14new_id1" value="SI" <?PHP if ($row['preg14new'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg14new" id="preg14new_id2" value="NO" <?PHP if ($row['preg14new'] == 'NO') echo 'checked';?>>NO</td></tr>			
			<tr><td colspan="2">a.	El abogado ¿le explicó en qué consistía el apoyo? </td></tr>
			<tr><td><INPUT type="radio" name="preg14new_a" id="preg14new_a_id1" value="SI" <?PHP if ($row['preg14new_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg14new_a" id="preg14new_a_id2" value="NO" <?PHP if ($row['preg14new_a'] == 'NO') echo 'checked';?>>NO</td></tr>			
			<tr><td colspan="2">b.	Cómo evalúa  en una escala de 1 a 7, donde 1 es pésimo y 7 excelente, el apoyo prestado por el abogado de la Compañía</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id1" value="1" <?PHP if ($row['preg14new_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id2" value="2" <?PHP if ($row['preg14new_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id3" value="3" <?PHP if ($row['preg14new_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id4" value="4" <?PHP if ($row['preg14new_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id5" value="5" <?PHP if ($row['preg14new_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id6" value="6" <?PHP if ($row['preg14new_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg14new_b" id="preg14new_b_id7" value="7" <?PHP if ($row['preg14new_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>


			<tr><td colspan="2"><h2>II.	Cumplimiento Protocolo Atención y Liquidación</h2></td></tr>

			<tr><td colspan="2">b).	¿Recibió el Informe de Liquidación de su Siniestro?</td></tr>
			<tr><td><INPUT type="radio" name="preg12_b" id="preg12_b_id1" value="SI" <?PHP if ($row['preg12_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg12_b" id="preg12_b_id2" value="NO" <?PHP if ($row['preg12_b'] == 'NO') echo 'checked';?>>NO</td></tr>			
			
			<tr><td colspan="2"><h3><span class="EnRojo">SI EL CLIENTE NO ES DE SANTIAGO PREGUNTAR - NOMBRE SUCURSAL: <?PHP echo $row['NOMBRE_SUCURSAL']; ?></span></h3></td></tr>

			<tr><td colspan="2">15.	¿Qué tipo de liquidador le atendió?</td></tr>
			<tr><td><INPUT type="radio" name="preg14" id="preg14_id1" value="a. Presencial" <?PHP if ($row['preg14'] == 'a. Presencial') echo 'checked';?>>a. Presencial</td></tr>
			<tr><td><INPUT type="radio" name="preg14" id="preg14_id2" value="b. En terreno" <?PHP if ($row['preg14'] == 'b. En terreno') echo 'checked';?>>b. En terreno</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h3><span class="EnRojo">SI EL CLIENTE ES DE SANTIAGO CONTINUAR CON:</span></h3></td></tr>
			<tr><td colspan="2">16.	Respecto de la información entregada por el liquidador, éste :</td></tr>
			<tr><td colspan="2">a.	¿Le entregó la orden de atención para el taller, cuando inspeccionó su vehículo y cuantificó los daños?</td></tr>
			<tr><td><INPUT type="radio" name="preg15_a" id="preg15_a_id1" value="SI" <?PHP if ($row['preg15_a'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg15_a" id="preg15_a_id2" value="NO" <?PHP if ($row['preg15_a'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">b.	Junto a la entrega de la orden de atención, el liquidador ¿le informó que la garantía de la reparación de su vehículo es de un año </td></tr>
			<tr><td><INPUT type="radio" name="preg15_b" id="preg15_b_id1" value="SI" <?PHP if ($row['preg15_b'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg15_b" id="preg15_b_id2" value="NO" <?PHP if ($row['preg15_b'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">c.	¿Le entregó claramente la información del deducible que debe pagar y cómo pagarlo?</td></tr>
			<tr><td><INPUT type="radio" name="preg15_c" id="preg15_c_id1" value="SI" <?PHP if ($row['preg15_c'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg15_c" id="preg15_c_id2" value="NO" <?PHP if ($row['preg15_c'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">d.	Cumplió los plazos establecidos en la inspección del vehículo</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg16_a" id="preg16_a_id1" value="1" <?PHP if ($row['preg16_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id2" value="2" <?PHP if ($row['preg16_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id3" value="3" <?PHP if ($row['preg16_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id4" value="4" <?PHP if ($row['preg16_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id5" value="5" <?PHP if ($row['preg16_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id6" value="6" <?PHP if ($row['preg16_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg16_a" id="preg16_a_id7" value="7" <?PHP if ($row['preg16_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">e.	Cumplió los plazos establecidos en la entrega de la orden de atención al taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg16_b" id="preg16_b_id1" value="1" <?PHP if ($row['preg16_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id2" value="2" <?PHP if ($row['preg16_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id3" value="3" <?PHP if ($row['preg16_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id4" value="4" <?PHP if ($row['preg16_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id5" value="5" <?PHP if ($row['preg16_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id6" value="6" <?PHP if ($row['preg16_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg16_b" id="preg16_b_id7" value="7" <?PHP if ($row['preg16_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">f.	Como calificaría, en escala de 1 a 7, la claridad en la información del proceso de reparación de su vehículo</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg16_c" id="preg16_c_id1" value="1" <?PHP if ($row['preg16_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id2" value="2" <?PHP if ($row['preg16_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id3" value="3" <?PHP if ($row['preg16_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id4" value="4" <?PHP if ($row['preg16_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id5" value="5" <?PHP if ($row['preg16_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id6" value="6" <?PHP if ($row['preg16_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg16_c" id="preg16_c_id7" value="7" <?PHP if ($row['preg16_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">g.  Como calificaría, en escala de 1 a 7, la facilidad para contactar cuando fue requerido</td></tr>
			<tr><td colspan="2">(Si es <b>liquidador en Terreno</b>: Cómo calificaría, la facilidad para contactar con <b>la Asistente</b>, cuando fue requerido)</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg16_e" id="preg16_e_id1" value="1" <?PHP if ($row['preg16_e'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id2" value="2" <?PHP if ($row['preg16_e'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id3" value="3" <?PHP if ($row['preg16_e'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id4" value="4" <?PHP if ($row['preg16_e'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id5" value="5" <?PHP if ($row['preg16_e'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id6" value="6" <?PHP if ($row['preg16_e'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg16_e" id="preg16_e_id7" value="7" <?PHP if ($row['preg16_e'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>
			
			<tr><td colspan="2">17.	¿Qué nota le colocaría al liquidador que atendió su siniestro, en los siguientes aspectos:</td></tr>
			<tr><td colspan="2">a.	Cordialidad</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg18_a" id="preg18_a_id1" value="1" <?PHP if ($row['preg18_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id2" value="2" <?PHP if ($row['preg18_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id3" value="3" <?PHP if ($row['preg18_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id4" value="4" <?PHP if ($row['preg18_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id5" value="5" <?PHP if ($row['preg18_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id6" value="6" <?PHP if ($row['preg18_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg18_a" id="preg18_a_id7" value="7" <?PHP if ($row['preg18_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	Calidad de la información entregada</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg18_b" id="preg18_b_id1" value="1" <?PHP if ($row['preg18_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id2" value="2" <?PHP if ($row['preg18_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id3" value="3" <?PHP if ($row['preg18_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id4" value="4" <?PHP if ($row['preg18_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id5" value="5" <?PHP if ($row['preg18_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id6" value="6" <?PHP if ($row['preg18_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg18_b" id="preg18_b_id7" value="7" <?PHP if ($row['preg18_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	Atención global</td></tr>
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

			<tr><td colspan="2"><h3>Sólo Para Casos de Pérdida Total</h3></td></tr>

			<tr><td colspan="2">18.	¿Qué nota le colocaría al Liquidador de su siniestro en los siguientes aspectos?: </td></tr>
			<tr><td colspan="2">a.	Claridad para solicitar la documentación necesaria para la liquidación </td></tr>
			<tr><td>
				<INPUT type="radio" name="preg19_a" id="preg19_a_id1" value="1" <?PHP if ($row['preg19_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id2" value="2" <?PHP if ($row['preg19_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id3" value="3" <?PHP if ($row['preg19_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id4" value="4" <?PHP if ($row['preg19_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id5" value="5" <?PHP if ($row['preg19_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id6" value="6" <?PHP if ($row['preg19_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg19_a" id="preg19_a_id7" value="7" <?PHP if ($row['preg19_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	Entrega de la información de los descuentos que debe asumir por el siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg19_b" id="preg19_b_id1" value="1" <?PHP if ($row['preg19_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id2" value="2" <?PHP if ($row['preg19_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id3" value="3" <?PHP if ($row['preg19_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id4" value="4" <?PHP if ($row['preg19_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id5" value="5" <?PHP if ($row['preg19_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id6" value="6" <?PHP if ($row['preg19_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg19_b" id="preg19_b_id7" value="7" <?PHP if ($row['preg19_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	Cumplimiento de los plazos de pago</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg19_c" id="preg19_c_id1" value="1" <?PHP if ($row['preg19_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id2" value="2" <?PHP if ($row['preg19_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id3" value="3" <?PHP if ($row['preg19_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id4" value="4" <?PHP if ($row['preg19_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id5" value="5" <?PHP if ($row['preg19_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id6" value="6" <?PHP if ($row['preg19_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg19_c" id="preg19_c_id7" value="7" <?PHP if ($row['preg19_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	Proceso de negociación de la liquidación del siniestro</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg19_d" id="preg19_d_id1" value="1" <?PHP if ($row['preg19_d'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id2" value="2" <?PHP if ($row['preg19_d'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id3" value="3" <?PHP if ($row['preg19_d'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id4" value="4" <?PHP if ($row['preg19_d'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id5" value="5" <?PHP if ($row['preg19_d'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id6" value="6" <?PHP if ($row['preg19_d'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg19_d" id="preg19_d_id7" value="7" <?PHP if ($row['preg19_d'] == '7') echo 'checked';?>>7 ...
			</td><tr>

			<tr><td colspan="2"><h3>Pasar a Pregunta 19</h3></td></tr>

			<tr><td colspan="2"><h2>III.	Evaluación Taller</h2></td></tr>

<!-- 			<tr><td>20.	¿En qué fecha fue a dejar su vehículo al taller?<INPUT size="10" type="text" name="preg20" value="<?PHP echo $row['preg20']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>
 -->			
			<tr><td colspan="2">19.	Cómo evalúa  en una escala de 1 a 7, donde 1 es pésimo y 7 excelente, los siguientes aspectos:</td></tr>
			<tr><td colspan="2">a.	La ubicación del taller asignado por la compañía</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_a" id="preg21_a_id1" value="1" <?PHP if ($row['preg21_a'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id2" value="2" <?PHP if ($row['preg21_a'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id3" value="3" <?PHP if ($row['preg21_a'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id4" value="4" <?PHP if ($row['preg21_a'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id5" value="5" <?PHP if ($row['preg21_a'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id6" value="6" <?PHP if ($row['preg21_a'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_a" id="preg21_a_id7" value="7" <?PHP if ($row['preg21_a'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">b.	La demora del taller para ser atendido</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_b" id="preg21_b_id1" value="1" <?PHP if ($row['preg21_b'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id2" value="2" <?PHP if ($row['preg21_b'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id3" value="3" <?PHP if ($row['preg21_b'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id4" value="4" <?PHP if ($row['preg21_b'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id5" value="5" <?PHP if ($row['preg21_b'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id6" value="6" <?PHP if ($row['preg21_b'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_b" id="preg21_b_id7" value="7" <?PHP if ($row['preg21_b'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">c.	El estado de limpieza de entrega del vehículo por parte del taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_c" id="preg21_c_id1" value="1" <?PHP if ($row['preg21_c'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id2" value="2" <?PHP if ($row['preg21_c'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id3" value="3" <?PHP if ($row['preg21_c'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id4" value="4" <?PHP if ($row['preg21_c'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id5" value="5" <?PHP if ($row['preg21_c'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id6" value="6" <?PHP if ($row['preg21_c'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_c" id="preg21_c_id7" value="7" <?PHP if ($row['preg21_c'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">d.	¿Le informaron un plazo de entrega de su vehículo?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_d" id="preg21_d_id1" value="SI" <?PHP if ($row['preg21_d'] == 'SI') echo 'checked';?>>SI ...
				<INPUT type="radio" name="preg21_d" id="preg21_d_id2" value="NO" <?PHP if ($row['preg21_d'] == 'NO') echo 'checked';?>>NO ...
			</td><tr>
			<tr><td colspan="2">..	¿Se cumplió?</td></tr>
			<tr><td><INPUT type="radio" name="preg21_d_1" id="preg21_d_1_id1" value="SI" <?PHP if ($row['preg21_d_1'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg21_d_1" id="preg21_d_1_id2" value="NO" <?PHP if ($row['preg21_d_1'] == 'NO') echo 'checked';?>>NO</td></tr>

			<tr><td colspan="2">e.	El trato del personal del taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_e" id="preg21_e_id1" value="1" <?PHP if ($row['preg21_e'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id2" value="2" <?PHP if ($row['preg21_e'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id3" value="3" <?PHP if ($row['preg21_e'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id4" value="4" <?PHP if ($row['preg21_e'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id5" value="5" <?PHP if ($row['preg21_e'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id6" value="6" <?PHP if ($row['preg21_e'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_e" id="preg21_e_id7" value="7" <?PHP if ($row['preg21_e'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">f.	La preocupación por parte de la persona que lo atendió en el taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_f" id="preg21_f_id1" value="1" <?PHP if ($row['preg21_f'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id2" value="2" <?PHP if ($row['preg21_f'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id3" value="3" <?PHP if ($row['preg21_f'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id4" value="4" <?PHP if ($row['preg21_f'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id5" value="5" <?PHP if ($row['preg21_f'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id6" value="6" <?PHP if ($row['preg21_f'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_f" id="preg21_f_id7" value="7" <?PHP if ($row['preg21_f'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">g.	Calidad de la información del proceso de reparación de su vehículo</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_g" id="preg21_g_id1" value="1" <?PHP if ($row['preg21_g'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id2" value="2" <?PHP if ($row['preg21_g'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id3" value="3" <?PHP if ($row['preg21_g'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id4" value="4" <?PHP if ($row['preg21_g'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id5" value="5" <?PHP if ($row['preg21_g'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id6" value="6" <?PHP if ($row['preg21_g'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_g" id="preg21_g_id7" value="7" <?PHP if ($row['preg21_g'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2">h.	Facilidad para contactarse con el taller</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg21_h" id="preg21_h_id1" value="1" <?PHP if ($row['preg21_h'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id2" value="2" <?PHP if ($row['preg21_h'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id3" value="3" <?PHP if ($row['preg21_h'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id4" value="4" <?PHP if ($row['preg21_h'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id5" value="5" <?PHP if ($row['preg21_h'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id6" value="6" <?PHP if ($row['preg21_h'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg21_h" id="preg21_h_id7" value="7" <?PHP if ($row['preg21_h'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">20.	¿Qué nota le colocaría al taller en qué se reparó su vehículo?</td></tr>
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

			<tr><td colspan="2"><h2>IV.	Auto de Reemplazo y Evaluación General de la Compañía </h2></td></tr>
			<tr><td colspan="2">21.	¿Su póliza tiene cobertura de Vehículo de Reemplazo? </td></tr>
			<tr><td><INPUT type="radio" name="preg23" id="preg23_id1" value="SI" <?PHP if ($row['preg23'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg23" id="preg23_id2" value="NO" <?PHP if ($row['preg23'] == 'NO') echo 'checked';?>>NO ¿La utilizó? :<INPUT type="text" name="preg23_a" size="50" value="<?PHP echo $row['preg23_a']; ?>"></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">22.	¿Qué nota le colocaría a la atención en el rent a car?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg24" id="preg24_id1" value="1" <?PHP if ($row['preg24'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg24" id="preg24_id2" value="2" <?PHP if ($row['preg24'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg24" id="preg24_id3" value="3" <?PHP if ($row['preg24'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg24" id="preg24_id4" value="4" <?PHP if ($row['preg24'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg24" id="preg24_id5" value="5" <?PHP if ($row['preg24'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg24" id="preg24_id6" value="6" <?PHP if ($row['preg24'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg24" id="preg24_id7" value="7" <?PHP if ($row['preg24'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">23.	¿Tuvo usted algún problema con el auto reemplazo?</td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id1" value="SI" <?PHP if ($row['preg25'] == 'SI') echo 'checked';?>>SI ¿Cual? :<INPUT type="text" name="preg25_a" size="50" value="<?PHP echo $row['preg25_a']; ?>"></td></tr>
			<tr><td><INPUT type="radio" name="preg25" id="preg25_id2" value="NO" <?PHP if ($row['preg25'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h2>V.	Sugerencias y Reclamos</h2></td></tr>
<!-- 			<tr><td colspan="2">22.	Recomendaría la Compañía a sus familiares o amigos?</td></tr>
			<tr><td><INPUT type="radio" name="preg26" value="SI" <?PHP if ($row['preg26'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg26" value="NO" <?PHP if ($row['preg26'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr> -->

			<tr><td colspan="2">24.	¿Qué nota le colocaría a la atención general recibida por la compañía en su siniestro?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg27" id="preg27_id1" value="1" <?PHP if ($row['preg27'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg27" id="preg27_id2" value="2" <?PHP if ($row['preg27'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg27" id="preg27_id3" value="3" <?PHP if ($row['preg27'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg27" id="preg27_id4" value="4" <?PHP if ($row['preg27'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg27" id="preg27_id5" value="5" <?PHP if ($row['preg27'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg27" id="preg27_id6" value="6" <?PHP if ($row['preg27'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg27" id="preg27_id7" value="7" <?PHP if ($row['preg27'] == '7') echo 'checked';?>>7 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>

<!-- 			<tr><td colspan="2">24. ¿Que tendría que mejorar la Compañia para calificarla con Nota 7?</td></tr>
			<tr><td><textarea name="preg28" cols="100" rows="5"><?PHP echo $row['preg28']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>				 -->		

			<tr><td colspan="2">25. En una escala de 0 a 10, donde “0” significa “no recomendaría en lo absoluto” y “10” significa “definitivamente recomendaría”, ¿qué tanto recomendaría la Compañia a un amigo o familiar?</td></tr>
			<tr><td>
				<INPUT type="radio" name="preg28" id="preg28_id0" value="0" <?PHP if ($row['preg28'] == '0') echo 'checked';?>>0 ...
				<INPUT type="radio" name="preg28" id="preg28_id1" value="1" <?PHP if ($row['preg28'] == '1') echo 'checked';?>>1 ...
				<INPUT type="radio" name="preg28" id="preg28_id2" value="2" <?PHP if ($row['preg28'] == '2') echo 'checked';?>>2 ...
				<INPUT type="radio" name="preg28" id="preg28_id3" value="3" <?PHP if ($row['preg28'] == '3') echo 'checked';?>>3 ...
				<INPUT type="radio" name="preg28" id="preg28_id4" value="4" <?PHP if ($row['preg28'] == '4') echo 'checked';?>>4 ...
				<INPUT type="radio" name="preg28" id="preg28_id5" value="5" <?PHP if ($row['preg28'] == '5') echo 'checked';?>>5 ...
				<INPUT type="radio" name="preg28" id="preg28_id6" value="6" <?PHP if ($row['preg28'] == '6') echo 'checked';?>>6 ...
				<INPUT type="radio" name="preg28" id="preg28_id7" value="7" <?PHP if ($row['preg28'] == '7') echo 'checked';?>>7 ...
				<INPUT type="radio" name="preg28" id="preg28_id8" value="8" <?PHP if ($row['preg28'] == '8') echo 'checked';?>>8 ...
				<INPUT type="radio" name="preg28" id="preg28_id9" value="9" <?PHP if ($row['preg28'] == '9') echo 'checked';?>>9 ...
				<INPUT type="radio" name="preg28" id="preg28_id10" value="10" <?PHP if ($row['preg28'] == '10') echo 'checked';?>>10 ...
				<INPUT type="radio" name="preg28" id="preg28_id99" value="99" <?PHP if ($row['preg28'] == '99') echo 'checked';?>>99 ...
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>						

 			<tr><td colspan="2">26. ¿Cuáles son las razones de esta nota? [escribir respuesta textual] [si responde 0 a 8 y da razones positivas, preguntar qué falta para que esa nota sea 9 o 10]</td></tr>
			<tr><td><textarea name="preg25_0" cols="100" rows="5"><?PHP echo $row['preg25_0']; ?></textarea></td></tr>
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg25_0_a1" id ="preg25_0_a1" size="1">
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
				<select name="preg25_0_c1" id="preg25_0_c1" size="1">

 				</select>			
			</td></tr>
			
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg25_0_a2" id ="preg25_0_a2" size="1">
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
				<select name="preg25_0_c2" id="preg25_0_c2" size="1">

 				</select>			
			</td></tr>
 			<tr><td colspan="2">
				<strong>AREA:</strong>
				<select name="preg25_0_a3" id ="preg25_0_a3" size="1">
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
				<select name="preg25_0_c3" id="preg25_0_c3" size="1">

 				</select>			
			</td></tr>
			
			
			<tr><td colspan="2"><br></td><td></td></tr>		

			<tr><td colspan="2">27.	¿Tiene algún comentario, reclamo, sugerencia o felicitaciones que desee indicarnos?</td></tr>
			<tr><td><INPUT type="radio" name="preg29" id="preg29_id1" value="SI" <?PHP if ($row['preg29'] == 'SI') echo 'checked';?>>SI</td></tr>
			<tr><td><INPUT type="radio" name="preg29" id="preg29_id2" value="NO" <?PHP if ($row['preg29'] == 'NO') echo 'checked';?>>NO</td></tr>
			<tr><td colspan="2">Si la respuesta es SI, el encuestador debe poder clasificar la respuesta en:</td></tr>
			<tr><td><INPUT type="radio" name="preg29_1" id="preg29_1_id1" value="COMENTARIO" <?PHP if ($row['preg29_1'] == 'COMENTARIO') echo 'checked';?>>COMENTARIO</td></tr>
			<tr><td><INPUT type="radio" name="preg29_1" id="preg29_1_id2" value="SUGERENCIA" <?PHP if ($row['preg29_1'] == 'SUGERENCIA') echo 'checked';?>>SUGERENCIA</td></tr>
			<tr><td><INPUT type="radio" name="preg29_1" id="preg29_1_id3" value="FELICITACIONES" <?PHP if ($row['preg29_1'] == 'FELICITACIONES') echo 'checked';?>>FELICITACIONES</td></tr>
			<tr><td><INPUT type="radio" name="preg29_1" id="preg29_1_id4" value="RECLAMO" <?PHP if ($row['preg29_1'] == 'RECLAMO') echo 'checked';?>>RECLAMO</td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2"><h3>Solo para el caso de reclamo, sugerencia o felicitaciones</h3></td></tr>
			<tr><td colspan="2">28.	¿Cuál?, ¿A quién va dirigido su reclamo ó sugerencia?</td></tr>
			<tr><td><textarea name="preg30" id="preg30_id1" cols="100" rows="5"><?PHP echo $row['preg30']; ?></textarea></td></tr>
			<tr><td colspan="2"><br></td><td></td></tr>

			<tr><td colspan="2">29.	¿Hace cuanto tiempo es cliente de la Compañía?</td></tr>
			<tr><td><INPUT type="radio" name="preg31" id="preg31_id1" value="Menos de 1 mes" <?PHP if ($row['preg31'] == 'Menos de 1 mes') echo 'checked';?>>Menos de 1 mes</td></tr>
			<tr><td><INPUT type="radio" name="preg31" id="preg31_id2" value="Entre 1 – 6 meses" <?PHP if ($row['preg31'] == 'Entre 1 – 6 meses') echo 'checked';?>>Entre 1 – 6 meses</td></tr>
			<tr><td><INPUT type="radio" name="preg31" id="preg31_id3" value="Entre 6 meses - 1 años" <?PHP if ($row['preg31'] == 'Entre 6 meses - 1 años') echo 'checked';?>>Entre 6 meses - 1 años</td></tr>
			<tr><td><INPUT type="radio" name="preg31" id="preg31_id4" value="Entre 1 - 3 años" <?PHP if ($row['preg31'] == 'Entre 1 - 3 años') echo 'checked';?>>Entre 1 - 3 años</td></tr>
			<tr><td><INPUT type="radio" name="preg31" id="preg31_id5" value="Más de 3 años" <?PHP if ($row['preg31'] == 'Más de 3 años') echo 'checked';?>>Más de 3 años</td></tr>
			</td><tr>
			<tr><td colspan="2"><br></td><td></td></tr>						

 			<tr><td colspan="2">30.	¿Nos podría decir cuál es su edad?<INPUT size="10" type="text" name="preg32" value="<?PHP echo $row['preg32']; ?>"></td></tr>
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

	
<script>
function mostrar() {
  if(document.getElementById('preg4_id1').checked ) {
	document.getElementById('preg4_div').style.display ='inherit';
  }
  else {
	document.getElementById('preg4_div').style.display ='none';		  
  }

  if(document.getElementById('preg4_id2').checked ) {
	alert('PASA A PREGUNTA 9');
	document.ingreso.preg8_a_id1.focus();
  }

  if(document.getElementById('preg4_id3').checked ) {
	alert('PASA A PREGUNTA 10');
	document.ingreso.preg9_id1.focus();
  }

  if(document.getElementById('preg4_id4').checked ) {
	alert('PASA A PREGUNTA 13');
	document.ingreso.preg13_id1.focus();
  }

  if(document.getElementById('preg4_id5').checked ) {
	alert('PASA A PREGUNTA 13');
	document.ingreso.preg13_id1.focus();
  }
  
};
</script>

  
	</body>
	</html>
<?PHP
}
?>
