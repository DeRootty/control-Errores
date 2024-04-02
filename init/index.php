<?php declare(strict_types=1);
    namespace practicasAPP\init;
    //use practicasAPP;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/init/accion.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod("Adios mundo cruel en " . __FILE__ . " => " . __LINE__);
        echo $ex->getMessage();
        exit;
    }finally{
        //include ("/srv/vhost/derootty.xyz/home/html/init/accion.php");
        require_once ("/srv/vhost/derootty.xyz/home/html/init/accion.php");
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
            $this->constantes = $permisso->accionRun(false);
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