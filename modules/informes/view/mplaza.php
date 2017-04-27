<?php
require_once '../../config/superior.php';
$informes = new informes_class();
$conn = new config();
$conn->CargaCampanaSession(4);
?>
<div class="wrapper">
    <div class="row col-lg-12">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Encuestas Por Mall</div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">

            </div>

        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">

            </div>
        </div>
    </div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_SPONSOR__ . 'js/sponsor_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
