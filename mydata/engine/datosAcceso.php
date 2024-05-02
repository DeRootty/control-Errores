<?php declare(strict_types=1);

    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            array(
                'respuesta',
                'valor',
                "EOIX"
            ),
            array(
                'TRansmision denegada',
                '%insertar valor%',
                "EOIX"
            ),
            array(),
            'POST' => $_POST
        ));
    }else if($_GET["inicio"] == "constante"){
        $salida= json_encode(array(
            array(
                "dapp_00",
                "dapp_01",
                "dapp_02",
                "dapp_03",
                "dapp_04",
                "dapp_05",
                "hash_BCK",
                "hash_DAP",
                "hash_ERR",
                "hash_FNT",
                "hash_LOAD",
                "EOIX"
            ),
            array(
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_00/'.'index.php',
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_01/'.'index.php',
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_02/'.'index.php',
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_03/'.'index.php',
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_04/'.'index.php',
                $_SERVER["SERVER_NAME"].'/mydata/app/dapp_05/'.'index.php',
                $_SERVER["SERVER_NAME"].'/admin/'.'index.php',
                $_SERVER["SERVER_NAME"].'/indexes/'.'index.php',
                $_SERVER["SERVER_NAME"].'/Dinamica/fallos/'.'main.php',
                $_SERVER["SERVER_NAME"].'/Dinamica/Entorno/'.'index.php',
                $_SERVER["SERVER_NAME"].'/index.php',
                "EOIX"
            ),
            array(
                
            ),
            'POST' => $_POST

        ));
    }else{
        $salida= json_encode(array(
            array(
                'respuesta',
                'valor',
                "EOIX"
            ),
            array(
                'Sin definir',
                '%insertar valor%',
                "EOIX"
            ),
            array(),
            'POST' => $_POST
        ));
    }
    /*
     *          $_GET["basePath"].'00_sendme/'.'index.php',
                $_GET["basePath"].'01_logit/'.'index.php',
                $_GET["basePath"].'02_shopon/'.'index.php',
                $_GET["basePath"].'03_payme/'.'index.php',
                $_GET["basePath"].'04_moreinfo/'.'index.php',
                $_GET["basePath"].'05_mail/'.'index.php',
                $_GET["basePath"].'admin/'.'index.php',
                $_GET["basePath"].'indexes/'.'index.php',
                $_GET["basePath"].'Dinamica/fallos/'.'main.php',
                $_GET["basePath"].'Dinamica/Entorno/'.'index.php',
                $_GET["basePath"].'index.php',
                "EOIX"
     */
    header("Content-Type: application/json");
    echo $salida;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

