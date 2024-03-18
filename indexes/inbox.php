<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    
    
    namespace practicasAPP;

      use Exception;


    define("APP_00", "/00_sendme");     //
    define("APP_01", "/01_sendme");     //
    define("APP_02", "/02_sendme");     //
    define("APP_03", "/03_sendme");     //
    define("APP_04", "/04_sendme");     //
    define("APP_05", "/05_sendme");     //
    define("APP_INDEX", __FILE__);                               //Privilegios con los que se marca el flujo.