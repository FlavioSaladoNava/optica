<?php
include_once ('./models/model.php'); //manda a traer el archivo de modelo

    class controller{
        private $model; //declaracion de una variable privada
        

        public function __construct() { //inicializacion de la variable model 
            $this->model = new model; 
        }


        public function registrerUser(){ //metodo para registrar al usuario
            if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['username'])
            && isset($_POST['password']) && isset($_POST['confirmpassword'])){
                if(!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password'])
                && !empty($_POST['confirmpassword'])){
                    $name = $this->model->sanear($_POST['name']);
                    $lastname = $this->model->sanear($_POST['lastname']);
                    $username = $this->model->sanear($_POST['username']);
                    $password = $this->model->sanear(sha1($_POST['password']));

                    $this->model->prepareQueryInsertUser($name,$lastname,$username,$password); 

                    echo '<div class="alert alert-success" role="alert">
                                Espere un momento.
                          </div>';
                    header( "refresh:2; url=login.php" );

                }else{
                    echo '<div class="alert alert-danger" role="alert">
                                Campos vacios.
                          </div>';
                }
            }else{
                echo '<div class="alert alert-danger" role="alert">
                                Falta rellenar campos.
                          </div>';
            }
        }


        public function entryUser(){ //metodo para iniciar sesion dependiendo del status administrador o operador
            if(isset($_POST['username']) && isset($_POST['password'])){
                if(!empty($_POST['username']) && !empty($_POST['password'])){
                    $name = $this->model->sanear($_POST['username']);
                    $password = $this->model->sanear(sha1($_POST['password']));
                    $user = $this->model->prepareQueryLogin($name,$password);
                    if(isset($user)){
                        if($user['tipo']== 'Admin'){
                            $_SESSION['id'] = $user['id_usuario'];
                            $_SESSION['administrator'] = 'administrator';

                            $this->model->prepareQueryLoginStatusEntryLog($_SESSION['id']);
                        
                            $this->model->redirect('./home-admin.php?id='.$_SESSION['id'].'&type='.$_SESSION['administrator']);
                        }else if($user['tipo']== 'Operador'){
                            $_SESSION['id'] = $user['id_usuario'];
                            $_SESSION['administrator'] = 'operator';

                            $this->model->prepareQueryLoginStatusEntryLog($_SESSION['id']); 
                        
                            $this->model->redirect('./home-user.php?id='.$_SESSION['id'].'&type='.$_SESSION['administrator']);
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                        Nombre de usuario o contraseña incorrecta.
                        </div>';
                     }
                }else{
                    echo "<script>console.log('2')</script>";
                } 
            }else{
                echo "<script>console.log('1')</script>";
            }
        }


        public function authenticated(){ //metodo que autentifica si se ha iniciado sesion
            if(isset($_SESSION['id'])){
                if(!empty($_SESSION['id'])){
                    return true;
                }else{
                    $this->model->redirect('./login.php');
                    return false;
                }
            }else{
                return false;
            }
        }

        public function redirect($url){
            header("Location: ".$url);
        }

        public function informationUser(){ //metodo que te devuelve la informacion del usuario
            if(isset($_SESSION['id'])){
                if(!empty($_SESSION['id'])){

                    $id_user = $_SESSION['id'];

                    $user = $this->model->prepareQueryInformationUser($id_user);
                    

                    if(isset($user)){
                
                    echo ' <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="color: #fff;">
                    <i id="user-navbar-circle-icon" class="fa fa-user-circle"></i>
                    '. $user['nombre'] .' '.$user['apellidos'] .'
                </a>';
                    
                    }

                }else{
                    echo 'empty..!';
                }
                
            }else{
                echo 'empty..!';  
            }    
        }


        public function signOut(){ //metodo para cerrar sesion
            if(isset($_GET['exit'])){
                session_destroy();
                $this->model->prepareQueryLoginStatusExitLog($_SESSION['id']);
                $this->model->redirect('./login.php');
            }
        }

    }
  

?>