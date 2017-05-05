var RegioSeleccionada=0;
var ProvinciaSeleccionada=0;
var ComunaSeleccionada=0;
var chkmismaregion1=true;
var chkmismaregion2=true;
	
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
	eventocheck("../funciones/combos3.php?Id=0&valor1=2","divmismaprovincia1")
	eventocheck("../funciones/combos3.php?Id=0&valor1=3","divmismacomuna1")
	document.ingreso.mismaprovincia1.checked=true;
	document.ingreso.mismacomuna1.checked=true;
}
function cambiarprovincia1()
{
	var destino='divmismacomuna1';
	eventocheck("../funciones/combos3.php?Id=0&valor1=1",destino)
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
		eventocheck("../funciones/combos3.php?Id=0&valor1=1",destino)
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
		eventocheck("../funciones/combos3.php?Id=0&valor1=2",destino)
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
		eventocheck("../funciones/combos3.php?Id=0&valor1=3",destino)
	}
}
