<?php
require_once '../../config/config.php';
$login=new login_class();
if(is_null($_POST['Usr']) or $_POST['Usr']=="" or $_POST['Pass']==null or $_POST['Pass']==""){
    echo false;
}
else{
    if($login->CargarSession($_POST['Usr'], $_POST['Pass'], __BASE_DATOS__, "usuario")==TRUE){
       return true;
    }
   
}
