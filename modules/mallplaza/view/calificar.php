<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$mplaza=new mallplaza_class();
$baseperso=    $mplaza->CargaPersona($_GET['ru']);
?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza - Calificar Encuesta: <strong> <?php echo $baseperso['nombre'];?>  </strong> </div>
    <div class="panel-body">
        <div class="panel panel-warning">
        <div class="panel-heading">Datos Encuesta</div>
        <div class="panel-body">
        <table class="table table-hover">
             <tr>
                <td>Rut</td><td><?php echo $baseperso['rut']?></td>
                <td>MALL</td><td><?php echo $baseperso['mall']?></td>
            </tr>
            <tr>
                <td>Nota</td><td><?php echo $baseperso['nps']?></td>
                <td>Comentario</td><td><?php echo utf8_encode($baseperso['npsdtractor'])?></td>
            </tr>
        </table>
    </div>
</div>
</div>
    <div class="panel panel-info">
        <div class="panel-heading">Calificar Encuesta</div>
        <div class="panel-body">
            <label>Dimension 1</label>
            <select class="form-control">
<?php $mplaza->CargaDimemsion() ?>
            </select>
            <label>Tipo 1</label>
            <select class="form-control"></select>
            <label>Dimension 2</label>
            <select class="form-control"></select>
            <label>Tipo 3</label>
            <select class="form-control"></select>
            <label>Dimension 3</label>
            <select class="form-control"></select>
            <label>Tipo 2</label>
            <select class="form-control"></select>
            <button class="btn btn-block btn-success">Guardar</button>
        </div>
    </div>
    
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
