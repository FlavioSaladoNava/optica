<?php  
session_start(); 
include_once ('./controller/controller.php');
$controller = new controller();//declaracion de la clase controlador

//metodo para verificar si existe la variable de sesion y te arroja a la pagina dependiendo el status
if (isset($_SESSION['id']) && isset($_SESSION['administrator'])){
  if($_SESSION['administrator'] == 'administrator'){
    header('location: ./home.php?id='.$_SESSION['id'].'&type='.$_SESSION['administrator']);
    exit;
  }else{
      header('location: ./home-user.php?id='.$_SESSION['id'].'&type='.$_SESSION['administrator']); 
      exit;
  }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>OPTICA - Acceso</title>
    <link rel="stylesheet" href="fonts/bootstrap/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="fonts/css/signup-form.css" type="text/css" />

    <link href="fonts/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/assets/sticky-footer-navbar.css" rel="stylesheet">

</head>

<body class="haloBody">
    <div class="container" style="color: white">
        <!-- Contenido -->
        <div>
            <div class="signup-form-container">

                <form method="post" role="form" id="register-form" autocomplete="off">
                    <div class="form-header" style="border:0;">
                        <h3 class="form-title"><i class="fa fa-user"></i>
                            <a href="index.html">
                                <img class="avatar" src="./fonts/media/award1.png" alt="Logo Optica">
                            </a>
                    </div>
                    <div class="form-body">
                        <h2 id="title-form-body-login">¡ Bienvenido !</h2>
                        <h4 id="subtitle-form-body">¡ Estamos muy entusiasmados por verte !</h4>
                        <?php

                         $controller->entryUser();
                        
                        ?>
                        <div id="errorDiv"></div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><span
                                            class="glyphicon glyphicon-user"></span></span> </div>
                                <input type="text" id="username" name="username" placeholder="Ingrese un usuario"
                                    class="form-control" maxlength="40">   
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><span
                                            class="glyphicon glyphicon-lock"></span></span> </div>
                                <input name="password" id="password" type="password" class="form-control"
                                    placeholder="Contraseña">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center" role="group"
                            aria-label="Botonera">
                            <button type="submit" class="btn btn-primary" id="validarLogin">Entrar</button>
                        </div>


                    </div>

                    <div class="form-footer">
                        <p id="footer_title">¿ Necesitas una cuenta ? <a href="./registro.php">Registrate</a> </p>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Fin Contenido -->
    <!-- Fin row -->
    </div>
    <!-- Fin container -->
    <script src="fonts/assets/jquery-1.12.4-jquery.min.js"></script>
    <script src="fonts/assets/jquery.validate.min.js"></script>
    <script src="fonts/assets/ValidarRegistro.js"></script>
    <script src="fonts/dist/js/bootstrap.min.js"></script>
</body>

</html>