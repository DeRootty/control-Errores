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
    header("Content-Type: application/json");
    echo $salida;