<?PHP
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$suma_total1=0;
$suma_total2=0;
$suma_total3=0;

$cabecera="";
$cabecera2="";
$strselect="";
$tabla="";
$tabla_linea= "<tr>";

include_once('../reclutador/funciones/valida.php');
echo "<div align=\"center\">";

$validacion1=false;
$validacion2=false;
$validacion=false;

if(isset($_GET['g_fecha_1']) and isset($_GET['g_fecha_2']))
{
	$fecha1=sqlitoFecha($_GET['g_fecha_1']);
	$fecha2=sqlitoFecha($_GET['g_fecha_2']);

	$validacion1=check_date($fecha1);
	$validacion2=check_date($fecha2);

	if($validacion1==true and $validacion2==true)
	{
		$fecha_uno = new DateTime($fecha1);
		$fecha_dos = new DateTime($fecha2);

		$year_inicio=$fecha_uno->format('Y');
		$year_fin=$fecha_dos->format('Y');

		$year1=$fecha_uno->format('Y');
		$year2=$fecha_uno->format('Y') + 1;
		$year3=$fecha_uno->format('Y') + 2;

		if($fecha_uno->format('Ymd')<=$fecha_dos->format('Ymd'))
		{
			$validacion=true;
		}
	}
}

if($validacion==true)
{

	$cuenta=2;

	$tabla_linea= "<tr>";

	if($year_inicio>$year_fin)
	{
		$validacion=false;
	}
	elseif($year_inicio==$year_fin)
	{
		$fecha_1_a=$year1.$fecha_uno->format('md');
		$fecha_1_b=$year1.$fecha_dos->format('md');

		$rango_fecha= "<h3>Hasta el ".$fecha_uno->format('d-m-Y')."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m-Y')."</h3>";

		$strpagos= " total1 =sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_1_a."' and '".$fecha_1_b."' then (ROUND(valor_linea, 0)) else 0 end)";

		$strselect.= " select origen,agencia,total1=isnull(total1,0)";
		$strselect.= " from #tmp_tabla1";
		$strselect.= " where (total1)<>0";
		$strselect.= " order by total1 desc";

		$cabecera2.= "<th class=\"rounded-q4\">".$year1."</th>";

		$validacion=true;
	}
	elseif($year_inicio+1==$year_fin)
	{
		//echo "<p>dos años</p>";
		$fecha_inicio=$fecha_uno->format('d-m')."-".$fecha_uno->format('Y');
		$fecha_fin=$fecha_dos->format('d-m')."-".$fecha_dos->format('Y');

		$fecha_1_a=$year1.$fecha_uno->format('md');
		$fecha_1_b=$year1.$fecha_dos->format('m-d');

		$fecha_2_a=$year2.$fecha_uno->format('md');
		$fecha_2_b=$year2.$fecha_dos->format('md');

		$rango_fecha= "<h3>Hasta el ".$fecha_uno->format('d-m')."-".$year1."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m')."-".$year1."</h3>";
		$rango_fecha.= "<h3>Hasta el ".$fecha_uno->format('d-m')."-".$year2."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m')."-".$year2."</h3>";

		$strpagos= "  total1 =sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_1_a."' and '".$fecha_1_b."' then ROUND(valor_linea, 0) else 0 end),";
		$strpagos.= " total2 =sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_2_a."' and '".$fecha_2_b."' then ROUND(valor_linea, 0) else 0 end)";

		$cabecera2.= "<th>".$year1."</th>";
		$cabecera2.= "<th>".$year2."</th>";
		$cabecera2.= "<th>Diferencia ".$year1."-".$year2."</th>";
		$cabecera2.= "<th class=\"rounded-q4\">Crecimiento ".$year1."-".$year2."</th>";

		$strselect.= " select origen,agencia,total1=isnull(total1,0),total2=isnull(total2,0)";
		$strselect.= " from #tmp_tabla1";
		$strselect.= " where (total1 + total2)<>0";
		$strselect.= " order by (case when isnull(total1,0)=0 then 100 else ((isnull(total2,0)-total1)/total1)*100 end ) desc";

		$validacion=true;
	}
	elseif($year_inicio+2==$year_fin)
	{
		//echo "<p>tres años</p>";
		$fecha_inicio=$fecha_uno->format('d-m')."-".$fecha_uno->format('Y');
		$fecha_fin=$fecha_dos->format('d-m')."-".$year3;

		$cabecera2.= "<th>".$year1."</th>";
		$cabecera2.= "<th>".$year2."</th>";
		$cabecera2.= "<th>".$year3."</th>";
		$cabecera2.= "<th>Diferencia ".$year1."-".$year2."</th>";
		$cabecera2.= "<th>Diferencia ".$year2."-".$year3."</th>";
		$cabecera2.= "<th>Crecimiento ".$year1."-".$year2."</th>";
		$cabecera2.= "<th class=\"rounded-q4\">Crecimiento ".$year2."-".$year3."</th>";

		$fecha_1_a=$year1.$fecha_uno->format('md');
		$fecha_1_b=$year1.$fecha_dos->format('md');

		$fecha_2_a=$year2.$fecha_uno->format('md');
		$fecha_2_b=$year2.$fecha_dos->format('md');

		$fecha_3_a=$year3.$fecha_uno->format('md');
		$fecha_3_b=$year3.$fecha_dos->format('md');

		$rango_fecha= "<h3>Hasta el ".$fecha_uno->format('d-m')."-".$year1."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m')."-".$year1."</h3>";
		$rango_fecha.= "<h3>Hasta el ".$fecha_uno->format('d-m')."-".$year2."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m')."-".$year2."</h3>";
		$rango_fecha.= "<h3>Hasta el ".$fecha_uno->format('d-m')."-".$year3."&nbsp;&nbsp; de &nbsp;&nbsp;".$fecha_dos->format('d-m')."-".$year3."</h3>";

		$strpagos= "  total1 = isnull(sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_1_a."' and '".$fecha_1_b."' then ROUND(valor_linea, 0) else 0 end),0),";
		$strpagos.= " total2 = isnull(sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_2_a."' and '".$fecha_2_b."' then ROUND(valor_linea, 0) else 0 end),0),";
		$strpagos.= " total3 = isnull(sum(case when convert(varchar(10),fecha_facturacion,112) BETWEEN '".$fecha_3_a."' and '".$fecha_3_b."' then ROUND(valor_linea, 0) else 0 end),0)";

		$strselect.= " select origen,agencia,total1=isnull(total1,0),total2=isnull(total2,0),total3=isnull(total3,0)";
		$strselect.= " from #tmp_tabla1";
		$strselect.= " where (total1 + total2 + total3)<>0";

		$strselect.= " order by (
case when total3=total2 then 
	0 
else 
	(
	case when (total2=0 and total3>0) then 
		100 
	else 
		(case when (total2>0 and total3=0) then -100 else ((total3-total2)/total2)*100 end)
	end
	)
end

) desc";
	
		$validacion=true;
	}
	else
	{
		//echo "error";
		$validacion=false;
	}
}

include("../reclutador/funciones/tablas_estilos.php");

tabla_superior(600,"profile");
echo "<h2>Informe de Ventas por CLIENTE - Comparativo</h2>";
if($validacion==true)
{
	echo $rango_fecha;
}

echo "<p></p>";
tabla_inferior("profile");
echo "<p></p>";

if($validacion==true)
{
	$_SESSION['tabla']="";
	
	$strsql = " select origen,agencia=LTRIM(agencia),";
	$strsql.= $strpagos;
	$strsql.= " into #tmp_tabla1";
	$strsql.= " From RIGT_Base_datos_Compras";
	$strsql.= " group by origen,agencia";
	$strsql.= $strselect;

	$pivote=0;
	
	//echo "strsql: ".$strsql;
	
	$cabecera = "<table width=\"700\" cellspacing=\"0\" border=\"0\" cellpadding=\"0\" align=\"center\">";
	$cabecera.= "<tr><td align=\"center\">";
	$cabecera.= "<h2>Informe de Ventas por Cliente - Comparativo</h2>";
	$cabecera.= $rango_fecha;
	$cabecera.= "</td></tr></table>";
	$cabecera1= "<table width=\"700\" align=\"center\" id=\"rounded-corner\">";
	$cabecera1.= "<thead>";
	$cabecera1.= "<tr>";
	$cabecera1.= "<th scope=\"col\" class=\"rounded-company\">Cliente</th>";
	$cabecera1.= $cabecera2;
	$cabecera1.= "</tr></thead>";
	$tabla.= "<tbody>";

	include_once('../reclutador/funciones/botones.php');
	include_once('../reclutador/funciones/conectar.php');

	$link=sql();

	$consulta_sql = mssql_query($strsql,$link);
	
	while ($rw = mssql_fetch_array($consulta_sql))
	{
		$pivote++;
		$T_Crecimiento1=100;
		$T_Crecimiento2=100;

		$tabla.="<tr>";
		$tabla.="<td width=\"250\" align=\"left\"><a href=\"javascript:Cargar('VtasPorClienteComparativoD.php?g_origen=".$rw['origen']."&g_cliente=".utf8_encode($rw['agencia'])."');\"> ".utf8_encode($rw['agencia'])." </a></td>";
		
		$tabla.="<td width=\"75\" align=\"right\">".number_format($rw['total1'])."</td>";
		$suma_total1+=$rw['total1'];

		if($year_inicio+1<=$year_fin)
		{
			$tabla.="<td width=\"75\" align=\"right\">".number_format($rw['total2'])."</td>";
			$suma_total2+=$rw['total2'];
		}

		if($year_inicio+2==$year_fin)
		{
			$tabla.="<td width=\"75\" align=\"right\">".number_format($rw['total3'])."</td>";
			$suma_total3+=$rw['total3'];
		}

		if($year_inicio+1<=$year_fin)
		{
			$tabla.="<td width=\"75\" align=\"right\">".number_format($rw['total2'] - $rw['total1'])."</td>";
		}

		if($year_inicio+2==$year_fin)
		{
			$tabla.="<td width=\"75\" align=\"right\">".number_format($rw['total3'] - $rw['total2'])."</td>";
		}

		if($year_inicio+1<=$year_fin)
		{
			if($rw['total1']>0) $T_Crecimiento1=(($rw['total2']-$rw['total1'])/$rw['total1'])*100;
			if($rw['total1']==$rw['total2']) $T_Crecimiento1=0;

			$tabla.="<td width=\"75\" align=\"right\">".number_format($T_Crecimiento1)." %&nbsp;&nbsp;&nbsp;</td>";
		}

		if($year_inicio+2==$year_fin)
		{
			if($rw['total2']>0) $T_Crecimiento2=(($rw['total3']-$rw['total2'])/$rw['total2'])*100;
			if($rw['total2']==$rw['total3']) $T_Crecimiento2=0;

			$tabla.="<td width=\"75\" align=\"right\">".number_format($T_Crecimiento2)." %&nbsp;&nbsp;&nbsp;</td>";
		}

		$tabla.="</tr>";
	}
	mssql_free_result($consulta_sql);
	mssql_close($link);

	if($pivote==0)
	{
		tabla_superior(600,"profile");
		echo "<p align=\"center\" class=\"TextoError\">No se encontraron resultados para la busqueda ingresada</p>";
		tabla_inferior("profile");
	}
	else
	{
		$tabla_linea= "<tr><td>&nbsp;</td><td>&nbsp;</td>";
		$total_columnas = 1;
		$tabla_total= "<tr>";
		$tabla_total.= "<td class=\"capCabTot\" align=\"left\">SUMA TOTAL</td>";
		$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($suma_total1)."</td>";
				
		if($year_inicio+1<=$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($suma_total2)."</td>";
		}

		if($year_inicio+2==$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($suma_total3)."</td>";
		}

		if($year_inicio+1<=$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($suma_total2 - $suma_total1)."</td>";
		}

		if($year_inicio+2==$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($suma_total3 - $suma_total2)."</td>";
		}

		if($year_inicio+1<=$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			if($suma_total1>0) $T_Crecimiento1=(($suma_total2-$suma_total1)/$suma_total1)*100;
			if($suma_total1==$suma_total2) $T_Crecimiento1=0;

			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($T_Crecimiento2)." %&nbsp;&nbsp;&nbsp;</td>";
		}
		
		if($year_inicio+2==$year_fin)
		{
			$tabla_linea.= "<td>&nbsp;</td>";
			$total_columnas++;
			if($suma_total2>0) $T_Crecimiento2=(($suma_total3-$suma_total2)/$suma_total2)*100;
			if($suma_total2==$suma_total3) $T_Crecimiento2=0;

			$tabla_total.= "<td class=\"capSumTot\" align=\"right\">".number_format($T_Crecimiento2)." %&nbsp;&nbsp;&nbsp;</td>";
		}
		$tabla_total.= "</tr>";
		$tabla_linea.= "</tr>";

		include_once('../reclutador/funciones/botones.php');

		boton_excel($_SERVER['PHP_SELF']);

		$linkproveedor1="<a href=\"javascript:Cargar('VtasPorClienteComparativo.php?g_uno=uno');\">COMPARATIVO</a>";
		
		echo "<table width=\"700\" border=\"0\"><tr><td>";
		echo "<p class=\"capRuta\">INFO. VENTAS POR CLIENTE > ".$linkproveedor1." > </p>";
		echo "</td></tr></table>";

		echo $cabecera1;
		echo $tabla;

		echo $tabla_linea;
		echo $tabla_total;

		pie_tabla($total_columnas);


		$_SESSION['s_tabla']= $cabecera."".$cabecera1."".$tabla."".$tabla_total;
	}
}
else
{
	tabla_superior(600,"profile");
	echo "<p align=\"center\" class=\"TextoError\">Debe Ingresar Año de Inicio y de Fin para realizar la busqueda</p>";
	echo "<p align=\"center\" class=\"TextoError\">El Año de Inicio debe ser menor al de Fin</p>";
	tabla_inferior("profile");
}
	?>

</div>
