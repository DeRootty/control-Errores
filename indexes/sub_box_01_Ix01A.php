<?php declare(strict_types=1);
    //loop para indice
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo " . __FILE__ . " Viola el acceso al recurso");
        }
        if(!isset($this)){
            throw new Exception("El archivo " . __FILE__ . " No heredas los permisos de ejecucion<br>\n");
        }else if(!isset($this->esqueletoHTML)){
            throw new Exception("El archivo " . __FILE__ . " No heredas los permisos de ejecucion<br>\n");
        }
        if(!isset($this->modoTest)){
            throw new Exception("El archivo " . __FILE__ . " No heredas los permisos de ejecucion<br>\n");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{

    }
    
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");
    if(!file_exists(BASE_PATH . RENDER_PATH . "/inicio.php")){
        array_push($salida["A"], $this->modoTest);
        array_push($salida["B"], "inicioHTML"." - Error en " . __FILE__ . " Linea: " . __LINE__);
        array_push($salida["C"], "Ruta inexistente " . BASE_PATH . RENDER_PATH . "/inicio.php");
        array_push($salida["D"], $check);
        array_push($salida["E"], true);
        return $salida;
    }
    
    try{
        //echo "En asignacion Indice Modo test en true<br>\n";
        if(count($this->index)==0 && count($this->salidaFinHTML)>0 ){
            require_once(BASE_PATH . RENDER_PATH . "/inicio.php");
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML");
            array_push($salida["C"], "entrada a inicio<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
        }else if(count($this->index)==0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML");
            array_push($salida["C"], "reentrada a inicio<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
        }else if(count($this->index)>0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML");
            array_push($salida["C"], "definicion por controlar en error<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
        }else{
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML".""."<br>\n");
            array_push($salida["C"], "Error en " . __FILE__ . " Linea: " . __LINE__ . "<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], true);
            throw new Exception($salida);
        }
        if(count($this->index)==0){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML"."Error en " . __FILE__ . " Linea: " . __LINE__ ."<br>\n");
            array_push($salida["C"], "El archivo " . __FILE__ . " linea " . __LINE__ . " La variable de contenidos no esta establecida" . "<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], true);
            throw new Exception($salida);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        $ii=-1;
        $ii=count($this->index);
    }
    
    while($ii>0){
        if($this->modoTest){
            //echo "estamos en modo test <br> \n";
            if (strpos($this->index[0], "<flowCode||value=>>'main'||position=>") !== false) {
                array_shift($this->index);
                $ii=count($this->index);
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "inicioHTML");
                array_push($salida["C"], "index ".$ii." salida <br>\n");
                array_push($salida["D"], $check);
                array_push($salida["E"], false);
                break;
            }
            $addInsert=array_shift($this->index);
            array_push($this->salidaFinHTML, $addInsert);
            $ii=count($this->index);
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "inicioHTML");
            array_push($salida["C"], "index ".$ii);
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
            //echo "index ".$ii." recorriendo <br>\n";
        }else{
            //echo "NONONO estamos en modo test <br> \n";
            if (strpos($this->index[0], "<flowCode||value=>>'main'||position=>") !== false) {
                array_shift($this->index);
                $ii=count($this->index);
                break;
            }
            $addInsert=array_shift($this->index);
            array_push($this->salidaFinHTML, $addInsert);
            $ii=count($this->index);
        }
    }
