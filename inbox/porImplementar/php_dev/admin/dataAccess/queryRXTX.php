<?php
class setCookieNav{
    public string $alphanumeric="";
    public array $ixValEndRefMap=array(); //mapa que integra los valores de dasphalmeric como id asociativo y lo relaciona con el orden establecido para el usuario
    public array $ixIdValRefMap=array(); //Identificadores por orden natural
    public string $valMax="";
    public string $valMax1="";
    public array $iniVal=array();
    public array $iniVal1=array(array());
    public string $dasphalmeneric="";
    public bool $repeat=true;
    public int $TTvalEnd=-1;
    public int $iiValEnd=-1;
    public string $cabezaFrm="";
    public array $inputsFields=array();
    public array $buttonSubmit=array();
    public string $idAlta="";
    public $valorRand="";
    //asignamos los nombres de los campos del formulario, para asociarlos a la base de datos
    /**
     * inference: id asociativo pensado para almacenar los indices de incio de la cadena que definira el cifrado de los campos
     * coherence: campo de cifras en modo texto, sembrado para poder recoger las cadenas que se asociaran a los campos de formulario y que necesitan de inference como semilla para poder establecer referencias coherentes
     * login: resultado final, preparado para enviar a iniciar sesion
     * preLogin: resultado previo, un paso antes de establecer el login final, donde contiene un borrador de los datos de inicio de sesion y formulario previo
     * faltan asociar los datos de longitud de la cifra asociada a los campos del formulario
     */
    public $campo=array(
        "inference"=>"",
        "coherence"=>"",
        "login"=>array(),
        "prelogin"=>array()
    );
    /**
     * $checkFieldLong - longitud de las variables del formulario
     * $camposFrmTT - campos que asignaran aleatoriedad
     * 
     */
    public function __construct($checkFieldLong, $camposFrmTT){
        $iiFrmToTT=-1;
        $codeOk=false; //variable de control de ejecucion para el codigo de la siguiente version
        $repeat=false;
        $tempTRansCode="";
        $this->alphanumeric="abcdefghijklmnopqrstuvwxyz";
        $this->alphanumeric.=strtoupper($this->alphanumeric);
        $this->alphanumeric.="0123456789";
        $this->dasphalmeneric=str_shuffle($this->alphanumeric);
        $this->ixIdValRefMap = str_split($this->dasphalmeneric);
        $this->ixValEndRefMap = array_flip($this->ixIdValRefMap);
        $this->valMax=(strlen($this->dasphalmeneric)-$checkFieldLong);
        //codigo en desarrollo para la siguiente version
        if($codeOk){
            $this->iniVal=$this->aleatorio1($camposFrmTT);
            $this->iniVal1=$this->aleatorio2($checkFieldLong,$camposFrmTT);
        }
        if(file_exists("rxtxIO.ofcd")){
            $chivoAr=@fopen("rxtxIO.ofcd","r");
            while(!feof($chivoAr)){
                $tempTRansCode=fgets($chivoAr);
            }
            fclose($chivoAr);
            for($iiFrmToTT=0;$iiFrmToTT<=($camposFrmTT);$iiFrmToTT++){
                do{
                    $proofRand=random_int(0,$this->valMax);
                    if(!(in_array($proofRand,$this->iniVal,true))){
                        //$this->inputsFields[$this->iniVal[count($this->iniVal)-1]]=array();
                        if((count($this->iniVal)!==$camposFrmTT)){                        
                            $this->iniVal[]=random_int(0,$this->valMax);
                            $repeat==true;
                        }else{
                            $repeat=false;
                        }
                    }else{
                        $repeat==true;
                    }
                }while($repeat==true);
            }

            foreach($this->iniVal as $idVal => &$valEnd){
                $this->alphanumeric=str_shuffle($this->alphanumeric);
                $this->dasphalmeneric=str_shuffle($this->alphanumeric);
                $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                do{
                    $test=substr($this->valorRand,0,1);
                    if(is_numeric($test)){
                        $valEnd=random_int(0,$this->valMax);
                        $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                        $this->idAlta.=$this->valorRand."  ";
                        $repeat=true;
                    }else{
                        if(!(in_array($this->valorRand,$this->campo["prelogin"],true))){
                            array_push($this->campo["prelogin"],$this->valorRand);
                            if(count($this->campo["prelogin"])<$camposFrmTT){
                                $repeat=false;
                            }else{
                                $repeat=false;
                            }
                        }else{
                            $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                            $this->idAlta.=$this->valorRand."  ";
                            $repeat=false;
                        }
                    }
                }while($repeat);
                //array_push($this->campo["login"],$this->dasphalmeneric);
                $this->campo["coherence"].=$this->dasphalmeneric."  ";
                $this->campo["inference"].=$valEnd.":".$checkFieldLong."  ";
            }
            $this->campo["coherence"]=trim($this->campo["coherence"]);
            $this->campo["coherence"]=str_replace("  ","_",$this->campo["coherence"]);
            $this->campo["inference"]=trim($this->campo["inference"]);
            $this->campo["inference"]=str_replace("  ","#",$this->campo["inference"]);
            $this->idAlta=trim($this->idAlta);
            $this->idAlta=str_replace("  ","_",$this->idAlta);


            if(!(count($this->campo["prelogin"])==$camposFrmTT)){
                echo "reporte de fallo desde el constructor<br>";
                echo "se esperaban ".$camposFrmTT." pero se han generado ".count($this->campo["login"])."<br>";
                echo "<pre>";
                print_r($this->campo["login"]);
                print_r($this->iniVal);
                echo "</pre>";
                return "error";
            }
        }else{
            $this->ixIdValRefMap = str_split($this->dasphalmeneric);
            $this->ixValEndRefMap = array_flip($this->ixIdValRefMap);
            $this->valMax=(strlen($this->dasphalmeneric)-$checkFieldLong);
            $chivoAr=fopen("rxtxIO.ofcd","x");
            foreach($this->ixIdValRefMap as $idVal => $valEnd){
                fwrite($chivoAr,$idVal.":".$valEnd."__".$this->ixValEndRefMap[$valEnd].":".(strlen($this->dasphalmeneric)-$checkFieldLong));
            }
            fclose($chivoAr);
        }

        //$this->idAlta=trim($this->idAlta);
        //$this->idAlta=str_replace("  ","_",$this->idAlta);
    }

    private function aleatorio1(&$camposFrmTT){
        $salida=array();
        $iiFrmToTT=-1;
        $repeat=true;
        for($iiFrmToTT=0;$iiFrmToTT<=($camposFrmTT);$iiFrmToTT++){
            do{
                $proofRand=random_int(0,$this->valMax);
                if(!(in_array($proofRand,$this->iniVal,true))){
                    //$this->inputsFields[$this->iniVal[count($this->iniVal)-1]]=array();
                    if(!(count($salida)==$camposFrmTT)){                        
                        $salida[]=random_int(0,$this->valMax);
                        $repeat==true;
                    }else{
                        $repeat=false;
                    }
                }else{
                    $repeat==true;
                }
            }while($repeat==true);
        }
    }
    private function aleatorio2(&$checkFieldLong,&$camposFrmTT){
        $salida=array(array());
        $iiFrmToTT=-1;
        $idIter=-1;
        $idItem=-1;
        $repeat=true;
        for($iiFrmToTT=0;$iiFrmToTT<=($camposFrmTT);$iiFrmToTT++){
            $idIter=count($salida)-1;
            do{
                $proofRand=random_int(0,$this->valMax);
                if(!(in_array($proofRand,$this->iniVal,true))){
                    //$this->inputsFields[$this->iniVal[count($this->iniVal)-1]]=array();
                    if(!(count($salida[$idIter])==$camposFrmTT)){                        
                        $salida[$idIter][]=random_int(0,$this->valMax);
                        $repeat==true;
                    }else{
                        $repeat=false;
                    }
                }else{
                    $repeat==true;
                }
            }while($repeat==true);
            $salida[]=NULL;
        }
    }

    /**
     * $tagFieldFrm - nombre de las tablas de la base de datos
     * $visible - Si el campo sera visible para el usuario: true o False
     * $pathHost - ruta de accion del formulario que contendra los inputs visibles o invisibles
     */
    function salidaRandomField($tagFieldFrm,$visible,$pathHost){
        $salida="";
        $ii=-1;
        if(!(count($this->campo["prelogin"])==count($tagFieldFrm))){
            echo "reporte de fallo desde el montador<br>";
            echo "<pre>";
            print_r($this->campo["prelogin"]);
            print_r($tagFieldFrm);
            echo "</pre>";
            return "error";
        }
        foreach($this->campo["prelogin"] as $idVal => &$valEnd){
            $ii++;
            $salida.=$valEnd."=".$tagFieldFrm[$ii]."  ";
            if($tagFieldFrm[$ii]=="logokey"){
                if($visible){
                    $oculto=chr(34)."checkbox".chr(34)." value=".chr(34)."logokey".chr(34);
                }else{
                    $oculto=chr(34)."hidden".chr(34)." value=".chr(34)."logokey".chr(34);
                }
                $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(34).$this->campo["prelogin"][$ii].chr(34)." id=".chr(34).$tagFieldFrm[$ii].chr(34)." class=".chr(34)."form-check-input".chr(34)." checked>";
                //$this->campo["prelogin"][$ii]=$tagFieldFrm[$ii];
                $this->campo["login"][]=$valEnd;
            }else if($tagFieldFrm[$ii]=="lontrasenia"){
                if($visible){
                    $oculto=chr(34)."password".chr(34);
                }else{
                    $oculto=chr(34)."hidden".chr(34)." value=".chr(34).$this->dasphalmeneric.chr(34);
                }
                $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(39).$this->campo["prelogin"][$ii].chr(39)." id=".chr(39).$tagFieldFrm[$ii].chr(39)." class=".chr(39)."form-control".chr(39).$oculto.">";
                //$this->campo["prelogin"][$ii]=$tagFieldFrm[$ii];
                $this->campo["login"][]=$valEnd;
            }else if($tagFieldFrm[$ii]=="leyenda"){
                $this->inputsFields[$valEnd]="<input type='hidden' value='".$this->campo["coherence"]."_!".$this->campo["inference"]."' name=".chr(39).$this->campo["prelogin"][$ii].chr(39)." id=".chr(39).$tagFieldFrm[$ii].chr(39).">";
                //$this->campo["prelogin"][$ii]=$tagFieldFrm[$ii];
                $this->campo["login"][]=$valEnd;
            }else{
                if($visible){
                    $oculto=chr(34)."text".chr(34);
                }else{
                    $oculto=chr(34)."hidden".chr(34)." value=".chr(34)."logokey".chr(34);
                }

                $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(34).$this->campo["prelogin"][$ii].chr(34)." id=".chr(34).$tagFieldFrm[$ii].chr(34)." class=".chr(34)."form-control".chr(34).$oculto.">";
                //$this->campo["prelogin"][$ii]=$tagFieldFrm[$ii];
                $this->campo["login"][]=$valEnd;
            }
            
        }
        $salida=trim($salida);
        $salida=str_replace("  ","&",$salida);
        /*

        */
        $this->cabezaFrm ="<form action=".chr(34).$pathHost."?".$salida.chr(34)."&".$this->idAlta."='nuevoAlta' method=".chr(39)."post".chr(39).chr(34).">"."\n";
        $this->buttonSubmit[$this->idAlta]="<button type='submit' class='btn btn-primary btn-block mb-4'>_caption_</button>";
        return 1;
    }
    function salidaRandomInputFields($idExitInput){
        if(isset($this->inputsFields[$idExitInput])){
            return $this->inputsFields[$idExitInput]."\n";
        }else{
            echo "reporte de fallo desde el visualizador en id: ".$idExitInput."<br>";
            echo "<pre>";
            echo "inputsFields:<br>";
            print_r($this->inputsFields);
            echo "campo:<br>";
            print_r($this->campo);
            echo $idExitInput;
            echo "</pre>";
            exit;
        }
    }
    function salidaRandomSubmit($caption){
        $salida=array();
        if(isset($this->buttonSubmit[$this->idAlta])){
            $salida=explode("_",$this->buttonSubmit[$this->idAlta]);
            if((count($salida)<3||count($salida)>3)){
                return "error";
            }else if(count($salida)==3){
                return $salida[0].$caption.$salida[count($salida)-1]."\n";
            }
            //$this->$buttonSubmit[$this->idAlta]
        }else{
            return "error";
        }
    }
}




//setcookie();