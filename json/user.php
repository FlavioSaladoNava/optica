<?php

include_once '../models/model.php';

//esta capa solo se dedica a consultar,eliminar,modificar,agregar funcionalidades para el usuario


$model = new model(); //inicializacion de la variable modelo

$user = ""; //variable user
     

if(isset($_GET['user'])){ //obtencion de variable atra vez del metodo GET para armar rutas ejemplo:
    $user = $_GET['user']; //user.php?user="algo"
}


if($user == 'readCampaingsUser'){ //obtiene las campañas que se le han asignado al usuario
   $id_user = $_GET['id_user'];
   $model->prepareQueryCampaingsUsuario($id_user);
}


if($user == 'uploadServer'){ //obtiene las imagen para subirla directamente al servidor y te devuelve la ruta en el protocolo HTTP o HTTPS
    if (is_array($_FILES) && count($_FILES) > 0) {
    if (($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/gif")) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../fonts/images/".$_FILES['file']['name'])) {
            //more code here...
            echo "http://localhost/socialnet/fonts/images/".$_FILES['file']['name'];
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
}

?>