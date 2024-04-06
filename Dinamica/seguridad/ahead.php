<?php declare(strict_types=1);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    try{
        $descripcionErr=array();
        if(!isset($modoRtm)){
            $descripcionErr = json_encode(array(
                "A" => "modoRtm||no esta definido",
                "B" => "BASE_PATH no hay asignacion de root index",
                "C" => "/index.php",
                "D" => "index.php no hereda los permisos de ejecucion",
                "E" => __FILE__ . " : " . __LINE__
            ));
            throw new Exception($descripcionErr);
        }

        //$descripcionErr="El archivo al que estas invocando, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";

        if(!defined("CONST_USR") || count(CONST_USR) == 0){
            $descripcionErr = json_encode(array(
                "A" => "CONST_USR no esta definido",
                "B" => "BASE_PATH no hay asignacion de root index",
                "C" => "/index.php",
                "D" => "index.php no hereda los permisos de ejecucion",
                "E" => __FILE__ . " : " . __LINE__
            ));
            throw new Exception($descripcionErr);
        }
        
        //$descripcionErr="El archivo al que estas invocando, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
        foreach(CONST_USR as $idVal => $valEnd){
            if($_SERVER["SERVER_NAME"] !== $valEnd && $idVal !== "CURL_PATH"){
                if("BASE_PATH" !== $idVal && "ROOT_INDEX" !== $idVal){
                    if(!file_exists(BASE_PATH . $valEnd . "/index.php")){
                        $descripcionErr = json_encode(array(
                            'A' => '$idVal =>' . $idVal . '||' . '$valEnd =>' . $valEnd,
                            'B' => 'index' . "index.php no hereda los permisos de ejecucion",
                            'C' => 'BASE_PATH' . BASE_PATH,
                            'D' => array('CONST_USR' => CONST_USR),
                            'E' => 'carga' . __FILE__ . " : " . __LINE__,
                        ));
                        
                        //$descripcionErr ="Este archivo ". BASE_PATH . $valEnd . "/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion";
                        throw new Exception($descripcionErr);
                    }
                }else{
                    if("ROOT_INDEX" !== $idVal){
                        if(!file_exists($valEnd . "/index.php")){
                            $descripcionErr = json_encode(array(
                                'A' => '$idVal =>' . $idVal . '||' . '$valEnd =>' . $valEnd,
                                'B' => 'index' . "index.php no hereda los permisos de ejecucion",
                                'C' => 'BASE_PATH' . BASE_PATH,
                                'D' => array('CONST_USR' => CONST_USR),
                                'E' => 'carga' . __FILE__ . " : " . __LINE__,
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
    } catch (Exception $ex){
        $verifica=array();
        $analiza=array();
        $verifica=json_decode($ex->getMessage(), true);
        $analiza=explode("||", $verifica["A"]);
        if($analiza[0]=="modoRtm"){
            echo "<pre>";
            print_r($verifica);
            echo "</pre>";
        }else{
            $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
            $modoRtm->registroMod($ex->getMessage());
            $modoRtm->salidaModo();
        }
        exit;
    }finally{
        $modoRtm->registroMod("Hola mundo en " . __FILE__ . " => " . __LINE__);
        $descripcionErr = json_encode(array(
            'A' => '$idVal Todas las globales ok||$valEnd todas las rutas se han ok',
            'B' => "Todas las rutas estan asociadas",
            'C' => 'BASE_PATH' . BASE_PATH,
            'D' => array('CONST_USR' => CONST_USR),
            'E' => 'carga' . __FILE__ . " : " . __LINE__
        ));
    }