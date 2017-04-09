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

    function logout() {
        session_destroy();
        header("Location: " . __BASE_URL__);
        return;
    }

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

    public function sessionactiva() {
        // session_destroy();
        if ($_SESSION['islog'] == FALSE) {
            header("Location: " . __BASE_URL__);
            return false;
        } else {

            return TRUE;
        }
    }

    function CargarSession($usr, $pass, $bd, $tbl) {
        $conn = new config();
        try{
        $sql = "select * from $bd.$tbl where usuario='$usr' and clave='$pass' and estado=14 ";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        var_dump($usuario = mysql_fetch_array($res));
        if ($usuario['idusuario'] == FALSE) {
            $this->Error();
        } else {
            $_SESSION['usuario']['islog'] = 1;
            $_SESSION['usuario']['nombre'] = $usuario['usuario'];
            $_SESSION['usuario']['id'] = $usuario['idusuario'];
            $_SESSION['usuario']['rut'] = $usuario['rut'];
            $_SESSION['usuario']['perfil'] = $usuario['perfil'];
            return TRUE;
        }
    } catch (Exception $e){
        return FALSE;
    }
    }
    

}
