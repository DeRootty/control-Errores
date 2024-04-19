<?php declare(strict_types=1);

/**
 * @copyright 2024 Control de flujo del mapa web
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: index.php 14084 2024-01-06 02:44:03Z pdontthink $
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

  namespace practicasAPP;
    use Exception;
    //use admin\conexion;
    use practicasAPP\init\constante;
    use practicasAPP\admin\conecta\conexion;
    use practicasAPP\admin\rootsysBD\cargaAdmin;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\indexes\box_01\salidaFinVista;
    flush();
    trait callBackInit {
        #funcion de arranque para las rutas necesarioas a la hora de conformar la identidad base del root archivo.
        function initIndex(string $passPath): string{
            global $modoRtm;
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
            $modoRtm->registroMod("-----Registrando clase de inicio");
            try{
                if(!file_exists($passPath)){
                    throw new Exception("Adios mundo cruel: Violacion de inicio" . __FILE__ . " => " . __LINE__);
                }
                $salida=$passPath;
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
        function rootIndex(array $con_St){
            global $modoRtm;

            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
            try{
              if(empty($con_St["user"])){
                  $describeException = "Este archivo " . __NAMESPACE__ . " >> " . __LINE__ . " No se reconocen las variables de entorno";
                  throw new Exception($describeException);
              }
            }catch (Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $describeException="";
                $modoRtm->registroMod($ex->getMessage());
                $this->mode = 1;
                $modoRtm->salidaModo();
                exit;
            }finally{
                #Llamada a funcion de registro de log
            }
            define("CONST_USR", $con_St["user"]);
            $modoRtm->registroMod("Hola mundo: Se ha definido la constante global de carga en " . __FILE__ . " => " . __LINE__);
            return CONST_USR;
        }
        
        #procesa la ruta que incluira los archivos para gestionar la tolerancia al fallo
        function getFailPath(string $passPath): string{
            global $modoRtm;
            /**
             * Iniciamos la app web instanciando el archivo app root, con privilegios absolutos
             *
             */
            $modoRtm->registroMod("hola mundo antes de dar root file a index " . __FILE__ . " => " . __LINE__);
            try{
                $describeException="";
                if(ROOT_INDEX != "/srv/vhost/derootty.xyz/home/html/index.php"){
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
            $modoRtm->registroMod("hola mundo se otorgan las funciones para gestionar el root de index " . __FILE__ . " => " . __LINE__);
            $modoRtm->registroMod("----- hola mundo para la administracion del flujo " . BASE_PATH . FAIL_PATH . "/index.php");
            $modoRtm->registroMod("hola mundo cuando ya tenemos el file root configurado " . __FILE__ . " => " . __LINE__);
            
            $modoRtm->entradaPathInit(BASE_PATH . FAIL_PATH . "/index.php", __FILE__ . " => " . __LINE__);
            return BASE_PATH . FAIL_PATH . "/index.php";
        }

        #MMotor que se encarga de obtener las entradas
        function getDatEngIndex(array $queryCurl): array{
            global $modoRtm;

            #revisar: definir checkeo de integridad onerror
            /*
            $checkIn = match (true){
                in_array($queryCurl) => true
            };
            
            try{
                if(!$checkIn){

                }
            } catch (Exception $ex) {

            }
             * 
             */


            $modoRtm->registroMod("hola mundo: ". "cargamos el motor de entorno" ." en " . __FILE__ . " => " . __LINE__);

            //getCURL es usado para obtener los datos de entorno: las constantes
            $queryCURL=new getCURL($queryCurl["querys"], $queryCurl["trace"], false);

            //Se inicia encendido del motor
            $queryCURL->setFLow(false, false);

            //A futuro, la misma clase tambien sera usada para obtener los permisos de carga de las apps
            $defcon = new constante(__FILE__ , $queryCURL);
            //$defcon = new init\constante(__FILE__, $queryCURL);
            $modoRtm->registroMod("hola mundo antes de registrar los resultados del motor " . __FILE__ . " => " . __LINE__);
            $ii=-1;
            $bypass="";
            while ($bypass!=="EOIX"){
                $ii++;
                $bypass=$defcon->salidaCheck($ii, false);
                if($bypass!=="EOIX"){
                    define($defcon->salidaValor($ii, 0, false), $defcon->salidaValor($ii, 1, false));
                }
            }
            $modoRtm->registroMod("hola mundo despues de registrar los resultados del motor " . __FILE__ . " => " . __LINE__);

            //Definimos el indice general de constantes para la gestion de la dapp
            $passPath = $queryCurl["trace"][0]."/".$queryCurl["trace"][1]."/".$queryCurl["querys"]["carga"]."?".$queryCurl["querys"]["variable"]."=".$queryCurl["querys"]["destino"];
            $modoRtm->entradaPathInit($passPath, __FILE__ . " => " . __LINE__);
            return get_defined_constants(true);
        }

        function myEngineIndex(string $passPath): string{
            global $modoRtm;
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
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
            $modoRtm->registroMod("hola mundo verificando que el entorno recae sobre root index " . __FILE__ . " => " . __LINE__);
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

            $modoRtm->registroMod("Ruta ok ".__FILE__ . " => " .__LINE__);
            return $rutaRequerida;
        }
        //Evaluacion de modulos indice para la carga de la web
        function pathPassThrow(array $splitIX, string $passPath): string{
            global $modoRtm;
            //$evaluaErr
            $applyPath = explode("||", $passPath);
            //Evaluacion de modulos indice para la carga de la web
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
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
                    exit;
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
            echo "Adios mundo cruel<br>\n";
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
                exit;
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
    #Instancia del motor de seguridad, modo 1, actividad false.
    $modoRtm = new modos(1, false);
    $modoRtm->registroMod("hola mundo en constructor modos salida " . __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/init/index.php"), __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/init/accion.php"), __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/mydata/engine/index.php"), __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/mydata/engine/accion.php"), __FILE__ . " => " . __LINE__);
    
    //--------- PRECAUCION NO BORRAR LINEAS COMENTADAS 
    /*
        $modoRtm->registroMod("-----------" . $modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/init/index.php"), __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod("-----------" . $modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php"), __FILE__ . " => " . __LINE__);
    */
    
    require_once($modoRtm->salidaModosPath(0));
    require_once($modoRtm->salidaModosPath(1));    
    require_once($modoRtm->salidaModosPath(2));
    require_once($modoRtm->salidaModosPath(3));

    $entorno = $modoRtm->rootIndex(
        $modoRtm->getDatEngIndex(
            array(
                "querys" => array(
                    "destino" => "constante",
                    "variable" => "inicio",
                    "carga" => "datosEntorno.php"
                ),
                "trace" => array(
                    $_SERVER["SERVER_NAME"],
                    "mydata/engine",
                    __FILE__
                )
            ),
        )
    );

    $modoRtm->registroMod("Hola mundo en: " . __FILE__ . " => " . __LINE__);
    
    $modoRtm->registroMod("-----------" . $modoRtm->salidaModosPath(4));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathFailIndex(CONST_USR, "BASE_PATH||FAIL_PATH||/index.php"), __FILE__ . " => " . __LINE__ ));
    
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH||INDEX_PATH||/box_00.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH||ADMIN_PATH||/rootsysBD.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH||FLOW_PATH||/index.php"), __FILE__ . " => " . __LINE__));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH||ADMIN_PATH||/conexion.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH||INDEX_PATH||/box_01.php"), __FILE__ . " => " . __LINE__ ));
    
    require_once($modoRtm->salidaModosPath(5));
    
    require_once($modoRtm->salidaModosPath(6));

    require_once($modoRtm->salidaModosPath(7));
    
    require_once($modoRtm->salidaModosPath(8));
    
    require_once($modoRtm->salidaModosPath(9));

    require_once($modoRtm->salidaModosPath(10));

    //INICIO ---------------------------analizar codigo------------------------------ INICIO
    
    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);    
    //use practicasAPP\rootsysBD;

    $defConn = new cargaAdmin(array("prueba 1", "prueba 2"), false);
    //$defConn = new practicasAPP\rootsysBD\cargaAdmin(array("prueba 1", "prueba 2"), false);
    $queBD=2;
    $setData=array();
    
        $modoRtm->getDatEngIndex(
            array(
                "querys" => array(
                    "destino" => "constante",
                    "variable" => "inicio",
                    "carga" => "datosAcceso.php"
                ),
                "trace" => array(
                    $_SERVER["SERVER_NAME"],
                    "mydata/engine",
                    __FILE__
                )
            ),
        );
    
    $conn = new getCURL(array("destino" => "constante", "variable" => "inicio", "carga" => "datosAcceso.php"), array($_SERVER["SERVER_NAME"], "mydata/engine", __FILE__), false);
    $conn->setFLow(false, false);
    try{
        $modoRtm->registroMod("Hola mundo puesta a prueba conexion en " . __FILE__ . " => " . __LINE__);    
        $setData=$defConn->dameDatos($conn, false);

        if($setData["E"][0]){
            $modoRtm->registroMod("Adios mundo cruel procesado de error en " . __FILE__ . " => " . __LINE__);    
            throw new Exception(json_encode($setData));
        }
        $modoRtm->registroMod("Hola mundo prueba exitosa conexion en " . __FILE__ . " => " . __LINE__);    
    }catch(Exception $e){
        $modoRtm->registroMod("getMessage() Interrupcion en " . __LINE__ . " ruta " . __FILE__);
        $modoRtm->registroMod(json_decode($e->getMessage(), true));
        $modoRtm->registroMod("mostrando matriz de error");
        $modoRtm->salidaModo();
        exit;
    }finally{

    }
    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);
    $tipoCnn="";
    $tipoCnn="carga";
    $modoRtm->registroMod("Hola mundo " . __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod(json_encode($setData), true);
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
    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);    

    $adminCrud = new conexion($setData, false);
    $booConn = $adminCrud->verificaConn($conn, false, "load");
    echo "hola mundo 2a". __LINE__ ."<br>\n";
    exit;
    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);
    

    $dinamicaAPP = new dinamica\dinamicaAPP();
    $ruta=$dinamicaAPP->dinamica($booConn);
    try {
        if(!file_exists(BASE_PATH . $ruta)){
            throw new Exception("Revisa ruta: ".$ruta);
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->registroMod("Adios mundo cruel Error en" . __FILE__ . " => " . __LINE__);        
        $modoRtm->registroMod(json_encode($booConn));
        $modoRtm->salidaModo();
        exit;
    }finally{
        
    }

    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);
    
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
    $modoRtm->registroMod("Hola mundo procesado de conexion en " . __FILE__ . " => " . __LINE__);
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
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        $modoRtm->registroMod("Adios mundo cruel: Error en la administracion de la conexion");
        $modoRtm->registroMod(json_encode($conn));
        exit;
    }
    $modoRtm->registroMod("Hola mundo saliendo de " . __FILE__ . " => " . __LINE__);
    
    //FIN ------------------------analizar codigo------------------------------------ FIN

    //$con_St = myDatEngIndex(); // require_once("mydata/engine/index.php");

//    use practicasAPP\salidaFinVista;
    $renderVista = new salidaFinVista(false);
    //$renderVista = new box_01\salidaFinVista(false);
    $SalidaHTML=array();    
    $SalidaHTML=$renderVista->salida_HTML_final($booConn, false);
    
    //echo "registros integrados de la pagina: ".count($SalidaHTML)."<br>\n";
    //echo $SalidaHTML."<br>\n";
    if(!file_exists(BASE_PATH . $ruta)){
        $modoRtm->registroMod($ruta);
        exit;
    }
    $normalRender=true;

    flush();
    $modoRtm->salidaModo();
    if($normalRender){
        if(is_array($SalidaHTML)){
            if(isset($SalidaHTML["A"][0])){
                if(is_bool($SalidaHTML["A"][0])){
                    if(($SalidaHTML["A"][0] && $SalidaHTML["D"][0]) || $SalidaHTML["E"][0]){
                        //echo "Modo depuracion <br>\n";
                        foreach($SalidaHTML["C"] as $idVal => $valEnd){
                            echo $valEnd . "<br>\n";
                        } 
                    }
                }else {
                    //echo "Modo render <br>\n";
                    foreach($SalidaHTML["C"] as $idVal => $valEnd){
                        echo $valEnd;
                    } 
                }
            }else{
                foreach($SalidaHTML as $idVal => $valEnd){
                    echo $valEnd;
                } 
            }
        }else{
            echo "Error de erroes <br>\n";
        }
    }else{

    }