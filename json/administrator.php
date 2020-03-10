<?php
    include_once ('../models/model.php');

    //esta capa solo se dedica a consultar,eliminar,modificar,agregar funcionalidades para el administrador

    $model = new model(); //inicializacion de la variable modelo

    $administrator = ""; //variable administrador
     
    if(isset($_GET['administrator'])){ //obtencion de variable atra vez del metodo GET para armar rutas ejemplo:
        $administrator = $_GET['administrator']; //administrator.php?administrator="algo"
    }

    if($administrator == 'read'){ //consulta a los usuarios que han entrado y salido al iniciar sesion.
        $id_administrator = $_GET['id_administrator'];
        $model->prepareLogJSONEntryAndExit($id_administrator);
    }


    if($administrator == 'insertOperator'){ //inserta al operador que ha registrado el administrador
        $name = $_GET['name'];
        $lastname = $_GET['lastname'];
        $user = $_GET['user'];
        $password = sha1($_GET['password']);
        $id_administrator = $_GET['id_admin'];

        $model->prepareQueryInsertOperator($name,$lastname,$user,$password,$id_administrator);
    }

    if($administrator == 'readOperator'){ //obtiene a los usuarios que ha registrador el administrador
       $id_administrator = $_GET['id_administrator'];
       $model->prepareUserJSON($id_administrator);
    }
    
    if($administrator == 'insertArmazon'){
        $stock = $_GET['insertstock'];
        $marca = $_GET['insertmarca'];
        $descripcion = $_GET['insertdescipcion'];
        $precio = $_GET['insertprecio'];
        $imagen = $_GET['insertImage'];
        $id_administrator = $_GET['id_admin'];

        $model->prepareQuyeryInsertArmazon($stock, $marca, $descripcion, $precio_armazon, $imagen, $id_administrator);
    }


    if($administrator == 'deleteOperator'){ //elimina al operador que ha registrado el administrador
        $id_user = $_GET['id_user'];
        $id_administrator = $_GET['id_administrator'];
        $model->prepareQueryDeleteOperator($id_user, $id_administrator);
    }

    if($administrator == 'readCampaings'){ //obtiene las campañas que ha registrado el administrador
        $id_administrator = $_GET['id_administrator'];
        $model->prepareQueryCampaings($id_administrator);
    }

    if($administrator == 'insertCampaings'){ //inserta las campañas que ha registrado el administrador
        $name = $_GET['name'];
        $id_page = $_GET['id_page'];
        $img_campana = $_GET['img_camp'];
        $id_usuario = $_GET['id_user'];
        $es_facebook = $_GET['es_facebook'];
        $es_twitter = $_GET['es_twitter'];
        $es_instagram = $_GET['es_instagram'];
        $es_pinterest = $_GET['es_pinterest'];
        $es_whatsapp = $_GET['es_whatsapp'];
        $es_messenger = $_GET['es_messenger'];
        $es_sms = $_GET['es_sms'];
        $es_telegram = $_GET['es_telegram']; 
        $model->prepareQueryInsertCampana($name,$id_page,$img_campana,$id_usuario,$es_facebook,$es_twitter,$es_instagram,$es_pinterest,$es_whatsapp,$es_messenger,$es_sms,$es_telegram);
    }

   
   
?>