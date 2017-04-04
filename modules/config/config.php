<?php
session_start();

define("__ROOT__", "/var/www/html/seguros/");
define("__BASE_URL__", "http://190.100.117.172/seguros/");
define("__BASE_DATOS__", "qsservicios2");
define("__MODULO_ACCESORIOS__", "archivos/");
define("__MODULO_MENU__", "modules/menu/");
define("__MODULO_CARGAR__", "modules/cargas/");
define("__MODULO_SEGUROS__", "modules/seguros/");
define("__MODULO_PAGOS__", "modules/pagos/");
define("__MODULO_TARIFAS__", "modules/tarifas/");
define("__MODULO_SEMANALES__", "modules/semanales/");
define("__MODULO_LOGIN__", "modules/login/");

class config {

    function consulta($sql) {
        return $this->conectar($sql);
    }

    function conectar($query) {
        $link = mysql_connect('localhost', 'root', 'zinho1982')
                or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db('qsservicios');
//echo 'Connected successfully'; 
        return $link;
    }

    function BuscaDatos($Tabla, $DatoBuscar, $CampoComparar, $CampoMostrar) {
        $sql = "select $CampoMostrar as dato from " . __BASE_DATOS__ . ".$Tabla where $CampoComparar='$DatoBuscar'";
        $res = mysql_query($sql, $this->conectar());
        return mysql_result($res, 0);
    }

}

//require_once MODULO_SEGUROS.'core/seguros_class.php';
require_once __ROOT__ . __MODULO_LOGIN__ . 'core/login_class.php';
?>
