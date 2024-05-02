<?php declare(strict_types=1);

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