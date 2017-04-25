<?php
require_once '../../config/superior.php';
$conn=new config();
$supervisor=new supervisor_class();
?>
    <div class="panel panel-primary">
        <div class="panel-heading">Asignar Encuestas</div>
        <div class="panel-body">
            <form id="FromCampanas" method="post">
                <select class="form-control" name="Sponsor" id="Sponsor">
                    <option value="-1" selected="">Seleccion Sponsor</option>
                    <?php
                 echo    $conn->CargaSponsor();
                    ?>
                </select>
                <select class="form-control" name="Campana" id="Campana"></select>
                <select class="form-control" name="CodCarga" id="CodCarga"></select>
                <input class="btn btn-block btn-success" id="BuscarEncAsignada" type="submit" value="Buscar">
                
            </form>
            <table class="table" id="Asignados">
                <thead>
                    <tr><th>Ejecutivo</th><th>Cod Carga</th><th>Asignadas</th><th>Campaña</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_POST['Campana'])){
                        $supervisor->ObtenerListaencuestas($_POST['Campana'], $_POST['CodCarga']);
                        
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="<?php echo __BASE_URL__.__MODULO_SUPERVISOR__ ?>js/supervisor_js.js"></script>
<?php
require_once '../../config/footer.php';
?>