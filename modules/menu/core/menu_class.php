<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_class
 *
 * @author zinho
 */
class menu_class {

    function CrearMenu($bd, $nivel, $usuario) {
        $conn = new config();
        $sql = "select * from $bd.menu mnu
inner join $bd.acceso_menu acm on acm.idusuario=$usuario and acm.idmenu=mnu.idmenu and mnu.nivel=$nivel order by mnu.idmenu asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mnu = mysql_fetch_array($res)) {
            if ($this->VerSubmenu($bd, $usuario, 2, $mnu['idmenu']) < 1) {
                $this->MenuSinSub("cargas/view/cargas_index.php#", $mnu['item']);
            } else {
                echo '<li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $mnu['item'] . ' <span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                $this->MenuConSub($bd, 2, $usuario, $mnu['idmenu']);
                echo "</ul></li>";
            }
        }
    }

    private function MenuSinSub($link, $item) {
        echo "<li><a href='" . __BASE_URL__ . "modules/" . $link . "'>" . $item . "</a></li>";
    }

    private function MenuConSub($bd, $nivel, $usuario, $mnuPadre) {
        $conn = new config();
        $sql = "select * from $bd.menu mnu
inner join $bd.acceso_menu acm on acm.idusuario=$usuario and acm.idmenu=mnu.idmenu and mnu.nivel=$nivel and mnu.pertenece=$mnuPadre order by item asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        while ($mnu = mysql_fetch_array($res)) {
            echo "<li><a href='" . __BASE_URL__ . "modules/" . $mnu['link'] . "'>" . $mnu['item'] . "</a></li>";
        }
    }

    private function VerSubmenu($bd, $usuario, $nivel, $menuPadre) {
        $conn = new config();
        $sql = "select count(*) as cant from $bd.menu mnu
inner join $bd.acceso_menu acm on acm.idusuario=$usuario and acm.idmenu=mnu.idmenu and mnu.nivel=$nivel and mnu.pertenece=$menuPadre order by mnu.idmenu asc";
        $res = mysql_query($sql, $conn->conectar()) or die(mysql_error());
        return mysql_result($res, 0);
    }

    public function ListaAcceso($bd, $tabla) {
        $conn = new config();
        $sql = "select * from $bd.$tabla where idusuario!=1";
        $res = mysql_query($sql, $conn->conectar());
        while ($acc = mysql_fetch_array($res)) {
            echo "<tr><td>".$conn->BuscaDatos("usuario",  $acc['idusuario'],"idusuario", "usuario")."</td>"
                    . "<td>".$conn->BuscaDatos("menu",  $acc['idmenu'],"idmenu", "item")."</td>"
                    . "</tr>";
        }
    }

}
