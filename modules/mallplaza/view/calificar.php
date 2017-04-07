<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$mplaza=new mallplaza_class();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza - Calificar Encuesta: <strong> <?php echo $_GET['nom'];?>  </strong> </div>
    <div class="panel-body">
    </div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
