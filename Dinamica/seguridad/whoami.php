<?php declare(strict_types=1);
    //extrae el directorio inmediatamente precedente al archivo de script.
    //Recibe la ruta completa
    class queScript{
        public string $miArchivo="";
        public string $iknowiam="";
        public bool $status=false;
        public function __construct($queScriptCargo){
            if(empty($queScriptCargo)){
                $this->status=false;
                $this->miArchivo="XxXxXx";
            }else{
                $this->status=true;
                $this->miArchivo=$queScriptCargo;
            }
        }

        public function nombreScript(){
            if(!$this->status && $this->miArchivo=="XxXxXx"){
                $this->iknowiam=$this->miArchivo;
                return false;
            }
            $salida="";
            $directorios=array();
            $directorios = explode("/",$this->miArchivo);
            $posId=count($directorios)-1;
            $arcPHP=explode(".",$directorios[$posId]);
            $posicionIndex = array_search('php', $arcPHP);
            if ($posicionIndex !== false && $posicionIndex > 0) {
                $salida = $directorios[$posId - 1];
                $this->iknowiam=$directorios[$posId - 1];
                return true;
            } else {
                $salida = $directorios[$posId];
                $this->iknowiam=$directorios[$posId];
                return true;
                //return "No se encontró el archivo index.php en la ruta proporcionada.";
            }
        }
    }