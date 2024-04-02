<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
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
*/

    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            "name" => "Transmision denegada"
        ));
    }else if($_GET["inicio"] == "transmite"){
        $salida= json_encode(array(
            "name" => __FILE__ . " => " . __LINE__
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
                array()
            )
        );
    }else{
        $salida= json_encode(array(
            "name" => "no definido"
        ));
    }

    echo $salida;