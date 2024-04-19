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
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    /**
     * Clase destinada a la declaracion de constantes
     */
    class constante{
        private array $constantes;
        public string $rootPath;
        public string $bypass;
        public function __construct(string $rootIndex, object $permisso){
            global $modoRtm;
            $salida="";
            $temp = array();
            $temp1 = array();
            $temp2 = array();
            $temp3 = "";
            $baseTH = "";
            $temp = explode(".", $rootIndex);
            if(count($temp)>1){
                array_pop($temp); //eliminamos la extension
            }
            if(count($temp)==2){
                $temp1 = explode("/", $temp[count($temp)-1]);
                array_pop($temp1); //eliminamos el nombre del archivo
                $temp3 = implode("/", $temp1);
                $temp[count($temp)-1] = $temp3;
                $baseTH = implode(".", $temp);
            }else if(count($temp)==1){
                $temp1 = explode("/", $temp[count($temp)-1]);
                array_pop($temp1); //eliminamos el nombre del archivo
                $baseTH = implode("/", $temp1);
            }
            
            $this->constantes = $permisso->accionRun(array("read", "legacy", "basePath||".$baseTH, __FILE__ . " => " . __LINE__), false);
            foreach ($this->constantes[0] as $idVal => &$valEnd){
                if($valEnd =="ROOT_INDEX"){
                    $this->constantes[1][$idVal] = $permisso->salidaRootFile();
                    $modoRtm->registroMod(__LINE__ . " root index actualizado " . __FILE__);
                }
                if($valEnd =="EOIX"){
                    array_push($this->constantes[2], "EOIX");
                    break;
                }
                array_push($this->constantes[2], "BOIX" . $idVal);
                //{$valEnd}
            }
        }//__construct

        public function salidaValor(int $qConst, int $opc ,bool $check){
            $salida = $this->constantes[$opc][$qConst];
            return $salida;            
        }//salidaValor
        
        public function salidaCheck(int $qConst, bool $check){
            $salida = $this->constantes[2][$qConst];
            return $salida;            
        }//salidaCheck
        
    }//class