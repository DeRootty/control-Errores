<?php declare(strict_types=1);

    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    if(isset($_GET["var"]) && $_GET["var"]=="valor"){
        $salida= json_encode(array(
            "respuesta" => "ok, conectado"
        ));
        echo $salida;
        exit;
    }
    $salida= json_encode(array(
        "respuesta" => "error"
    ));
    echo $salida;
    exit;
/* 
 * /admin/index.php
 * 
 * 
 */

    //namespace admin;

    
    
    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        
    }
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");