<?php  require_once '../../config/superior.php';
$conn=new config();
?>
<div class="panel panel-primary">
    <div class="panel-heading">Carga de Archivos</div>
    <div class="panel-body">
        <form id="CargaArch" name="CargaArch" method="post" >
             <select name="TipoArchivo" id="TipoArchivo" class="form-control">
                <option value="-1" selected="">Seleccione Tipo de Archivo a Cargar</option>
                <?php
                $sql="select * from ".__BASE_DATOS__.".config where pertenece=1 order by texto asc";
                $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
                while($tarchivo=mysql_fetch_assoc($res)):?>
                <option value="<?php echo $tarchivo['idconfig'];?>"><?php echo $tarchivo['texto'];?></option>
                <?php endwhile; ?>
            </select>
            <select id="TipoCarga" class="form-control" name="TipoCarga"></select>
            <input type="file" name="archivo" id="archivo" class="form-control">
            <input type="button" id="cargar" value="Cargar" class="btn btn-success btn-block  ">
        </form>
    </div>
</div>
<div class="alert alert-warning" id="msg"></div>
<script src="<?php  echo __BASE_URL__.__MODULO_CARGAR__.'js/cargas_js.js';?>" ></script>
<?php   require_once '../../config/footer.php';?>
