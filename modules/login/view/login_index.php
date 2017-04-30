<?php require_once '../../config/superior.php';?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title"></h1>
            <div class="account-wall">
                <img class="profile-img" src="<?php echo __BASE_URL__.__MODULO_IMAGENES__?>logoQs.jpg" alt="Qsservicios">
                <form class="form-signin" name="FormLogin" id="FormLogin">
                    <input type="text" class="form-control" placeholder="Usuario" name="Usr" required autofocus>
                <input type="password" name="Pass" class="form-control" placeholder="Password" required>
                <button id="BtnIngresar" class="btn btn-lg btn-primary btn-block" type="button">Ingresar</button>
                <!--<label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>-->
                <!--<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>-->
                </form>
            </div>
           <!-- <a href="#" class="text-center new-account">Create an account </a>-->
        </div>
    </div>
</div>
<script src="<?php echo __BASE_URL__.__MODULO_LOGIN__?>js/login_js.js"></script>
<?php 
require_once 'modules/config/footer.php';