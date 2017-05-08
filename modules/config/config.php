<?php 
session_start(); 
ob_start(); 
error_reporting(E_ERROR | E_PARSE);
//define("__SERVIDOR_DATOS__", "201.239.170.83/intranet/"); 
define("__SERVIDOR_DATOS__", "www.qsservicios.cl/intranet/"); 
define("__ROOT__",$_SERVER['DOCUMENT_ROOT']."/intranet/");  
define("__ATRAS__",'../');
define("__BASE_URL__", "http://" . __SERVIDOR_DATOS__ ); 
define("__BASE_DATOS__", "qsschile_qsservicios");
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
define("__MODULO_informes__", "modules/informes/");
define("__MODULO_Encuestas__", "modules/encuestas/");
define("__MODULO_SUPERVISOR__", "modules/supervisor/");
define("__MODULO_PANEL__", "modules/panel/"); 
define("__MODULO_CLIENTE__", "modules/cliente/");
//
class config {

    function CargaSponsor() {
        $sql = "select * from " . __BASE_DATOS__ . ".sponsor order by nombre asc ";
        $res = mysql_query($sql, $this->conectar()) or die(mysql_error());
        while ($opc = mysql_fetch_array($res)) {
            $selec .= "<option value=" . $opc['idsponsor'] . ">" . $opc['nombre'] . "</option>";
        }
        return $selec;
    }

    function CargaTablaSession($campana) {
        switch ($campana) {
            case 4:$_SESSION['campana']['tabla'] = "qs_encuestascli_sodimac_emp"; 
                break;
            case 7:$_SESSION['campana']['tabla'] = "qs_encuestascli_sodimac_emp";
                break;
            case 8:$_SESSION['campana']['tabla'] = "qs_encuestascli_sodimac_emp";
                break;
            case 9:$_SESSION['campana']['tabla'] = "qs_encuestascli_sodimac_ind";
                break;
            
        }
    }

    function CargarCodCargaSession($usuario) {
        $conn = new config();
         $sql = "select * from " . __BASE_DATOS__ . ".ejecutivocampana where ejecutivo=$usuario";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        $dato = mysql_fetch_assoc($res);
        $_SESSION['campana']['codcarga'] = $dato['codcarga'];
        $this->CargaTablaSession($dato['campana']);
        $this->CargaCampanaSession($dato['campana']);
    }

    function CargaCodCarga($tabla) {
        $selec = "<option value=-1 selected=''>Seleccione Codigo de Carga</option>";
        echo $sql = "select count(*),cod_carga from " . $_SESSION['campana']['bd'] . ".$tabla group by cod_carga order by cod_carga desc ";
        $res = mysql_query($sql, $this->conectar()) or die(mysql_error());
        while ($opc = mysql_fetch_array($res)) {
            $selec .= "<option value='" . $opc['cod_carga'] . "'>" . $opc['cod_carga'] . "</option>";
        }
        return $selec;
    }

    function consulta($sql) {
        return $this->conectar($sql);
    }

    function conectar() {
        $link = mysql_connect('localhost', 'qsschile2017', 'Quality!2017')
                or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db(__BASE_DATOS__);
//echo 'Connected successfully'; 
        return $link;
    }

    function BuscaDatos($bd, $Tabla, $DatoBuscar, $CampoComparar, $CampoMostrar) {
       
          $sql = "select $CampoMostrar as dato from $bd.$Tabla where $CampoComparar='$DatoBuscar'";
        $res = mysql_query($sql, $this->conectar());
        $dev=mysql_result($res, 0);
        if(!$dev){
            return 'N/A';
        }
        else{
            return mysql_result($res, 0);
        }
    }

    function CargaCampanaSession($idCampana) {
        $sql = "select * from " . __BASE_DATOS__ . ".campana where idcampana=$idCampana";
        $res = mysql_query($sql, $this->conectar());
        $sesscam = mysql_fetch_array($res);
        $_SESSION['campana']['bd'] = $sesscam['bd'];
        $_SESSION['campana']['id'] = $sesscam['idcampana'];
        $_SESSION['campana']['nombre'] = $sesscam['nombre'];
        $this->CargaTablaSession($idCampana);
    }
    

    function ListaCampanas($Sponsor) {
        $selec = "<option value='-1' selected=''>Seleccion Una Campaña</option>";
        $sql = "select * from " . __BASE_DATOS__ . ".campana where sponsor=$Sponsor and estado=14";
        $res = mysql_query($sql, $this->conectar()) or die(mysql_error());
        while ($opc = mysql_fetch_array($res)) {
            $selec .= "<option value=" . $opc['idcampana'] . ">" . $opc['nombre'] . "</option>";
        }
        return $selec;
    }

    function MesRecortado($nummes) {
        switch ($nummes) {
            case 1:$mes = "Ene";
                break;
            case 2:$mes = "Feb";
                break;
            case 3:$mes = "Mar";
                break;
            case 4:$mes = "Abr";
                break;
            case 5:$mes = "May";
                break;
            case 6:$mes = "Jun";
                break;
            case 7:$mes = "Jul";
                break;
            case 8:$mes = "Ago";
                break;
            case 9:$mes = "Sep";
                break;
            case 10:$mes = "Oct";
                break;
            case 11:$mes = "Nov";
                break;
            case 12:$mes = "Dic";
                break;
        }
        return $mes;
    }
    function MesEntero($nummes) {
        switch ($nummes) {
            case 1:$mes = "Enero";
                break;
            case 2:$mes = "Febrero";
                break;
            case 3:$mes = "Marzo";
                break;
            case 4:$mes = "Abril";
                break;
            case 5:$mes = "Mayo";
                break;
            case 6:$mes = "Junio";
                break;
            case 7:$mes = "Julio";
                break;
            case 8:$mes = "Agosto";
                break;
            case 9:$mes = "Septiembre";
                break;
            case 10:$mes = "Octubre";
                break;
            case 11:$mes = "Noviembre";
                break;
            case 12:$mes = "Diciembre";
                break;
        }
        return $mes;
    }
            
}


//require_once MODULO_SEGUROS.'core/seguros_class.php';
require_once    __ROOT__. __MODULO_LOGIN__ . 'core/login_class.php';
require_once __ROOT__ . __MODULO_MALLPLAZA__ . 'core/mallplaza_class.php';
require_once __ROOT__ . __MODULO_SPONSOR__ . 'core/sponsor_class.php';
require_once __ROOT__ . __MODULO_CAMPANA__ . 'core/campana_class.php';
require_once __ROOT__ . __MODULO_MENU__ . 'core/menu_class.php';
require_once __ROOT__ . __MODULO_informes__ . 'core/informes_class.php';
require_once __ROOT__ . __MODULO_Encuestas__ . 'core/encuestas_class.php';
require_once __ROOT__ . __MODULO_SUPERVISOR__ . 'core/supervisor_class.php';
require_once __ROOT__ . __MODULO_PANEL__ . 'core/panel_class.php';
?>
