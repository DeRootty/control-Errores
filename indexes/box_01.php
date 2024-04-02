<?php declare(strict_types=1);
    namespace box_01;
    use Exception;
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

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
   
    class salidaFinVista{

        public array $salidaFinHTML;
        private array $esqueletoHTML;
        private array $index;
        private array $error;
        private array $salidaSQL;
        private bool $modoTest;

        public function __construct(bool $depuracion){
            $this->salidaFinHTML=array();
            $this->esqueletoHTML=array();
            $this->index=array();
            $this->error=array();
            $this->salidaSQL=array();
            $this->modoTest=$depuracion;
        }//public function __construct

        /**
         * Pantalla de inicio o error
         *
         * $opcion - string
         *
         * Valores admitidos:
         *  1.- "index"
         *  2.- "error"
         */
        public function modoDev(bool $test): array{
            $this->modoTest=$test;
            return $salida;
        }

        /**
         * 
         * @param array $secuencia= array(
         *                                  0 => true o false,
         *                                  1 => contexto (index, error, solicitud),
         *                                  1 => BASE_PATH,
         *                                  2 => HOME_PATH,
         *                                  3 => archivo.php
         *                                )
         *                                  
         * @return string
         */
        private function engineRender(array $secuencia): string{

        }

        private function runIxDos($matriz2, &$contenedor){
            foreach ($this->esqueletoHTML as $valor) {
                if (strpos($valor, "stop") !== false) {
                    break;
                }
                $contenedor .= $valor . " ";
            }
        }


      /**
       * 
       * @param array $montar Array que pasa la coleccion a plantear en el render
       * @param bool $check pasamos true o false en funcion de si queremos hacer un test de los archivos incluidos en mydata
       * @return array
       * @throws Exception
       * 
       */
        private function estructuraHTML(array $montar, bool $check): array{
            $salida=array(
                "A" =>array(),
                "B" =>array(),
                "C" =>array(),
                "D" =>array(),
                "E" =>array()
            );
            //Verificacion de disponibilidad
            if($check){
                if(!empty($this->modoTest)){
                    if($this->modoTest){
                        //echo "Modo check en true para estructura<br>\n";
                        array_push($salida["A"], $this->modoTest);
                        array_push($salida["B"], "estructuraHTML");
                        array_push($salida["C"], "Se inicia peticion de alcance en modo||depuracion");
                        array_push($salida["D"], $check);
                        array_push($salida["E"], false);                
                        return $salida;
                    } else {
                        //echo "Modo check en false para estructura<br>\n";
                        array_push($salida["A"], $this->modoTest);
                        array_push($salida["B"], "estructuraHTML");
                        array_push($salida["C"], "Se inicia peticion de alcance en modo||render");
                        array_push($salida["D"], $check);
                        array_push($salida["E"], false);                
                        return $salida;
                    }
                }
            }
            $addInsert="";
            
            try{
                if(!file_exists(BASE_PATH . INDEX_PATH . '/sub_box_01_Px00A.php')){
                    throw new Exception(BASE_PATH . INDEX_PATH . '/sub_box_01_Px00A.php');
                }
            } catch (Exception $ex) {
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "estructuraHTML");
                array_push($salida["C"], "Revisar ".__FILE__ . " en " . __LINE__ . "No se encuentra el archivo: " . $ex->getMessage());
                array_push($salida["D"], $check);
                array_push($salida["E"], true);                
                echo "<pre>";
                print_r($salida);
                echo "</pre>";
                exit;
                return $salida;
            }finally{
                require_once (BASE_PATH . INDEX_PATH . '/sub_box_01_Px00A.php');
            }
            
            if(($this->modoTest || $check) && $salida["E"][(count($salida["E"])-1)]){
                echo "retornando salida desde estructura depuracion<br>\n";
            }
            return $salida;
        }//private function estructuraHTML

          /**
           * Carga datos de la plantilla de error en html
           *
           */
        private function errorHTML(array $montar, bool $check): array{
            $salida=array(
                "A" =>array(),
                "B" =>array(),
                "C" =>array(),
                "D" =>array(),
                "E" =>array()
            );
            if($check){
                if(!empty($this->modoTest)){
                    if($this->modoTest){
                        array_push($salida["A"], $this->modoTest);
                        array_push($salida["B"], "errorHTML");
                        array_push($salida["C"], "Se inicia peticion de alcance en modo||depuracion");
                        array_push($salida["D"], $check);
                        array_push($salida["E"], false);                
                        return $salida["C"];
                    } else {
                        array_push($salida["A"], $this->modoTest);
                        array_push($salida["B"], "errorHTML");
                        array_push($salida["C"], "Se inicia peticion de alcance en modo||render");
                        array_push($salida["D"], $check);
                        array_push($salida["E"], false);                
                        return $salida["C"];
                    }
                }
            }
            $addInsert="";
            try{
                if(!file_exists(BASE_PATH . INDEX_PATH . '/sub_box_01_Ex01A.php')){
                    throw new Exception(BASE_PATH . INDEX_PATH . '/sub_box_01_Ex01A.php');
                }
                
            } catch (Exception $ex){
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "errorHTML");
                array_push($salida["C"], "Error en " . __FILE__ . __LINE__ . "Archivo no localizado: " . $ex->getMessage());
                array_push($salida["D"], $check);
                array_push($salida["E"], true);                
                echo "<pre>";
                print_r($salida);
                echo "</pre>";
                exit;
            }finally{
                require_once (BASE_PATH . INDEX_PATH . '/sub_box_01_Ex01A.php');
            }
            
            if(($this->modoTest || $check) && $salida["E"][(count($salida["E"])-1)]){
                echo "retornando salida error depuracion<br>\n";
            }
            return $salida;            
        }//private function errorHTML

        /**
         * Carga datos de la plantilla de inicio en html
         *
         */
        private function inicioHTML(array $montar, bool $check): array{
            $addInsert="";
            if(!file_exists(BASE_PATH . RENDER_PATH . "/inicio.php")){
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "inicioHTML Ruta inexistente " . BASE_PATH . RENDER_PATH . "/inicio.php");
                array_push($salida["C"], "Error en ".__FILE__." Linea: ".__LINE__);
                array_push($salida["D"], $check);
                array_push($salida["E"], true);    
                return $salida;
            }
            $salida=array(
                "A" =>array(),
                "B" =>array(),
                "C" =>array(),
                "D" =>array(),
                "E" =>array()
            );
            if($check){
                if(!empty($this->modoTest)){
                    array_push($salida["A"], $this->modoTest);
                    array_push($salida["B"], "inicioHTML");
                    array_push($salida["C"], "Se inicia peticion de alcance en modo||depuracion");
                    array_push($salida["D"], $check);
                    array_push($salida["E"], false);                
                    return $salida;
                }
            }
            try{
                if(!file_exists(BASE_PATH . INDEX_PATH . '/sub_box_01_Ix01A.php')){
                    throw new Exception(BASE_PATH . INDEX_PATH . '/sub_box_01_Ix01A.php');
                }
            } catch (Exception $ex){
                array_push($salida["A"], $this->modoTest);
                array_push($salida["B"], "inicioHTML");
                array_push($salida["C"], "Se inicia peticion de alcance en modo||render");
                array_push($salida["D"], $check);
                array_push($salida["E"], true);    
                return $salida;
            }finally{
                require_once (BASE_PATH . INDEX_PATH . '/sub_box_01_Ix01A.php');
            }
            if(($this->modoTest || $check) && $salida["E"][(count($salida["E"])-1)]){
                echo "retornando salida desde inicio depuracion<br>\n";
            }
            return $salida;
        }

        public function salidaSQL(){
            $salida="";
            $salida=implode("",$this->salidaSQL);
            return $salida;
        }
        public function salidaError(array $tipoError): array{
            $salida = array();
            $backToMain = array();
            $idStart = array();
            $addArray=false;
            if(!$tipoError[0]){
                array_push($salida,false);
                array_push($salida,"EF_6XX");
                array_push($salida,"EF_600");
                array_push($salida,"index.php");
                array_push($salida,"Entrada de dato no coherente con lo esperado: "."Ruta: ".__FILE__." linea: ".__LINE__);
                array_push($salida,true);
                return $salida;
            }
            foreach($this->esqueletoHTML as $ivVal => $valEnd){
            if(substr($valEnd,0,9)=="<flowCode"){
              if(count($backToMain)>0){
                $idStart=explode("=>",$backToMain[count($backToMain)-1]);
              }
              foreach($this->error as $idVal1 => $valEnd1){
                if(isset($idStart) && is_array($idStart)){
                  $idStartUp=$idStart[1];
                }else if(empty($idStartUp)){
                  $idStartUp=0;
                }
                if($idStartUp==$idVal1){
                  $addArray=true;
                }
                if($addArray){
                  if(substr($valEnd,0,9)=="<flowCode"){
                    array_push($backToMain, $valEnd1);
                  }
                  array_push($salida, $valEnd1);
                }
              }
            }else{
              array_push($salida, $valEnd);
            }
            array_push($salida, $valEnd);
          }
        }
        
        /**
         * 
         * @param array $flujoDin
         * @param bool $modoTest
         * @return array
        */
        public function salida_HTML_final(array $flujoDin, bool $modoTest): array{
            $salida=array(
                "A" =>array(),
                "B" =>array(),
                "C" =>array(),
                "D" =>array(),
                "E" =>array()
            );
            $preEntrada=array();
            $preEntrada=$this->estructuraHTML($flujoDin, $modoTest);
            array_push($salida["A"], $this->modoTest);
            array_push($salida["B"], "salida_HTML_final");
            $salida["C"] = array_merge($salida["C"], $preEntrada["C"]);
            array_push($salida["D"], $modoTest);
            array_push($salida["E"], $preEntrada["E"]);
            if(($this->modoTest || $modoTest) && $salida["E"][(count($salida["E"])-1)]){
                echo "retornando salida desde inicio depuracion<br>\n";
                return $salida;
            }else{
                return $this->salidaFinHTML;
            }
        }//public function salida_HTML_final
        public function salidaNavegacion(array $paginaDestino): array{
            $salida = array();
            $backToMain = array();
            $idStart = array();
            $addArray=false;
            foreach($paginaDestino as $idVal => $valEnd){
              if(substr($valEnd,0,9)=="<flowCode"){

              }
              array_push($salida, $valEnd);
            }
            return $salida;
        }//public function salidaNavegacion
    }//Class
