<?php require_once '../../config/superior.php'; ?>
  <?php
        $conn = new config();
        ?>
<div class="panel panel-primary">
    <div class="panel-heading">Mall Plaza</div>
    <div class="panel-body">
        <form id="BuscarArchivo">
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
                <?php   for($i=date('Y');$i>2012;$i--): ?>
                <option value="<?php echo $i?>"><?php echo $i ?></option>
                <?php endfor;?>
            </select>
            <select name="archivo" id="archivo" class="form-control">
                
            </select>
            <input type="button" id="Procesar" name="Procesar" class="btn btn-block btn-success" value="Procesar...">
        </form>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Resultado Registros</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-clone fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $sql = "  select count(*) from qsservicios.temporal tm
group by concat(tm.ad1,tm.ad2,tm.ad4,tm.ad7,tm.ad21,tm.ad13,tm.ad18) having count(*)>1;";
                                   // var_dump(      $conn->consulta($sql));
                                    ?>
                                </div>
                                <div>Duplicados</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ ?>view/duplicados.php?mnu=seguro" >
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money  fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    ?>
                                </div>
                                <div>Diferencia Tarifas</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ ?>view/tarifas.php?mnu=seguro">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
             <div class="col-lg-3 col-md-6">
                  <div class="panel panel-info">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-calendar-check-o fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <div class="huge">
            <?php
            ?>
                                  </div>
                                  <div>Duplicados del Mes</div>
                              </div>
                          </div>
                      </div>
                      <a href="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ ?>view/duplimes.php?mnu=seguro">
                          <div class="panel-footer">
                              <span class="pull-left">Ver Detalles</span>
                              <span class="pull-right"><i class="fa fa-2x fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6">
                  <div class="panel panel-danger">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-calendar-times-o fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <div class="huge">
            <?php
            ?>
                                  </div>
                                  <div>Pleno Fallido</div>
                              </div>
                          </div>
                      </div>
                      <a href="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ ?>view/plenofallido.php?mnu=seguro"">
                          <div class="panel-footer">
                              <span class="pull-left">Ver Detalles</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>
            <div class="col-lg-3 col-md-6">
                  <div class="panel panel-info">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-calendar-check-o fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <div class="huge">
            <?php
            ?>
                                  </div>
                                  <div>Registros sin Duplicados</div>
                              </div>
                          </div>
                      </div>
                      <a href="<?php echo __BASE_URL__ . __MODULO_SEGUROS__ ?>view/sinduplicar.php?mnu=seguro">
                          <div class="panel-footer">
                              <span class="pull-left">Ver Detalles</span>
                              <span class="pull-right"><i class="fa fa-2x fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>
                  <div class="panel panel-warning">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-credit-card fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <div class="huge">
                                     $120.000
                                  </div>
                                  <div>Mis Comisiones</div>
                              </div>
                          </div>
                      </div>
                      <a href="#">
                          <div class="panel-footer">
                              <span class="pull-left">Ver Detalles</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>-->
            


        </div>
    </div>
</div>

<script src="<?php echo __BASE_URL__ . __MODULO_MALLPLAZA__ . 'js/mallplaza_js.js'; ?>" ></script>
<?php require_once '../../config/footer.php'; ?>
