<?php declare(strict_types=1);

/**
 * @copyright 2024 Control de flujo del mapa web
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: accion.php 14084 2024-04-21 17:23:03Z pdontthink $
 * @author David Salado Rodriguez
 * @package practicasAPP
 * @link http://www.derootty.xyz
 * @todo Se contemplan seis facetas comunes a toda dinamica de app web:
 * 00.- Envio de comunicaciones por escrito.
 * 01.- Inicio de sesion 'perfecto'.
 * 02.- Una muestra de tienda online.
 * 03.- Una pasarela de pagos.
 * 04.- Solicitud de mas informacion (gestion por email).
 * 05.- Un cliente de correo electronico (SquierrerMail).
 *
 * PD: para futuras versiones se contempla la posibilidad de conexion a bases de datos, incluyendo la integracion de phpmyadmin
 */


namespace practicasAPP\accion;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\init\loadDataFrom_cURL;
    use Exception;
    trait callBackInit {
        #funcion de arranque para las rutas necesarias a la hora de conformar la identidad base del entorno de informacion
        function initIndex(string $passPath): string{
            global $modoRtm;
            try{
                if(!file_exists($passPath)){
                    throw new Exception("Adios mundo cruel: Violacion de inicio" . __FILE__ . " => " . __LINE__);
                }
                $salida = $passPath;
            } catch (Exception $ex) {
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                exit($modoRtm->salidaModo());
            }finally{
                #codigo para registro de log del resultado try
            }
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);
            return $salida;
        }
        
        #funcion de arranque para las rutas necesarioas a la hora de conformar la identidad base del root archivo.
        function rootIndex(array $con_St): array{
            global $modoRtm;
            try{
                if(empty($con_St)){
                    $describeException = "Este archivo " . __NAMESPACE__ . " >> " . __LINE__ . " No se reconocen las variables de entorno";
                    throw new Exception($describeException);
                }
            }catch (Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $describeException="";
                $modoRtm->registroMod($ex->getMessage());
                $this->mode = 1;
                $modoRtm->salidaModo();
                echo "con_st";
                echo "<pre>";
                print_r($con_St);
                echo "</pre>";
                exit;
            }finally{
                #Llamada a funcion de registro de log
            }
            if(defined("CONST_USR")){
                echo "----------------sddsds-------------------<br>\n";                
                exit;
            }else{
                define("CONST_USR", $con_St);
            }
            return CONST_USR;
        }
        
        #procesa la ruta que incluira los archivos para gestionar la tolerancia al fallo
        function getFailPath(string $passPath): string{
            global $modoRtm;
            /**
             * Iniciamos la app web instanciando el archivo app root, con privilegios absolutos
             *
             */
            try{
                $describeException="";
                if(ROOT_INDEX != __DIR__ . '/index.php'){
                  throw new Exception(ROOT_INDEX . " se esperaba " . "/srv/vhost/derootty.xyz/home/html/index.php");
                }
                if(!file_exists($passPath)){
                    $describeException = "Se deberia generar un archivo de reporte log: " . "Origen: " . __NAMESPACE__ . " => " . __LINE__ . "Error en ruta: " . BASE_PATH . FAIL_PATH . "/index.php";
                    throw new Exception($describeException);
                }
                if(!file_exists(ROOT_INDEX)){
                    $describeException = "Se deberia generar un archivo de reporte log: " . "Origen: " . __NAMESPACE__ . " => " . __LINE__ . "Error en ruta: " . ROOT_INDEX . "/index.php";
                    throw new Exception($describeException);
                }
            }catch (Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->salidaModo();
                $describeException = "";
                return false;
            }finally{
                #Llamada a funcion de registro de log
            }
            $modoRtm->entradaPathInit(BASE_PATH . FAIL_PATH . "/index.php", __FILE__ . " => " . __LINE__);
            return BASE_PATH . FAIL_PATH . "/index.php";
        }

        #MMotor que se encarga de obtener las entradas
        function getDatEngIndex(array $queryCurl): array{
            global $modoRtm;
            $fillMe = false;
            $ii=-1;
            $bypass="";
            $defcon = new loadDataFrom_cURL($queryCurl);
            while ($bypass!=="EOIX"){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if($bypass!=="EOIX"){
                    if(!isset(get_defined_constants(true)["User"]) || $fillMe){
                        define($defcon->salidaValor($ii, 0, false), $defcon->salidaValor($ii, 1, false));
                        $fillMe = true;
                    }else{
                        echo "Ejecucion de codigo no controlada " . __FILE__ . " => " . __LINE__ . "<br>\n" ;
                        exit;
                    }
                }else if($bypass=="EOIX"){
                    $fillMe = false;
                }
            }
            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = CURL_PATH . "/". "/mydata/engine" ."/". "/datosEntorno.php" ."?". "inicio" ."="."constante"."&"."basePath"."=".BASE_PATH;
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);
            return get_defined_constants(true);
        }

        function getDatEngEntorno(array $queryCurl): array{
            global $modoRtm;
            $fillMe = false;
            $ii=-1;
            $bypass="";
            $salida=array();
            $defcon = new loadDataFrom_cURL($queryCurl);
            while ($bypass!=="EOIX"){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if($bypass!=="EOIX"){
                    if(!isset(get_defined_constants(true)["User"]) || $fillMe){
                        $salida[$defcon->salidaValor($ii, 0, false)]=$defcon->salidaValor($ii, 1, false);
                        //define($defcon->salidaValor($ii, 0, false), $defcon->salidaValor($ii, 1, false));
                        $fillMe = true;
                    }else{
                        echo "Ejecucion de codigo no controlada " . __FILE__ . " => " . __LINE__ . "<br>\n" ;
                        exit;
                    }
                }else if($bypass=="EOIX"){
                    $fillMe = false;
                }
            }

            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = CURL_PATH . "/". "/mydata/engine" ."/". "/datosAcceso.php" ."?". "inicio" ."="."constante"."&"."basePath"."=".BASE_PATH;
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);

            return $salida;
        }
        
        //Revisar
        function getDatEngDAPP(array $queryCurl): array{
            global $modoRtm;
            $fillMe = false;
            $ii=-1;
            $bypass = "";
            $salida = array();
            $defcon = new loadDataFrom_cURL($queryCurl);
            while ($bypass!=="EOIX"){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if($bypass!=="EOIX"){
                    if(!isset(get_defined_constants(true)["User"]) || $fillMe){
                        $salida[$defcon->salidaValor($ii, 0, false)]=$defcon->salidaValor($ii, 1, false);
                        //define($defcon->salidaValor($ii, 0, false), $defcon->salidaValor($ii, 1, false));
                        $fillMe = true;
                    }else{
                        echo "Ejecucion de codigo no controlada " . __FILE__ . " => " . __LINE__ . "<br>\n" ;
                        exit;
                    }
                }else if($bypass=="EOIX"){
                    $fillMe = false;
                }
            }
            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = $salida["ruta"] ."?". $salida["base_URI"];
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);

            return $salida;
        }
        
        
        
        function myEngineIndex(string $passPath): string{
            global $modoRtm;
            try{
                $rutaBoot=$passPath;
                if(!file_exists($rutaBoot)){
                    throw new Exception("No se ha cargado el indexador de accesos||" . $rutaBoot . "<br>\n");
                }
                //revisar
                //$modoRtm->salidaPathInit($rutaBoot);
            }catch(Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->salidaModo();
                return false;
            }finally{
                #codigo para registro de log del resultado try
            }
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);
            return $rutaBoot; // true;
        }

        function pathFailIndex(array $passEnvoVal, string $applyPath): string{
            global $modoRtm;
            $pathInit = explode("||", $applyPath);
            try{
                if($passEnvoVal < 1){
                    $describeException="Violacion de acceso a entorno ";
                    throw new Exception($describeException);
                }
                if(!file_exists($passEnvoVal[$pathInit[0]] . $passEnvoVal[$pathInit[1]] . $pathInit[2])){
                    throw new Exception("Adios mundo cruel: " . $pathInit[0] . $pathInit[1] . $pathInit[2]);
                }
            }catch (Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->salidaModo();
                $describeException="";
                exit;
            }finally{
                #Llamada a funcion de registro de log
            }   
            
            return $passEnvoVal[$pathInit[0]] . $passEnvoVal[$pathInit[1]] . $pathInit[2]; //$pathInit;
        }

        /**
         * Resolutor de rutas absolutas
         * 
         * @param array $ixUsr conteneedor de la matriz constante CONST_USR
         * @param string $match1 BASE_PATH o la localizacion en ruta absoluta del archivo en el servidor.
         * @param string $match2 ruta relativa o URI del arcuivo
         * @param string $catalogo nombre final del archivo
         * @return string salida de la ruta absoluta
         */
        function montaRuta(array $ixUsr, string $match1, string $match2, string $catalogo): string{
            global $modoRtm;
            $ruta1="";
            $ruta2="";
            $rutaRequerida="";
            foreach($ixUsr as $idVal => $valEnd){
                if($idVal == $match2){
                    $ruta2=$valEnd;
                }
                if($idVal == $match1){
                    $ruta1=$valEnd;
                }
            }    
            $rutaRequerida=$ruta1 . $ruta2 . $catalogo;
            //$modoRtm->entradaPathInit($rutaRequerida, __FILE__ . " => " . __LINE__);
            if(!file_exists($rutaRequerida)){
                throw new Exception("<br>Error en localizacion del archivo en funcio montaRuta()".__NAMESPACE__." ".__LINE__."<br>\n"." verifica: ".$rutaRequerida);
            }

            return $rutaRequerida;
        }
        //Evaluacion de modulos indice para la carga de la web
        function pathPassThrow(array $splitIX, string $passPath): string{
            global $modoRtm;
            //$evaluaErr
            $applyPath = explode("||", $passPath);
            //Evaluacion de modulos indice para la carga de la web
            try{
                $describeException="";
                $requerido = $modoRtm->montaRuta($splitIX, $applyPath[0], $applyPath[1], $applyPath[2]);
                if(!file_exists($requerido)){
                    $describeException="No se ha instanciado el archivo " . $requerido;
                    throw new Exception($describeException);
                }
            } catch (Exception $ex) {
                $describeException="";
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->salidaModo();
                exit;
            }finally{
                #Llamada a funcion de registro de log
            }

            $modoRtm->registroMod("accediendo a " . $requerido);
            return $requerido;
        }
    }
    
    final class modos{
        public array $initMode;
        public static array $statusRunTime;
        public array $setStepByStep;
        public bool $initIndex;
        public string $pathInit;
        private static array $pathResolve;
        private int $mode;
        private int $passThrow;
        private bool $regOn; //Activa o desactiva la capacidad de registro de actividad
        
        use callBackInit;
        
        public function __construct(int $mod, bool $setReg){
            self::$statusRunTime = array();
            self::$pathResolve = array();
            $this->setStepByStep = array();
            $this->initMode=array(
                "check",
                "depuracion",
                "produccion"
            );
            $this->passThrow = -1;
            $this->regOn=$setReg;

            array_push(self::$statusRunTime, "hola mundo en constructor modos entrada " . __FILE__ . " => " . __LINE__);
            try{
                if(!isset($_SERVER["SERVER_NAME"])){
                    throw new Exception("Adios mundo cruel: " . __FILE__ . " => " . __LINE__ . " Problemas con las variables superglobales <br>\n" . "Superglobales disponibles: <br>\n");
                }
            } catch (Exception $ex) {
                $this->mode = 1;
                array_push(self::statusRunTime, $ex->getMessage());
                exit($modoRtm->salidaModo());
            }finally{
                #Llamada a funcion de registro de log
            }
            $this->mode=$mod;
            self::$statusRunTime=array();

            saliendo:
        }
        public function registroMod(string $entrada): int{
            try{
                if(empty($entrada)){
                    throw new Exception("Los valores esperados no se han establecido");
                }
            } catch (Exception $ex) {
                array_push(self::$statusRunTime, "Adios mundo cruel: fallo en " . __FILE__ . " => " . __LINE__."||-----Salida en excepcion" . ": " . $ex->getMessage());
                exit($modoRtm->salidaModo());
            }finally{
                #Llamada a funcion de registro de log
            }
            $evalua = array();
            $evalua = json_decode($entrada, true);
            if(is_array($evalua)){
                unset($entrada);
                $entrada = array("error" => array());
                foreach($evalua as $idVal => $valEnd){
                    array_push($entrada["error"], $valEnd);
                }
            }else{
                unset($evalua);
            }
            if($this->regOn){
                array_push(self::$statusRunTime, $entrada);
            }
            return 0;
        }
        /**
         * 
         * @param int $idPath: Debera ser igual a -1
         * @return string
         */
        public function salidaPathResolve(int $idPath): string{
            if($idPath<0 && $idPath>-3){
                if($idPath<0 && $idPath>-3){
                    echo "<pre>";
                    print_r(self::$pathResolve);
                    echo "</pre>";
                    return count(self::$pathResolve);
                }
            }
            if(empty(self::$pathResolve[$idPath])){
                return -2;
            }
            return self::$pathResolve[$idPath];
        }
        public function salidaModo(){
            if($this->initMode[$this->mode]!=="depuracion"){
                return -1;
            }
            echo "Adios mundo cruel ". __FILE__ . " =>" . __LINE__ . "<br>\n";
            echo "<pre>";
            print_r(self::$statusRunTime);
            echo "</pre>";
        }
        public function controlFlow(string $flowCheck): int{
            $this->initIndex = false;
            if(!empty($flowCheck)){
                $this->initIndex = true;
                $this->pathInit = $flowCheck;
                $this->passThrow++;                
            }
            if($this->initIndex){
                $start = microtime(true);
                array_push(self::$statusRunTime, "runtime init " . $this->passThrow . "||".$start);
               //$end = microtime(true);
                $this->pathInit = $flowCheck;
                return $this->passThrow;
            }else{
                return 999;
            }
        }
        
        public function salidaPathInit(string $queryBy, int $passPath): string{
            $evalua = count(self::$pathResolve);
            if($queryBy=="todo" && $passPath == -1){
                $passPath = 0;
            }
            try{
                if($evalua < 1){
                    return "error||no hay rutas dadas de alta";
                }
                if($passPath > $evalua){
                    return "error||el indice es demasiado alto";
                }
                if(!isset(self::$pathResolve[$passPath])){
                    return "error||no hay registros con ese indice";
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }finally{
                #Llamada a funcion de registro de log                
            }
            if($queryBy=="stepByStep" && $passPath <= ($evalua - 1)){
                return "ok" . "||" . self::$pathResolve[$passPath];
            }
            $salida="";
            if($queryBy=="todo"){
                foreach(self::$pathResolve as $idVal => $valEnd){
                    $salida.= $valEnd . "  ";
                }
            }
            $salida= str_replace("  ", "||", $salida);
            echo $salida;
            exit;
        }
        /**
         * 
         * @param int $idModosPath valor especial -1: vuelca todas las rutas recolectadas
         * @return string
         * @throws Exception
         */
        public function salidaModosPath(int $idModosPath): string{
            $salida = "";
            $adOnSalida = "";
            try{
                if(empty(self::$pathResolve[$idModosPath])){
                    if($idModosPath < 0 && $idModosPath == -1){
                        $adOnSalida = "Solicitud de listado de rutas||" . "idCurso=>".$idModosPath . "||" . "totalCount=>" . count(self::$pathResolve);
                        foreach(self::$pathResolve as $idVal => $valEnd){
                            $adOnSalida.= "||" . $valEnd;
                        }
                    }else{
                        throw new Exception("Adios mundo cruel: Identificador no valido ".__FILE__ . "=>" . __LINE__);                        
                    }
                }                
            } catch (Exception $ex) {
                echo "__" . $ex->getMessage();
                exit;
                $this->regError($ex->getMessage());
                
            }finally{
                #Llamada a funcion de registro de log
            }
            saliendo:
            if($idModosPath!==-1){
                $salida=self::$pathResolve[$idModosPath];                    
            }else if($idModosPath==-1){
                echo "Salidaaaa pathing<br>\n";
                //echo modos::salidaModosPath(0);
                echo "<pre>";
                print_r(explode("||", $adOnSalida));
                echo "</pre>";
            }
            return $salida . $adOnSalida;
        }
        public function entradaPathInit(string $passPath, string $origen): string{
            $salida = "Registro en ruta antes: " . count(self::$pathResolve);
            if(empty($passPath)){
                return "error||710";
            }
            try{
                if(in_array($passPath, self::$pathResolve)){
                    throw new Exception("Esta ruta: => " . $passPath . " ya esta registrada||".$origen);
                }
                array_push(self::$pathResolve, $passPath);
            } catch (Exception $ex) {
                exit($ex->getMessage());
            }finally{
                #Llamada a funcion de registro de log
            }
            return $salida . "||Registro en ruta despues: " . count(self::$pathResolve);;
        }
        private function regError(array $errorByPass): bool{
            $salida = false;
            //analizar entrada deinforma de error
            if(count($errorByPass)){
                
            }
            return $salida;
        }
        public function getFlow(int $ini): bool{
            if($ini == $this->passThrow){
                return $this->initIndex;
            }else if ($this->passThrow == -1){
                return false;
            }
        }
    }