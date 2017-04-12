<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$mplaza = new mallplaza_class();
$baseperso = $mplaza->CargaPersona($_GET['id']);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza - Calificar Encuesta: <strong> <?php echo $baseperso['nombre']; ?>  </strong> </div>
    <div class="panel-body">
        <div class="panel panel-warning">
            <div class="panel-heading">Datos Encuesta</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr class="info" >
                        <td><strong>Rut</strong></td><td><?php echo $baseperso['rut'] ?></td>
                        <td><strong>MALL</strong></td><td><?php echo $baseperso['mall'] ?></td>
                    </tr>
                    <tr class="danger">
                        <td><strong>Nota</strong></td><td><?php echo $baseperso['nps'] ?></td>
                        <td><strong>Comentario</strong></td><td><?php echo utf8_encode($baseperso['npsdtractor']) ?></td>
                    </tr>
                    <tr class="info">
                        <td><strong>Journey</strong></td><td><?php echo utf8_encode($baseperso['encuesta'])  ?></td>
                        <td><strong>Medio Transporte</strong></td><?php echo $baseperso['medotransp']  ?><td></td>
                    </tr>
                    <tr><td><?php echo $baseperso['nps'] ?></td><td><?php echo utf8_encode($baseperso['npsdtractor']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <form id="FormCalificacion" name="FormCalificacion">
        <div class="panel panel-info">
            <div class="panel-heading">Calificar Encuesta</div>
            <div class="panel-body">
                <div class="col-lg-4">
                    <label>Dimension 1</label>
                    <select class="form-control" id="Dim1" name="Dim1">
                        <?php $mplaza->CargaDimemsion() ?>
                    </select>

                    <label>Tipo 1</label>
                    <select class="form-control" id="Area1" name="Area1"></select>
                    <label>Sentido</label>
                    <select id="Clasi1" class="form-control" name="Clasi1"><?php $mplaza->CargaClasificacion() ?></select>
                </div>
                <div class="col-lg-4">
                    <label>Dimension 2</label>
                    <select class="form-control" id="Dim2" name="Dim2"><?php $mplaza->CargaDimemsion() ?></select>
                    <label>Tipo 2</label>
                    <select class="form-control"  id="Area2" name="Area2"></select>
                    <label>Sentido</label>
                    <select id="Clasi2" class="form-control" name="Clasi2"><?php $mplaza->CargaClasificacion() ?></select>
                </div>
                <div class="col-lg-4">
                    <label>Dimension 3</label>
                    <select class="form-control" id="Dim3" name="Dim3"><?php $mplaza->CargaDimemsion() ?></select>
                    <label>Tipo 3</label>
                    <select class="form-control"  id="Area3" name="Area3"></select>
                    <label>Sentido</label>
                    <select id="Clasi3" class="form-control" name="Clasi3"><?php $mplaza->CargaClasificacion() ?></select>
                    <input  type="hidden" id="IdCli" name="IdCli" value="<?php echo $_GET['id'] ?>">
                </div>
                <button type="button" class="btn btn-block btn-success" id="Guardar">Guardar</button>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
