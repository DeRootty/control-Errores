<?php declare(strict_types = 1);
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
        private array $estadoRunTime;
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
            $this->estadoRunTime = array();
            $this->ii_Curl = -1;
            $temp = array();
            $temp1 = array();
            $temp2 = array();
            $temp3 = "";
            $baseTH = "";

            try{
                if(is_null($dataCurl)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'constructor',
                        'Clase' => 'loadDataFrom_cURL',
                        'Archivo' => __FILE__,
                        'linea' => __LINE__,
                        'Leyenda' => "Error en la entrada de datos: no se admiten valores nulos ",
                        'Arreglo' => $dataCurl
                    ));
                    
                    throw new Exception($test);
                }
                if(in_array('Error', $dataCurl)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'constructor',
                        'Clase' => 'loadDataFrom_cURL',
                        'Archivo' => __FILE__,
                        'linea' => __LINE__,
                        'Leyenda' => "Error en el formato de datos Curl ",
                        'Arreglo' => $dataCurl
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $error = json_decode($ex->getMessage(), true);
                $this->estadoRunTime = $error;
                return false;
            }
            $this->data_cURL = array();
            array_push($this->data_cURL, $dataCurl);
            $this->ii_Curl = count($this->data_cURL)-1;
            //lanzamos el resultado
            $colector = $this->collectorCurl($this->data_cURL[$this->ii_Curl]);
            $this->estadoRunTime = array(
                'ok',
                $colector
            );
            return true;
            unset($dataCurl);
        }//__construct

        public function getEstado(){
            if(in_array('Error', $this->estadoRunTime)){
                echo '<pre>';
                print_r($this->estadoRunTime);
                echo '</pre>';
                return false;
            }
            return true;
        }
        
        public function salidaValor(int $qConst, int $opc ,bool $check){
            $foundError = false;
            if(in_array('Error', $this->estadoRunTime)){
                $foundError = true;
            }else if($qConst==-1 || $this->ii_Curl==-1 || empty($this->data_cURL[$this->ii_Curl][$opc][$qConst])){
                $foundError = true;
            }
            try{
                if($foundError){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'modo' => 'Estado_RunTime',
                        'ID_in' => $qConst,
                        'IDs_log' => $this->ii_Curl,
                        'IX_set' => $this->data_cURL,
                        'Funcion' => 'salidaValor()',
                        'Clase' => 'loadDataFrom_cURL',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__,
                        'Leyenda' => 'Las referencias apuntan a EOIX undefined'
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $this->estadoRunTime = json_decode($ex->getMessage(), true);
                return $this->estadoRunTime;
            }
            $this->estadoRunTime = array(
                'Estado' => 'ok',
                'data' => $this->data_cURL[$this->ii_Curl][$opc][$qConst]
            );
            return $this->estadoRunTime;            
        }//salidaValor
        
        public function salidaCheck(int $qConst, bool $check): array{
            try{
                if($qConst==-1 || $this->ii_Curl==-1 || empty($this->data_cURL[$this->ii_Curl][2][$qConst])){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'modo' => 'Estado_RunTime',
                        'Funcion' => 'salidaCheck()',
                        'Clase' => 'loadDataFrom_cURL',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__,
                        'ID_in' => $qConst,
                        'IDs_log' => $this->ii_Curl,
                        'IX_set' => $this->data_cURL,
                        'Leyenda' => 'Las referencias apuntan a EOIX undefined'
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $this->estadoRunTime = json_decode($ex->getMessage(), true);
                return $this->estadoRunTime;
            }

            $this->estadoRunTime = array(
                'Estado' => 'ok',
                'data' => $this->data_cURL[$this->ii_Curl][2][$qConst]
            );
            return $this->estadoRunTime;            
        }//salidaCheck
        
        private function collectorCurl(array &$dataCurl){
            if(is_string($dataCurl[0])){
                echo $dataCurl[0];
                exit;
            }
            if(is_string($dataCurl[0])){
                echo 'Deberia ser array, y se esta procesando un string <br>'."\n";
                exit;
            }
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
            /*
            echo "<pre>";
            print_r($this->data_cURL);
            echo "</pre>";
             * 
             */
        }
        
    }//class