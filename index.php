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
    use practicasAPP\init\constante;
    use practicasAPP\mydata\engine\getCURL;
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
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        if(!isset($_SERVER["SERVER_NAME"])){
            throw new Exception("Problemas con las variables superglobales <br>\n" . "Superglobales disponibles: <br>\n");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        echo "hola mundo en superglobales ok " . __FILE__ . " => " . __LINE__ . "<br>\n";
        echo "-----Registrando clase de modos <br>\n";
        class modos{
            public array $initMode;
            public array $statusRunTime;
            private int $mode;
            public function __construct(int $mod){
                $this->initMode=array(
                    "check",
                    "depuracion",
                    "produccion"
                );
                $this->mode=$mod;
                $this->statusRunTime=array();
            }
            public function registroMod(string $entrada): int{
                if(empty($entrada)){
                    echo "Error llamada<br>\n";
                    exit;
                }
                $evalua = array();
                $evalua = json_decode($entrada, true);
                if(is_array($evalua)){
                    unset($entrada);
                    $entrada = array("error" => array());
                    foreach($evalua as $idVal => $valEnd){
                        array_push($entrada["error"], $valEnd);
                    }
                    array_push($this->statusRunTime, $entrada);
                }else{
                    unset($evalua);
                    array_push($this->statusRunTime, $entrada);
                }
                return 0;
            }
            public function salidaModo(){
                if(!$this->initMode[$this->mode]=="depuracion"){
                    return -1;
                }
                echo "<pre>";
                print_r($this->statusRunTime);
                echo "</pre>";
            }            
        }
        $modoRtm = new modos(1);
    }
    $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod("-----Registrando clase de inicio");
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/init/index.php")){
            throw new Exception("Adios mundo cruel: Violacion de inicio" . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        require_once "/srv/vhost/derootty.xyz/home/html/init/index.php";
    }

    $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
    try{
        $rutaBoot="/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php";
        if(!file_exists($rutaBoot)){
            throw new Exception("No se ha cargado el indexador de accesos||" . $rutaBoot . "<br>\n");
        }
    }catch(Exception $ex){
        $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        
        $modoRtm->registroMod("hola mundo: ". "cargamos el motor de entorno" ." en " . __FILE__ . " => " . __LINE__);
        require_once("/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php");
        $queryCURL=new getCURL(array("destino" => "constante", "variable" => "inicio", "carga" => "datosEntorno.php"), array($_SERVER["SERVER_NAME"], "mydata/engine", __FILE__), false);

        //Se inicia encendido del motor
        $queryCURL->setFLow(false, false);

        //getCURL es usado para obtener los datos de entorno: las constantes
        //A futuro, la misma clase tambien sera usada para obtener los permisos de carga de las apps
        $defcon = new constante(__FILE__, $queryCURL);
        //$defcon = new init\constante(__FILE__, $queryCURL);
        $modoRtm->registroMod("hola mundo antes de registrar los resultados del motor " . __FILE__ . " => " . __LINE__);
    }
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
    $modoRtm->registroMod("hola mundo Definimos el indice general de constantes para la gestion de la dapp " . __FILE__ . " => " . __LINE__);
    $con_St=get_defined_constants(true);
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
        define("CONST_USR", $con_St["user"]);
        unset($con_St);
        $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
    }
    
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
        exit;
    }finally{
        $modoRtm->registroMod("hola mundo se otorgan las funciones para gestionar el root de index " . __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod("----- hola mundo para la administracion del flujo " . BASE_PATH . FAIL_PATH . "/index.php");
        require_once BASE_PATH . FAIL_PATH . "/index.php";
    }
    $modoRtm->registroMod("hola mundo cuando ya tenemos el file root configurado " . __FILE__ . " => " . __LINE__);
    
    $modoRtm->registroMod("hola mundo verificando que el entorno recae sobre root index " . __FILE__ . " => " . __LINE__);
    try{
        if(CONST_USR < 1){
            $describeException="Violacion de acceso a entorno ";
            throw new Exception($describeException);
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
        function montaRuta(array $ixUsr,string $match1,string $match2,string $catalogo): string{
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
            $rutaRequerida=$ruta1.$ruta2.$catalogo;
            if(!file_exists($rutaRequerida)){
                throw new Exception("<br>Error en localizacion del archivo en funcio montaRuta()".__NAMESPACE__." ".__LINE__."<br>\n"." verifica: ".$rutaRequerida."<br>\n");
            }
            $modoRtm->registroMod("Ruta ok ".__FILE__ . " => " .__LINE__);
            return $rutaRequerida;
        }
    
    }catch (Exception $ex){
        $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        $describeException="";
        exit;
    }finally{
        //Evaluacion de modulos indice para la carga de la web
        $requerido = montaRuta(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_00.php");
        //echo $requerido . "<br>\n";
        $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        try{
            $describeException="";
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
            $modoRtm->registroMod("accediendo a " . $requerido);
            require_once($requerido);
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        }
        $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        //Evaluacion de modulos de identidad para la carga de la web
        try{
            $requerido = montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/rootsysBD.php");
            $describeException = "";
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
        } finally {
            $modoRtm->registroMod(__LINE__ . " finalmente: " . $requerido);
            require_once($requerido);
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        }
        //$queryCURL;
        //$conn = mysqli_init();
        $incluir = montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/conexion.php");
        $modoRtm->registroMod("Incluyendo 2 " . $incluir);
        require_once($incluir);
        $modoRtm->registroMod("Incluido 2 " . $incluir);
        $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        //Evaluacion de modulos indice para la carga de la web
        try{
            $requerido= montaRuta(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_01.php");
            $describeException="";
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
            $modoRtm->registroMod("finalmente: ");
            require_once ($requerido);
            $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
        }
    }   

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