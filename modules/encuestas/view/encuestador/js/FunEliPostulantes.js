var RegioSeleccionada=0;
var ProvinciaSeleccionada=0;
var ComunaSeleccionada=0;
var chkmismaregion1=true;
var chkmismaregion2=true;

function pregunta()
{
    if (confirm('¿Seguro desea Borrar Postulante?'))
	{
       		document.ingreso.submit()
    	}
}  
	
function cancelar()
{

}
function NuevoAjax()
{
	var xmlhttp=false;
	try
	{
	        xmlHttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("No AJAX!?");
				return false;
			}
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
	var contenido, preloader
	contenido = document.getElementById('contenido')
	preloader = document.getElementById('preloader')
	var TfechaInicio = document.getElementById('f_date_1')
	var TfechaFin = document.getElementById('f_date_2')

	ajax=NuevoAjax()

	ajax.open("GET", url,true)

	ajax.onreadystatechange=function()
	{
	        if(ajax.readyState==1)
		{
	                preloader.innerHTML = "."
	                //modificamos el estilo de la div, mostrando una imagen de fondo
	                preloader.style.background = "url('ajax-loader-2.gif') no-repeat"
	        }
		else if(ajax.readyState==4)
		{
	                if(ajax.status==200)
			{
	                        //mostramos los datos dentro de la div
	                        contenido.innerHTML = ajax.responseText
	                        preloader.innerHTML = ""
	                        preloader.style.background = "url('loaded.gif') no-repeat"
	                }
			else if(ajax.status==404)
			{
	                        preloader.innerHTML = "La página no existe"
	                }
			else
			{
	                        //mostramos el posible error
	                        preloader.innerHTML = "Error:".ajax.status
	                }
	        }
	}
	ajax.send(null);
}

function ajaxcombos(url,destino)
{
	var contenido, preloader
	contenido = document.getElementById(destino)
	preloader = document.getElementById('preloader')

	ajax=NuevoAjax()

	ajax.open("GET", url,true)

	ajax.onreadystatechange=function()
	{
	        if(ajax.readyState==1)
		{
	                preloader.innerHTML = "."
	                //modificamos el estilo de la div, mostrando una imagen de fondo
	                preloader.style.background = "url('ajax-loader-2.gif') no-repeat"
	        }
		else if(ajax.readyState==4)
		{
	                if(ajax.status==200)
			{
	                        //mostramos los datos dentro de la div
	                        contenido.parentNode.innerHTML = ajax.responseText
	                        preloader.innerHTML = ""
	                        preloader.style.background = "url('loaded.gif') no-repeat"
	                }
			else if(ajax.status==404)
			{
	                        preloader.innerHTML = "La página no existe"
	                }
			else
			{
	                        //mostramos el posible error
	                        preloader.innerHTML = "Error:".ajax.status
	                }
	        }
	}
	ajax.send(null);
}

function eventocheck(url,destino)
{
	
	var contenido, preloader
	contenido = document.getElementById(destino)
	preloader = document.getElementById('preloader')

	ajax=NuevoAjax()

	ajax.open("GET", url,true)

	ajax.onreadystatechange=function()
	{
	        if(ajax.readyState==1)
		{
	                preloader.innerHTML = "."
	                //modificamos el estilo de la div, mostrando una imagen de fondo
	                preloader.style.background = "url('ajax-loader-2.gif') no-repeat"
	        }
		else if(ajax.readyState==4)
		{
	                if(ajax.status==200)
			{
	                        //mostramos los datos dentro de la div
	                        contenido.innerHTML = ajax.responseText
	                        preloader.innerHTML = ""
	                        preloader.style.background = "url('loaded.gif') no-repeat"
	                }
			else if(ajax.status==404)
			{
	                        preloader.innerHTML = "La página no existe"
	                }
			else
			{
	                        //mostramos el posible error
	                        preloader.innerHTML = "Error:".ajax.status
	                }
	        }
	}
	ajax.send(null);
}

function combos(str1,str2,destino,IdCombo)
{
	ajaxcombos("../funciones/combos3.php?Id="+IdCombo+"&valor1="+str1+"&valor2="+str2,destino,IdCombo)
}

function combosmultiples(str1,str2,str3,destino,IdCombo)
{
	ajaxcombos("../funciones/combos3.php?Id="+IdCombo+"&valor1="+str1+"&valor2="+str2+"&valor3="+str3,destino,IdCombo)
}

function cambiaregion1()
{
	var destino='divmismaprovincia1';
	combos(destino,destino,destino,0)
	destino='divmismacomuna1';
	combos(destino,destino,destino,0)
	document.ingreso.mismaprovincia1.checked=true;
	document.ingreso.mismacomuna1.checked=true;
}
function cambiarprovincia1()
{
	var destino='divmismacomuna1';
	combos(destino,destino,destino,0)
	document.ingreso.mismacomuna1.checked=true;
}
function modificaregion1(check,destino,IdCombo)
{
	chkmismaregion1=check;
	if(check==false)
	{
		combos(document.ingreso.region.value,0,destino,IdCombo)
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}
function modificaprovincia1(check,destino,IdCombo)
{
	if(check==false)
	{
		if(chkmismaregion1==true)
		{
			combos(document.ingreso.region.value,document.ingreso.provincia.value,destino,IdCombo)
		}
		else
		{
			combos(document.ingreso.otraregion1.value,0,destino,IdCombo)
		}
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}
function modificacomuna1(check,destino,IdCombo)
{
	if(check==false)
	{
		if(document.ingreso.mismaprovincia1.checked==true)
		{
			combos(document.ingreso.provincia.value,document.ingreso.comuna.value,destino,IdCombo)
		}
		else
		{
			combos(document.ingreso.otraprovincia1.value,0,destino,IdCombo)
		}
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}



function cambiaregion2()
{
	var destino='divmismaprovincia2';
	combos(destino,destino,destino,0)
	destino='divmismacomuna2';
	combos(destino,destino,destino,0)
	document.ingreso.mismaprovincia2.checked=true;
	document.ingreso.mismacomuna2.checked=true;
}
function cambiarprovincia2()
{
	var destino='divmismacomuna2';
	combos(destino,destino,destino,0)
	document.ingreso.mismacomuna2.checked=true;
}
function modificaregion2(check,destino,IdCombo)
{
	chkmismaregion2=check;
	if(check==false)
	{
		combos(document.ingreso.region.value,0,destino,IdCombo)
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}
function modificaprovincia2(check,destino,IdCombo)
{
	if(check==false)
	{
		if(chkmismaregion2==true)
		{
			combos(document.ingreso.region.value,document.ingreso.provincia.value,destino,IdCombo)
		}
		else
		{
			combos(document.ingreso.otraregion2.value,0,destino,IdCombo)
		}
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}
function modificacomuna2(check,destino,IdCombo)
{
	if(check==false)
	{
		if(document.ingreso.mismaprovincia2.checked==true)
		{
			combos(document.ingreso.provincia.value,document.ingreso.comuna.value,destino,IdCombo)
		}
		else
		{
			combos(document.ingreso.otraprovincia2.value,0,destino,IdCombo)
		}
	}
	else
	{
		eventocheck("../funciones/combos3.php?Id=0",destino)
	}
}
