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

            //[10] => www.derootty.xyz/index.php?var=
  namespace practicasAPP;
    use Exception;
    //use admin\conexion;
    use practicasAPP\test;
    use practicasAPP\accion\modos;
    use practicasAPP\init\constante;
    use practicasAPP\admin\conecta\conexion;
    use practicasAPP\admin\rootsysBD\cargaAdmin;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\indexes\box_01\salidaFinVista;
    
    require_once(__DIR__ . '/test.php');

    goto iniciando;
    if(count($_GET)<1){
        goto iniciando;
    }
    if(isset($_GET["var"]) && $_GET["var"]=="hash_LOAD"){
        $salida= json_encode(array(
            "respuesta" => "ok, conectado"
        ));
        echo $salida;
        exit;
    }
    
    iniciando:

    function init__(string $passPath): string{
        $salida = "";
        try{
            if(!file_exists($passPath)){
                throw new Exception("Adios mundo cruel: Invocacion a carga en vacio" . __FILE__ . " => ". __LINE__);
            }
            $salida = $passPath;
        } catch (Exception $ex) {
            exit($ex->getMessage());
        }finally{
            
        }

        return $salida;
    }
    
    require_once(init__(__DIR__ . '/accion.php'));

    #Instancia del motor de seguridad, modo 1, actividad false.
    $modoRtm = new modos(1, false);
    $modoRtm->registroMod("hola mundo en constructor modos salida " . __FILE__ . " => " . __LINE__);

    //Definiciones:
    # ... del entorno de informacion
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/init/index.php"), __FILE__ . " => " . __LINE__);
    
    # ... del root archivo
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/init/accion.php"), __FILE__ . " => " . __LINE__);
    
    # ... de las definicioenes del motor de identidad informativa
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/mydata/engine/index.php"), __FILE__ . " => " . __LINE__);
    
    # ... de las entradas de accion por las que el motor iniciara el arranque en base a la identidad informativa
    $modoRtm->registroMod("-----------" . $modoRtm->initIndex(__DIR__ . "/mydata/engine/accion.php"), __FILE__ . " => " . __LINE__);
    
    //Desplegando:
    # ... el entorno de informacion
    require_once($modoRtm->salidaModosPath(0));
    
    # ... los privilegios del root archivo
    require_once($modoRtm->salidaModosPath(1));    
    
    # ... las definiciones del motor de informacion
    require_once($modoRtm->salidaModosPath(2));
    
    # ... alcance del motor que da coherencia a la logica de la identidad desplegada por el motor.
    require_once($modoRtm->salidaModosPath(3));
    //Lanzadores:
    # ... a actividad el ambito root
    
    $rutaPpal = explode("/", __FILE__);
    $queArchivo = array_pop($rutaPpal);

    $dataConn = array(
        'ruta' => $queArchivo,
        "localServer" => $_SERVER['SERVER_NAME'],
        "base_cURL" => '/mydata/engine',
        "launchLoad" => '/datosEntorno.php',
        "base_URI" => 'inicio=constante&basePath=' . __DIR__
    );
    $testingConn = new test\testVal($dataConn);

    //Se obtienen los datos en crudo y se pasa a traves del formateador, conteniendolo en la variable $entorno
    $entorno = $modoRtm->getDatEngIndex($testingConn->pruebas($dataConn));
    $const_system=$modoRtm->rootIndex($entorno["user"]);
    
    # Linea de control del run time: Propositos de depuracion.
    $modoRtm->registroMod("Hola mundo en: " . __FILE__ . " => " . __LINE__);
    
    # Linea de control del run time: Propositos de depuracion.
    $modoRtm->registroMod(
            "-----------" . $modoRtm->salidaModosPath(4));

    # Se cargan las especificaciones de los fallos
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathFailIndex(
            CONST_USR, "BASE_PATH||FAIL_PATH||/index.php"), __FILE__ . " => " . __LINE__ ));
    
    # Se define el primer nivel de jail para actividad de root archivo
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(
            CONST_USR, "BASE_PATH||INDEX_PATH||/box_00.php"), __FILE__ . " => " . __LINE__ ));

    # Se definen las conexiones a datos
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(
            CONST_USR, "BASE_PATH||ADMIN_PATH||/rootsysBD.php"), __FILE__ . " => " . __LINE__ ));

    # Se definen los permisos de acceso a datos
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(
            CONST_USR, "BASE_PATH||FLOW_PATH||/index.php"), __FILE__ . " => " . __LINE__));

    # Se definen los usuarios y sus categorias en relacion al jail de primer nivel
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(
            CONST_USR, "BASE_PATH||ADMIN_PATH||/conexion.php"), __FILE__ . " => " . __LINE__ ));

    # Se define el jail de segundo nivelpara dotar de coherencia a las DAPP futuras
    $modoRtm->registroMod("-----------" . $modoRtm->entradaPathInit($modoRtm->pathPassThrow(
            CONST_USR, "BASE_PATH||INDEX_PATH||/box_01.php"), __FILE__ . " => " . __LINE__ ));
    
    //Lanzadores: 
    # ... las especificaciones de los fallos
    require_once($modoRtm->salidaModosPath(5));
    
    # ... el jail de activodad para el ambito root archivo
    require_once($modoRtm->salidaModosPath(6));

    # ... las conexiones a datos necesarias para la coherencia root
    require_once($modoRtm->salidaModosPath(7));

    # ... las reglas del flujo de datos
    require_once($modoRtm->salidaModosPath(8));

    # ... las identidades permitidas en el ambito jail de primer nivel definido y cargado
    require_once($modoRtm->salidaModosPath(9));

    # ... el jail de segundo nivel, que permitira ir cargadno las DAPP
    require_once($modoRtm->salidaModosPath(10));
    
    # Se espera que el sistema este activo para que root archivo pueda pivotar actividad en el front
    # y permitir a los usuarios desplegar sus configuraciones
    //INICIO ---------------------------analizar codigo------------------------------ INICIO

    
    require_once(init__(__DIR__ . '/run.php'));

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