<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
            array()
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
            array()
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
            array()
        ));
    echo $salida;
    exit;
    
    
    
    
    
//enviar -----------------------------------------------------------
$ch = curl_init();

// Establece la URL y otras opciones apropiadas
curl_setopt($ch, CURLOPT_URL, "http://www.example.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);

// Captura la URL y la envía al navegador
curl_exec($ch);

// Cierrar el recurso cURL y libera recursos del sistema
curl_close($ch);

//publicar -------------------------------------------------------------
$url = '{POST_REST_ENDPOINT}';
$curl = curl_init();

$data = curl_exec($curl);
curl_close($curl);