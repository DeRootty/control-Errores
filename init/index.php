<?php declare(strict_types=1);
    namespace practicasAPP\init;
    use Exception;
    //use practicasAPP;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel: Violacion del acceso al archivo ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    /**
     * Clase destinada a la declaracion de constantes
     */
    class loadDataFrom_cURL{
        private array $data_cURL = array(); //Contiene los datos procedentes de cURL y ya formateados
        private int $ii_Curl;
        public string $rootPath;
        public string $bypass;
        /**
         * 
         * @global type $modoRtm
         * @param string $rootIndex cadena que indica la ruta absoluta del archivo root del sitio.
         * @param object $permisso
         * @throws Exception
         */
        public function __construct(array &$dataCurl){
             //object $permisso
            global $modoRtm;
            $this->ii_Curl = -1;
            $temp = array();
            $temp1 = array();
            $temp2 = array();
            $temp3 = "";
            $baseTH = "";

            try{
                if(is_null($dataCurl)){
                    throw new Exception("Error en el formato de datos Curl" . __LINE__ . " => " . __FILE__);
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            $this->data_cURL = array();
            array_push($this->data_cURL, $dataCurl);
            $this->ii_Curl = count($this->data_cURL)-1;
            //lanzamos el resultado
            $this->collectorCurl($this->data_cURL[$this->ii_Curl]);
            unset($dataCurl);
        }//__construct

        public function salidaValor(int $qConst, int $opc ,bool $check){
            $salida = $this->data_cURL[$this->ii_Curl][$opc][$qConst];
            return $salida;            
        }//salidaValor
        
        public function salidaCheck(int $qConst, bool $check){
            $salida = $this->data_cURL[$this->ii_Curl][2][$qConst];
            return $salida;            
        }//salidaCheck
        
        private function collectorCurl(array &$dataCurl){
            foreach ($dataCurl[0] as $idVal => &$valEnd){
                if($valEnd =="ROOT_INDEX"){
                    $dataCurl[1][$idVal] = $dataCurl[1][0];
                }
                if($valEnd =="EOIX"){
                    array_push($dataCurl[2], "EOIX");
                    break;
                }
                //Datos a usar en la base de definiciones de errores
                array_push($dataCurl[2], "BOIX__" . $idVal);
            }            
            echo "<pre>";
            print_r($this->data_cURL);
            echo "</pre>";
        }
        
    }//class