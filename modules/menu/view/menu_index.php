<?php
switch ($_GET['mnu']) {
    case "carga":$m1 = 'active';
        break;
    case "seguro":$m2 = 'active';
        break;
    case "mensual":$m4 = 'active';
        break;
    case "tarifas":$m5 = 'active';
        break;
    case "procesar":$m6 = 'active';
        break;

    case "admin":$m7 = 'active';
        break;
}
$mnu = new menu_class();
?>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo __BASE_URL__ ?>"><img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logoQs.jpg" title="Quality Servicios" width="100"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
<?php
$mnu->CrearMenu(__BASE_DATOS__, 1, $_SESSION['usuario']['id']);
?>
            </ul>



            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user">  <?php echo $_SESSION['usuario']['nombre'] ?></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo __BASE_URL__ . __MODULO_PANEL__ ?>view/panel_index.php"><i class="fa fa-home"></i> Home </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo __BASE_URL__ . __MODULO_LOGIN__ ?>view/salir.php"><i class="fa fa-sign-out"></i> Salir </a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
     
</nav>
