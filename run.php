<?php  declare(strict_types=1);

/**
 * @copyright 2024 Control de flujo del mapa web
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: run.php 14084 2024-04-21 17:28:03Z pdontthink $
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

  namespace practicasAPP\run;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo "iniciando logica...<br>\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    if(isset($_GET["init__"]) && $_GET["init__"]=="ok"){
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
                'run.php',
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
    use practicasAPP\test;
    use practicasAPP\admin\rootsysBD\cargaAdmin;
    use practicasAPP\mydata\engine\accion\getCURL;
    use practicasAPP\admin\conecta\conexion;
    
    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel: Violacion del acceso al archivo ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
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
    $queBD=2;
    $dataConn = array(
        'ruta' => $queArchivo,
        "localServer" => $_SERVER['SERVER_NAME'],
        "base_cURL" => '/mydata/engine',
        "launchLoad" => '/datosAcceso.php',
        "base_URI" => 'inicio=constante&basePath=' . __DIR__
    );
    //$testingConn = new test\testVal($dataConn);
    $retorno = $modoRtm->getDatEngEntorno($testingConn->pruebas($dataConn));
    try{
        if(in_array('Error', $retorno)){
            $test = json_encode(array(
                'Estado' => 'Error',
                'IX_deploid' => 'retorno',
                'dataConn' => $dataConn,
                'trace_inherit' => $retorno,
                'Funcion' => 'require_flow',
                'Clase' => 'null_instance',
                'Especial' => 'no_traits',
                'FileLoad' => __FILE__,
                'Linea' => __LINE__
            ));
            throw new Exception($test);
        }
    } catch (Exception $ex) {
        $error = json_decode($ex->getMessage(),true);
        echo '<h2>Ejemplo de traza completa de un error: </h2><br>'."\n";
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        echo 'Notas por aniadir.<br>'."\n";
        exit;
    }
    unset($error);
    $adminCrud = new conexion(false);
    $ii=1;
    $launchDataConn=array();
    /*START ------------------------------- preparar para un call back ---------------------------------- START*/
    #Se montan las rutas
    foreach($retorno as $idVal => $valEnd){
        $defrag = array();
        $ii++;
        $defrag = explode("/", $valEnd);
        $archivo = array_pop($defrag);
        $localServer = array_shift($defrag);
        $base = implode("/", $defrag);
        array_push($launchDataConn, 
            array(
                'ruta' => BASE_PATH,
                "localServer" => $localServer,
                "base_cURL" => '/'. $base,
                "launchLoad" => '/' . $archivo,
                "base_URI" => 'var=' . $idVal . '&basePath=' . BASE_PATH,
                'exec' => 'hash'
            )
        );
    }
    try{
        if(!empty($error)){
            throw new Exception('Abortando la linea de ejecucion principal');
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        exit;
    }
    unset($error);
    $dappDataConn=array();
    #se obtienen los permisos
    echo 'Estableciendo conexion, recuperacion de datos de 1er nivel, IDs -> '.' <br>'."\n";
    foreach($launchDataConn as $idVal => $valEnd){
        //Obtenemos respuesta 'remota' de nivel 1
        $passTo = $testingConn->pruebas($valEnd);
        //Resolvemos crear matriz de referencias: Convertimos $passTo a una sola matriz: Entidad => Valor
        $passBack = $modoRtm->getDatEngDAPP($passTo, true);
        try{
            if(!in_array('ok_conectado', $passBack)){
                $test = json_encode(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'conexion fallida en la recuperacion de datos de 1er nivel. Intento en el ID -> '.$idVal,
                    'Funcion' => 'require_flow',
                    'Clase' => 'null_instance',
                    'Especial' => 'no_traits',
                    'launchDataConn' => $launchDataConn,
                    'passTo' => $passTo,
                    'IX_deploid' => $passBack,
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__
                ));
                throw new Exception($test);
            }else{
                echo $idVal . '_';
            }
        } catch (Exception $ex) {
            $error = json_decode($ex->getMessage(),true);
            break;
        }
        array_push($dappDataConn, $passBack);
    }
    echo ' <br>'."\n";
    try{
        if(!empty($error)){
            throw new Exception('Abortando la linea de ejecucion principal');
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        exit;
    }finally{
        
    }
    unset($error);
    $subDappConn=array();
    echo 'Estableciendo conexion, recuperacion de datos de 2do nivel, IDs -> '.' <br>'."\n";
    foreach($dappDataConn as $idVal => $valEnd){
        //echo 'Estableciendo conexion para recuperacion de datos de 2do nivel: ID -> '.$idVal.' <br>'."\n";
        //Obtenemos respuesta 'remota' de nivel 2
        $passTo = $testingConn->pruebas($valEnd);
        //Resolvemos crear matriz de referencias: Convertimos $passTo a una sola matriz: Entidad => Valor
        $passBack = $modoRtm->getDatEngDAPP($passTo, false);
        try{
            if(!in_array('ok_conectado', $passBack)){
                $test= json_encode(array(
                    'Estado' => 'Error',
                    'Leyenda' => 'conexion fallida en la recuperacion de datos de 2do nivel.',
                    'ID' => $idVal,
                    'Funcion' => 'require_flow',
                    'Clase' => 'null_instance',
                    'Especial' => 'no_traits',
                    'FileLoad' => __FILE__,
                    'Linea' => __LINE__
                        
                ));
                throw new Exception($test);
            }else{
                echo $idVal .'_';
            }
        } catch (Exception $ex) {
            $error = json_decode($ex->getMessage(), true);
            echo '<pre>';
            print_r($error);
            echo '</pre>';
            exit;
        }
        array_push($subDappConn, $passBack);
    }
    echo ' <br>'."\n";
    try{
        if(!empty($error)){
            throw new Exception('Abortando la linea de ejecucion principal');
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        echo '<pre>';
        print_r($error);
        echo '</pre>';
        exit;
    }
    /*END ------------------------------- preparar para un call back ---------------------------------- END*/
        /*
        echo "Entrada a boo coon por admind crud verificaConn<br>\n";
        //pasamos el arreglo entidad => valor en la construccion del adminCrud
        $booConn = $adminCrud->verificaConn(false, $testingConn, $ii);
        $defrag = array();
        echo "Entrada a defrag por modoRtm getDatEngDAPP 2<br>\n";
        $defrag = $modoRtm->getDatEngDAPP($booConn);
        echo "Entrada a pass to 2<br>\n";
        $passTo = $testingConn->montaBoton($defrag);
        echo "-------------------- pass back " . $idVal . " <br>\n";
        echo "<pre>";
        print_r($passBack);
        echo "boo conn " . " <br>\n";
        print_r($booConn);
        echo "defrag " . " <br>\n";
        print_r($defrag);
        echo "</pre>";
         * 
         */
    
    echo "retorno<br>\n";
    echo "<pre>";
    print_r($retorno);
    echo "</pre>";

    echo "<pre>";
    print_r($launchDataConn);
    echo "</pre>";

    echo "dapp data conn<br>\n";
    echo "<pre>";
    print_r($dappDataConn);
    echo "</pre>";    

    echo "sub dapp conn<br>\n";
    echo "<pre>";
    print_r($subDappConn);
    echo "</pre>";
    exit;
    
    $dinamicaAPP = new dinamica\dinamicaAPP();
    $ruta=$dinamicaAPP->dinamica($booConn);
    echo "hola mundo 2a". __LINE__ ."<br>\n";
    exit;
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
    
    //FIN ------------------------analizar codigo------------------------------------ FIN
