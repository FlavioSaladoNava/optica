<?php

include_once '../models/model.php';

//esta capa solo se dedica a consultar,eliminar,modificar,agregar funcionalidades para la aplicacion.


$model = new model();

$app = ""; //variable app
     

if(isset($_GET['app'])){ //obtencion de variable atra vez del metodo GET para armar rutas ejemplo:
    $app = $_GET['app']; //app.php?app="algo"
}

if($app == 'readUserApp'){ //metodo para iniciar sesion devuelve un json con tu perfil
   $username = $_GET['username'];
   $password= sha1($_GET['password']);
   header('Access-Control-Allow-Origin: http://localhost:8100');
   header("Access-Control-Allow-Methods: GET");
   echo $model->prepareQueryLoginApp($username,$password);
}

if($app == 'insertPhoneApp'){ //metodo para insertar un contacto en la base de datos
    $phone = $_GET['phone'];
    $user = $_GET['user'];
    $name = $_GET['name'];
    header('Access-Control-Allow-Origin: http://localhost:8100'); //encabezado para autorizar dominios para consumir la API
    header("Access-Control-Allow-Methods:  GET"); //encabezado para autorizar extraccion de informacion atravez del metodo GET.
    echo $model->preparyQueryInsertPhone($phone,$user,$name);
}

if($app == 'readContacsApp'){ //metodo para obtener un contacto en la base de datos.
    $id_admin = $_GET['id_administrator'];
    header('Access-Control-Allow-Origin: http://localhost:8100'); //encabezado para autorizar dominios para consumir la API
    header("Access-Control-Allow-Methods:  GET"); //encabezado para autorizar extraccion de informacion atravez del metodo GET.
    echo $model->prepareQueryContactsApp($id_admin);
}

if($app == 'editContactsApp'){ //metodo para edita un contacto en la base de datos.
    $id_sms= $_GET["id_sms"];
    $name = $_GET["name"];
    $phone = $_GET["phone"];
    header('Access-Control-Allow-Origin: http://localhost:8100'); //encabezado para autorizar dominios para consumir la API
    header("Access-Control-Allow-Methods:  GET"); //encabezado para autorizar extraccion de informacion atravez del metodo GET.
    echo $model->preparyQueryUpdatePhoneApp($phone,$id_sms,$name);
}

if($app == 'deleteContactsApp'){ //metodo que eliminar un contacto en la base de datos.
    $id_sms= $_GET["id_sms"];
    header('Access-Control-Allow-Origin: http://localhost:8100');//encabezado para autorizar dominios para consumir la API
    header("Access-Control-Allow-Methods:  GET"); //encabezado para autorizar extraccion de informacion atravez del metodo GET.
    echo $model->preparyQueryDeletePhoneApp($id_sms);
}


?>