<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_class
 *
 * @author Analista 01
 */
class login_class {

    private function Error() {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        json_encode(array('message' => 'ERROR', 'code' => 1337));
    }

    public function VerSession() {
        if ($_SESSION['islog'] == FALSE) {
            // $_SESSION['islog']==TRUE;
            // header("Location: ".__BASE_URL__.__MODULO_LOGIN__."view/login_index.php");

            $this->Error();
        }
    }

    function CargarSession($usr, $pass, $bd, $tbl) {
        $conn = new config();
        $sql = "select * from $bd.$tbl where usuario='$usr' and clave='$pass' and estado=14 ";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        $usuario = mysql_fetch_array($res);
        if ($usuario == FALSE) {
            $this->Error();
        } else {
            $_SESSION['usuario']['islog'] = TRUE;
            $_SESSION['usuario']['nombre'] = $usuario['usuario'];
            $_SESSION['usuario']['id'] = $usuario['idusuario'];
            $_SESSION['usuario']['rut'] = $usuario['rut'];
           
        }
    }

}
