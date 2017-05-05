<?php
require_once '../../config/config.php';
switch ($_SESSION['usuario']['perfil']){
    case 28: header("Location: ".__BASE_URL__.__MODULO_CLIENTE__."view/cliente_index.php");        break;
    case 9: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
    case 12: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
    case 10: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
    default :header("Location: ".__BASE_URL__);        break;
}
