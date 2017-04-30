<?php
require_once '../../config/superior.php';
$conn = new config();
$supervisor = new supervisor_class();
$conn->CargaCampanaSession($_POST['Campana']);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Asignar Encuestas</div>
    <div class="panel-body">
        <form id="FromCampanas" method="post">
            <select class="form-control" name="Sponsor" id="Sponsor">
                <option value="-1" selected="">Seleccion Sponsor</option>
                <?php
                echo $conn->CargaSponsor();
                ?>
            </select>
            <select class="form-control" name="Campana" id="Campana"></select>
            <!--<select class="form-control" name="CodCarga" id="CodCarga"></select>-->
            <input class="btn btn-block btn-success" id="BuscarEncAsignada" type="submit" value="Buscar">

        </form>
            <!-- Modal -->
            <div id="formulario" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" >
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="TituloVentana"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="FormAsignar" method="post">
                                <input id="EjQuita" name="EjQuita" class="form-control">
                                <select class="form-control" name="EjAsigna" id="EjAsigna">
                                    <option value="-1" selected="">Ejecutivo a Asignar Registros</option>
                                    <?php echo $supervisor->ListaEjecutivos(); ?>
                                </select>
                                <input type="text" id="AccionReg" name="AccionReg">
                                <input type="text" id="codCamReg" name="codCamReg">

                                <input type="text" id="Cantidad" name="Cantidad" placeholder="Cantidad a asignar" >
                                <input type="button" id="AsignarReg" name="AsignarReg" value="Asignar">
                            </form> 
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



        <table class="table" id="Asignados">
            <thead>
                <tr><th>Ejecutivo</th><th>Cod Carga</th><th>Asignadas</th><th>Recorridas</th><th>Campaña</th><th>accion</th></tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['Campana'])) {
                    echo $supervisor->ObtenerListaencuestas($_POST['Campana'], $_POST['CodCarga']);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SUPERVISOR__ ?>js/supervisor_js.js"></script>
<?php
require_once '../../config/footer.php';
?>