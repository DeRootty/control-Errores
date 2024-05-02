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
    }
    header("Content-Type: application/json");
    echo $salida;
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
    $adminCrud = new conexion(false);
    $ii=1;
    echo "entorno<br>\n";
    echo "<pre>";
    print_r($retorno);
    echo "</pre>";
    $launchDataConn=array();
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
    
    echo "launch data conn<br>\n";
    echo "<pre>";
    $dappDataConn=array();
    #se obtienen los permisos
    foreach($launchDataConn as $idVal => $valEnd){
        //Obtenemos respuesta 'remota' de nivel 1
        $passTo = $testingConn->pruebas($valEnd);
        //Resolvemos crear matriz de referencias: Convertimos $passTo a una sola matriz: Entidad => Valor
        $passBack = $modoRtm->getDatEngDAPP($passTo, true);
        if(!in_array('ok, conectado', $passBack)){
            exit('conexion fallida');
        }else{
            echo 'conexion establecida, recuperando datos nivel 1 <br>'."\n";
        }
        array_push($dappDataConn, $passBack);
    }
    echo "</pre>";
    echo "dapp data conn<br>\n";
    echo "<pre>";
    print_r($dappDataConn);
    echo "</pre>";
    //exit;
    $subDappConn=array();
    foreach($dappDataConn as $idVal => $valEnd){
        //Obtenemos respuesta 'remota' de nivel 2
        $passTo = $testingConn->pruebas($valEnd);
        //Resolvemos crear matriz de referencias: Convertimos $passTo a una sola matriz: Entidad => Valor
        $passBack = $modoRtm->getDatEngDAPP($passTo, false);
        if(!in_array('ok, conectado', $passBack)){
            exit('conexion fallida');
        }else{
            echo 'conexion establecida, recuperando datos nivel 2 <br>'."\n";
        }
        array_push($subDappConn, $passBack);
    }
    echo "sub dapp conn<br>\n";
    echo "<pre>";
    print_r($subDappConn);
    echo "</pre>";
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
