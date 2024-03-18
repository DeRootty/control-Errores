<?php declare(strict_types=1);

    namespace indexes;
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
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    try{
        if(count(CONST_USR) == 0 || !defined("CONST_USR")){
            throw new Exception("El archivo al que estas invocabdo, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion en 8");
        }
        foreach(CONST_USR as $idVal => $valEnd){
            if((BASE_PATH != $valEnd) && (ROOT_INDEX != $valEnd) ){
                if(!file_exists(BASE_PATH . $valEnd."/index.php")){
                    throw new Exception("Este archivo ". BASE_PATH . $valEnd."/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion");
                }
            }
            //echo $idVal." => ".$valEnd."<br>\n";
        }
        //verificamos que el entorno es el adecuado
    } catch (Exception $e){
        echo $e->getMessage();
        exit;
    } 