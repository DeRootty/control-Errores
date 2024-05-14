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
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo "iniciando acciones...<br>\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    use practicasAPP\test;
    $iid=8231;
    function firmaThis($iid){
        try{
            if(!file_exists(__DIR__ . '/test.php') || !file_exists(__DIR__ . '/iosubsys.php')){
                $test = json_encode(array(
                    array(
                        'Respuesta'
                    ),
                    array(
                        'Error',
                    )
                ));
                throw new Exception();
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        require_once(__DIR__ . '/test.php');
        $dataConn = json_encode(array(
            array(
                'ruta' => '/iosubsys.php',
                "localServer" => $_SERVER['SERVER_NAME'],
                "base_cURL" => '/init',
                "launchLoad" => '/iosubsys.php',
                "base_URI" => 'getIni=' . $iid . '&basePath=' . __DIR__
            )
        ));
        $testingConn = new test\testVal($dataConn);
        //$modoRtm = new modos(1, false);
        //$testingConn->getDataConn();
        $passTo = $testingConn->pruebas($testingConn->getDataConn());
        //require_once(__DIR__ . 'init/iosubsys.php');
        if($iid==8231){
            return $passTo['data'];
        }else{
            return 'fail';
        }
        // . $iid;
    }
    if(isset($_GET["init__"]) && $_GET["init__"]==firmaThis($iid)){
        $salida= json_encode(array(
            array(
                "respuesta",
                "accion",
                "ambito",
                "runtime",
                'basePath',
                "EOIX"
            ),
            array(
                'ok',
                'require',
                'accion.php',
                'enabled',
                $_GET["basePath"],
                "EOIX"
            ),
            array(
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else{
        $salida= json_encode(array(
            array(
                "respuesta",
                "accion",
                "ambito",
                "runtime",
                'basePath',
                "EOIX"
            ),
            array(
                'error',
                'redirige',
                'ruta_pagina_error',
                'disabled',
                $_GET["basePath"],
                "EOIX"
            ),
            array(
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }
    exit;
    iniciando:
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\init\loadDataFrom_cURL;
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
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__, true);
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
        //Revisar para ver si getDatEngEntorno, getDatEngIndex y  getDatEngDAPP se pueden convertir en una sola funcion 06/05/2024 - 23:30h
        function getDatEngIndex(string $passQueryCurl): array{
            global $modoRtm;
            $queryCurl = json_decode($passQueryCurl, true);
            $fillMe = false;
            $ii=-1;
            $bypass=array();
            $defcon = new loadDataFrom_cURL($queryCurl);
            try{
                $test = $defcon->getEstado();
                if(!$test){
                    throw new Exception('Error sin controlar');
                }                
            } catch (Exception $ex) {
                return ($ex->getMessage());
            }
            while (!in_array("EOIX", $bypass)){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if(in_array('ok', $bypass) && !in_array('EOIX', $bypass)){
                    if(!isset(get_defined_constants(true)["User"]) || $fillMe){
                        try{
                            $val1 = $defcon->salidaValor($ii, 0, false);
                            $val2 = $defcon->salidaValor($ii, 1, false);
                            if(is_array($val1) && is_array($val2)){
                                if(in_array('Error', $val1) && in_array('Error', $val2)){
                                    $test = json_encode(array(
                                        'Estado' => 'Error',
                                        'Val1' => $val1,
                                        'Val2' => $val2,
                                        'Funcion' => 'getDatEngIndex()',
                                        'Clase' => 'modos',
                                        'Especial' => 'traits',
                                        'FileLoad' => __FILE__,
                                        'Linea' => __LINE__
                                    ));
                                    $fillMe = false;
                                    throw new Exception($test);
                                }else if(in_array('ok', $val1) && in_array('ok', $val2)){
                                    define($val1['data'], $val2['data']);
                                    $fillMe = true;
                                }else{
                                    $test = json_encode(array(
                                        'Estado' => 'Error',
                                        'Val1' => $val1,
                                        'Val2' => $val2,
                                        'Funcion' => 'getDatEngIndex()',
                                        'Clase' => 'modos',
                                        'Especial' => 'traits',
                                        'FileLoad' => __FILE__,
                                        'Linea' => __LINE__
                                    ));
                                    $fillMe = false;
                                    throw new Exception($test);
                                }
                            }else{
                                $test = json_encode(array(
                                    'Estado' => 'Error',
                                    'Val1' => $val1,
                                    'Val2' => $val2,
                                    'Funcion' => 'getDatEngIndex()',
                                    'Clase' => 'modos',
                                    'Especial' => 'traits',
                                    'FileLoad' => __FILE__,
                                    'Linea' => __LINE__
                                ));
                                $fillMe = false;
                                throw new Exception($test);
                            }
                        } catch (Exception $ex) {
                            self::$statusRunTime = json_decode($ex->getMessage(), true);
                            $fillMe = false;
                            return self::$statusRunTime;
                        }
                    }else{
                        echo "Ejecucion de codigo no controlada " . __FILE__ . " => " . __LINE__ . "<br>\n" ;
                        exit;
                    }
                }else if(in_array("EOIX", $bypass)){
                    //echo 'Se ha finalizado la progresion'."\n";
                    $fillMe = false;
                }
            }
            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = CURL_PATH . "/". "mydata/engine" ."/". "datosEntorno.php" ."?". "inicio" ."="."constante"."&"."basePath"."=".BASE_PATH;
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__, true);
            self::$statusRunTime = array(
                'Estado' => 'ok',
                'data' => $passPath,
                'args' => __FILE__ . " => " . __LINE__
            );
            return get_defined_constants(true);
        }
        //Revisar para ver si getDatEngEntorno, getDatEngIndex y  getDatEngDAPP se pueden convertir en una sola funcion 06/05/2024 - 23:30h
        function getDatEngEntorno(array $queryCurl): array{
            global $modoRtm;
            $fillMe = false;
            $ii=-1;
            $bypass=array();
            $salida=array();
            $defcon = new loadDataFrom_cURL($queryCurl);

            while (!in_array("EOIX", $bypass)){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                try{
                    if(!in_array("EOIX", $bypass)){
                        if(count($salida) == 0 || $fillMe){
                            $idVal = $defcon->salidaValor($ii, 0, false);
                            $valEnd = $defcon->salidaValor($ii, 1, false);
                            if(($idVal['data'] == 'respuesta' && $valEnd['data'] == 'ok_conectado') && !$fillMe){
                                $fillMe = true;
                            }else if($fillMe){
                                if((count($salida) == 0) || empty($salida)){
                                    $salida = array(
                                        $idVal['data'] => $valEnd['data']
                                    );
                                }else{
                                    $salida[$idVal['data']]=$valEnd['data'];
                                }
                            }else{
                                $test = json_encode(array(
                                    'Estado' => 'Error',
                                    'Leyenda' => 'No se registra una respuesta dadecuada',
                                    'Funcion' => 'getDatEngEntorno()',
                                    'Clase' => 'modos',
                                    'Espcial' => 'traits_callBacksInits',
                                    'idVal' => $idVal,
                                    'valEnd' => $valEnd,
                                    'IX_dataIN' => $queryCurl,
                                    'CheckID_'.$ii => $bypass,
                                    'FileLoad' => __FILE__,
                                    'Linea' => __LINE__
                                    
                                ));
                                throw new Exception($test);
                            }
                        }else{
                            $test = json_encode(array(
                                'Estado' => 'Error',
                                'Leyenda' => 'No se registra una respuesta dadecuada',
                                'Funcion' => 'getDatEngEntorno()',
                                'Clase' => 'modos',
                                'Espcial' => 'traits_callBacksInits',
                                'idVal' => $idVal,
                                'valEnd' => $valEnd,
                                'IX_dataIN' => $queryCurl,
                                'CheckID_'.$ii => $bypass,
                                'FileLoad' => __FILE__,
                                'Linea' => __LINE__
                            ));
                            throw new Exception($test);
                        }
                    }else if(in_array("EOIX", $bypass)){
                        $fillMe = false;
                    }
                } catch (Exception $ex) {
                    $error = json_decode($ex->getMessage(), true);
                    return $error;
                }
            }
            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = CURL_PATH . "/". "/mydata/engine" ."/". "/datosAcceso.php" ."?". "inicio" ."="."constante"."&"."basePath"."=".BASE_PATH;
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__, true);
            return $salida;
        }
        //Revisar para ver si getDatEngEntorno, getDatEngIndex y  getDatEngDAPP se pueden convertir en una sola funcion 06/05/2024 - 23:30h
        function getDatEngDAPP(string $pasaArray, bool $regOn): array{
            global $modoRtm;
            $queryCurl = json_decode($pasaArray, true);
            $fillMe = false;
            $ii=-1;
            $bypass = array();
            $salida = array();
            $defcon = new loadDataFrom_cURL($queryCurl);
            while (!in_array("EOIX", $bypass)){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if(!in_array("EOIX", $bypass)){
                    if(empty($salida) || $fillMe){
                        $idVal = $defcon->salidaValor($ii, 0, false);
                        $valEnd = $defcon->salidaValor($ii, 1, false);
                        try{
                            if(in_array('Error', $idVal) || in_array('Error', $valEnd)){
                                $test=json_encode(array(
                                    'Estado' => 'Error',
                                    'Funcion' => 'getDatEngDAPP()',
                                    'Clase' => 'modos',
                                    'Espcial' => 'traits_callBacksInits',
                                    'CheckID_'.$ii => $bypass,
                                    'idVal' => $idVal,
                                    'valEnd' => $valEnd
                                ));
                                throw new Exception($test);
                            }
                        } catch (Exception $ex) {
                            $error = json_decode($ex->getMessage(), true);
                            return $error;
                        }
                        if(empty($salida)){
                            $salida = array(
                                $idVal['data'] => $valEnd['data']
                            );
                        }else{
                            $salida[$idVal['data']] = $valEnd['data'];
                        }
                        $fillMe = true;
                    }else{
                        echo "Ejecucion de codigo no controlada " . __FILE__ . " => " . __LINE__ . "<br>\n" ;
                        exit;
                    }
                }else if(in_array("EOIX", $bypass)){
                    $fillMe = false;
                }
            }
            //Definimos el indice general de constantes para la gestion de la dapp
            //revisar cadenas de texto y substituir por variables de origen
            $passPath = $salida["ruta"] ."?". $salida["base_URI"];
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__, $regOn);
            return $salida;
        }
        function myEngineIndex(string $passPath): array{
            global $modoRtm;
            try{
                $rutaBoot=array(
                    'Estado' => 'evalua',
                    'data' => $passPath
                );
                if(!file_exists($rutaBoot['data'])){
                    $rutaBoot['Estado'] = 'Error';
                    $test=json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => "No se ha cargado el indexador de accesos: Carga en vacio -> " . $rutaBoot,
                        'IX_deploid' => $rutaBoot,
                        'Funcion' => 'myEngineIndex()',
                        'Clase' => 'modos',
                        'Espcial' => 'traits_callBacksInits',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new Exception($test);
                }
                $rutaBoot['Estado'] = 'ok';
                //revisar
                //$modoRtm->salidaPathInit($rutaBoot);
            }catch(Exception $ex){
                $error = json_decode($ex->getMessage());
                $modoRtm->salidaModo();
                return $error;
            }finally{
                #codigo para registro de log del resultado try
            }
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);
            return $rutaBoot; // true;
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
                $requerido = $this->montaRuta($splitIX, $applyPath[0], $applyPath[1], $applyPath[2]);
                if(!file_exists($requerido)){
                    $describeException="No se ha instanciado el archivo " . $requerido;
                    throw new Exception($describeException);
                }
            } catch (Exception $ex) {
                $describeException="";
                $this->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $this->registroMod($ex->getMessage());
                $this->salidaModo();
                exit;
            }finally{
                #Llamada a funcion de registro de log
            }

            $this->registroMod("accediendo a " . $requerido);
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
        //private array $estadoRunTime;
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
                        throw new Exception('Adios mundo cruel: Identificador no valido: ' . $idModosPath . ' : '.__FILE__ . '=>' . __LINE__);                        
                    }
                }                
            } catch (Exception $ex) {
                echo '<pre>';
                echo 'Array de referencia al error<br>'."\n";
                print_r(self::$pathResolve);
                echo '</pre>';
                echo "__" . $ex->getMessage();
                exit;
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
        public function entradaPathInit(string $passPath, string $origen, bool $regOn): string{
            $salida = "Registro en ruta antes: " . count(self::$pathResolve);
            if(empty($passPath)){
                return "error||710";
            }
            if($regOn){
                try{
                    if(in_array($passPath, self::$pathResolve)){
                        throw new Exception("Esta ruta: => " . $passPath . " ya esta registrada||".$origen);
                    }else{
                        array_push(self::$pathResolve, $passPath);
                    }

                } catch (Exception $ex) {
                    exit($ex->getMessage());
                }finally{
                    #Llamada a funcion de registro de log
                }
            }else{
                array_push(self::$pathResolve, $salida . "||Registro en ruta despues: " . count(self::$pathResolve));
            }

            return $salida . "||Registro en ruta despues: " . count(self::$pathResolve);
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