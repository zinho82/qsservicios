<?php  require_once '../../config/superior.php';
$conn=new config();
$acc=new menu_class();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Acceso a Menus</div>
    <div class="panel-body">
        <table id="Acceso" class="display">
            <thead>
            <th>Usuario</th>
            <th>Menu</th>
            </thead>
            <tbody>
                <?php
                $acc->ListaAcceso(__BASE_DATOS__, "acceso_menu");
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="alert alert-warning" id="msg"></div>
<script src="<?php  echo __BASE_URL__.__MODULO_MENU__.'js/menu_js.js';?>" ></script>
<?php   require_once '../../config/footer.php';?>
