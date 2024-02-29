<?php
        $queEjercicio=0;
        $queBD=$ejercicio[$queEjercicio];

        class conexion{
            private string $servername;
            private string $username;
            private string $password;
            private string $dbname;
            public array $statusConn;

            /**
             * $adminBD - Matriz con los datos de conexion
             *      0 - servername
             *      1 - username
             *      2 - password
             *      3 - dbname
             */
            public function __construct($adminBD,$queBD){
                if(is_array($adminBD)&&count($adminBD)>0){
                    $this->servername = $adminBD[$queBD][0];
                    $this->username = $adminBD[$queBD][1];
                    $this->password = $adminBD[$queBD][2];
                    $this->dbname = $adminBD[$queBD][3];
                    $this->statusConn[]=true;
                    $this->statusConn[]="Datos establecidos<br>\n";
                }else{
                    $this->statusConn[]=false;
                    $this->statusConn[]="Fallo en la entrada de datos<br>\n";
                }
            }    

            /**
             * $conn - pasa por referencia la instancia a MySqli
             */
            public function verificaConn(&$conn){
                if(!$this->statusConn[0]){
                    return $this->statusConn;
                }else{
                    // Create connection
                    unset($this->statusConn);
                    $this->statusConn=array();
                    if (!$conn->real_connect($this->servername, $this->username, $this->password, $this->dbname)) {
                        $this->statusConn[]=false;
                        $this->statusConn[]='Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error();
                        //die('Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
                    }
                    // Check connection
                    if (!$conn) {
                        $this->statusConn[]=false;
                        $this->statusConn[]='Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error();
                        //return false;
                    }
                    if (!$conn->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
                        $this->statusConn[]=false;
                        $this->statusConn[]='Falló la configuración de MYSQLI_INIT_COMMAND';
                    }
                    if (!$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
                        $this->statusConn[]=false;
                        $this->statusConn[]='Falló la configuración de MYSQLI_OPT_CONNECT_TIMEOUT';
                    }
                    $this->statusConn[]=true;
                    $this->statusConn[]='Éxito... ' . $conn->host_info . "\n";
                }
                return $this->statusConn;        
            }
        }
        require_once "rootsysBD.php";
        $adminCrud=new conexion($adminBD, $queBD);
        function lanzaConexion(&$adminCrud,&$conn){
            $salida=array();
            $salida = $adminCrud->verificaConn($conn);
            if(is_array($adminCrud)){
                if(!$adminCrud[0]){
                    die($adminCrud[1]);
                }else{
                    $statusFlow[]=true;
                    $statusFlow[]="Crud correctamente administrado<br>\n";
                }
            }
            return $salida;
        }
        $statusFlow=array();
        $atackBD = array();
        $atackBD[]=NULL;
        if(isset($_POST) && is_array($_POST) && count($_POST)>0){
            $setFormulario=array();
            foreach($_POST as $idVal => $valEnd){
                if(!empty($valEnd)){
                    $setFormulario[$idVal]=$valEnd;
                }
            }
            if(count($_POST)==count($setFormulario) && ((count($_POST)>1) && (count($setFormulario)>1))){
                $atackBD[0]=true;
            }else{
                $atackBD[0]=false;
                unset($_POST);
                unset($setFormulario);
            }
        }else if(!isset($datosMatriz)){
            $atackBD[0]=false;
        }else{
            $atackBD[0]=false;
        }
        if($atackBD[0]===NULL){
            $statusFlow[]=false;
            $statusFlow[]="Llamada incompetente<br>\n";
            $atackBD[]="../empl_error.php";
        }else if( (!$atackBD[0]) || ($atackBD[0]) ){
            $conn = mysqli_init();
            if (!$conn) {
                die('Falló mysqli_init');
            }
            $statusFlow[]=lanzaConexion($adminCrud, $conn);   
        }
        if(empty($conn)){
            echo "Error en la administracion de la conexion<br>\n";
            echo "<pre>";
            print_r($conn);
            echo "</pre>";
            exit;
        }
?>