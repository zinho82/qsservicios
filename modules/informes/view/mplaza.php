<?php
require_once '../../config/superior.php';
$informes=new informes_class();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Informes Mall plaza <img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logo_mplaza2.jpg" width="50"></div>
    <div class="panel-body">
        <div class="row col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Encuestas por Mall</div>
                <div class="panel-body ">
                    <table  id="EncMall" class="table table-hover">
                        <thead>
                        <th>Mall</th>
                        <th>Q Encuestas</th>
                        <th>Q Negativo</th>
                        <th>Q Promotor</th>
                        <th>Q Neutro</th>
                        <th>Q Ecnuestas Realizadas</th>
                    </thead>
                    <tbody>
                        <?php $informes->EncxMall($_SESSION['campana']['bd'], "cliente_dato", "", "group by mall") ?>
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
