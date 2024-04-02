<?php declare(strict_types=1);
    //loop para estructura
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
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
        $ii=-1;
        $ii=count($this->index);
    }
    try{
        if(!file_exists(BASE_PATH . RENDER_PATH . "/esqueleto.php")){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "estructuraHTML");
            array_push($salida["C"], "Ruta inexistente: " . BASE_PATH . RENDER_PATH . "/esqueleto.php" . "REvisa archivo en " . __FILE__.__LINE__);
            array_push($salida["D"], $check);
            array_push($salida["E"], true);
            throw new Exception($salida);
        }
        if(count($salida)==0){
            array_push($salida, $this->modoTest);
        }
        //echo "Modo test en true para estructura<br>\n";
        if((count($this->esqueletoHTML)==0) && (count($this->salidaFinHTML)==0)){
            require_once(BASE_PATH . RENDER_PATH . "/esqueleto.php");
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "estructuraHTML");
            array_push($salida["C"], "entrada a extructura<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
            //echo "entrada a extructura<br>\n";
        }else if(count($this->esqueletoHTML)==0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "estructuraHTML");
            array_push($salida["C"], "reentrada a estructura<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
            //echo "reentrada a estructura: ".count($salida)."<br>\n";
        }else if(count($this->esqueletoHTML)>0 && count($this->salidaFinHTML)>0 ){
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "estructuraHTML");
            array_push($salida["C"], "definicion por controlar en estructura<br>\n");
            array_push($salida["D"], $check);
            array_push($salida["E"], false);
            //echo "definicion por controlar en estructura<br>\n";
        }else{
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "estructuraHTML");
            array_push($salida["C"], "Excepcion no controlada");
            array_push($salida["D"], $check);
            array_push($salida["E"], true);
            throw new Exception($salida);
        }
    } catch (Exception $ex){
        echo "<pre>";
        print_r($ex->getMessage());
        echo "</pre>";
        exit;
        return $ex->getMessage();
    }finally{
        $ii=-1;
        $ii=count($this->esqueletoHTML);
    }
    while($ii>0){
        $addInsert="";
        if (strpos($this->esqueletoHTML[0], "<flowCode||value=>>'index|error'||position=>") !== false) {
            // Encontramos un marcador, llamamos a la función para la matriz 2
            //Discriminamos si estamos depurando la inclusion de nuevas estructuras en mydata
            if($this->modoTest){
                $retornoTest = array();
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "estructuraHTML");
                if(!$montar[0] && $montar[5]){
                    array_push($salida["C"], "estructura detecta error en ".$ii." entrando en valoracion <br>\n");
                    $retornoTest = $this->errorHTML($montar, $check);
                    $salida["C"] = array_merge($salida["C"], $retornoTest["C"]);
                    array_push($salida["C"], $retornoTest["B"]. $ii . " saliendo de valoracion <br>\n");
                    array_push($salida["C"], "estructura detecta error en ". $ii . " saliendo de valoracion <br>\n");
                    array_push($salida["D"], $check);
                    array_push($salida["E"], true);
                    echo "estructura detecta error en ".$ii." <br>\n";
                }else{
                    array_push($salida, "estructura detecta entrada a index en " . $ii . " <br>\n");
                    $retornoTest = $this->inicioHTML($montar, $check); //
                    $salida["C"] = array_merge($salida["C"], $retornoTest["C"]);
                    array_push($salida["C"], $retornoTest["B"]. $ii . " saliendo de valoracion <br>\n");
                    array_push($salida["D"], $check);
                    array_push($salida["E"], false);
                }
            }else{
                if(!$montar[0] && $montar[5]){
                    $this->errorHTML($montar, $this->modoTest);
                }else{
                    $this->inicioHTML($montar, $this->modoTest);
                }
            }
            array_shift($this->esqueletoHTML);
            $ii=count($this->esqueletoHTML);
        } else {
            $addInsert=array_shift($this->esqueletoHTML);
            array_push($this->salidaFinHTML, $addInsert);
        }
        $ii=count($this->esqueletoHTML);
        if($this->modoTest){
            array_push($salida, "estructura ".$ii." <br>\n");
        }
    }