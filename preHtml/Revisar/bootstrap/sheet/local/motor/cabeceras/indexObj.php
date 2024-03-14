<?php

    class index{
        public int $ejecuta;
        public array $contrucOK;
        public string $uriNow;
        public array $armazon;
        public array $formulario;
        public array $terceros;
        public array $redirecciones;
        public array $rutasIncludes;
        public array $salidaHTML;
        private array $trasvaseHTML; //Temporal donde se asocia el valor de entrada a construir, a esta referencia como sustitucion temporal
        private array $sitiosAdmin;

        /**
         * $accion - porta el valor de redireccion al sitio web a cargar
         * $superGlobSrv - porta la matriz superglobal $_SERVER
         * $redirect - Matriz con todos los sitios a redireccionar
         */
        public function __construct($accion, $superGlobSrv, $redirect){
            if(isset($redirect) && is_array($redirect) && count($redirect)>0){
                $this->ejecuta=$accion;
                $this->uriNow=$superGlobSrv["SERVER_NAME"].$superGlobSrv["REQUEST_URI"];
                $this->redirecciones=$redirect;
            }else{
                $this->construcOK[]=false;
                $this->construcOK[]="No se han establecido las redirecciones";
            }

            if(isset($this->redirecciones) && is_array($this->redirecciones) && count($this->redirecciones)>0){
                $this->construcOK[]=true;
                $this->construcOK[]="Se ha construido adecuadamente";
            }
        }

        /**
         * $superGlobalGet como su nombre indica, porta la referencia de $_GET
         * $integracionHTML es un array que porta el contenido de primeros, de segundos y terceros contenidos web
         *      - $armazon = 0
         *      - $salida = 1
         *      - $terceros = 2
         */
        public function redireccion(&$superGlobGet, $integracionHTML){
            if(!$this->construcOK[0]){
                return $this->construcOK;
            }else{
                unset($this->construcOK);
                $this->construcOK=array();
                $this->construcOK[]=true;
                $this->construcOK[]="Redireccionamos";
                return $this->redirecciones[$this->ejecuta];//    require_once "practicas/inLoginObj.php";
            }
        }
        public function cargaArmazon($entrada){
            if(is_array($entrada) && isset($entrada) && count($entrada) > 0){
                $this->armazon=$entrada;
                return true;
            }else{
                return false;
            }
        }

        public function cargaFormulario($entrada){
            if(is_array($entrada) && isset($entrada) && count($entrada) > 0){
                $this->formulario=$entrada;
                return true;
            }else{
                return false;
            }
        }

        public function cargaTerceros($entrada){
            if(is_array($entrada) && isset($entrada) && count($entrada) > 0){
                $this->terceros=$entrada;
                return true;
            }else{
                return false;
            }
        }

        public function salidaArmazon(){
            return $this->armazon;
        }

        public function salidaFormulario(){
            return $this->formulario;
        }

        public function salidaTerceros(){
            return $this->terceros;
        }
    }
    settype($redirect, "array");
    global $redirect;
    $redirect = array(
        "practicas/inLoginObj.php",
        "wordpress/index.php", 
        "wordpress/wp-login.php", 
        "practicas/ejercicio1.php"
    );

?>