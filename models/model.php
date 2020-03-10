<?php
    class model {
        protected $connection;
        private $bd="opticasucursal"; //nombre de la base de datos
        private $user = "root"; //Usuario de la base de datos 'root'
        private $password = ""; // Contraseña de la base de datos 
    
        public function openConnection(){ //abre la conexion a mysql 
            try{

            $this->connection = new PDO('mysql:host=localhost;dbname='.$this->bd,$this->user,$this->password);
            $this->connection->exec("set character set utf8");

            }catch(PDOException $e){

                 print("!Error :" . $e->getMessage()."<br>");

            die();
            } 

        }

        //funciones para administrador
        public function closeConnection(){ //cierra la conexion a la base de datos
           $this->connection = null;
        }

        public function prepareQueryAllUser(){ //selecciona a todos los usuarios existentes en la base de datos y los devuelve en un JSON
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("SELECT id_usuario,usuario FROM usuarios");
                $judgment->execute();
                $this->closeConnection();
            }else{
               
            }

            $userData = array();

            while($row=$judgment->fetchAll(PDO::FETCH_ASSOC)){
                $userData['Registros']= $row;
            }
            echo json_encode($userData);
        }

        public function prepareLogJSONEntryAndExit($id_administrator){ //prepara una consulta a la tabla de LOG para ver todos los usuarios
            //que han ingresado a la aplicacion y te los devuelve en un json
            if($this->connection == null){
                $this->openConnection();
                
                $judgment = $this->connection->prepare("SELECT u.id_usuario,u.nombre,u.apellidos,l.date_entrada,l.date_salida from log l ,usuarios"."
                u WHERE u.id_usuario = l.id_usuario and u.id_administrador = :id_admin");

                $judgment->bindParam(':id_admin', $id_administrator,PDO::PARAM_INT);

                $judgment->execute();

                $this->closeConnection();
            }else{
                echo "fail prepareLogJSONEntryAndExit";
            }

            $userDataEntryAndExit = array();

            while($row = $judgment->fetchAll(PDO::FETCH_ASSOC)){
                $userDataEntryAndExit['EntryAndExitLog'] = $row;
            }

            echo json_encode($userDataEntryAndExit);
        }

        public function prepareUserJSON($id_administrator){ //prepara a todos los usuarios que has registrado en la base de datos 
            if($this->connection == null){
                $this->openConnection();

                $judgment = $this->connection->prepare("SELECT id_usuario,nombre,apellidos,usuario,contrasena from usuarios where tipo = 'Operador' and id_administrador = :id_admin and estado != 'Baja' ORDER BY id_usuario DESC");
                $judgment->bindParam(':id_admin',$id_administrator,PDO::PARAM_INT);

                $judgment->execute();

                $this->closeConnection();
            }else{
                echo "fail prepareLogJSONEntryAndExit"; 
            }
            $userDataAdministrator = array();

            while($row = $judgment->fetchAll(PDO::FETCH_ASSOC)){  
                $userDataAdministrator['AdministratorUser'] = $row;
            }

            echo json_encode($userDataAdministrator);
        }
        public function prepareQueryUpdateUser($id_user,$name,$lastname,$user,$password){ //metodo que prepara la modificacion del usuario
            //en la base de datos
            if($this->connection == null){
                $this->openConnection();
        
                    $judgment = $this->connection->prepare("CALL modUsuario(:name,:lastname,:user,:password,:id_user)");
                    $judgment->bindParam(':id_user',$id_user,PDO::PARAM_INT);
                    $judgment->bindParam(':name',$name,PDO::PARAM_STR);
                    $judgment->bindParam(':lastname',$lastname,PDO::PARAM_STR);
                    $judgment->bindParam(':password',$password,PDO::PARAM_STR);
                    $judgment->bindParam(':user',$user,PDO::PARAM_STR);
                  

                $this->closeConnection();

            }else{
                $judment = "not execute method prepareQueryLoginStatusUpdate";
            }

            return $judgment->execute();
        }

        public function prepareQueryLogin($user,$password){ //prepara el login del administrador o usuario
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("SELECT id_usuario,usuario,contrasena,tipo FROM usuarios WHERE usuario = ? AND contrasena = ?  AND estado != 'Baja'");

                $judgment->bindParam(1,$user,PDO::PARAM_STR);
                $judgment->bindParam(2,$password,PDO::PARAM_STR);

                $judgment->execute();

                $this->closeConnection();

            }else{
                echo 'not execute';
            }

            foreach($judgment->fetchAll(PDO::FETCH_ASSOC) as $person){
                return $person;
            }
        }

        public function prepareQueryInformationUser($id_user){ //prepara la informacion de la persona que ha iniciado sesion en la aplicacion.
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("SELECT nombre,apellidos FROM usuarios WHERE id_usuario = :id_user");

                $judgment->bindParam(':id_user',$id_user,PDO::PARAM_INT);

                $judgment->execute();

                $this->closeConnection();

            }else{
                echo 'not execute';
            }

            $prepareQueryAdministrator = array();

            foreach($judgment->fetchAll(PDO::FETCH_ASSOC) as $person){
                return $person;
            }

        }

        public function prepareQueryLoginStatusEntryLog($id_user){ //prepara las entradas de inicio de sesion a los usuarios para poder ser registradas
            //en la tabla log
            if($this->connection == null){
                $this->openConnection();

                $judgment = $this->connection->prepare("CALL insertlog(:id_user)");

                $judgment->bindParam(':id_user',$id_user,PDO::PARAM_INT);

                $this->closeConnection();

            }else{
                $judment = "not execute method prepareQueryLoginStatusUpdate";
            }

            return $judgment->execute();

        }


        public function prepareQueryLoginStatusExitLog($id_user){ //prepara las salidas de inicio de sesion a los usuarios para poder ser registradas
            //en la tabla log
            if($this->connection == null){
                $this->openConnection();

                $judgment = $this->connection->prepare("CALL insertSalida(:id_user)");

                $judgment->bindParam(':id_user',$id_user,PDO::PARAM_INT);

                $this->closeConnection();

            }else{
                $judment = "not execute method prepareQueryLoginStatusUpdate";
            }

            return $judgment->execute();

        }

        public function prepareQueryDeleteOperator($id_user){ //metodo que da de baja temporal al usuario en la base de datos.
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("CALL delOperador(:id_user,:id_admin)");
                $judgment->bindParam(':id_user',$id_user,PDO::PARAM_INT);
                $judgment->bindParam(':id_admin',$id_administrator,PDO::PARAM_INT);
                $this->closeConnection();
            }else{
                $judment = "not execute method prepareQueryDeleteOperator";
            }
            return $judgment->execute();
        }



        public function prepareQueryInsertOperator($name,$lastname,$user,$password,$id_administrator){ //metodo en donde el administrador dara de alta
            //al operador en la base de datos
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("CALL insertOperador(:name,:lastname,:user,:password,:id_admin)");

                $judgment->bindParam(':name',$name,PDO::PARAM_STR);
                $judgment->bindParam(':lastname',$lastname,PDO::PARAM_STR);
                $judgment->bindParam(':user',$user,PDO::PARAM_STR);
                $judgment->bindParam(':password',$password,PDO::PARAM_STR);
                $judgment->bindParam(':id_admin',$id_administrator,PDO::PARAM_INT);
                $this->closeConnection();
            }else{
                $judment = "not execute method prepareQueryInsertOperator";
            }
            return $judgment->execute(); 
        }

        public function prepareQuyeryInsertArmazon($stock, $marca, $descripcion, $precio_armazon, $imagen, $id_usuario){
            if($this->connection == null){
                $this->openConnection();
                $judgment = $this->connection->prepare("CALL InsertArmazon(:stock,:marca,:descripcion,:precio_armazon,:imagen,:id_usuario)");
                
                $judgment->bindParam(':stock', $stock, PDO::PARAM_INT);
                $judgment->bindParam(':marca', $marca, PDO::PARAM_STR);
                $judgment->bindParam(':descripcion',$descripcion, PDO::PARAM_STR);
                $judgment->bindParam(':precio_armazon',$precio_armazon, PDO::PARAM_STR);
                $judgment->bindParam(':imagen',$imagen,PDO::PARAM_STR);
                $judgment->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            }else{
                $judment = "not execute method prepareQuyeryInsertArmazon";
            }
            return $judgment->execute(); 
        }




        public function prepareQueryInsertUser($name,$lastname,$username,$password){ //metodo para insertar al administrador que esta ligada con el registro
            //de usuarios
             if($this->connection == null){
            
            $this->openConnection();

            $judgment= $this->connection->prepare("CALL insertAdmin(:name,:lastname,:user,:password)");

            $judgment->bindParam(':name',$name,PDO::PARAM_STR);
            $judgment->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $judgment->bindParam(':user',$username,PDO::PARAM_STR);
            $judgment->bindParam(':password',$password,PDO::PARAM_STR);

            $this->closeConnection();
            }else{
                $judment = "not execute method prepareQueryInsertUser";
            }

            return $judgment->execute();

        }

        

        public function redirect($url){
            header("Location: ".$url);
        }

        public function sanear($value){ //metodo que borra cualquier tipo de caracter malicioso he inyeccion de codigo mysql

            $value = str_replace("#","",$value);
            $value = str_replace("|","",$value);
            $value = str_replace("%","",$value);
            $value = str_replace("&","",$value);
            $value = str_replace("<","",$value);
            $value = str_replace(">","",$value);
            $value = str_replace("</","",$value);
            $value = str_replace("<>","",$value);
            $value = str_replace(".","",$value);
            $value = str_replace(",","",$value);
            $value = str_replace(";","",$value);
            $value = str_replace("{","",$value);
            $value = str_replace("}","",$value);
            $value = str_replace("[","",$value);
            $value = str_replace("]","",$value);
            $value = str_replace("(","",$value);
            $value = str_replace(")","",$value);
            $value = str_replace("'\'","",$value);
            $value = str_replace(":","",$value);
            $value = str_replace("?","",$value);
            $value = str_replace("=","",$value);
            $value = str_replace("==","",$value);
            $value = str_replace("Foo","",$value);
            $value = str_replace("foo","",$value);
            $value = str_replace("FOO","",$value);
            $value = htmlspecialchars($value);
            $value = stripslashes($value);
            $value = trim($value);
            $value = htmlentities($value, ENT_QUOTES | ENT_HTML401, 'UTF-8');
            $value = strip_tags($value);
            $value = rawurldecode($value);
            $value = str_replace('/', '', $value);
            $value = str_replace("'","", $value);
            $value = str_replace('\"',"", $value);
            $value = str_replace('<\"',"", $value);
            $value = str_replace('>"',"", $value);
            $value = str_replace(':',"", $value);
            $value = str_replace(';',"", $value);
            $value = str_replace('//',"", $value);
            $value = str_replace('\\',"", $value);
            $value = str_replace(':\\',"", $value);
            $value = str_replace('update',"", $value);
            $value = str_replace('select',"", $value);
            $value = str_replace('delete',"", $value);
            $value = str_replace('insert into',"", $value);
            $value = str_replace('values',"", $value);
            $value = str_replace('.exe',"", $value);
            $value = str_replace('.com',"", $value);
            $value = str_replace('.bat',"", $value);
            $value = str_replace('UPDATE',"", $value);
            $value = str_replace('SELECT',"", $value);
            $value = str_replace('DELETE',"", $value);
            $value = str_replace('INSERT INTO',"", $value);
            $value = str_replace('VALUES',"", $value);
            $value = str_replace('set',"", $value);
            $value = str_replace('SET',"", $value);
            $value = str_replace('http:\\',"", $value);
            $value = str_replace('http',"", $value);
            $value = str_replace('www',"", $value);
            $value = str_replace('http:\\www',"", $value);
            $value = str_replace('http:\\www.',"", $value);
            $value = str_replace('com.ve',"", $value);
            $value = str_replace('.com.ve',"", $value);
            $value = str_replace('.ve',"", $value);
            $value = str_replace('.com.org',"", $value);
            $value = str_replace('.com.net',"", $value);
            $value = str_replace('.org',"", $value);
            $value = str_replace('.net',"", $value);
            $value = str_replace('ve',"", $value);
            $value = str_replace('HTTP',"", $value);
            $value = str_replace('*',"", $value);
            $value = str_replace("admin' --","", $value);
            $value = str_replace("admin' #","", $value);
            $value = str_replace("admin'/*","", $value);
            $value = str_replace("' or 1=1--","", $value);
            $value = str_replace("' or 1=1#","", $value);
            $value = str_replace("' or 1=1/*","", $value);
            $value = str_replace("') or '1'='1--","", $value);
            $value = str_replace("') or ('1'='1--","", $value);
            $value = str_replace("' or 1=1 --IamJOE","", $value);
            $value = str_replace("OR 1=1--","", $value);
            $value = str_replace("%27%20or%20%27%27%3D%27","", $value);
            $value = str_replace("Guest","", $value);
            $value = str_replace("admin';DROP","", $value);
            $value = str_replace("/*","", $value);
            $value = str_replace("*/","", $value);
            $value = str_replace("/**/","", $value);
            $value = str_replace("/","", $value);
            $value = str_replace("#","", $value);
            $value = str_replace("if","", $value);
            $value = str_replace("IF","", $value);
            $value = str_replace("--","", $value);
            $value = str_replace("<>","", $value);
            $value = str_replace("!--","", $value);
            $value = str_replace("--!","", $value);
            $value = str_replace("=","", $value);
            $value = str_replace("cast","", $value);
            $value = str_replace("CAST","", $value);
            $value = str_replace("UNION","", $value);
            $value = str_replace("union","", $value);
            $value = str_replace("JOIN","", $value);
            $value = str_replace("join","", $value);
            $value = str_replace("ORDER BY","", $value);
            $value = str_replace("order by","", $value);
            $value = str_replace("WHERE","", $value);
            $value = str_replace("where","", $value);
            $value = str_replace("*;SHUTDOWN --","", $value);
            $value = str_replace("-;shutdown --","", $value);
            $value = str_replace("EXEC","", $value);
            $value = str_replace("exec","", $value);
            $value = str_replace("login","", $value);
            $value = str_replace("logout","", $value);
            $value = str_replace("LOGIN","", $value);
            $value = str_replace("LOGOUT","", $value);
            $value = str_replace("index","", $value);
            $value = str_replace("INDEX","", $value);
            $value = str_replace(".CSS","", $value);
            $value = str_replace(".css","", $value);
            $value = str_replace(".php","", $value);
            $value = str_replace(".aspx.net","", $value);
            $value = str_replace("asp.net","", $value);
            $value = str_replace("alert","", $value); 
            $value = str_replace("open","", $value);
            $value = str_replace("opened","", $value);
            $value = str_replace("close","", $value);
            $value = str_replace("closed","", $value);
            $value = str_replace("OPEN","", $value);
            $value = str_replace("OPENED","", $value);
            $value = str_replace("CLOSE","", $value);
            $value = str_replace("CLOSED","", $value);
            $value = str_replace("?","", $value);
            $value = str_replace("&","", $value);
            $value = str_replace("!=","", $value);
            $value = str_replace("=!","", $value);
            $value = str_replace("LOAD_FILE","", $value);
            $value = str_replace("load_file","", $value);
            $value = str_replace("HEX","", $value);
            $value = str_replace("hex","", $value);
            $value = str_replace("(//","", $value);
            $value = str_replace(".ini","", $value);
            $value = str_replace("()","", $value);
            $value = str_replace("=''","", $value);
            $value = str_replace("<","", $value);
            $value = str_replace(">","", $value);
            $value = str_replace("</","", $value);
            $value = str_replace(".php?","", $value);
            $value = str_replace("session","", $value);
            $value = str_replace("SESSION","", $value);
            $value = str_replace("[]","", $value);
            $value = str_replace("{}","", $value);
            $value = str_replace("ping","", $value);
            $value = str_replace("from","", $value);
            
            return $value;
        }   







        
    
    }


?>