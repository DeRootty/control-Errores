<?php declare(strict_types=1);

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
    //credenciales
    //use superglobals;
    if(!isset($_GET["inicio"]) || empty($_GET)){
        $salida= json_encode(array(
            "name" => "Transmision denegada"
        ));
    }else if($_GET["inicio"] == "transmite"){
        $salida= json_encode(array(
            "hash_00" => "acceso_00",
            "hash_01" => "acceso_01",
            "hash_02" => "acceso_02",
            "hash_03" => "acceso_03",
            "hash_04" => "acceso_04",
            "hash_05" => "acceso_05",
            "hash_env" => "acceso_env",
            "hash_err" => "acceso_err",
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

