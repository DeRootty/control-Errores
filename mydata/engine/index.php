<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Cabeceras de arranque
    
    $modoRtm->registroMod("hola mundo en " . __FILE__ . " => " . __LINE__);
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php")){
            throw new Exception("No se ha cargado el motor de accesos<br>\n");
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        $modoRtm->registroMod('carga ok: ' . __FILE__ . "=>" . __LINE__);
        require_once("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php");
    }

   // $modoRtm->salidaModo();