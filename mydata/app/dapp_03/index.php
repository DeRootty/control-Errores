<?php declare(strict_types=1);

    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    $dirMe = explode("/", __DIR__);
    if((isset($_GET["var"]) && $_GET["var"]==$dirMe[count($dirMe)-1]) && (!isset($_GET["exec"]) && empty($_GET["exec"]))){
        $salida= json_encode(array(
            array(
                "respuesta",
                'ruta',
                'postPath',
                "launchLoad",
                "localServer",
                'base_URI',
                'exec',
                'var',
                'EOIX'
                ),
            array(
                "ok, conectado",
                __DIR__,
                '/mydata/app/' . $_GET["var"],
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'var=' . $_GET["var"],
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
        $salida= json_encode(array(
            array(
                'respuesta',
                'ruta',
                'postPath',
                "launchLoad",
                "localServer",
                'base_URI',
                "exec",
                'idUser',
                'EOIX'
                ),
            array(
                "ok, conectado",
                __DIR__,
                '/apps',
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'app=' . $dirMe[count($dirMe)-1],
                '/apps/00_sendme/' . 'main.php',
                '/apps/00_sendme/' . 'login.php',
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
header('Location: /error/index.html');
exit;

echo "Estas en la pagina en construccion de la pasarela de pagos ";
exit;

define('PAGE_NAME', 'index');
define('SM_PATH','../');
try{    
    if(file_exists(SM_PATH . "admin/controller/whoami.php")){
        require_once(SM_PATH . "admin/controller/whoami.php");
    }else{
        throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);            
    }
}catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    exit;
}

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
        //header('Location: src/login.php?'.$branch."=".$randomStr[0]["val"][0]."&error"=$randomStr[1]["val"][0]);
    }else{
        throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
    }
}catch(Exception $e){
    echo "Archivo en construccion<br>\n";
    exit;
}