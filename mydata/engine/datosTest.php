<?php declare(strict_types=1);
    namespace practicasAPP\myData\engine\test;
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
            array(),
            'POST' => $_POST
        ));
    }else if($_GET["inicio"] == "transmite"){
        $salida= json_encode(array(
            array(
                "status",
                "EOIX"
            ),
            array(
                "ok: " . __FILE__ . " => " . __LINE__,
                "EOIX"
            ),
            array(),
            'POST' => $_POST
             
        ));
    }else if($_GET["inicio"] == "test"){
        $salida= json_encode(
            array(
                array(
                    "status",
                    "EOIX"
                ),
                array(
                    "connected",
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
            array(),
            'POST' => $_POST
        ));
    }
    echo $salida;
iniciando: