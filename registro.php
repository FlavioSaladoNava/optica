<?php
    include_once ('./controller/controller.php');

    $controller = new controller();

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>TMAC - Registro</title>
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
                                <img class="avatar" src="./fonts/media/award1.png" alt="Logo optica">
                            </a>
                    </div>
                    <div class="form-body">

                        <h2 id="title-form-body">Crear una cuenta</h2>


                        <?php 
                   $controller->registrerUser();
            ?>

                        <div id="errorDiv">
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><span
                                            class="glyphicon glyphicon-user"></span></span> </div>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Ingrese su(s) nombre(s)" maxlength="40" autofocus="true">


                            </div>
                            <span class="help-block" id="error"></span>
                        </div>


                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><span
                                            class="glyphicon glyphicon-user"></span></span> </div>
                                <input type="text" id="lastname" name="lastname" placeholder="Ingrese sus apellidos"
                                    class="form-control" maxlength="40">

                            </div>
                            <span class="help-block" id="error"></span>
                        </div>


                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><span
                                            class="glyphicon glyphicon-user"></span></span> </div>
                                <input onkeypress="searchEmailUser()" type="text" id="username" name="username"
                                    placeholder="Ingrese un usuario" class="form-control" maxlength="40">
                            </div>
                            <span class="help-block" id="error"></span>
                            <p style="color:#A94442;" id="errorEmail"></p>
                        </div>


                        <div class="row">
                            <div class="form-group col-lg-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"> <span class="input-group-text"
                                            id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                    </div>
                                    <input name="password" id="password" type="password" class="form-control"
                                        placeholder="Contraseña">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"> <span class="input-group-text"
                                            id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                    </div>
                                    <input name="confirmpassword" type="password" class="form-control"
                                        placeholder="Repita contraseña">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>

                        <div class="btn-group  d-flex justify-content-between align-items-center" role="group"
                            aria-label="Botonera">
                            <button type="submit" class="btn btn-primary" id="validarLogin">Registrarse</button>
                        </div>

                    </div>
                    <div class="form-footer">
                        <p id="footer_title"><a href="./login.php">¿ Ya tienes una cuenta ?</a> </p>
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

    <script type="text/javascript">
    function searchEmailUser() {
        list = {};
        fetch('./json/user.php')
            .then(response => response.json())
            .then(json => {
                found = false;

                contador = 0;

                messaje = "";

                while (!found) {

                    if (json['Registros'][contador].usuario == document.getElementById("username").value) {
                        found = true;
                        document.getElementById("errorEmail").innerHTML = "El Usuario ya existe";

                    } else {
                        found = false;
                        document.getElementById("errorEmail").innerHTML = "";
                    }

                    contador++;
                }

            });
    }
    </script>
    <script src="fonts/dist/js/bootstrap.min.js"></script>
</body>

</html>