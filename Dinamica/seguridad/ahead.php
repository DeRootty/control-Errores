<?php declare(strict_types=1);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        $descripcionErr=array();
        //$descripcionErr="El archivo al que estas invocando, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
        $descripcionErr = json_encode(array(
            "A" => "CONST_USR no esta definido",
            "B" => "BASE_PATH no hay asignacion de root index",
            "C" => "/index.php",
            "D" => "index.php no hereda los permisos de ejecucion",
            "E" => __FILE__ . " : " . __LINE__
        ));
        if(!defined("CONST_USR") || count(CONST_USR) == 0){
            throw new Exception($descripcionErr);
        }
        
        //$descripcionErr="El archivo al que estas invocando, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
        foreach(CONST_USR as $idVal => $valEnd){
            if($_SERVER["SERVER_NAME"] !== $valEnd && $idVal !== "CURL_PATH"){
                if("BASE_PATH" !== $idVal && "ROOT_INDEX" !== $idVal){
                    if(!file_exists(BASE_PATH . $valEnd . "/index.php")){
                        $descripcionErr = json_encode(array(
                            '$idVal' => $idVal,
                            '$valEnd' => $valEnd,
                            'BASE_PATH' => BASE_PATH,
                            'CONST_USR' => CONST_USR,
                            'index' => "index.php no hereda los permisos de ejecucion",
                            'carga' => __FILE__ . " : " . __LINE__
                        ));
                        
                        //$descripcionErr ="Este archivo ". BASE_PATH . $valEnd . "/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
                        throw new Exception($descripcionErr);
                    }
                }else{
                    if("ROOT_INDEX" !== $idVal){
                        if(!file_exists($valEnd . "/index.php")){
                            $descripcionErr = json_encode(array(
                                '$idVal' => $idVal,
                                '$valEnd' => $valEnd,
                                'BASE_PATH' => BASE_PATH,
                                'CONST_USR' => CONST_USR,
                                'index' => "index.php no hereda los permisos de ejecucion",
                                'carga' => __FILE__ . " : " . __LINE__
                            ));
                            //$descripcionErr ="Seccion BASE PATH Este archivo ". BASE_PATH . $valEnd . "/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
                            throw new Exception($descripcionErr);
                        }
                    }
                }
            }            
            //echo $idVal." => ".$valEnd."<br>\n";
        }
        //verificamos que el entorno es el adecuado
    } catch (Exception $e){
        //echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        echo "volcado ad hoc";
        echo "<pre>";
        print_r(json_decode($e->getMessage(),true));
        echo "</pre>";
        exit;
    }finally{
        $descripcionErr = json_encode(array(
            '$idVal' => $idVal,
            '$valEnd' => $valEnd,
            'BASE_PATH' => BASE_PATH,
            'CONST_USR' => CONST_USR,
            'index' => "index.php no hereda los permisos de ejecucion",
            'carga' => __FILE__ . " : " . __LINE__
        ));
    }