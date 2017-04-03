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
    public function VerSession(){
        if($_SESSION['islog']==FALSE){
           // $_SESSION['islog']==TRUE;
           // header("Location: ".__BASE_URL__.__MODULO_LOGIN__."view/login_index.php");
            
            return FALSE;
        }
    }
            function CargarSession($usr, $pass, $bd, $tbl) {
        $conn= new config();
                echo $sql="select * from $bd.$tbl where usuario='$usr' and clave='$pass' and estado=14 ";
        $res=mysql_query($sql,$conn->conectar()) or die(mysql_error());
       $usuario=mysql_fetch_array($res);
       var_dump($usuario)        ;
        if($usuario==FALSE){
            echo 'false';
            return FALSE;
        }
    }

}
