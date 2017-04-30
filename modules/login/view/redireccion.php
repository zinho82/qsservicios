<?php
require_once '../../config/config.php';
var_dump($_SESSION);
echo $_SESSION['usuario']['perfil'];
switch ($_SESSION['usuario']['perfil']){
    case 28: header("Location: ".__BASE_URL__.__MODULO_CLIENTE__."view/cliente_index.php");        break;
    case 9: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
    case 12: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
    case 10: header("Location: ".__BASE_URL__.__MODULO_PANEL__."view/panel_index.php");        break;
}
