<?php
require_once '../../config/superior.php';
$conn = new config();

?>
<div >
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

			from qs_encuestascli_sodimac_ind e 

			left join qs_encuesta_sodimac_ind pe on e.id_encuesta = pe.id_encuesta 

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



				$StrSql="UPDATE qs_encuesta_sodimac_ind set 

				fec_inicio = ADDDATE(NOW(),INTERVAL 1 HOUR)  	

				where id_encuesta = ".$_GET['id_encuesta']." 

				and fec_termino is null";

				

				query_bd($StrSql);



			?>

			<form name="ingreso" action="IngresarEncuestaSODI_IND.php" method="POST" id="ingreso" enctype="multipart/form-data">

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

					<option value="1.a.i. NO ha ido a una tienda en los �ltimos 6 meses" >1.a.i. NO ha ido a una tienda en los �ltimos 6 meses</option>

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

					<option value="1.b.i. N�mero equivocado" >1.b.i. N�mero equivocado</option>

					<option value="1.b.ii. Inubicable por Horario" >1.b.ii. Inubicable por Horario</option>

					<option value="1.b.iii. Cliente de Viaje" >1.b.iii. Cliente de Viaje</option>

					<option value="1.b.iv. Volver a LLamar" >1.b.iv. Volver a LLamar</option>

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

						

 			<table>

			<tr><td colspan="1"><h3>Buenos d�as\buenas tardes\buenas noches. Mi nombre es <?PHP echo $nombre_acceso; ?> y estamos interesados en conocer su nivel de satisfacci�n con las tiendas de mejoramiento del hogar.</h3></td></tr>

			<tr><td colspan="1"><h3>Y para ello queremos entender sus opiniones acerca de este tipo de tiendas.<br /> 

			�Tiene disponibilidad para responder algunas preguntas durante los pr�ximos 2 minutos? <br />

			Tenga en consideraci�n que toda la informaci�n se mantendr� confidencial y an�nima, y que no ser� contactado(a) en el futuro como resultado de esta encuesta.</h3></td></tr>

			</table>



 			<table>

			<tr><td><h2>I.- Encuesta General</h2></td></tr>

			<tr><td colspan="2">1.	�Ha comprado alg�n producto para la construcci�n y/o de mejoramiento para el hogar, como materiales de construcci�n, pinturas, art�culos de ba�o y cocina, pisos, muebles y/o cualquier otro producto para remodelar o decorar su casa, en los �ltimos meses?</td><tr>

			<tr><td><INPUT type="radio" name="preg1" value="SI" <?PHP if ($row['preg1'] == 'SI') echo 'checked';?>>SI</td></tr>

			<tr><td><INPUT type="radio" name="preg1" value="NO" <?PHP if ($row['preg1'] == 'NO') echo 'checked';?>>

			NO <span class="Estilo1">Terminar</span> </td>

			</tr>

			<tr><td colspan="2"><br /></td></tr>



			<tr><td colspan="2">2.	�En qu� empresas realiz� la compra?</td><tr>

			<tr><td>Empresa 1: <INPUT size="70" type="text" name="preg2_1" value="<?PHP echo $row['preg2_1']; ?>"> 

			<span class="Estilo1">(*) Pasa a Pregunta 3</span></td>

			</tr>

			<tr><td>Empresa 2: <INPUT size="70" type="text" name="preg2_2" value="<?PHP echo $row['preg2_2']; ?>">

			<span class="Estilo1">(*) Pasa a Pregunta 5</span></td>

			</tr>

			<tr><td colspan="2"><br /></td></tr>

						

			<tr><td colspan="2">3.  En una escala de 0 a 10, donde �0� significa �no recomendar�a en lo absoluto� y �10� significa �definitivamente recomendar�a�, �qu� tanto recomendar�a a [Empresa 1] un familiar o amigo?</td><tr>

			<tr><td>

				<INPUT type="radio" name="preg3" value="0" <?PHP if ($row['preg3'] == '0') echo 'checked';?>>0 ...

				<INPUT type="radio" name="preg3" value="1" <?PHP if ($row['preg3'] == '1') echo 'checked';?>>1 ...

				<INPUT type="radio" name="preg3" value="2" <?PHP if ($row['preg3'] == '2') echo 'checked';?>>2 ...

				<INPUT type="radio" name="preg3" value="3" <?PHP if ($row['preg3'] == '3') echo 'checked';?>>3 ...

				<INPUT type="radio" name="preg3" value="4" <?PHP if ($row['preg3'] == '4') echo 'checked';?>>4 ...

				<INPUT type="radio" name="preg3" value="5" <?PHP if ($row['preg3'] == '5') echo 'checked';?>>5 ...

				<INPUT type="radio" name="preg3" value="6" <?PHP if ($row['preg3'] == '6') echo 'checked';?>>6 ...

				<INPUT type="radio" name="preg3" value="7" <?PHP if ($row['preg3'] == '7') echo 'checked';?>>7 ...

				<INPUT type="radio" name="preg3" value="8" <?PHP if ($row['preg3'] == '8') echo 'checked';?>>8 ...

				<INPUT type="radio" name="preg3" value="9" <?PHP if ($row['preg3'] == '9') echo 'checked';?>>9 ...

				<INPUT type="radio" name="preg3" value="10" <?PHP if ($row['preg3'] == '10') echo 'checked';?>>10 ...

				<INPUT type="radio" name="preg3" value="99" <?PHP if ($row['preg3'] == '99') echo 'checked';?>>99 ...

			</td><tr>

			<tr><td colspan="2"><br /></td></tr>



			<tr><td colspan="2">4.	�Cu�les son las razones de esta nota? [escribir respuesta textual] [si responde 0 a 8 y da razones positivas, preguntar qu� falta para que esa nota sea 9 o 10]</td><tr>

			<tr><td><textarea name="preg4" cols="100" rows="2"><?PHP echo $row['preg4']; ?></textarea></td></tr>

			<tr><td><strong>AREA:</strong>

				<select name="preg4_area1" id ="preg4_area1" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg4_causa1" id="preg4_causa1" size="1">



 				</select>



			<tr><td><strong>AREA:</strong>

				<select name="preg4_area2" id ="preg4_area2" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg4_causa2" id="preg4_causa2" size="1">



 				</select>



			<tr><td><strong>AREA:</strong>

				<select name="preg4_area3" id ="preg4_area3" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg4_causa3" id="preg4_causa3" size="1">



 				</select>

				

			</td><tr>

			<tr><td colspan="2"><p>			        <span class="Estilo1">Pasa a Pregunta 7</span>

</p>



			<tr><td colspan="2">5.	En una escala de 0 a 10, donde �0� significa �no recomendar�a en lo absoluto� y �10� significa �definitivamente recomendar�a�, �qu� tanto recomendar�a a [Empresa 2] a un amigo o colega?</td><tr>

			<tr><td>

				<INPUT type="radio" name="preg5" value="0" <?PHP if ($row['preg5'] == '0') echo 'checked';?>>0 ...

				<INPUT type="radio" name="preg5" value="1" <?PHP if ($row['preg5'] == '1') echo 'checked';?>>1 ...

				<INPUT type="radio" name="preg5" value="2" <?PHP if ($row['preg5'] == '2') echo 'checked';?>>2 ...

				<INPUT type="radio" name="preg5" value="3" <?PHP if ($row['preg5'] == '3') echo 'checked';?>>3 ...

				<INPUT type="radio" name="preg5" value="4" <?PHP if ($row['preg5'] == '4') echo 'checked';?>>4 ...

				<INPUT type="radio" name="preg5" value="5" <?PHP if ($row['preg5'] == '5') echo 'checked';?>>5 ...

				<INPUT type="radio" name="preg5" value="6" <?PHP if ($row['preg5'] == '6') echo 'checked';?>>6 ...

				<INPUT type="radio" name="preg5" value="7" <?PHP if ($row['preg5'] == '7') echo 'checked';?>>7 ...

				<INPUT type="radio" name="preg5" value="8" <?PHP if ($row['preg5'] == '8') echo 'checked';?>>8 ...

				<INPUT type="radio" name="preg5" value="9" <?PHP if ($row['preg5'] == '9') echo 'checked';?>>9 ...

				<INPUT type="radio" name="preg5" value="10" <?PHP if ($row['preg5'] == '10') echo 'checked';?>>10 ...

				<INPUT type="radio" name="preg5" value="99" <?PHP if ($row['preg5'] == '99') echo 'checked';?>>99 ...

			</td><tr>

			<tr><td colspan="2"><br /></td></tr>



			<tr><td colspan="2">6.	�Cu�les son las razones de esta nota? [escribir respuesta textual] [si responde 0 a 8 y da razones positivas, preguntar qu� falta para que esa nota sea 9 o 10]</td><tr>

			<tr><td><textarea name="preg6" cols="100" rows="2"><?PHP echo $row['preg6']; ?></textarea></td></tr>

			<tr><td><strong>AREA:</strong>

				<select name="preg6_area1" id ="preg6_area1" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg6_causa1" id="preg6_causa1" size="1">



 				</select>



			<tr><td><strong>AREA:</strong>

				<select name="preg6_area2" id ="preg6_area2" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg6_causa2" id="preg6_causa2" size="1">



 				</select>



			<tr><td><strong>AREA:</strong>

				<select name="preg6_area3" id ="preg6_area3" size="1">

	            <option value="">Selecciona</option>

				<?php

				$consulta = "SELECT * from qs_areas";

				$query=consulta_bd($consulta);

				while ($fila = mysql_fetch_array($query)) {

					echo '<option value="'.str_replace(" ","%20",$fila['CodArea']).'">'.$fila['Area'].'</option>';

				};

				?>

				</select>

				<strong>CAUSA:</strong>

				<select name="preg6_causa3" id="preg6_causa3" size="1">



 				</select>

				

			</td><tr>

			<tr><td colspan="2"><p>		        <span class="Estilo1">Pasa a Pregunta 7</span>

</p>

			    <p>&nbsp;			  </p></td></tr>



			<tr><td colspan="2">7.	�En qu� ciudad realiza habitualmente sus compras de productos para la construcci�n y/o de mejoramiento para el hogar, como herramientas, muebles, decoraci�n y l�nea blanca, con fines profesionales?</td><tr>

			<tr><td>Ciudad: <INPUT size="60" type="text" name="preg7" value="<?PHP echo $row['preg7']; ?>"></td></tr>

			<tr><td colspan="2"><br /></td></tr>



			<tr><td colspan="2">8.	Ciudad en que est� cliente al momento de realizar la encuesta: </td><tr>

			<tr><td><INPUT size="60" type="text" name="preg8" value="<?PHP echo $row['preg8']; ?>"></td></tr>

			</table>			



			<table>

			<tr><td colspan="2"><h3>T�rmino de Encuesta</h3></td></tr>



<?PHP 

			require_once("../funciones/conectar.php");

			$strsql="insert into qs_eventos (id_acceso, id_empresa, fec_evento, gls_evento) 

			VALUES (".$_SESSION['s_id_acceso'].",".$_SESSION['s_id_acceso'].", ADDDATE(NOW(),INTERVAL 1 HOUR) , 'Comienza Ingreso Encuesta 7. Encuestador ".$_SESSION['s_id_acceso']."')";			

			query_bd($strsql);

?> 			



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
</div>
<div class="panel panel-primary">
    
    <div class="panel-heading">Encuestas Homcenter Empresas</div>
    <table class="table" id='ListaEncuestas'>
        <thead>
            <tr><th><button id="Agenda" type="button" class="btn btn-info">Mi Agenda</button></th></tr>
            <tr>
        <th>Cod_carga</th>
        <th>IDEncuesta</th>
        <th>Rut</th>  
        <th>Nombre</th>
        <th>Fono1</th>
        <th>Estado</th>
        <th>Ultima Llamada</th>
        <th></th></tr>
        </thead>
        <tbody >
            <?php 
               $conn->CargarCodCargaSession($_SESSION['usuario']['id']);
             $sql = "select * from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']."  sm where sm.id_acceso=" . $_SESSION['usuario']['id'] . "  and (sm.estado!=30 and  sm.estado!=7) and id_encuesta!=0 and  sm.cod_carga='".$_SESSION['campana']['codcarga']."' and datediff(date(now()),date(fec_termino))>0 and sm.num_post<6";
            $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            if( mysql_num_rows($res)==0){
                 $SQL="UPDATE ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']." set estado=33 where estado!=14 and estado!=18 and estado!=30 and id_acceso=" . $_SESSION['usuario']['id'] . " and estado!=7 and datediff(date(now()),date(fec_termino))>0 and cod_carga='".$_SESSION['campana']['codcarga']."'" ;
                mysql_query($SQL,$conn->conectar()) or die(mysql_error());
                 $sql = "select * from ".$_SESSION['campana']['bd'].".".$_SESSION['campana']['tabla']."  sm where sm.id_acceso=" . $_SESSION['usuario']['id'] . " and sm.estado=33 and id_encuesta!=0 and  sm.cod_carga='".$_SESSION['campana']['codcarga']."'  and sm.num_post<6";
                $resi = mysql_query($sql, $conn->conectar()) or die(mysql_error());
            } else {
$resi = mysql_query($sql, $conn->conectar()) or die(mysql_error());                
}
            
            while ($enc = mysql_fetch_assoc($resi)) {
                echo "<tr><td>" . $enc['cod_carga'] . "</td>"
                . "<td>" . $enc['id_encuesta'] . "</td>"
                . "<td>" . $enc['rut'] . "</td>"
                . "<td>" . $enc['Cliente'] . "</td>"
                . "<td>" . $conn->BuscaDatos($_SESSION['campana']['bd'], 'arbol', $enc['estado'], 'idarbol', 'texto') . "</td>"
                        ."<td>".$enc['CELULAR_CONTACTO']."</td>"
                . "<td>" . $enc['fec_termino'] . "</td>"
                . "<td><a href='" . __BASE_URL__ . "modules/encuestas/view/Enc_hc_ind.php?id_encuesta=" . $enc['id_encuesta'] . "&id_formato=12&estado=2' ><i class='fa fa-search'></i></a></td>"
                . "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_Encuestas__ ?>js/hcenter_js.js"></script>
<?php require_once '../../config/footer.php'; ?>
