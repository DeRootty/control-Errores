<?php declare(strict_types=1);
            //[8] => www.derootty.xyz/Dinamica/fallos/main.php?var=
    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    $dirMe = explode("/", __DIR__);
    $iid='28776';
    if((isset($_GET["var"]) && $_GET["var"]=="hash_ERR") && (!isset($_GET["exec"]) && empty($_GET["exec"]))){
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
                 $iid . ':_ERR_1ero',
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
    }else if((isset($_GET["exec"]) && $_GET["exec"]=="hash") && ((isset($_GET["var"]) && $_GET["var"]=="hash_ERR"))){
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
                $iid .'_ERR_2do',
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
    //namespace excepciones;

    define("ERRORES_PATH", "../");

    require_once ERRORES_PATH . "EC_4XX/index.php";
    require_once ERRORES_PATH . "ES_5XX/index.php";
    require_once ERRORES_PATH . "EF_6XX/index.php";
    require_once ERRORES_PATH . "ET_7XX/index.php";