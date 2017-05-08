<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
?>


<div class="row">
    <div class="col-lg-2">
        <?php require_once 'sidebarhcenter.php'; ?>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">Informes Sodimac Homcenter</div>
            <div class="panel-body">
                <div class="panel-info">
                    <div class="panel-heading">
                        Encuestas
                        <form method="post">
                            <select name="Sponsor" id="Sponsor">
                                <option selected="">Seleecione Sponsor</option>
                                <?php echo $conn->CargaSponsor() ?>
                            </select>
                            <select name="Campana" id="Campana" onchange="this.form.submit()">
                                <option  selected="">Seleccione Campana</option>

                            </select>
                        </form> 
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Encuestas</div>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <th>Mes</th>
                                            <th>Encuestas</th>
                                            <th>Contestadas</th>
                                            </thead>
                                            <tbody>
                                                <?php echo $informes->TblEncuestas($_POST['Campana']) ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************************
*CHARTS 
*
*************************************************-->

<script src="<?php echo __BASE_URL__ . __MODULO_informes__ . 'js/informes_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
