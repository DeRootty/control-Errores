<?php declare(strict_types=1);
    namespace conexion;
    use Exception;
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }
    //Nos aseguramos de que tenemos acceso a la ejecucion del flujo logico del controlador


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
        private function conectaBD(){
            
        }
        private function conectaMail(){
            
        }
        private function conectaConfianza(){
            $randomStr[]=$_SERVER['REMOTE_ADDR'];                                                                                       //2
            $randomStr[]=$_SERVER['REQUEST_URI'];                                                                                       //3
            $randomStr[]=str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ");                                                                     //4
            $randomStr[]=str_shuffle("abcdefghijklmnopqrstuvwxyz");                                                                     //5
            $randomStr[]=str_shuffle("0123456789");                                                                                     //6
            $randomStr[]=str_shuffle("_@!+-*();~");                                                                                     //7
            $randomStr[]=substr($randomStr[4],1,5).substr($randomStr[5],1,5).substr($randomStr[6],1,5).substr($randomStr[7],1,5);       //8
            $randomStr[0]["val"][]=GenerateRandomString(8,$randomStr[8]);
            $randomStr[1]["val"][]=GenerateRandomString(8,$randomStr[8]);
            $inequal=false;
            //echo "<br>".$randomStr[0]["val"][count($randomStr[0]["val"])-1]."<br>\n";
            //echo $randomStr[1]["val"][count($randomStr[0]["val"])-1]."<br>\n";
            //echo $randomStr[8]."<br>\n";
            //exit;
            if($randomStr[0]["val"][count($randomStr[0]["val"])-1]==$randomStr[1]["val"][count($randomStr[1]["val"])-1]){
                do{
                    if($randomStr[0]["val"][count($randomStr[0]["val"])-1]!==$randomStr[0]["val"][count($randomStr[0]["val"])-2]){
                        $inequal=true;
                    }else{
                        $randomStr[0]["val"][]=GenerateRandomString(8,$randomStr[6]);
                        $randomStr[1]["val"][]=GenerateRandomString(8,$randomStr[6]);
                    }
                }while($inequal);
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
                    array_push($this->statusConn, false);
                    array_push($this->statusConn, "ES_5XX");
                    array_push($this->statusConn, "ES_500");
                    array_push($this->statusConn, "index.php");
                    array_push($this->statusConn, $e->getMessage());
                    array_push($this->statusConn, false);
                    return $this->statusConn;
                }
                array_push($this->statusConn, true);
                array_push($this->statusConn, "PT_1XX");
                array_push($this->statusConn, "PT_103");
                array_push($this->statusConn, "index.php");
                array_push($this->statusConn, 'Éxito... ' . $conn->host_info . "\n");
                array_push($this->statusConn, true);
            }
            return $this->statusConn;        
        }
    }
    //require_once "admin/rootsysBD.php";
    use rootsysBD;
    $bdConect = new rootsysBD\cargaAdmin();
    $queBD=2;
    $setData=array();
    try{
        $setData=$bdConect->dameDatos();
        if(!$setData[0]){
            throw new Exception($setData[1] . " Interrupcion en ".__LINE__." ruta ".__NAMESPACE__);
        }
            //header('Location: '.$ruta.'?setDat1a='.$booConn[1]);
    }catch(Exception $e){
        if(!$setData[0]){
            header('Location: /Dinamica/fallos/index.php?setData='.$e->getMessage());
        }else if(!$booCon[0]){
            header('Location: /Dinamica/fallos/index.php?booConn='.$e->getMessage());
        }
        echo "Se deberia estar creando 1 archivo de registro para este error: ".$e->getMessage()."<br>\n";
        exit;
    }
    
    /* 
     * Se definen tres tipos de conexiones: 
     * Funcion inception en layer($estado, $nameLayer){
     *      $Layer[$nameLayer] = array( 
     *          Cliente - servidor by script, 
     *          script - servicio to front end,
     *          Front End - App,
     *          estado - $estado
     *      )
     *  }
     *  
     *  throw new inception en layer B.
     */
    $adminCrud = new conexion($setData, $queBD);
    $booConn = $adminCrud->verificaConn($conn);
        /*
        echo "<pre>";
        print_r($booConn);
        echo "</pre>";
        exit;
        */
    use dinamica;
    $dinamicaAPP = new dinamica\dinamicaAPP();
    $ruta=$dinamicaAPP->dinamica($booConn);
    if(!file_exists(BASE_PATH . $ruta)){
        echo $ruta;
        exit;
        throw new Exception("REvisa ruta: ".$ruta);
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