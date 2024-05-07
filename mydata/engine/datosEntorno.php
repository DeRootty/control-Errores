<?php declare(strict_types=1);
    namespace practicasAPP\myData\engine\enviroment;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo "iniciando acciones...<br>\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            array(
                "status",
                 "EOIX"
            ),
            array(
                "Transmision denegada",
                 "EOIX"
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else if($_GET["inicio"] == "transmite"){
        $salida= json_encode(array(
            array(
                "name",
                "EOIX"
            ),
            array(
                __FILE__ . " => " . __LINE__,
                "EOIX"
            ),
            'POST' => $_POST
             
        ));
        echo $salida;
        exit;
    }else if($_GET["inicio"] == "constante"){
        $salida= json_encode(
            array(
                array(
                    "BASE_PATH",
                    "ENV_PATH",
                    "FAIL_PATH",
                    "SECURITY_PATH",
                    "FLOW_PATH",
                    "ADMIN_PATH",
                    "ASSET_PATH",
                    "INDEX_PATH",
                    "RENDER_PATH",
                    "CURI_PATH",
                    "INIT_PATH",
                    "ROOT_INDEX",
                    "CURL_PATH",
                    "EOIX"
                ),
                array(
                    $_GET["basePath"],
                    "/Dinamica/Entorno",
                    "/Dinamica/fallos",
                    "/Dinamica/seguridad",
                    "/Dinamica",
                    "/admin",
                    "/assets/app_com",
                    "/indexes",
                    "/mydata/entorno",
                    "/mydata/engine",
                    "/init",
                    $_GET["basePath"],
                    $_SERVER["SERVER_NAME"]."",
                    "EOIX"
                ),
                array(),
                'POST' => $_POST
            )
        );
        echo $salida;
        exit;
    }else{
        $salida= json_encode(array(
            array(
                "status",
                "EOIX"
            ),
            array(
                "error",
                "EOIX"
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }
iniciando: