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
    if(empty($_GET) && empty($_POST)){
        //goto pruebaCAB;
        echo "iniciando indices...<br>\n";
        goto iniciando;
    }
    pruebaCAB:
    header("Content-Type: application/json");
    $iid=7145;
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

    if(isset($_GET["init__"])){
        if($_GET["init__"]==firmaThis($iid)){
        //if($_GET["init__"]==firmaThis($iid)){
            $salida= json_encode(array(
                array(
                    "accion",
                    "run",
                    "index",
                    "test",
                    'rutaBase',
                    "EOIX"
                ),
                array(
                    $_POST['localServer'].'/accion.php',
                    $_POST['localServer'].'/run.php',
                    $_POST['localServer'].'/index.php',
                    $_POST['localServer'].'/test.php',
                    $_GET["basePath"],
                    "EOIX"
                ),
                array(
                ),
                'POST' => $_POST
            ));
        }else{
            $salida= json_encode(array(
                array(
                    "respuesta",
                    'Leyenda',
                    'ruta',
                    'base_cURL',
                    "launchLoad",
                    "localServer",
                    'base_URI',
                    'from',
                    'var',
                    'EOIX'
                ),
                array(
                    "Error",
                    'Violacion_de_la_firma',
                    __DIR__,
                    '/Dinamica/fallos',
                    '/index.php',
                    $_SERVER['SERVER_NAME'],
                    'var=index_LOAD&exec=EF_6XX',
                    __FILE__,
                    'EF_600',
                    'EOIX'
                ),
                array(),
                'POST' => $_POST
            ));

        }
        echo $salida;
        exit;
    }else if(isset($_GET["var"]) && $_GET["var"]=="hash_LOAD"){
        $workPath=explode('_', $_GET["var"]);
        $salida= json_encode(array(
            array(
                "respuesta",
                'ruta',
                'base_cURL',
                "launchLoad",
                "localServer",
                'base_URI',
                'exec',
                'var',
                'EOIX'
                ),
            array(
                "ok_conectado",
                __DIR__,
                '/admin/' . $workPath[0] . '/' . $workPath[1],
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'var=' . $_GET["var"] . '&exec='.$_POST["exec"],
                'hash',
                $_GET["var"],
                'EOIX'
                ),
            array(),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else if((isset($_GET["exec"]) && $_GET["exec"]=="hash") && ((isset($_GET["var"]) && $_GET["var"]=="hash_BCK"))){
        $dirMe = explode('_', $_GET["var"]);
        $salida= json_encode(array(
            array(
                'respuesta',
                'ruta',
                'base_cURL',
                "launchLoad",
                "localServer",
                'base_URI',
                "exec",
                'idAdmin',
                'EOIX'
                ),
            array(
                "ok_conectado",
                __DIR__,
                '/apps',
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'app=' . $dirMe[count($dirMe)-1],
                '/admin' . '/' . $dirMe[0] . '/' . $dirMe[1] . '/' . 'main.php',
                '/admin' . '/' . $dirMe[0] . '/' . $dirMe[1] . '/' . 'login.php',
                'EOIX'
                ),
            array(),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else{
        $salida= json_encode(array(
            array(
                "respuesta",
                'ruta',
                'base_cURL',
                "launchLoad",
                "localServer",
                'base_URI',
                'from',
                'var',
                'EOIX'
                ),
            array(
                "Error",
                __DIR__,
                '/Dinamica/fallos',
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'var=index_LOAD&exec=EF_6XX',
                __FILE__,
                'EF_600',
                'EOIX'
            ),
            array(),
            'POST' => $_POST
        ));
        echo $salida;
        exit;        
    }
    
    echo $salida;
    exit;
    //------------------------------------------------------
    iniciando:
    //use admin\conexion;

    use practicasAPP\test;
    use practicasAPP\accion\modos;
    use practicasAPP\init\constante;
    use practicasAPP\admin\conecta\conexion;
    use practicasAPP\admin\rootsysBD\cargaAdmin;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\indexes\box_01\salidaFinVista;

    require_once(__DIR__ . '/test.php');

    $rutaPpal = explode("/", __FILE__);
    $queArchivo = array_pop($rutaPpal);
    
    $dataConn = array(
        'ruta' => $queArchivo,
        "localServer" => $_SERVER['SERVER_NAME'],
        "base_cURL" => '',
        "launchLoad" => '/index.php',
        "base_URI" => 'init__=ok&basePath=' . __DIR__
    );
    #Lanzamos la consexion para obtenr matriz de datos
    $testingConn = new test\testVal($dataConn);
    #Primer callback
    #Revisar el array y el object, pues el array es un arreglo de datos que, ya hemos instanciado en el object
    function init__(object &$testingConn): string{
        $estado = array();

        function comprueba(string &$entrada1, int $ii, array &$estado, string &$check): string{
            $salida= json_decode($entrada1, true);
            $saliendo = array();
            #Control de iteracion del callBack
            if($salida[0][$ii] =='EOIX' || $salida[0][$ii] == 'rutaBase'){
                if($salida[0][$ii] == 'rutaBase'){
                    $ii--;
                    $passOK= json_encode(array(
                        'Estado' => 'ok',
                        'ID_rutaBase' => $ii,
                        'data' => $salida[2]['rutaBase'] . '/' . $salida[0][$ii] . '.php'
                    ));
                    return $passOK;
                }
                $ii--;
                $passOK= json_encode(array(
                    'Estado' => 'ok',
                    'ID_rutaBase' => $ii,
                    'data' => $salida[2]['rutaBase'] . '/' . $salida[0][$ii] . '.php'
                ));
                return $passOK;
            }
            try{
                #Inicio de la formacion de la URI destino
                $check = $salida[2]['rutaBase'] . '/' . $salida[0][$ii] . '.php';
                if(!file_exists($check)){
                    $test= json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => 'Invocacion a carga en vacio',
                        'Funcion' => 'comprueba()',
                        'clase' => 'null_instance_main_flow',
                        'IX_deploID' => $salida,
                        'IX_ID' => 'IX[2]["rutaBase"].IX[0]['.$ii.'].php',
                        'Carga_en_vacio' => $check,
                        'Origen_carga' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new Exception($test);
                }
                #Se aniade a la coleccion de URIs buenas
                $estado[$salida[0][$ii]]=$check;
                $ii++;
                //$salida[3][$salida[0][$ii]]=$check;
                //array_push($estado, $check);
                $entrada1=json_encode($salida);
                $saliendo[$ii] = json_decode(comprueba($entrada1, $ii, $estado, $check), true);
                try{
                    if(in_array('Error', $saliendo)){
                        $test= json_encode(array(
                            'Estado' => 'Error',
                            'Leyenda' => 'Salida de fallo en pruebas',
                            'Funcion' => 'comprueba()',
                            'clase' => 'null_instance_main_flow',
                            'IX_deploid ' . $ii => $saliendo,
                            'Origen_carga' => __FILE__,
                            'Linea' => __LINE__
                        ));
                        throw new Exception($test);
                    }
                } catch (Exception $ex) {
                    return $ex->getMessage();
                }
                //echo $passPath[$ii] . '<br>' . "\n";
                if(in_array('EOIX', $estado)){
                    if($ii > 0){
                        $ii--;
                        $salida= json_encode(array(
                            'Estado' => 'Ok',
                            'data' => 'EOIX',
                            'IX_deploid ' . $ii => $saliendo,
                            'Destino_carga' => $check,
                            'Origen_carga' => __FILE__,
                            'Linea' => __LINE__
                        ));
                        return $salida;
                    }
                }else{
                    if($ii > 0){                    
                        $ii--;
                        $salida= json_encode(array(
                            'Estado' => 'Ok',
                            'data' => 'callback',
                            'IX_deploid ' . $ii => $saliendo,
                            'Destino_carga' => $check,
                            'Origen_carga' => __FILE__,
                            'Linea' => __LINE__
                        ));
                        return $salida;
                    }
                }
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                return $error;
            }finally{

            }
            $salida = json_encode(array(
                'Estado' => 'Ok',
                'data' => 'salida',
                'IX_deploid ' . $ii => $saliendo,
                'Destino_carga' => $check,
                'Origen_carga' => __FILE__,
                'Linea' => __LINE__
            ));
            return $salida;
        }//comprueba

        try{
            if(in_array('Error', $estado)){
                $estado1 = array();
                $estado1 = json_decode($testingConn->getRowConn(), true);
                $test=json_enconde(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'byPassValue',
                    'flowIn' => 'callBack',
                    'RollUp' => 'init__()',
                    'RollDown' => 'comprueba()',
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__,
                    'rowConn' => $estado1,
                    'getFieldConn' => $estado
                ));
                throw new Exception($test);
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        //Obtengo el set de conexion
        $estado1=json_decode($testingConn->getFieldConn(), true);
        try{
            if(in_array('Error', $estado1)){
                $test = json_encode(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'Herencia_error_en_localizacion_de_matriz_de_consultas_curl',
                    'flowIn' => 'main_index_php_callBack',
                    'flowOut' => '$testingConn->getFieldConn()',
                    'RollUp' => 'init__()',
                    'RollDown' => 'comprueba()',
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__,
                    'rowConn' => $estado1,
                    'passNow' => $passNow
                ));
                throw new Exception($test);
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $passNow = json_encode($estado1);
        
        #Le debemos pasar el passConn array
        $salida = json_decode($testingConn->pruebas($passNow), true);
        try{
            $chkError = false;
            if(in_array('Error', $salida)){
                $chkError = true;
            }
            if($chkError){
                $test= json_encode(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'Herencia_error_en_localizacion_de_matriz_de_consultas_curl',
                    'flowIn' => 'main index_php_callBack',
                    'FlouOut' => '$testingConn->pruebas($passNow)',
                    'RollUp' => 'init__()',
                    'RollDown' => 'pre comprueba()',
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__,
                    'rowConn' => $estado1,
                    'passNow' => json_decode($passNow, true)
                ));
                throw new Exception($test);
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        foreach($salida[0] as $idVal => $valEnd){
            if($valEnd == "EOIX"){
                break;
            }
            $salida[2][$valEnd] = $salida[1][$idVal];
        }
        $check='BOIX';
        $entradaDato1 = json_encode($salida);
        $check1 = comprueba($entradaDato1, 0, $estado, $check);
        //La variable $estado lleva asociado un arreglo de todas las rutas que se han verificado como buenas en el servidor
        $idVal = json_decode($check1, true);
        try{
            if(in_array('Error', $idVal)){
                $test= json_encode(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'Comprovacion_de_rutas_fallida',
                    'Funcion' => 'init__()',
                    'FlowOut' => '$check1 = comprueba($entradaDato1, 0, $estado, $check)',
                    'Clase' => 'no_class-Main_flow',
                    $idVal['Estado'] => $idVal['Leyenda'],
                    'Valor_de_retorno:' => $idVal,
                    'IX_Harvesting' => $salida,
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__
                ));
                throw new Exception($test);
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $salida['ok'][] = $estado;
        $salida['ok'][] = $salida[2];
        $salida['traza'] = $idVal;
        return json_encode($salida);
    }//init__
    //se obtiene respuesta, pasando la instancia del objeto
    $veri = json_decode(init__($testingConn), true);
    $ChkError=false;
    try{
        if(in_array('Error', $veri)){
            $ChkError=true;
        }else{
            echo 'verificacion nivel 1: ok<br>'."\n";
        }
        if($ChkError){
            $test = json_encode(array(
                'Estado' => 'Error',
                'IX_deploid' => $veri,
                'dataConn' => $dataConn,
                'FLowOut' => '$veri = json_decode(init__($testingConn), true);',
                'trace_inherit' => 'main_flow_index.php',
                'Funcion' => 'require_flow',
                'Clase' => 'null_instance',
                'Especial' => 'no_traits',
                'FileLoad' => __FILE__,
                'Linea' => __LINE__
            ));
            throw new Exception($test);
        }
    } catch (Exception $ex) {
        $error = json_decode($ex->getMessage(), true);
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        exit;
    }
    //se procesa a matriz local
    $veriff = $testingConn->setPathInit__($veri['ok']);
    if($veriff){
        //accion
        $accionRuta = json_decode($testingConn->getPathInit__(0), true);
        require_once($accionRuta[0]);
    }
    #Instancia del motor de seguridad, modo 1, actividad false.
    $modoRtm = new modos(1, false);
    $modoRtm->registroMod("hola mundo en constructor modos salida " . __FILE__ . " => " . __LINE__);
    
    #se debe aniadir futura funcion de rescate de datos por peticion cURL
    $inicios = array(
        0 => "BOIX",
        # ... del entorno de informacion
        1 => __DIR__ . "/init/index.php", # ... el entorno de informacion
        # ... del root archivo
        2 => __DIR__ . "/init/accion.php", # ... los privilegios del root archivo
        # ... de las definicioenes del motor de identidad informativa
        3 => __DIR__ . "/mydata/engine/index.php", # ... las definiciones del motor de informacion
        # ... de las entradas de accion por las que el motor iniciara el arranque en base a la identidad informativa
        4 => __DIR__ . "/mydata/engine/accion.php", # ... alcance del motor que da coherencia a la logica de la identidad desplegada por el motor.
        5 => "EOIX"
    );
    # Se cargan las especificaciones de los fallos
    function iniciando(int $ii, array &$inicios): array{
        global $modoRtm;
        $salida='';
        if($ii==-1){
            $salida=array();
            foreach($inicios as $idVal => $valEnd){
                if($valEnd=='BOIX'){
                    $salida[$valEnd] = $idVal;
                }else if($valEnd=='EOIX'){
                    $salida[$valEnd] = $idVal - 1;
                }
            }
            return array('min' => $salida['BOIX'], 'max' =>  $salida['EOIX']);
        }
        if($inicios[$ii] != 'EOIX' && $inicios[$ii] != 'BOIX'){
            $modoRtm->registroMod("-----------" . $modoRtm->initIndex($inicios[$ii]), __FILE__ . " => " . __LINE__);
            return array('ok' => $inicios[$ii]);
        }else if($inicios[$ii] == 'EOIX'){
            return array('fin' => $ii);
        }else if($inicios[$ii] == 'BOIX'){
            return array('inicio' => $ii);
        }
    }
    
    $iii=0;
    $tt = iniciando(-1, $inicios);
    $rutaIX = array();
    $i=0;
    for ($iii = $tt['min']; $iii <= $tt['max']; $iii++){
        $rutaIX = iniciando($iii, $inicios);
        if((!isset($rutaIX['inicio']) && !isset($rutaIX['fin'])) && isset($rutaIX['ok'])){
            require_once($modoRtm->salidaModosPath($i));
            $i++;
        }
    }
    # ... a actividad el ambito root
    $dataConn = json_encode(array(
        array(
            'ruta' => $queArchivo,
            "localServer" => $_SERVER['SERVER_NAME'],
            "base_cURL" => '/mydata/engine',
            "launchLoad" => '/datosEntorno.php',
            "base_URI" => 'inicio=constante&basePath=' . __DIR__
        )
    ));
    //Se obtienen los datos en crudo y se pasa a traves del formateador, conteniendolo en la variable $entorno
    $passThrow = $testingConn->pruebas($dataConn);
    $entorno = $modoRtm->getDatEngIndex($passThrow);
    try{
        if(in_array('Error', $entorno)){
            $test = json_encode(array(
                'Estado' => 'Error',
                'IX_deploid' => 'dataConn',
                'dataConn' => $dataConn,
                'trace_inherit' => $entorno,
                'Funcion' => 'main_flow',
                'Clase' => 'null_instance',
                'Especial' => 'no_traits',
                'FileLoad' => __FILE__,
                'Linea' => __LINE__,
            ));
            throw new Exception($test);
        }
    } catch (Exception $ex) {
        $error = json_decode($ex->getMessage(),true);
        echo '<h2>Ejemplo de traza completa de un error: </h2><br>'."\n";
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        echo 'Efectivamente, EOIX undefined, pues el ID apunta a 14 y EOIX tiene como ID 13. 14 no esta definido.<br>'."\n";
        echo 'El arreglo con ID 2 de IX_set, me indica que, se han procesado todos los BOIX, se ha llegado a EOIX, y el bucle no tiene adecuadamente programado el cierre<br>'."\n";
        echo 'Un ejemplo de como recopilar una traza de errores util para ser usada en la depuracion cuando los datos entrantes no cunplen el formato estandar<br>'."\n";
        echo 'Tengo que continuar homologando las entradas, los datos de ejemplo para depurar la logica central, son buenos, pero cuando vario a un set de datos mal formado, el programa es inestable<br>'."\n";
        exit;
    }

    $const_system=$modoRtm->rootIndex($entorno["user"]);
    # Linea de control del run time: Propositos de depuracion.
    $modoRtm->registroMod("Hola mundo en: " . __FILE__ . " => " . __LINE__);
    # Linea de control del run time: Propositos de depuracion.
    $modoRtm->registroMod(
            "-----------" . $modoRtm->salidaModosPath(4));
    #se debe aniadir futura funcion de rescate de datos por peticion cURL
    $definiciones = array(
        4 => "BOIX",
        # Se cargan las especificaciones de los fallos
        5 => "BASE_PATH||FAIL_PATH||/index.php", # ... las especificaciones de los fallos
        # el primer nivel de jail para actividad de root archivo
        6 => "BASE_PATH||INDEX_PATH||/box_00.php", # ... el jail de activodad para el ambito root archivo
        # las conexiones a datos
        7 => "BASE_PATH||ADMIN_PATH||/rootsysBD.php", # ... las conexiones a datos necesarias para la coherencia root
        #los permisos de acceso a datos
        8 => "BASE_PATH||FLOW_PATH||/index.php", # ... las reglas del flujo de datos
        #los usuarios y sus categorias en relacion al jail de primer nivel
        9 => "BASE_PATH||ADMIN_PATH||/conexion.php", # ... las identidades permitidas en el ambito jail de primer nivel definido y cargado
        #el jail de segundo nivelpara dotar de coherencia a las DAPP futuras
        10 => "BASE_PATH||INDEX_PATH||/box_01.php", # ... el jail de segundo nivel, que permitira ir cargadno las DAPP
        11 => "EOIX"
    );
    # Se cargan las especificaciones de los fallos
    function definicion(int $ii, array &$definiciones): array{
        global $modoRtm;
        $salida='';
        if($ii==-1){
            $salida=array();
            foreach($definiciones as $idVal => $valEnd){
                if($valEnd=='BOIX'){
                    $salida[$valEnd] = $idVal + 1;
                }else if($valEnd=='EOIX'){
                    $salida[$valEnd] = $idVal - 1;
                }
            }
            return array('min' => $salida['BOIX'], 'max' =>  $salida['EOIX']);
        }
        # Se cargan las especificaciones ...
        $passTrhow = $modoRtm->pathPassThrow(CONST_USR, $definiciones[$ii]);
        $pathInit = $modoRtm->entradaPathInit($passTrhow, __FILE__ . " => " . __LINE__, true);
        $modoRtm->registroMod("-----------" . $pathInit);
        #Lanzadores: 
        return array('ok' => $modoRtm->salidaModosPath($ii));
    }
    $iii=0;
    $tt = definicion(-1, $definiciones);
    $rutaIX=array();
    for ($iii=$tt['min']; $iii<=$tt['max']; $iii++){
        $rutaIX = definicion($iii, $definiciones);
        require_once($rutaIX['ok']);
    }
    # Se espera que el sistema este activo para que root archivo pueda pivotar actividad en el front
    # y permitir a los usuarios desplegar sus configuraciones
    //INICIO ---------------------------analizar codigo------------------------------ INICIO
    //require_once(init__(__DIR__ . '/run.php'));
    $accionRuta=json_decode($testingConn->getPathInit__(1), true);
    require_once($accionRuta[0]);
    //require_once($testingConn->getPathInit__(0));
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