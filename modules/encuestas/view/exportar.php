<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$encuesta = new encuestas_class();
?>

<div class="wrapper">
    <div class="col-lg-12 ">
    <div class="panel panel-primary">
        <div class="panel-heading">Sodimac  - Exportar Encuestas  </div>
        <div class="panel-body">
            <form method="post">
                <div class="container">
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' placeholder="Fecha Inicio Busqueda" name="Fdesde" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input name="Fhasta" placeholder="Fecha Termino Busqueda" type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Buscar" class="btn-block btn btn-success">
                </div>
            </form>
            <table id="calificacion">
                <thead>
                <th>ID</th>
                <th>Cliente</th>
                <th>Rut</th>
                <th>Cod_carga</th>
                <th>Cvend</th>
                <th>Ejecutivo</th>
                <th>Subg</th>
                <th>distrito</th>
                <th>Contacto</th>
                <th>Mail</th>
                <th>Celular Contactto</th>
                <th>Telefono Trabajo</th>
                <th>Telefono Casa</th>
                <th>Disc AT4</th>
                <th>Fono AT4</th>
                <th>Disc AT5</th>
                <th>Fono AT5</th>
                <th>Celular 2</th>
                <th>Celular 3</th>
                <th>Observaciones</th>
                <th>Fecha Encuesta</th>
                <th>Estado Llamada 1</th>
                <th>Estado Llamada 2</th>
                <th>Estado Llamada 3</th>
                <th>Estado Llamada 4</th>
                <th>Estado Llamada 5</th>
                <th>Estado Encuesta</th>
                <th>Cant. Postergada</th>
                <th>Preg1</th>
                <th>Preg2</th>
                <th>Preg2_a1</th>
                <th>Preg2_c1</th>
                <th>Preg2_a2</th>
                <th>Preg2_c2</th>
                <th>Preg2_a3</th>
                <th>Preg2_c3</th>
                <th>Preg3_1a</th>
                <th>Preg3_1b</th>
                <th>Preg3_1c</th>
                <th>Preg3_1d</th>
                <th>Preg3_2a</th>
                <th>Preg3_2b</th>
                <th>Preg3_2c</th>
                <th>Preg3_3a</th>
                <th>Preg3_3b</th>
                <th>Preg3_3c</th>
                <th>Preg3_4a</th>
                <th>Preg3_4b</th>
                <th>Preg3_4c</th>
                <th>Preg3_5a</th>
                <th>Preg3_5b</th>
                <th>Preg3_5c</th>
                <th>Preg4</th>
                <th>Preg5_a</th>
                <th>Preg5_b</th>
                <th>Preg5_c</th>
                <th>Preg5_d</th>
                <th>Argumento Cliente</th>
                <th>usuario</th>
                </thead>
                <tbody>
                    <?php
                    if ($_POST) {
                        $encuesta->ExportarDatosSodimac($_POST['Fdesde'], $_POST['Fhasta']);
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_Encuestas__ . 'js/encuestas_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
