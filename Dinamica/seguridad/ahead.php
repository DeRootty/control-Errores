<?php declare(strict_types=1);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        $descripcionErr="";
        $descripcionErr="El archivo al que estas invocabdo, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
        if(!defined("CONST_USR")){
            throw new Exception($descripcionErr);
        }
        if(count(CONST_USR) == 0){
            throw new Exception($descripcionErr);
        }
        foreach(CONST_USR as $idVal => $valEnd){
            if((BASE_PATH != $valEnd) && (ROOT_INDEX != $valEnd) ){
                if($_SERVER["SERVER_NAME"] !== $valEnd && $idVal !== "CURL_PATH"){
                    if(!file_exists(BASE_PATH . $valEnd."/index.php")){
                        throw new Exception("Este archivo ". BASE_PATH . $valEnd."/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion");
                    }
                }
            }
            //echo $idVal." => ".$valEnd."<br>\n";
        }
        //verificamos que el entorno es el adecuado
    } catch (Exception $e){
        echo $e->getMessage();
        exit;
    }