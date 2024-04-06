<?php declare(strict_types=1);

/**
 * Clase que marca al cliente como unico, sin necesidad de conocer sus datos reales de identidad.
 * Marcamos a nuestro cliente y sesgamos el servicio
 */
class cookiesRoottyies{
    private string $rndStrAlpha="";
    private string $rndStrInt="";
    public string $strIdValidation = "";
    private static string $StrAlpha="";
    private static string $StrBetha="";
    private static string $StrInteger="";
    private static string $StrSpecials="";
    private array $rndChunk;
    
    function __construct($datas){
        $this->rndChunk = array(
            "Word" => array(),
            "Int" => array(),
            "Hex" => array(),
            "UUID" => array()
        );
        $this->rndStrAlpha="XxXxXx";
        $this->rndStrInt="101010";
        $this->strIdValidation = "10Xx01xX";
        self::$StrAlpha="ABCDEFGHIJKLMNOPQRST";
        self::$StrBetha=strtolower(self::$StrAlpha);
        self::$StrInteger="0123456789";
        self::$StrSpecials="_/:;()#%@!";
        //$this->rndChunk["UUID"]=array(NULL);

        //$this->rndChunk["Word"] = "";
        $rndMin=-1;
        $rndMax=-1;
        $this->strIdValidation = str_shuffle(self::$StrAlpha).str_shuffle(self::$StrBetha).str_shuffle(self::$StrInteger).str_shuffle(self::$StrSpecials);
        $this->rndChunk["Word"]=str_split(str_shuffle($this->strIdValidation));

    }

    public function showIx(){
        $salida=array();
        /*
        $salida=(
            array(
                $valEnd => array(
                    $this->rndChunk["Int"][count($this->rndChunk["Int"])-1] => array(
                        $this->rndChunk["Hex"][count($this->rndChunk["Hex"])-1] => array()
                    )
                )
            )
        );
        */
        $id8=false;
        $id4a=false;
        $id4b=false;
        $id4c=false;
        $id12=false;
        $i_UUID=0;
        $temp = "";
        $idTemp = array();
        //setcookie('foo', 'bar');
        $ii_UUID=-1;
        $iii_UUID=-1;
        foreach($this->rndChunk["Word"] as $idVal => $valEnd){
            $this->rndChunk["Int"][]= ord($valEnd);
            $this->rndChunk["Hex"][]= dechex(ord($valEnd));
        }
        foreach($this->rndChunk["Word"] as $idVal => $valEnd){
            $iii_UUID=0;
//cambiar por do while
            for($iii_UUID=0;$iii_UUID<32;$iii_UUID++){
                $i_UUID=0;
                $ii_UUID=random_int(0, (count($this->rndChunk["Word"])-1));
                try{
                    $temp.= $this->rndChunk["Hex"][$ii_UUID];
                    if(strlen($temp)<2 || strlen($temp)%2 !=0){
                        throw new Exception(__LINE__." => ".__FILE__);
                    }
                }catch(Exception $e){
                    $salida[] = false;
                    $salida[] = "EF_600";
                    $salida[] = strlen($temp) . $e->getMessage();
                    $salida[] = $this->rndChunk;
                    exit;
                }
                $i_UUID+= strlen($temp);
                if($i_UUID == 8 && !$id8){
                    $this->rndChunk["UUID"][] = $temp;
                    $temp="";
                    $id8=true;
                }
                if($i_UUID == 4 && (!$id4a || !$id4b || !$id4c) && $id8){
                    if(!$id4a){
                        $this->rndChunk["UUID"][count($this->rndChunk["UUID"])-1].= "-".$temp;
                        $temp="";
                        $id4a=true;
                        $id8=true;
                    }else if(!$id4b && $id4a){
                        $this->rndChunk["UUID"][count($this->rndChunk["UUID"])-1].= "-".$temp;
                        $temp="";
                        $id4b=true;
                        $id4a=true;
                        $id8=true;
                    }else if(!$id4c && $id4b){
                        $this->rndChunk["UUID"][count($this->rndChunk["UUID"])-1].= "-".$temp;
                        $temp="";
                        $id4c=true;
                        $id4b=true;
                        $id4a=true;
                        $id8=true;
                    }
                }
                if($i_UUID == 12 && !$id12 && $id4c){
                    $this->rndChunk["UUID"][count($this->rndChunk["UUID"])-1].= "-".$temp;
                    $temp="";
                    $id12=true;
                    $id4c=true;
                    $id4b=true;
                    $id4a=true;
                    $id8=true;
                }
                //$this->rndChunk["UUID"][count($this->rndChunk["UUID"])-1].=dechex(ord($valEnd));
                if($id8 && $id4a && $id4b && $id4c && $id12){
                    $id8=false;
                    $id4a=false;
                    $id4b=false;
                    $id4c=false;
                    $id12=false;
                }
            }
        }
        foreach($this->rndChunk["UUID"] as $idVal => $valEnd){
            try{
                if(strlen($valEnd)<36){
                    throw new Exception("La ultima asignacion no tiene la longitud adecuada<br>\n");
                }
            }catch(Exception $e){
                echo "Excepcion encontrada en: ".__LINE__." ".__FILE__." ".$e->getMessage()."<br>\n";
                exit;
            }

        }
        echo "<pre>";
        echo "UUID<br>\n";
        print_r($this->rndChunk);
        //print_r($ii_UUID);
        echo "</pre>";
    }
}