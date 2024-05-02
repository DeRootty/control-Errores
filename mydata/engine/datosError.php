<?php declare(strict_types=1);
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
                    "/srv/vhost/derootty.xyz/home/html",
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
                    __FILE__,
                    $_SERVER["SERVER_NAME"]."",
                    "EOIX"
                ),
                array(),
                'POST' => $_POST
            )
        );
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
    }

    header("Content-Type: application/json");
    echo $salida;
    
    
    /*
    header('HTTP/1.0 404 Not Found', true, 404);
    
    $datoUri = "El tip solicitado es" . $_GET['tip'] ?? "Se redirecciona a: ". $_SERVER['REQUEST_URI'];
    echo "Esta pagina es de error: ".$datoUri."\n";
     * 
     */