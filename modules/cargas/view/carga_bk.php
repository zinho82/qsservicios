<?php

require_once '../../config/config.php';
$conn = new config();
//comprobamos que sea una petición ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    //obtenemos el archivo a subir
    $file = date("YmdGis") . "_" . $_FILES['archivo']['name'];
     $file = str_replace(' ', '_', $file);
      
    if (is_writable(__ROOT__ . __MODULO_ACCESORIOS__ )) {
        if(is_uploaded_file($_FILES['archivo']['tmp_name'])) {
            //comprobamos si el archivo ha subido
            
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], __ROOT__ . __MODULO_ACCESORIOS__ .$file)) {
                   $sql = "insert into " . __BASE_DATOS__ . ".archivos values(null,'$file','" . $_FILES['archivo']['name'] . "','" . date('Y-m-d G:i:s') . "',".$_POST['TipoArchivo'].",".$_POST['TipoCarga'].")";
               
                sleep(3); //retrasamos la petición 3 segundos
                  $file; //devolvemos el nombre del archivo para pintar la imagen
                  echo "Archivo Cargado Correctamente";
                    mysql_query($sql,$conn->conectar()) or die(mysql_error());
                    
                    
            } else { 
                echo "Error al subir el Archivo". $_FILES['archivo']['error'];
                exit; 
            }
        } else {
            echo "No es Posible subir el archivo";
            exit;
        }
    } else {
        echo "Directorio No es Escribible: ".$_FILES['archivo']['error'];
        
        exit;
        // throw new Exception("Error Processing Request", 1);   
    }
} else {
    echo "El Directorio no es Escribible, Asignar permisos";
    exit;
}