<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Cabeceras de arranque
    namespace practicasAPP\mydata\engine\index;
    use Exception;
    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    $modoRtm->registroMod("hola mundo a la entrada, calentando motores " . __FILE__ . " => " . __LINE__);
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php")){
            throw new Exception("No se ha cargado el motor de accesos<br>\n");
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        $modoRtm->registroMod('carga de motor aprovada ok: ' . __FILE__ . "=>" . __LINE__);
        require_once("/srv/vhost/derootty.xyz/home/html/mydata/engine/accion.php");
    }

   // $modoRtm->salidaModo();