<?php declare(strict_types=1);
            //[7] => www.derootty.xyz/indexes/index.php?var=
    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    $dirMe = explode("/", __DIR__);
    $iid = '2314';
    if((isset($_GET["var"]) && $_GET["var"]=="hash_DAP") && (!isset($_GET["exec"]) && empty($_GET["exec"]))){
        $dirMe = explode('_', $_GET["var"]);
        //respuesta de primer nivel: Obtiene los permisos
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
                 $iid . ': 1ero',
                __DIR__,
                '/admin/' . $dirMe[0] . '/' . $dirMe[1],
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
    }else if((isset($_GET["exec"]) && $_GET["exec"]=="hash") && ((isset($_GET["var"]) && $_GET["var"]=="hash_DAP"))){
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

   
    //namespace indexes;
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    try{
        if(count(CONST_USR) == 0 || !defined("CONST_USR")){
            throw new Exception("El archivo al que estas invocabdo, " . __NAMESPACE__ . " >> " . __LINE__ . " no hereda los permisos de ejecucion en 8");
        }
        foreach(CONST_USR as $idVal => $valEnd){
            if((BASE_PATH != $valEnd) && (ROOT_INDEX != $valEnd) ){
                if(!file_exists(BASE_PATH . $valEnd."/index.php")){
                    throw new Exception("Este archivo ". BASE_PATH . $valEnd."/index.php || " . __NAMESPACE__ . " >> " . __LINE__ . " no hereda los permisos de ejecucion");
                }
            }
            //echo $idVal." => ".$valEnd."<br>\n";
        }
        //verificamos que el entorno es el adecuado
    } catch (Exception $e){
        echo $e->getMessage();
        exit;
    } 