<?php
require_once '../../config/superior.php';
?>
<div class="panel panel-primary">
    <div class="panel-heading">Campañas</div>
    <div class="panel-body">
        <table id="campana" class="display">
            <thead>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Fecha Inicio</th>
            <th>Fecha Termino </th>
            <th>Sponsor</th>
            <th>Estado</th>
            </thead>
            <tbody>
                <?php
                $campana = new campana_class();
                echo $campana->GetCampana();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_CAMPANA__ . 'js/campana_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?> 
