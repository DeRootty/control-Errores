<?php declare(strict_types=1);
    //loop para error
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        
    }

    
    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo " . __FILE__ . " Viola el acceso al recurso");
        }
        if(!isset($this)){
            throw new Exception("El archivo " . __FILE__ . " No heredas los permisos de ejecucion<br>\n");
        }else if(!isset($this->esqueletoHTML)){
            throw new Exception("El archivo " . __FILE__ . " No heredas los permisos de ejecucion<br>\n");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{

    }
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");
    $ii=-1;
    $ii=count($this->index);
    
    if(!file_exists(BASE_PATH . RENDER_PATH . "/error.php")){
        array_push($salida["A"], $this->modoTest);
        array_push($salida["B"], "sub_box_01_Ex01A.php: " . __LINE__);
        array_push($salida["C"], "Ruta inexistente: " . BASE_PATH . RENDER_PATH . "/error.php");
        array_push($salida["D"], true);
        return $salida;
    }
    try{
        if(count($this->error)==0 && count($this->salidaFinHTML)>0 ){
            require_once(BASE_PATH . RENDER_PATH . "/error.php");
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "sub_box_01_Ex01A.php: " . __LINE__);
            array_push($salida["C"], "entrada a error<br>\n");
            array_push($salida["D"], false);
        }else if(count($this->error)==0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "sub_box_01_Ex01A.php: " . __LINE__);
            array_push($salida["C"], "reentrada a error<br>\n");
            array_push($salida["D"], false);
        }else if(count($this->error)>0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "sub_box_01_Ex01A.php: " . __LINE__);
            array_push($salida["C"], "definicion por controlar en error<br>\n");
            array_push($salida["D"], false);
        }else{
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "sub_box_01_Ex01A.php: " . __LINE__);
            array_push($salida["C"], "Error en asignacion de matrices"."<br>\n");
            array_push($salida["D"], false);
            throw new Exception($salida);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    $ii=-1;
    $ii=count($this->error);
    while($ii>0){
        if (strpos($this->error[0], "<flowCode||value=>>'main'||position=>") !== false) {
            if($this->modoTest){
                array_shift($this->error);
                $ii=count($this->error);
                array_push($salida, $this->error);
                array_push($salida, "errorHTML");
                array_push($salida, "error ".$ii." salida"." <br>\n");
                break;
            }else{
                array_shift($this->error);
                $ii=count($this->error);
                break;
            }
        }

        $addInsert=array_shift($this->error);
        array_push($this->salidaFinHTML, $addInsert);
        $ii=count($this->error);
        array_push($salida, $this->error);
        array_push($salida, "errorHTML");
        array_push($salida, "error ".$ii." <br>\n");
        //array_push($salida, "error ".$ii." <br>\n");
    }