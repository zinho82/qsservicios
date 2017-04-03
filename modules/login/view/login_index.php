<?php require_once '../../config/superior.php';?>
<div class="panel panel-success " style="margin: 0 auto">
    <div class="panel-heading">Login Qsservicios</div>
    <div class="panel-body">
        <form class="form-horizontal" id="FormLogin" method="post">
            <div class="input-group">
                <input class="form-control" placeholder="Usuario" name="Usr" id="Usr" type="text">
                <input class="form-control" placeholder="Clave" name="Pass" id="Pass" type="password">
                <input type="button" class="btn btn-block btn-success" name="BtnIngresar" id="BtnIngresar" value="Ingresar">
            </div>
        </form>  
    </div>
</div>
<script src="<?php echo __BASE_URL__.__MODULO_LOGIN__?>js/login_js.js"></script>
<?php 
require_once 'modules/config/footer.php';