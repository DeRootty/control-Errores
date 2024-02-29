<?php declare(strict_types=1);
/*
    $ejercicio=array();
    $queEjercicio=0;
    $queBD=$ejercicio[$queEjercicio];
*/
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
                $this->servername = $adminBD[$queBD]["back"][0]["local"];
                $this->username = $adminBD[$queBD]["back"][1];
                $this->password = $adminBD[$queBD]["back"][2];
                $this->dbname = $adminBD[$queBD]["back"][3];
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
                try{
                    if (!$conn->real_connect($this->servername, $this->username, $this->password, $this->dbname)) {
                        throw new Exception('Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
                    }
                    // Check connection
                    if (!$conn) {
                        throw new Exception('Error de conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
                    }
                    if (!$conn->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
                        throw new Exception('Falló la configuración de MYSQLI_INIT_COMMAND');
                    }
                    if (!$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
                        throw new Exception('Falló la configuración de MYSQLI_OPT_CONNECT_TIMEOUT');
                    }
                }catch(Exception $e) {
                    $this->statusConn[]=false;
                    $this->statusConn[]="ES_500";
                    $this->statusConn[]=$e->getMessage();
                    return $this->statusConn;
                }
                $this->statusConn[]=true;
                $this->statusConn[]="PT_103";
                $this->statusConn[]='Éxito... ' . $conn->host_info . "\n";
            }
            return $this->statusConn;        
        }
    }
    require_once "admin/rootsysBD.php";
    $bdConect=new cargaAdmin();
    $queBD=2;
    $setData=array();
    try{
        $setData=$bdConect->dameDatos();
        if(!$setData[0]){
            throw new Exception($setData[1] . " Interrupcion en ".__LINE__." ruta ".__FILE__);
        }else{
            $adminCrud=new conexion($setData, $queBD);
            $booConn=$adminCrud->verificaConn($conn);
            $dinamicaAPP=new dinamicaAPP();
            $ruta=$dinamicaAPP->dinamica($booConn);
            /*
            echo "<pre>";
            print_r($booConn);
            echo "</pre>";
            exit;
            */
            if(!file_exists($ruta)){
                echo $ruta;
                exit;
                throw new Exception("REvisa ruta: ".$ruta);
            }
            header('Location: '.$ruta.'?setDat1a='.$booConn[1]);
        }
    }catch(Exception $e){
        if(!$setData[0]){
            header('Location: /Dinamica/fallos/index.php?setData='.$e->getMessage());
        }else if(!$booCon[0]){
            header('Location: /Dinamica/fallos/index.php?booConn='.$e->getMessage());
        }
        echo "Se deberia estar creando un archivo de registro para este error: ".$e->getMessage()."<br>\n";
        exit;
    }
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