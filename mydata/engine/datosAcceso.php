<?php declare(strict_types=1);

    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            "name" => "Transmision denegada"
        ));
    }else if($_GET["inicio"] == "constante"){
        $salida= json_encode(array(
            "dapp_00" => 'www.derootty.xyz/'.'00_sendme/'.'index.php',
            "dapp_01" => 'www.derootty.xyz/'.'01_logit/'.'index.php',
            "dapp_02" => 'www.derootty.xyz/'.'02_shopon/'.'index.php',
            "dapp_03" => 'www.derootty.xyz/'.'03_payme/'.'index.php',
            "dapp_04" => 'www.derootty.xyz/'.'04_moreinfo/'.'index.php',
            "dapp_05" => 'www.derootty.xyz/'.'05_mail/'.'index.php',
            "hash_BCK" => 'www.derootty.xyz/'.'admin/'.'index.php',
            "hash_DAP" => 'www.derootty.xyz/'.'indexes/'.'index.php',
            "hash_ERR" => 'www.derootty.xyz/'.'Dinamica/fallos/'.'index.php',
            "hash_FNT" => "www.derootty.xyz".'Dinamica/Entorno/'.'index.php',
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

