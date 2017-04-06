<?php
require_once '../../config/superior.php';
?>
<div class="panel">
    <table id="sponsor" class="display">
        <thead>
        <th>Nombre</th>
        </thead>
        <tbody>
            <?php
         //   $sponsor = new sponsor_class();
         // echo   $sponsor->GetEmpresa();
            ?>
        </tbody>
    </table>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
