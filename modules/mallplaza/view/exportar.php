<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$mplaza=new mallplaza_class();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza  - Exportar Encuestas  </div>
    <div class="panel-body">
        <table id="calificacion">
            <thead>
            <th>ID</th>
            <th>Fecha Encuesta</th>
            <th>Hora Encuesta</th>
            <th>Mall</th>
            <th>Origen</th>
            <th>Fecha Compra</th>
            <th>Hora Compra</th>
            <th>Nota</th>
            <th>Motivo</th>
            <th>Dimension 1</th>
            <th>Area 1</th>
            <th>Sentido 1</th>
            <th>Dimension 2</th>
            <th>Area 2</th>
            <th>Sentido 2</th>
            <th>Dimension 3</th>
            <th>Area 3</th>
            <th>Sentido 3</th>
            <th>Transporte</th>
            <th>Observacion</th>
            <th>Quien llamo</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rut</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>Mail</th>
            <th>Autoriza Contacto</th>
            <th>Horario</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Direccion</th>
            <th>Comuna</th>
            <th>Pais</th>
            <th>telefono1</th>
            <th>telefono2</th>
            <th>Aceptacion Bases Legales</th>
            <th>Permiso Enc Competa</th>
            <th>Satisf Visita</th>
            <th>Satisf Limpieza</th>
            <th>Satisf Seguridad</th>
            <th>Satisf entretencion</th>
            <th>Medio Transporte</th>
            <th>satisf Estacionamiento</th>
            <th>Satisf Acceso</th>
            <th>Oferta Tienda</th>
            <th>Oferta Tienda Serv</th>
            <th>Recomendacion</th>
            <th>Tipo</th>
            <th>Mes</th>
            <th>ID1</th>
            <th>ID2</th>
            <th>ID3</th>
            
                
                
                
            </thead>
            <tbody>
                <?php $mplaza->ExportarDatos();?>
            </tbody>
            
        </table>
    </div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
