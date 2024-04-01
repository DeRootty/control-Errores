<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Cabeceras de arranque
    
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php")){
            throw new Exception("No se ha cargado el motor de accesos<br>\n");
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        require_once("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php");
    }
