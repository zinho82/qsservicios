<?php  require_once '../../config/superior.php';
$conn=new config();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Carga de Archivos</div>
    <div class="panel-body">

    </div>
</div>
<div class="alert alert-warning" id="msg"></div>
<script src="<?php  echo __BASE_URL__.__MODULO_CARGAR__.'js/menu_js.js';?>" ></script>
<?php   require_once '../../config/footer.php';?>
