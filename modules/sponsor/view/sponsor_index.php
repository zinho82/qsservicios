<?php
require_once '../../config/superior.php';
?>
<div class="panel panel-primary">
    <div class="panel-heading">Sponsor</div>
    <div class="panel-body">
        <table id="sponsor" class="display">
            <thead>
            <th>Nombre</th>
            <th>Rut</th>
            <th>Direccion</th>
            <th>Comuna</th>
            <th>Region</th>
            </thead>
            <tbody>
                <?php
                $sponsor = new sponsor_class();
                echo $sponsor->GetEmpresa();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
