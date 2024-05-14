<?php declare(strict_types=1);
    namespace practicasAPP\myData\engine\access;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        echo "iniciando acciones...<br>\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
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
        echo $salida;
        exit;
    }else if($_GET["inicio"] == "constante"){
        $salida= json_encode(array(
            array(
                'respuesta',
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
                'ok_conectado',
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
            array(
                'respuesta' => 9000,
                "dapp_00" => 9001,
                "dapp_01" => 9002,
                "dapp_02" => 9003,
                "dapp_03" => 9004,
                "dapp_04" => 9005,
                "dapp_05" => 9006,
                "hash_BCK" => 9007,
                "hash_DAP" => 9008,
                "hash_ERR" => 9009,
                "hash_FNT" => 9010,
                "hash_LOAD" => 9011,
                "EOIX" => 9000
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
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
        echo $salida;
        exit;
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

iniciando: