<?php declare(strict_types=1);


    //namespace practicasAPP\admin;
    //use practicasAPP;
    //use practicasAPP\dinamica;
    //use practicasAPP\mydata\engine;
    
    namespace practicasAPP\admin\conecta;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\admin\rootsysBD\cargaAdmin;
    use Exception;

    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    //use practicasAPP\rootsysBD;
    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo " . __FILE__ . " Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod("Adios mundo cruel, error en " . __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        //include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");
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
        private array $connExec;
        private array $modalCrud;
        private bool $depura;

        /**
         * $adminBD - Matriz con los datos de conexion
         *      0 - servername
         *      1 - username
         *      2 - password
         *      3 - dbname
         */
        /**
         * 
         * @param array $gestionAcceso "baseSQL" => bool, "permisoView" => bool, "correo" => bool
         * @param bool $depuracion
         */
        public function __construct(bool $depuracion){
            global $modoRtm;
            $this->statusConn=array(
                "A"=>array(),
                "B"=>array(),
                "C"=>array(),
                "D"=>array(),
                "E"=>array()
            );
            $this->modalCrud = array();
            $this->depura = $depuracion;
            $this->connExec = array();
        }    
        private function conectaBD(array $adminBD, int $queBD){
            
            if(is_array($adminBD)&&count($adminBD)>0){
                $this->servername = $adminBD[$queBD]["back"][0]["local"];
                $this->username = $adminBD[$queBD]["back"][1];
                $this->password = $adminBD[$queBD]["back"][2];
                $this->dbname = $adminBD[$queBD]["back"][3];
                
                array_push($this->statusConn["A"], $this->depura);
                array_push($this->statusConn["B"], "Constructor de clase conexion<br>\n");
                array_push($this->statusConn["C"], "Datos establecidos desde " . __FILE__ . " en " . __LINE__."<br>\n");
                array_push($this->statusConn["D"], false);
                array_push($this->statusConn["E"], false);
            }else{
                array_push($this->statusConn["A"], $this->depura);
                array_push($this->statusConn["B"], "Fallo en la entrada de datos<br>\n");
                array_push($this->statusConn["C"], "Datos abortados desde " . __FILE__ . " en " . __LINE__."<br>\n");
                array_push($this->statusConn["D"], false);
                array_push($this->statusConn["E"], true);
            }
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
                array_push($this->statusConn["A"], $this->depura);
                array_push($this->statusConn["B"], "ES_5XX||ES_500||index.php");
                array_push($this->statusConn["C"], array("getMessaje" => $e->getMessage()));
                array_push($this->statusConn["D"], $check);
                array_push($this->statusConn["E"], false);
                exit;
                return $this->statusConn;
            }
            array_push($this->statusConn[""], true);
            array_push($this->statusConn[""], "PT_1XX||PT_103||index.php");
            array_push($this->statusConn[""], 'Éxito... ' . $conn->host_info . "\n");
            array_push($this->statusConn[""], $check);
            array_push($this->statusConn[""], false);
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
         * $conn - pasa por referencia la instancia, proviene de la clase getCurl en /mydata/engine/accion.php
         */
        public function verificaConn(bool $check, object $conn, int $pid, array $setDatas): array{
            global $modoRtm;
            $compare = array();
            $compare = json_decode($conn->pidConn($pid), true);
            $setData = $conn->pruebas($compare);

            echo "Se crea registro de conexiones<br>\n";
            $this->connExec = json_decode(json_encode(array($setData)), true);
            try{
                #Expresion que ya viene evaluada, pero que se revisa.
                if(!is_array($this->connExec[count($this->connExec)-1])){
                    throw new Exception("Adios mundo cruel " . __FILE__ . " => " . __LINE__);
                }

                foreach ($this->connExec[count($this->connExec)-1][0] as $idVal => $valEnd) {
                    $salida = $valEnd;
                    if($valEnd == "EOIX"){
                        
                        break;
                    }
                    $this->connExec[count($this->connExec)-1][2][$valEnd] = $this->connExec[count($this->connExec)-1][1][$idVal];// . "?" ."var"."=".$valEnd;
                }
                
                echo "<pre>";
                echo "set data<br>\n";
                print_r($setData);
                echo "conn exec<br>\n";
                print_r($this->connExec);
                echo "</pre>";                        
                unset($setData);
                unset($compare);
                $response = array();                
                array_push(
                        $response, 
                        $this->connExec[count($this->connExec)-1][2]['localServer'] . 
                            $this->connExec[count($this->connExec)-1][2]['ruta'] . 
                            $this->connExec[count($this->connExec)-1][2]['launchLoad'] . '?exec=' . 
                            $this->connExec[count($this->connExec)-1][2]['exec']);
                $salida = $conn->pruebas($response);
            } catch (Exception $ex) {
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->registroMod("------Error al procesar las peticiones de solicitud del mapa web");
                $modoRtm->salidaModo();
                $this->statusConn["E"]=true;
                exit;
            }finally{
                #codigo para registro
            }
            return $salida;        
        }
    }
    //require_once "admin/rootsysBD.php";
    //use rootsysBD;
    //solicitud de permisos para carga app
