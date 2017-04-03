<?php
require_once '../../config/config.php';
$login=new login_class();
if($_POST['Usr']==null or $_POST['Usr']=="" or $_POST['Pass']==null or $_POST['Pass']==""){
    echo false;
}
else{
    if($login->CargarSession($_POST['Usr'], $_POST['Pass'], __BASE_DATOS__, "usuario")){
          return TRUE;
    }
}

