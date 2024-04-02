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
    
    
    /*
    header('HTTP/1.0 404 Not Found', true, 404);
    
    $datoUri = "El tip solicitado es" . $_GET['tip'] ?? "Se redirecciona a: ". $_SERVER['REQUEST_URI'];
    echo "Esta pagina es de error: ".$datoUri."\n";
     * 
     */