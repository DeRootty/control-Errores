<?php declare(strict_types=1);
    if(empty($_GET) && empty($_POST)){
        echo "iniciando indices...<br>\n";
        goto iniciando;
    }
    $ambito = 'admin/hash/FNT';
    if((!isset($_GET["var"]) && !isset($_GET["exec"])) || empty($_GET)){
        $salida= json_encode(array(
            array(
                'respuesta',
                'ambito',
                'EOIX'
            ),
            array(
                'Transmision denegada',
                $ambito,
                'EOIX'
            ),
            array(),
            'POST' => $_POST
        ));
    }else if($_GET["exec"] == "hash"){
        $salida= json_encode(array(
            array(
                'respuesta',
                'nivel',
                'ruta',
                'base_cURL',
                'launchLoad',
                'localServer',
                'base_URI',
                'exec',
                'var',
                'ambito',
                'EOIX'
            ),
            array(
                "ok_conectado",
                '3ero',
                __DIR__,
                $ambito,
                'index.php',
                $_SERVER['SERVER_NAME'],
                'var=load',
                'verificado',
                'load',
                'hash FNT',
                "EOIX"
            ),
            array(),
            'POST' => $_POST
             
        ));
    }else if($_GET["var"] == "test"){
        $salida= json_encode(
            array(
                array(
                    'respuesta',
                    'ambito',
                    "EOIX"
                ),
                array(
                    'connected',
                    $ambito,
                    'EOIX'
                ),
                array(),
                'POST' => $_POST
            )
        );
    }else{
        $salida= json_encode(array(
            array(
                "respuesta",
                'ambito',
                "EOIX"
            ),
            array(
                "error",
                $ambito,
                "EOIX"
            ),
            array(),
            'POST' => $_POST
        ));
    }
    
    echo $salida;
    exit;
    iniciando:
    //use admin\conexion;