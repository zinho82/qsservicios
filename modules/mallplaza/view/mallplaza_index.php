<?php require_once '../../config/superior.php'; ?>
<?php
$conn = new config();
$mplaza = new mallplaza_class();
if (!$_SESSION['campana']['id']) {
    $conn->CargaCampanaSession(4);
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza    </div>
    <div class="panel-body">
        <button class="btn-block btn-info btn" id="CargarEncuestas">Cargar Nuevas Encuestas</button>
        <div id="CargarEncuesta">
            <form id="BuscarArchivo">
                
                <select name="campana" class="form-control" id="campana">
                    <?php echo $conn->ListaCampanas(1); ?>
                </select>
                <select name="mes" id="mes" class="form-control">
                    <option value="-1" selected="" >Seleccione el  mes de carga</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <select name="ano" id="ano" class="form-control">
                    <option value="-1"selected="">Seleccione el Año de Carga</option>
                    <?php for ($i = date('Y'); $i > 2012; $i--): ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endfor; ?>
                </select>
                <select name="archivo" id="archivo" class="form-control">

                </select>
                <input type="button" id="Procesar" name="Procesar" class="btn btn-block btn-success" value="Procesar...">
            </form>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Resultado Registros</div>
    <div class="panel-body">
        <div class="row">
            <table id="calificacion" class="display">
                <thead>
                <th>Rut</th>
                <th>Cliente</th>
                <th>Mall</th>
                <th>Calificar</th>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['campana']['bd']) {
                        echo $mplaza->CargarNPS('', $_SESSION['campana']['bd'], "cliente_dato");
                    }
                    ?>
                </tbody>
                <tfoot>
                <th colspan="4"> <button id="Exportar" type="button" class="btn btn-block btn-info"> Exportar</button></th>
                </tfoot>
            </table>


        </div>
    </div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
