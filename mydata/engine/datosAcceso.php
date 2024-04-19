<?php declare(strict_types=1);
    header("Content-Type: application/json");

    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            "name" => "Transmision denegada"
        ));
    }else if($_GET["inicio"] == "constante"){
        $salida= json_encode(array(
            "dapp_00" => $_GET["basePath"].'00_sendme/'.'index.php',
            "dapp_01" => $_GET["basePath"].'01_logit/'.'index.php',
            "dapp_02" => $_GET["basePath"].'02_shopon/'.'index.php',
            "dapp_03" => $_GET["basePath"].'03_payme/'.'index.php',
            "dapp_04" => $_GET["basePath"].'04_moreinfo/'.'index.php',
            "dapp_05" => $_GET["basePath"].'05_mail/'.'index.php',
            "hash_BCK" => $_GET["basePath"].'admin/'.'index.php',
            "hash_DAP" => $_GET["basePath"].'indexes/'.'index.php',
            "hash_ERR" => $_GET["basePath"].'Dinamica/fallos/'.'main.php',
            "hash_FNT" => $_GET["basePath"].'Dinamica/Entorno/'.'index.php',
            "hash_LOAD" => $_GET["basePath"].'index.php'
        ));
    }else{
        $salida= json_encode(array(
            "name" => "no definido"
        ));
    }

    echo $salida;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

