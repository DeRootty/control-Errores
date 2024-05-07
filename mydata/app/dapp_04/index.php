<?php declare(strict_types=1);

    namespace practicasAPP\myData\app\dapp_00;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo 'iniciando ' . $nameHead . '<br>' . "\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    $dirMe = explode("/", __DIR__);
    $iid = 9247;
    if((isset($_GET["var"]) && $_GET["var"]==$dirMe[count($dirMe)-1]) && (!isset($_GET["exec"]) && empty($_GET["exec"]))){
        $salida= json_encode(array(
            array(
                "respuesta",
                'nivel',
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
                 $iid . ':_1ero',
                __DIR__,
                '/mydata/app/' . $_GET["var"],
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
    }else if(isset($_GET["exec"]) && $_GET["exec"]=="hash"){
        $dirMe = explode('_', $_GET["var"]);
        $salida= json_encode(array(
            array(
                'respuesta',
                'nivel',
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
                 $iid . ':_2do',
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
    }
        $salida= json_encode(array(
            array(
                "respuesta",
                'ruta',
                'EOIX'
                ),
            array(
                "error",
                'redirije pagina error',
                'EOIX'
                ),
            array(),
            'POST' => $_POST
        ));
    echo $salida;
    exit;
iniciando:
    header('Location: /error/index.html');
    exit;
    if(!defined('PAGE_NAME')){
        define('PAGE_NAME', 'index');
    }
    define('SM_PATH','../');
    try{    
        if(require_once(SM_PATH . "admin/controller/whoami.php")){
            if(file_exists(SM_PATH . "admin/controller/whoami.php")){
                header('Location: /error/index.html');
            }
        }else{
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);            
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    //echo "Estas en la pagina en construccion de mas informacion ";
    exit;
    try{
        $miNombre=new queScript(__FILE__);
        if(!$miNombre->status){
            throw new Exception('No se admiten argumentos vacios');
        }else{
            $miNombre->iknowiam=$miNombre->nombreScript($miNombre);
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    try{
        if($miNombre->iknowiam!==$_POST["formType"]){
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
        }else{
            try{
                if(file_exists(SM_PATH . "admin/stamp.php")){
                    require_once(SM_PATH . "admin/stamp.php");
                }else{
                    throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
                }
            }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                exit;
            }
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    if( ! file_exists ( 'config/config.php' ) ) {
        $branch="error";
        //exit;
    }else{
        $branch="ok";
    }


    try{
        if(isset($_POST)){
            header('Location: src/login.php?'.$branch."=".$randomStr[0]["val"][0]."&".$branch."=".$randomStr[1]["val"][0]);
        }else{
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
        }
    }catch(Exception $e){
        echo "Archivo en construccion<br>\n";
        exit;
    }

