<?php
require_once '../../config/superior.php';
$conn = new config();
$supervisor = new supervisor_class();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Asignar Registros</div>
        <div class="panel-body">
            <form id="FormAsignar" method="post">
                <input class="form-control" value="Registros Maximos  a <?php echo $_GET['acc'] . ' <' . $_GET['reg'] . '>' ?>" disabled="">
                <input type="hidden" id="EjQuita" name="EjQuita" class="form-control" value="<?php echo $_GET['id'] ?>">
                <select class="form-control" name="EjAsigna" id="EjAsigna">
                    <option value="-1" selected="">Ejecutivo a Asignar Registros</option>
                    <?php echo $supervisor->ListaEjecutivos(); ?>
                </select>
                <input type="hidden" id="Vuelta" name="Vuelta" value="<?php echo __BASE_URL__ . __MODULO_SUPERVISOR__ ?>view/asign_enc.php">

                <input type="hidden" id="AccionReg" name="AccionReg"  value="<?php echo $_GET['acc'] ?>">
                <input type="hidden" id="codCamReg" name="codCamReg" value="<?php echo $_GET['cod'] ?>">
                <input class="form-control" type="text" id="Cantidad" name="Cantidad" value="" placeholder="Cantidad a asignar max <?php echo $_GET['reg'] ?>" >
                <input type="hidden" id="Campanas" name="Campanas" value="<?php echo $_GET['c'] ?>">
                <input type="button" id="AsignarReg" name="AsignarReg" class="btn btn-block btn-success" value="Asignar">
            </form> 
        </div>
    </div>
</div>


<script src="<?php echo __BASE_URL__ . __MODULO_SUPERVISOR__ ?>js/supervisor_js.js"></script>    
<?php
require_once '../../config/footer.php';

