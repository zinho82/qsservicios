<?php
session_start();
//define("__SERVIDOR_DATOS__", "201.239.170.83");
define("__SERVIDOR_DATOS__", "190.100.117.172"); 
define("__ROOT__", "/var/www/html/qsservicios/");
define("__BASE_URL__", "http://".__SERVIDOR_DATOS__."/qsservicios/");
define("__BASE_DATOS__", "qsservicios");
define("__MODULO_ACCESORIOS__", "archivos/");
define("__MODULO_MENU__", "modules/menu/");
define("__MODULO_CARGAR__", "modules/cargas/");
define("__MODULO_SEGUROS__", "modules/seguros/");
define("__MODULO_PAGOS__", "modules/pagos/"); 
define("__MODULO_TARIFAS__", "modules/tarifas/");
define("__MODULO_SEMANALES__", "modules/semanales/");
define("__MODULO_LOGIN__", "modules/login/");
define("__MODULO_MALLPLAZA__", "modules/mallplaza/");
define("__MODULO_SPONSOR__", "modules/sponsor/");
define("__MODULO_CAMPANA__", "modules/campana/");
define("__MODULO_IMAGENES__", "images/");


class config {

    function consulta($sql) {
        return $this->conectar($sql);
    }

    function conectar() {
        $link = mysql_connect('localhost', 'root', 'zinho1982')
                or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db(__BASE_DATOS__);
//echo 'Connected successfully'; 
        return $link;
    }

    function BuscaDatos($bd,$Tabla, $DatoBuscar, $CampoComparar, $CampoMostrar) {
        $sql = "select $CampoMostrar as dato from $bd.$Tabla where $CampoComparar='$DatoBuscar'";
        $res = mysql_query($sql, $this->conectar());
        return mysql_result($res, 0);
    }
    function CargaCampanaSession($idCampana) {
       echo  $sql="select * from ".__BASE_DATOS__.".campana where idcampana=$idCampana";
        $res=mysql_query($sql, $this->conectar());
        $sesscam=mysql_fetch_array($res);
        $_SESSION['campana']['bd']=$sesscam['bd'];
        $_SESSION['campana']['id']=$sesscam['idcampana'];
        $_SESSION['campana']['nombre']=$sesscam['nombre'];
    }
    function ListaCampanas() {
        $selec="<option value='-1' selected=''>Seleccion Una Campaña</option>";
         $sql="select * from ".__BASE_DATOS__.".campana where sponsor=1";
        $res=mysql_query($sql, $this->conectar()) or die(mysql_error());
       while($opc=mysql_fetch_array($res)){
            $selec.= "<option value=".$opc['idcampana'].">".$opc['nombre']."</option>";
        }
        return $selec;
    }
}

//require_once MODULO_SEGUROS.'core/seguros_class.php';
require_once __ROOT__ . __MODULO_LOGIN__ . 'core/login_class.php';
require_once __ROOT__ . __MODULO_MALLPLAZA__ . 'core/mallplaza_class.php';
require_once __ROOT__ . __MODULO_SPONSOR__ . 'core/sponsor_class.php';
require_once __ROOT__ . __MODULO_CAMPANA__ . 'core/campana_class.php';
require_once __ROOT__ . __MODULO_MENU__ . 'core/menu_class.php';
?>
