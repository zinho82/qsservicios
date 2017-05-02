<?php require_once '../../config/superior.php'; ?>
<div class="wrapper">
   
    <div class="col-lg-12">
         <?php require_once 'sidebarAdmin.php'; ?>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">26</div>
                                <div>New Comments!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<center><img src="<?php echo __BASE_URL__ . __MODULO_IMAGENES__ ?>logoQs.jpg" title="Qs servicios" width="1000"><br><br></center>
<?php require_once '../../config/footer.php'; ?>
