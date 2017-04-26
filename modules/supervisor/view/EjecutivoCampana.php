<?php
require_once '../../config/superior.php';
$conn = new config();
$supervisor = new supervisor_class();
$conn->CargaCampanaSession($_POST['Campana']);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Asignar Campañas a Ejecutivos</div>
    <div class="panel-body">
      
            <!-- Modal -->
<div id="AddCruce" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="TituloModal"></h4>
      </div>
      <div class="modal-body">
           <form id="FromCampanasEje" method="post">
            <select class="form-control" name="SponsorA" id="SponsorA">
                <option value="-1" selected="">Seleccion Sponsor</option>
                <?php
                echo $conn->CargaSponsor();
                ?>
            </select>
            <select class="form-control" name="CampanaA" id="CampanaA"></select>
            <select class="form-control" name="CodCarga" id="CodCarga"></select>
            <select class="form-control" name="Ejecutivo" id="Ejecutivo">
                <option value="-1" selected="">Seleccion Ejecutivo</option>
                <?php
                echo $supervisor->ListaEjecutivos();
                ?>
            </select>
            <input class="btn btn-block btn-success" id="CargarUsusario" type="button" value="Asignar">

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
                <tr><th><button type="button" data-toggle="modal" data-target="#AddCruce" id="Nuevo">Agregar</button></th></tr>
                <tr><th>Ejecutivo</th><th>Campaña</th><th>Cod Carga</th><th>Accion</th></tr>
            </thead>
            <tbody>
                <?php
                    echo $supervisor->ObtenerListaEjeCam();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SUPERVISOR__ ?>js/supervisor_js.js"></script>
<?php
require_once '../../config/footer.php';
?>