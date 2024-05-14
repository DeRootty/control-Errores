<?php declare(strict_types=1);
   
  namespace practicasAPP\init\accion;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo "iniciando subsistema de indices...<br>\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    if(isset($_GET["init__"]) && $_GET["init__"]=="subsys"){
        $salida=array(
            'init' => array(
                0 => "BOIX",
                # ... del entorno de informacion
                1 => $_POST['basePath'] . '/init' . '/index.php', # ... el entorno de informacion
                # ... del root archivo
                2 => $_POST['basePath'] . '/init' . '/accion.php', # ... los privilegios del root archivo
                # ... de las definicioenes del motor de identidad informativa
                3 => $_POST['basePath'] . '/mydata/engine' . '/index.php', # ... las definiciones del motor de informacion
                # ... de las entradas de accion por las que el motor iniciara el arranque en base a la identidad informativa
                4 => $_POST['basePath'] . '/mydata/engine' . '/accion.php', # ... alcance del motor que da coherencia a la logica de la identidad desplegada por el motor.
                5 => "EOIX"
            ),
            'def' => array(
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
            )
        );
        echo $salida;
        exit;
    }else if(isset($_GET["var"]) && $_GET["var"]=="hash_LOAD"){
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
                "ok, conectado",
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
    }else if(isset($_GET["getIni"])){
        switch($_GET["getIni"]){
            case 7145: #index.php
                $salida= json_encode(array(
                    array(
                        "respuesta" => 'ok_conectado',
                        "data" => 'ok',
                        'EOIX' => 'EOIX'
                    )
                ));
                break;
            case 8231: #accion.php
                $salida= json_encode(array(
                    array(
                        "respuesta" => 'ok_conectado',
                        "data" => 'ok',
                        'EOIX' => 'EOIX'
                    )
                ));
                break;
            case 9223: #run.php
                $salida= json_encode(array(
                    array(
                        "respuesta" => 'ok_conectado',
                        "data" => 'ok',
                        'EOIX' => 'EOIX'
                    )
                ));
                break;
            case 3867: #test.php
                $salida= json_encode(array(
                    array(
                        "respuesta" => 'ok_conectado',
                        "data" => 'ok',
                        'EOIX' => 'EOIX'
                    )
                ));
                break;
            default:
                $salida= json_encode(array(
                    array(
                        "respuesta" => 'Error',
                        "data" => 'Error',
                        'EOIX' => 'EOIX'
                    )
                ));
        }
        echo $salida;
        exit;
    }
    echo $salida;
    exit;
    iniciando: