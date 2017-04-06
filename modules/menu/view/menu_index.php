<?php
switch ($_GET['mnu']){
case "carga":$m1='active';    break;
case "seguro":$m2='active';    break;
case "mensual":$m4='active';    break;
case "tarifas":$m5='active';    break;

}
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
      <a class="navbar-brand" href="<?php echo __BASE_URL__ ?>">Qsservicios</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo $m1?>"><a href="<?php echo __BASE_URL__.__MODULO_CARGAR__.'view/cargas_index.php?mnu=carga'?> ">Centro de Archivos</a></li>
        <li class="<?php echo $m2?>"><a href="<?php echo __BASE_URL__.__MODULO_SEGUROS__.'view/seguros_index.php?mnu=seguro'?> ">Procesar Carga X Semana </a></li>
        <li class="<?php echo $m4?>"><a href="<?php echo __BASE_URL__.__MODULO_SEMANALES__.'view/semanales_index.php?mnu=mensual'?> ">Procesar Carga X Mes </a></li>
        <li class="<?php echo $m5?>"><a href="<?php echo __BASE_URL__.__MODULO_TARIFAS__.'view/tarifas_index.php?mnu=tarifas'?> ">Listado Tarifas </a></li>
     <!--   <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>
        
        
     <!-- <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user">  <?php echo $_SESSION['usuario']['nombre'] ?></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <!-- <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>-->
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo __BASE_URL__.__MODULO_LOGIN__ ?>view/salir.php"><i class="fa fa-sign-out"></i> Salir </a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
