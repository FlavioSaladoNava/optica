<?php

session_start();
include_once('./controller/controller.php');
$controller = new controller();
if (!$controller->authenticated()) {
    $controller->redirect("./login.php");
}
$controller->signOut();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Optica-Administrador</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- FontAwesome Import-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <script type="text/javascript">
    function mostrarEntradas() {
        document.getElementById("tablaPedidos").style.display = "none";
        document.getElementById("tablaArmazones").style.display = "none";
        document.getElementById("tablaMicas").style.display = "none";
        document.getElementById("tablaDoctores").style.display = "node";
        document.getElementById("tablaEntradas").style.display = "block";
        document.getElementById("tablaUsuarios").style.display = "none";
    }

    function mostrarUsuarios() {
        document.getElementById("tablaPedidos").style.display = "none";
        document.getElementById("tablaArmazones").style.display = "none";
        document.getElementById("tablaMicas").style.display = "none";
        document.getElementById("tablaDoctores").style.display = "node";
        document.getElementById("tablaEntradas").style.display = "none";
        document.getElementById("tablaUsuarios").style.display = "block";
    }

    function mostrarDoctores() {
        document.getElementById("tablaPedidos").style.display = "none";
        document.getElementById("tablaArmazones").style.display = "none";
        document.getElementById("tablaMicas").style.display = "none";
        document.getElementById("tablaDoctores").style.display = "block";
        document.getElementById("tablaEntradas").style.display = "none";
        document.getElementById("tablaUsuarios").style.display = "none";
    }

    function mostrarPedidos() {
        document.getElementById("tablaPedidos").style.display = "block";
        document.getElementById("tablaArmazones").style.display = "none";
        document.getElementById("tablaMicas").style.display = "none";
        document.getElementById("tablaDoctores").style.display = "none";
        document.getElementById("tablaEntradas").style.display = "none";
        document.getElementById("tablaUsuarios").style.display = "none";
    }

    function mostrarArmazones() {
        document.getElementById("tablaPedidos").style.display = "none";
        document.getElementById("tablaArmazones").style.display = "block";
        document.getElementById("tablaMicas").style.display = "none";
        document.getElementById("tablaDoctores").style.display = "none";
        document.getElementById("tablaEntradas").style.display = "none";
        document.getElementById("tablaUsuarios").style.display = "none";
    }
    function mostrarMicas() {
        document.getElementById("tablaPedidos").style.display = "none";
        document.getElementById("tablaArmazones").style.display = "none";
        document.getElementById("tablaMicas").style.display = "block";
        document.getElementById("tablaDoctores").style.display = "none";
        document.getElementById("tablaEntradas").style.display = "none";
        document.getElementById("tablaUsuarios").style.display = "none";
    }
    </script>

</head> 

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        
        
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="IndexAdministrador.html">
                <div class="sidebar-brand-icon rotate-n-15">

                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Optica :D</div>
            </a>
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <p class="nav-link" onclick="mostrarEntradas()">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Entradas y Salidas</span>
                </p>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item active">
                <p class="nav-link" onclick="mostrarUsuarios()">
                <i class="fas fa-user"></i>
                    <span>Usuarios</span>
                </p>
            </li>
            
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link"  onclick="mostrarArmazones()">
                    <i class="fas fa-glasses"></i>
                    <span>Armazones</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <p class="nav-link" onclick="mostrarMicas()">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Micas</span></p>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item active">
                <p class="nav-link" onclick="mostrarDoctores()">
                    <i class="fas fa-stethoscope"></i>
                    <span>Doctores</span></p>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                </nav>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                  </button>

                            <!-- Topbar Search -->
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                <li class="nav-item dropdown no-arrow d-sm-none">
                                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-search fa-fw"></i>
                                    </a>
                                    <!-- Dropdown - Messages -->
                                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                        <form class="form-inline mr-auto w-100 navbar-search">
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                              </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Nav Item - User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php $controller->informationUser(); ?>
                                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                            
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="./home-admin.php?exit=1">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> cerrar sesion
                                            </a>
                                        </div>
                                    </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                         <div id="tablaEntradas" style="display:block">
                        
                            <div class="card mt-1 shadow-lg p-1 mb-1 bg-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title text-left">Registro Actividades</h6>
                                    </div>

                                    <div class="table-responsive-md">

                                        <table class="table table-sm table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Hora: Entrada</th>
                                                    <th scope="col">Hora: Salida</th>
                                                </tr>
                                            </thead>

                                            <tbody id="loadDataActivities">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div id="tablaUsuarios" style="display:block">
                            <div class="card mt-1 shadow-lg p-1 mb-1 bg-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title text-left">Usuarios</h6>
                                        <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                            data-target="#addUser">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>

                                    </div>
                                    <div id="resultOperator" class="alert alert-primary" role="alert" style="display:none">

                                    </div>

                                    <div class="table-responsive-md">

                                        <table class="table table-sm table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Usuario</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="loadDataUser">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                         <div id="tablaArmazones" style="display:none">
                         <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Catalogo Armazon</h1>
                                <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                            data-target="#addArmazon">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                            </div>
                            

                            <div class="row">
                                   
                                <!-- Collapsable Card Example -->
                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8056597124133.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center ">Armazón Ray-Ban Vista en Metal Plata</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$2359</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 5</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8056597124430.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Armazón Ray-Ban Vista Oro en Metal</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$2400</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8056597123334.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Armazón Ray-Ban en Acero Negro</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$2700</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 5</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Collapsable Card Example -->
                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8056597062589.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Armazón Vogue en Nylon Habana-Transparente-Oro</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$1600</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 3</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8056597063043.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center " class="m-0 font-weight-bold text-primary">Armazón Vogue en Nylon Violeta-Café</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$1500</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 4</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="https://www.sanborns.com.mx/imagenes-sanborns-ii/1200/8053672915198.jpg" height="250" width="150">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Armazón Vogue en metal oro rosa-vino</h5>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text">$1470</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">Stock: 6</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#anadirArmazon">
                                                        <i class="fas fa-plus" style="color:green"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#actualizarArmazon">
                                                        <i class="fas fa-pen" style="color:yellow"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 mb-12" style="text-align: center">
                                                    <a type="button" data-toggle="modal" data-target="#EliminarArmazon">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div id="tablaPedidos" style="display:none"></div>
                         <div id="tablaMicas" style="display:none"></div>
                         <div id="tablaDoctores" style="display:none"></div>
                         
                        </div>

                        <input id="id_admin" type="hidden" value="<?php echo $_SESSION['id']?>">
                        









                            <footer class="sticky-footer bg-white">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>Optica &copy;  2019</span>
                                    </div>
                                </div>
                            </footer>

                        </div>

                    </div>

                    <!-- Modal usuario -->
                <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                    >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="register-form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="float-left">Nombre</label>
                                        <input type="text" class="form-control" name="name" id="AddOperatorName"
                                            aria-describedby="emailHelp" placeholder="Ingrese su(s) nombre(s)">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>

                                    </div>

                                    <div class="form-group">
                                        <label class="float-left">Apellidos</label>
                                        <input type="text" class="form-control" name="lastname" id="AddOperatorLastName"
                                            aria-describedby="emailHelp" placeholder="Ingrese sus apellidos">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>

                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Nombre de Usuario</label>
                                        <input type="text" class="form-control" name="username" id="AddOperatorUser"
                                            aria-describedby="emailHelp" placeholder="Ingrese el nombre de usuario">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Contraseña</label>
                                        <input type="text" class="form-control" name="password" id="AddOperatorPassword"
                                            aria-describedby="emailHelp" placeholder="Ingrese una contraseña">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>


                                </div>
                                <div class="modal-footer" style="background-color:#ECF0F1;">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"
                                        id="cerrar">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar Datos</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal usuario -->




                <div class="modal fade" id="addArmazon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Armazon</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                       
                            <form id="register-form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="float-left">Stock</label>
                                        <input type="text" class="form-control" name="insertstock" id="insertstock" placeholder="Ingrese stock">
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Marca</label>
                                        <input type="text" class="form-control" name="insertmarca" id="insertmarca" placeholder="Ingrese la marca">

                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Descripcion</label>
                                        <input type="text" class="form-control" name="insertdescripcion" id="insertdescripcion" placeholder="Ingrese descripcion">
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Precio</label>
                                        <input type="text" class="form-control" name="insertprecio" id="insertprecio" placeholder="Ingrese el precio">
                                    </div>

                                    <form> <input type="file" style="display:none" name="insertImage" value="insertImage" id="insertImage">
                                        <label class="btn btn-success" for="insertImage"> Seleccionar Imagen</label> <br>
                                       
                                    </form>
                                </div>
                                <div class="modal-footer" style="background-color:#ECF0F1;">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"
                                        id="cerrar">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar Datos</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>









                <!-- Modal modificar usuario -->
                <div class="modal fade" id="updUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                    style="background-image: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.6));">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="update-form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="float-left">Nombre</label>
                                        <input type="text" class="form-control" name="upname" id="UpdateOperatorName"
                                            aria-describedby="emailHelp" placeholder="Ingrese su(s) nombre(s)">
                                        <input type="hidden" class="form-control" id="UpdateidOperator">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="float-left">Apellidos</label>
                                        <input type="text" class="form-control" name="uplastname"
                                            id="UpdateOperatorLastName" aria-describedby="emailHelp"
                                            placeholder="Ingrese sus apellidos">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Nombre de Usuario</label>
                                        <input type="text" class="form-control" name="upusername"
                                            id="UpdateOperatorUser" aria-describedby="emailHelp"
                                            placeholder="Ingrese un usuario">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="float-left">Contraseña</label>
                                        <input type="text" class="form-control" name="uppassword"
                                            id="UpdateOperatorPassword" aria-describedby="emailHelp"
                                            placeholder="Ingrese una contraseña">
                                        <input type="hidden" class="form-control" id="UpdateOperatorPasswordGet"
                                            aria-describedby="emailHelp" placeholder="Ingrese una contraseña">
                                        <span class="help-block float-right" id="error" style="color:#a94442"></span>
                                    </div>


                                </div>
                                <div class="modal-footer" style="background-color:#ECF0F1;">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"
                                        id="closeUpd">Cancelar</button>
                                    <button type="submit" class="btn btn-info">Guardar Datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- fin Modal modificar usuario -->


                <!--Start Modal Delete User-->
                <div class="modal fade" id="delOperator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <p class="text-left mb-0">¿Desea realmente eliminar este Usuario?</p>
                                    <p class="text-danger text-left mb-0">
                                        <small>Esta acción no se puede deshacer.</small>
                                    </p>
                                    <input type="hidden" id="DeleteOperatorId">
                                </div>
                                <div class="modal-footer" style="background-color:#ECF0F1;">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"
                                        id="closeOperatorDelete">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Delete User-->
                    <!-- End of Page Wrapper -->

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

                    

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="fonts/assets/jquery-1.12.4-jquery.min.js"></script>
    <script src="fonts/assets/jquery.validate.min.js"></script>
    <script src="fonts/assets/ValidarRegistro.js"></script>
    <script src="fonts/dist/js/bootstrap.min.js"></script>


    <script type="text/javascript" src="fonts/assets/load.js"></script>



    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <script src="./javascript/data-administrator.js"></script>

    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
                    






</body>

</html>