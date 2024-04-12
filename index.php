<?php  declare(strict_types=1);

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
    use practicasAPP\init\constante;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\indexes\box_01\salidaFinVista;
    use admin\conexion;
    //use modos;
    //use box_00;
    //use rootsysBD;
    //use box_01;
    
    //use mydata\engine\getCURL;
    //use practicasAPP\init\constante;
    //use practicasAPP\mydata\engine\getCURL;
    //use practicasAPP\indexes\box_01\salidaFinVista;
    //use admin\conexion;
    //use modos;


    //use practicasAPP\rootsysBD;
    //use mydata\engine;

    
    
    
    
    trait callBackInit {
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

        function getDatEngIndex(){
            global $modoRtm;
            $modoRtm->registroMod("hola mundo: ". "cargamos el motor de entorno" ." en " . __FILE__ . " => " . __LINE__);
            //require_once ("init/index.php");
            ///srv/vhost/derootty.xyz/home/html/mydata/engine/index.php

            //getCURL es usado para obtener los datos de entorno: las constantes
            $queryCURL=new getCURL(array("destino" => "constante", "variable" => "inicio", "carga" => "datosEntorno.php"), array($_SERVER["SERVER_NAME"], "mydata/engine", __FILE__), false);

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
                $modoRtm->salidaModo();
                exit;
            }finally{

            }
            define("CONST_USR", $con_St["user"]);
            unset($con_St);
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
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
                if(!file_exists(BASE_PATH . FAIL_PATH . "/index.php")){
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

            }
            $modoRtm->registroMod("hola mundo se otorgan las funciones para gestionar el root de index " . __FILE__ . " => " . __LINE__);
            $modoRtm->registroMod("----- hola mundo para la administracion del flujo " . BASE_PATH . FAIL_PATH . "/index.php");
            $modoRtm->registroMod("hola mundo cuando ya tenemos el file root configurado " . __FILE__ . " => " . __LINE__);
            
            $modoRtm->entradaPathInit(BASE_PATH . FAIL_PATH . "/index.php", __FILE__ . " => " . __LINE__);
            return BASE_PATH . FAIL_PATH . "/index.php";
        }

        function pathFailIndex(string $applyPath, bool $requireSuccess): string{
            global $modoRtm;
            $pathInit = explode("||", $applyPath);
            require_once($pathInit[0] . $pathInit[1] . $pathInit[2]);
            $modoRtm->registroMod("hola mundo verificando que el entorno recae sobre root index " . __FILE__ . " => " . __LINE__);
            try{
                if(CONST_USR < 1){
                    $describeException="Violacion de acceso a entorno ";
                    throw new Exception($describeException);
                }
                if(!$requireSuccess){
                    throw new Exception($describeException);
                }

            }catch (Exception $ex){
                $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
                $modoRtm->registroMod($ex->getMessage());
                $modoRtm->salidaModo();
                $describeException="";
                exit;
            }finally{

            }   
            return $pathInit;
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
            $modoRtm->entradaPathInit($rutaRequerida, __FILE__ . " => " . __LINE__);
            if(!file_exists($rutaRequerida)){
                throw new Exception("<br>Error en localizacion del archivo en funcio montaRuta()".__NAMESPACE__." ".__LINE__."<br>\n"." verifica: ".$rutaRequerida."<br>\n");
            }
            
            $modoRtm->registroMod("Ruta ok ".__FILE__ . " => " .__LINE__);
            return $rutaRequerida;
        }
        //Evaluacion de modulos indice para la carga de la web
        function pathPassThrow(array $splitIX, string $passPath): string{
            global $modoRtm;
            $applyPath = explode("||", $passPath);
            //Evaluacion de modulos indice para la carga de la web
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
            try{
                $describeException="";
                $requerido = montaRuta($splitIX, $applyPath[0], $applyPath[1], $applyPath[2]);
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
        public static array $pathResolve;
        private int $mode;
        private int $passThrow;
        use callBackInit;
        
        public function __construct(int $mod){
            self::$statusRunTime = array();
            array_push(self::$statusRunTime, "hola mundo en constructor modos entrada " . __FILE__ . " => " . __LINE__);
            self::$pathResolve = array();
            $this->passThrow = -1;
            $this->setStepByStep = array();
            
            $this->initMode=array(
                "check",
                "depuracion",
                "produccion"
            );
            
            try{
                if(!isset($_SERVER["SERVER_NAME"])){
                    throw new Exception("Adios mundo cruel: " . __FILE__ . " => " . __LINE__ . " Problemas con las variables superglobales <br>\n" . "Superglobales disponibles: <br>\n");
                }
            } catch (Exception $ex) {
                array_push(self::statusRunTime, $ex->getMessage());
                exit($modoRtm->salidaModo());
            }finally{

            }
            $this->mode=$mod;
            self::$statusRunTime=array();
        }
        public function registroMod(string $entrada): int{
            try{
                if(empty($entrada)){
                    throw new Exception("Los valores esperados no se han establecido");
                }
            } catch (Exception $ex) {
                array_push(self::$statusRunTime, "Adios mundo cruel: fallo en " . __FILE__ . " => " . __LINE__);
                array_push(self::$statusRunTime, "-----Salida en excepcion"  . ": " . $ex->getMessage());
                exit($modoRtm->salidaModo());
            }finally{

            }
            $evalua = array();
            $evalua = json_decode($entrada, true);
            if(is_array($evalua)){
                unset($entrada);
                $entrada = array("error" => array());
                foreach($evalua as $idVal => $valEnd){
                    array_push($entrada["error"], $valEnd);
                }
                array_push(self::$statusRunTime, $entrada);
            }else{
                unset($evalua);
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
                    print_r(self::$pathResolve1);
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
            if(!$this->initMode[$this->mode]=="depuracion"){
                return -1;
            }
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
            }


            $salida.= "||Registro en ruta despues: " . count(self::$pathResolve);
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
    

    


    $modoRtm = new modos(1);
    $modoRtm->registroMod("hola mundo en constructor modos salida " . __FILE__ . " => " . __LINE__);
    //$modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/init/index.php"), __FILE__ . " => " . __LINE__ ));
    //$modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php"), __FILE__ . " => " . __LINE__ ));
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/init/index.php"), __FILE__ . " => " . __LINE__ );
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex("/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php"), __FILE__ . " => " . __LINE__ );

    echo "<pre>";
    print_r(modos::$pathResolve);
    echo "</pre>";
    exit;
    
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->getDatEngIndex(), __FILE__ . " => " . __LINE__ ));


    
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathFailIndex(CONST_USR, "BASE_PATH||FAIL_PATH||/index.php", rootIndex()), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_00.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/rootsysBD.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/conexion.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_01.php"), __FILE__ . " => " . __LINE__ ));

    $modoRtm->salidaModo();
    exit;
    echo "Hasta aqui bien";
    exit;
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