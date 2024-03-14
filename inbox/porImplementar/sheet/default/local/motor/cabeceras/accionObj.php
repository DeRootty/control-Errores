<?php
    require_once "dataAccess/usersObj.php";
    require_once "conexionObj.php";
    $enviromentAdminUser=array($referencias,$acceso);
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    exit;
    */
    /**
     * $encabezadosAdmin es un array que contiene los datos de localizacion y acceso del usuario administrativo
     *      - $idsLogines: datos de localizacion: 
     *      - $ixers_Login: datos de acceso a usuario administrativo: 
     * 
     * $setBDAdmin es un array que contiene el entorno de la base de datos administrada por el usuario admin asignado
     * $pasoAFuncion provee un array de arrays, en donde se suministra las siguientes relaciones:
     *      - sqlAdHoc: cadena string con la consulta administrativa de declaracion de entorno.
     *      - ixBDAccess: Los permisos online accesibles en el entorno de acceso.
     *      - ixIdsBDAccess: Matriz que relaciona el usuario admin con el permiso y el estado: Granted, Ok.
     *      - ixIdBDLayer: Matriz reflejo por referencia a su origen: idsLogines
     */
    $seguridad = new passSecure($_SERVER["REQUEST_METHOD"], $_POST, $_GET, $enviromentAdminUser);
    class passSecure{
        private object $createUserAdmin; // new adminControl(); //adminControl($leyendaLogin,$dataLogin);
        private object $definicionEntorno; // = new enviromentDef();
        private array $preLogin = array(); //Tarro de mezcla
        private array $idLogin = array(); //Semillas referenciales
        private array $reLogin = array(); //Preparado en bruto, para su dosificacion
        public array $Login = array(); //Contenedor de salida, con el producto envasado y preparado para su distribucion comercial
        private bool $ejecuta = false;
        private array $actividad=array(); //Variable donde se registra el proceso, para mapearlo en un archivo de salida como un json que refleje el log de actividad.
        private string $campoFrmUnico=""; // Firma de la web mostrada, que la hace unica, o potencialmente unica.
        private string $archivo="";
        //variable de control del flujo secundaria, estableciendo si procede o no, la ejecucion de subcodigo de
        //proceso de errores en interaccion con el usuario web
        private bool $PrimeraCarga=false;

        public array $data;
        public bool $fallo;    

        public function __construct($SrvMethod, $superGlobP, $superGlobG, $datosEnviroment){
            $this->createUserAdmin = new adminControl($datosEnviroment[0],$datosEnviroment[1]);
            
            $this->definicionEntorno = new enviromentDef($datosEnviroment,);
            if ($SrvMethod == "POST") {
                $this->ejecuta=false;
                $this->PrimeraCarga=false;
                $temp=array();
                $checkPassLog=$this->verificaProceso($superGlobP, $superGlobG);
                if($checkPassLog){
                    $temp=$this->logTemp($superGlobG, $superGlobP);
                }
            }else{

            }
            $loggKinOut=$this->verificaTemporal($temp);
            if($loggKinOut){
                $this->Login=$this->sanitizeLogin();
                if(!($this->ejecuta&&(!isset($this->actividad["error"])))){
                    $this->reportaLog();
                }
                //-------------------------- - - - -   -   -   -   
            }
            if($this->ejecuta&&(is_array($this->Login))){

            }

        }//end function __construct
        private function reportaLog(): bool{
            $this->actividad["error"]["fallo"][]= "fallo registrado en nivel datos<br>";
            
            $logger="post.json";
            if(isset($this->actividad)){
                $temp["accion.php"][]=$this->actividad;
                $jsonData=json_encode($temp);
                if(!file_exists($logger)){
                    if (file_put_contents($logger, $jsonData) !== false) {
                        echo "Archivo de registro log guardado por primera vez<br>";
                    }
                }else{
                    $jsonString = file_get_contents($logger); // Lee el contenido del this->archivo JSON en una cadena
                    $temp=json_decode($jsonString,true);
                    $temp["accion.php"][]=$this->actividad;
                    $jsonData=json_encode($temp);
                    unset($this->actividad);
                    if (file_put_contents($logger, $jsonData) !== false) {
                        $this->actividad["error"]["fallo"][] = "Archivo de registro log guardado de forma incremental<br>";
                        return true;
                    }
                }
                //echo "fin accion.php";
            }
        }//end function reportaLog();

        /**
         * Verificacion de los datos obtenidos del formulario. Se verifica que las entradas sean procesables.
         */
        private function verificaProceso($superGlobP, $superGlobG){
            if((is_array($superGlobP))&&(is_array($superGlobG))){
                if((isset($superGlobP))&&(isset($superGlobG))){
                    return true;
                }else{
                    //variable de control del flujo ppal, estableciendo si procede o no, la ejecucion del codigo del
                    // contenido ppal de la web. Descarta el procesamiento de errores y deriva siempre
                    //al index de login
                    $this->actividad["error"]["fallo"]["incoherencia"][]="GET-POST"."_Error: El campo no contiene datos<br>";
                    unset($this->idLogin);
                    unset($this->preLogin);
                }
            }else{
                $this->actividad["error"]["fallo"]["incoherencia"][]="GET-POST"."_Error: El campo no contiene datos<br>";
                unset($this->idLogin);
                unset($this->preLogin);
            }
            return false;
        } // End function verificaProceso(){}
        /**
         * 
         * para el enfoque compatible de la securizacion
         * de la conexion con login, se verifica que todos los campos contengan informacion valida procedente del formulario.
         * Este es el nucleo de la recogida del dato del formulario.
         * 
         */
        private function logTemp($superGlobG, $superGlobP){
            $temp=array();
            foreach($superGlobP as $idVal => $valEnd){
                if(isset($superGlobG[$idVal])){
                    if((isset($valEnd))&&(!is_null($valEnd))&&(!($valEnd==""))){
                        //$this->preLogin[$superGlobG[$idVal]]=filter_var($valEnd,FILTER_SANITIZE_SPECIAL_CHARS);
                        $this->preLogin["flop"][$superGlobG[$idVal]]=htmlentities($valEnd);
                        $this->preLogin["flip"][$idVal]=htmlentities($valEnd);
                        $this->idLogin["flip"][$idVal]=htmlentities($superGlobG[$idVal]);
                        $this->idLogin["flop"][$superGlobG[$idVal]]=htmlentities($idVal);
                        $this->campoFrmUnico.=$idVal."  ";
                        //Se crea id unico de formulario
                        $this->ejecuta=true;
                    }else{
                        if($valEnd=="logokey"){
                            if(!isset($temp["remember"])){
                                $temp["remember"]["formulario"]="La casilla de recuerdo ha sido activada";
                            }
                            $this->ejecuta=true;
                        }else{
                            $temp["error"]["fallo"][$idVal]=$superGlobG[$idVal]."_Error: El campo no contiene datos";

                            //$fallo[$superGlobG[$idVal]][]=$idVal;
                        }
                    }
                }else{
                    unset($this->idLogin);
                    unset($this->preLogin);
                    echo $idVal."<br>";
                    $temp["error"]["fallo"][$idVal]=$superGlobG[$idVal]."_Error: GET no tiene el campo solicitado ".$idVal."<br>";                        
                }
            }
            if(!isset($temp["error"]["fallo"])){
                unset($superGlobP);
                $this->actividad["flow"][]="Inicio de this->archivo accion_php";
                if(isset($temp["remember"]["formulario"])){
                    $this->actividad["remember"]=true;
                }
                if($this->ejecuta==true){
                    $this->actividad["remember"]=true;
                }
            }else if(isset($temp["error"])){
                $this->actividad["error"]=$temp["error"];
                //echo $_SERVER["SERVER_NAME"]."<br>";
                //header('Location: '.$_SERVER["SERVER_NAME"]);
            }
            return $temp;
        }//End function logTemp
        /**
         * 
         * Paso de los datos, ya libre de errores ($temp), obtenidos del formulario, contenido en las variables superglobales,
         * a otra variable de flujo ($this->actividad), adaptado al formato de integracion.
         * 
         */
        private function verificaTemporal($temp){
            if(!isset($this->actividad["error"])){
                if(!isset($this->actividad["flow"])){
                    if(!isset($this->actividad["error"])){
                        if(!isset($this->actividad["control"])){
                            if(count($this->actividad)==0){
                                $this->actividad=$temp;
                                $this->actividad["control"]["accion_php"][]="Inicio con post reseteada";
                            }
                        }
                    }
                }

                if($this->ejecuta&&!isset($this->campoFrmUnico)){

                }else if($this->ejecuta&&isset($this->campoFrmUnico)){
                    $this->campoFrmUnico=trim($this->campoFrmUnico);
                    $testUnic=array();
                    $testUnic=explode("_",$this->campoFrmUnico);
                    if(count($testUnic)==4||count($testUnic)==3){
                        $this->campoFrmUnico=str_replace("  ","_",$this->campoFrmUnico);
                    }else{

                    }
                }
                if(isset($temp["error"])){
                    $superGlobP["error"]=$temp["error"];
                }
            }else if(isset($superGlobP["error"]["fallo"])){
                if(count($superGlobP["error"]["fallo"])>0){
                    unset($this->preLogin);
                    unset($this->idLogin);
                    unset($Login);
                    unset($this->reLogin);
                    unset($fallo);
                    unset($this->ejecuta);
                    $this->ejecuta=false;
                }
            }
        }//end verificaTemporal
        /**
         * antesala al volcado de los datos del formulario, a la variable definitiva.
         * Habilitara la variable definitiva, que servira para la ejecucion de las funciones de inicio de sesion
         * en el sitio de internet que tenga integrado este modelo de validación.
         * 
         */
        private function sanitizeLogin(){
            if($this->ejecuta){
                $salida=array();
                if(count($this->idLogin["flip"])>0){
                    foreach($this->idLogin["flip"] as $idVal => $valEnd){
                        if(!($valEnd=="logokey")){
                            $this->reLogin["UserTupName"]["inicio"]["flip"][$idVal]=password_hash($this->preLogin["flip"][$idVal], PASSWORD_BCRYPT,["cost"=>12]);
                            $this->reLogin["UserTupName"]["inicio"]["flop"][$this->idLogin["flop"][$valEnd]]=$this->preLogin["flip"][$idVal];
                            $this->reLogin["UserTupName"]["inicio"]["flup"][$valEnd]=$this->preLogin["flip"][$idVal];
                        }else if($this->ejecuta&&isset($this->campoFrmUnico)){
                            $this->reLogin["UserTupName"]["inicio"]["flip"][$idVal]=password_hash(htmlentities($this->campoFrmUnico), PASSWORD_BCRYPT,["cost"=>12]);
                            $this->reLogin["UserTupName"]["inicio"]["flop"][$this->idLogin["flop"][$valEnd]]=htmlentities($this->campoFrmUnico);
                            $this->reLogin["UserTupName"]["inicio"]["flup"][$valEnd]=htmlentities($this->campoFrmUnico);
                            $this->actividad["remember"]=true;
                        }
                    }
                }else{
                    $this->actividad["error"]["urlGET"]="No era de esperar, que los valores de integridad de formulario fuesen distintos<br>";
                    $this->ejecuta=false;
                }
                $this->archivo = "C:/xampp/htdocs/practicas/dataAccess/sesion/result".$this->reLogin["UserTupName"]["inicio"]["flop"][$this->idLogin["flop"]["luser"]].".json";
                $jsonData = json_encode($this->reLogin);
                $salida = json_decode($jsonData, true); // Convierte la cadena JSON en un array asociativo
                unset($this->campoFrmUnico);
                // Especifica la ruta y el nombre del this->archivo de texto
                //asegurar que la ruta existe
                unset($this->reLogin);
                unset($this->preLogin);
                return $salida;
            }else{

            }
            return "error";
        }//end function sanitizeLogin
    //-----------------------------------------------------------------------------------

        private function conxAdmin(){
            $this->actividad["flow"]="llamada a dataAccess ª users_php<br>";
            $ixers_Login=$this->createUserAdmin->salidaAdminLogin(0);
            $idsLogines=$this->createUserAdmin->salidaIdsLogin();
            $this->actividad["flow"]="llamada a conexion_php<br>";
            $datosEntorno=$this->definicionEntorno->salidaIxDbAccess(["OnLine"],[$idsLogines[3]],[count($ixDbAccess["OnLine"][$idsLogines[3]])-1]);
    //---------------------------- - - - - - 
            $datosEntorno=$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1];
            $ixBDConexion[$datosEntorno]=$this->definicionEntorno->obtenNombresTabla($pasoAFuncion,$conn);
            require_once "clases.php";
            $camposTablaDatos=entorname($pasoAFuncion,$conn,$ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]);
            //Saneamiento de contrasenia
            $campos=array();
            $campo="";
            $SQLWhere="";
            $SQLWhere1="";
            $SQLWhereCrypt="";
            $SQLWhere1crypt="";
            //$sql = file_get_contents($archivoSQL);
            //saneando contrasenia
            $contraste1=array("logokey"=>array());
            $contraste1=array("leyenda"=>array());
            $contraste1["logokey"]=explode("_",$Login["UserTupName"]["inicio"]["flup"]["logokey"]);
            $contraste1["leyenda"]=explode("_",$Login["UserTupName"]["inicio"]["flup"]["leyenda"]);
            $contraste2=array_pop($contraste1["leyenda"]);
            $inferencia1=explode("!",$contraste2);
            $inferencia2=explode("#",$inferencia1[count($inferencia1)-1]);
            $posicion=array();
            $pozoOk=array();
            if(count($contraste1["logokey"])==count($contraste1["leyenda"])){
                //iniciamos el proceso de las tablas de asignacion
                $idIItt=count($contraste1["logokey"])-1;
                echo "Se han establecido ".($idIItt+1)." registros a sanear<br>";
                foreach($contraste1["leyenda"] as $idVal => $valEnd){
                    $idII=-1;
                    //entramos en bucle con tendencia a coincidir
                    do{
                        //llevamos las vueltas, para no estar a lo tonto repitiendo lo mismo en modo infinito
                        $idII++;
                        //Exponemos la tabla de asignacion a contraste con el logokey que nos entra, para encontrar en que parte
                        //de la tabla de asignacion empieza el logokey, y si es en esta tabla o no, donde debemos buscar
                        if($idII<=$idIItt){
                            if(strpos($valEnd,$contraste1["logokey"][$idII])!==false){
                                //nos aseguramos que no ha sido anteriormente seleccionado
                                if(!in_array($contraste1["logokey"][$idII],$pozoOk,true)){
                                    $posicion[]=strpos($valEnd,$contraste1["logokey"][$idII]);
                                    $compp=array();
                                    foreach($inferencia2 as $idVal1 => $valEnd1){
                                        $compp=explode(":",$valEnd1);
                                        if($compp[0]==$posicion[count($posicion)-1]){
                                            $muestra1=substr($valEnd,$compp[0],$compp[1]);
                                            if($muestra1==$contraste1["logokey"][$idII]){
                                                $pozoOk[]=$muestra1;
                                                break;
                                            }
                                            //$muestra2=substr();
                                        }
                                    }
                                }
                            }
                        }
                    }while($idII<=$idIItt);
                }
            }else{
                $this->actividad["error"]["fallo"][]= "Contraste<br>";
                $this->actividad["error"]["fallo"][]= $contraste1;
                $this->actividad["error"]["fallo"][]=$inferencia2;
                //print_r($ixBDConexion[$datosEntorno]);
                $this->actividad["error"]["fallo"][]= "Los contadores de matriz no permiten el saneamiento de la contrasenia: logokey -> ".count($contraste1["logokey"])." || leyenda: ".count($contraste1["leyenda"])."<br>";
                $this->ejecuta=false;
            }
            if((count($pozoOk)<4)){
                $this->actividad["error"]["forbidden"]="Inicio de sesion abortada 1. Se reportan ".count($pozoOk)." saneados.";
                $PrimeraCarga=true;
                $this->actividad["flow"]["inLogin_php"][]="Se carga el acceso al codigo en linea ".__LINE__;
                //require_once "C:/XAMPP/htdocs/practicas/inLoginObj.php";
                $cabecerasOriginales=12;
                $this->ejecuta=0;
                //require_once "C:/XAMPP/htdocs/index.php";
                //require_once "inLogin.php";
                require_once "inLoginObj.php";
            }else{
                if(isset($this->actividad["flow"])){
                    if(isset($this->actividad["flow"]["inLogin_php"])){
                        $this->actividad["flow"]["inLogin_php"][]="Se deriva la carga, pues se han saneado las variables de entorno, y se continua el flujo en accion.php en linea ".__LINE__;
                    }
                }else{
                    $this->actividad["flow"]["inLogin_php"]=array();
                    $this->actividad["flow"]["inLogin_php"][]="La variable post se ha tenido que regenerar, Se deriva la carga, pues se han saneado las variables de entorno, y se continua el flujo en accion.php en linea ".__LINE__;
                }
                /*
                if(isset($this->actividad["flow"]["inLogin_php"])){
                    if(is_array($this->actividad["flow"]["inLogin_php"])){
                        $this->actividad["flow"]["inLogin_php"][]="Se deriva la carga, pues se han saneado las variables de entorno, y se continua el flujo en accion.php en linea ".__LINE__;
                    }else{
                        $this->actividad["flow"]["inLogin_php"]=array();
                        $this->actividad["flow"]["inLogin_php"][]="La variable post se ha tenido que regenerar, Se deriva la carga, pues se han saneado las variables de entorno, y se continua el flujo en accion.php en linea ".__LINE__;
                    }
                }
                */
                foreach($pozoOk as $idVal => &$valEnd){
                    $idII=-1;
                    do{
                        $idII++;
                        //echo $Login["UserTupName"]["inicio"]["flup"][$camposTablaDatos[$idII]]."<br>";
                        if($Login["UserTupName"]["inicio"]["flop"][$valEnd]==$Login["UserTupName"]["inicio"]["flup"][$camposTablaDatos[$idII]]){
                            ${$camposTablaDatos[$idII]}=$valEnd;
                            ${$valEnd}=$camposTablaDatos[$idII];
                            break;
                        }
        
                    }while($idII<=(count($camposTablaDatos)-1));
                }

    //----------------------------------------------------------------------------------------------
                foreach($Login["UserTupName"]["inicio"]["flop"] as $idVal => $valEnd){
                    $campos[]=${$idVal};
                    $campo.=${$idVal}."  ";
                }
                $campo=trim($campo);
                $campo=str_replace("  ",", ",$campo);
                foreach($campos as $idVal => $valEnd){
                    $compara=$Login['UserTupName']['inicio']['flup'][$valEnd];
                    //foreach($Login["UserTupName"]["inicio"]["flup"][$valEnd] as $idVal1 => $valEnd1){
                        if((!($valEnd=="logokey"))&&(!($valEnd=="leyenda"))&&(!($valEnd=="lontrasenia"))){
                            $SQLWhere.=trim($valEnd)." = '".trim($compara)."'"."  ";
                            $SQLWhereCrypt.=trim($valEnd)." = '".trim($compara)."'"."  ";
                        }else{
                            //$SQLWhere1crypt=" AND (".$valEnd." = '".$valEnd1."'"." OR ".$valEnd." LIKE '%')";
                            //$SQLWhere1=" AND (".$valEnd." = '".$idVal1."'"." OR ".$idVal1." LIKE '%')";
                        }
                    //}
                }
                $SQLWhere=trim($SQLWhere);
                $SQLWhere=str_replace("  "," AND ",$SQLWhere);
                $sqlCrypt="SELECT ".trim($campo)." FROM usuarios WHERE ".trim($SQLWhereCrypt).trim($SQLWhere1crypt).";";
                $sql="SELECT ".trim($campo)." FROM usuarios WHERE ".trim($SQLWhere).trim($SQLWhere1).";";
                //unset($SQLWhere);
                //unset($campos);
                //unset($campo);
                $this->actividad["depura"]["SQL"]["plano"]=trim($sql);
                $this->actividad["depura"]["SQL"]["crypt"]=trim($sqlCrypt);
                if($sql===false){
                    $this->actividad["error"]["fallo"][]= "Archivo sql no encontrado";
                    $this->ejecuta=false;
                }else{
                    $result = mysqli_query($conn, $this->actividad["depura"]["SQL"]["plano"]);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Dentro de este bucle, puedes acceder a cada fila de resultados
                            // utilizando la variable $row.
                            if(password_verify($Login["UserTupName"]["inicio"]["flop"][$lontrasenia],$row['lontrasenia'])){
                                $this->actividad["logonOK"][]="El login ha tenido exito<br>";
                                $Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["ixBDConexion"]=$ixBDConexion;
                                $Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["ixDbAccess"]=$ixDbAccess;
                                $Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["idsLogines"]=$idsLogines;
                                //echo $this->archivo."<br>";
                                if (file_put_contents("borrame.path", $this->archivo) !== false) {
                                    if(file_exists("borrame.path")){
                                        $jsonString = file_get_contents("borrame.path"); // Lee el contenido del this->archivo JSON en una cadena
                                        $this->actividad["session"]["control"]["ruta"][]=$this->archivo."||ruta Sesion luser";
                                        $this->actividad["session"]["control"]["ruta"][]=$jsonString."||ruta por verificar";
                                        $this->actividad["session"]["control"]["ruta"][]="Se ha verificado la existencia del this->archivo temporal borrame.path";
                                        $PrimeraCarga=false;
                                    }else{
                                        $jsonString = file_get_contents("borrame.path"); // Lee el contenido del this->archivo JSON en una cadena
                                        $this->actividad["session"]["control"]["ruta"][]=$this->archivo."||ruta Sesion luser";
                                        $this->actividad["session"]["control"]["ruta"][]=$jsonString."||ruta por verificar";
                                        $this->actividad["session"]["control"]["ruta"][]="No se ha podido verificar la existencia del this->archivo";
                                    }

                                }

                                if(isset($this->actividad["flow"])){
                                    if(isset($this->actividad["flow"]["logonOk_php"])){
                                        if(is_array($this->actividad["flow"]["logonOk_php"])){
                                            $this->actividad["flow"]["logonOk_php"][]="Se carga el acceso al codigo del this->archivo logonOk_php en linea ".__LINE__;
                                        }else{
                                            $this->actividad["flow"]["logonOk_php"]=array();
                                            $this->actividad["flow"]["logonOk_php"][]="La variable post se ha tenido que regenerar, Se carga el acceso al codigo del this->archivo logonOk_php en linea ".__LINE__;
                                        }
                                    }
                                }else{
                                    $this->actividad["flow"]["logonOk_php"]=array();
                                }
                                if(isset($this->actividad["flow"]["logonOk_php"])){
                                    if(is_array($this->actividad["flow"]["logonOk_php"])){
                                        $this->actividad["flow"]["logonOk_php"][]="Se carga el acceso al codigo del this->archivo logonOk_php en linea ".__LINE__;
                                    }else{
                                        $this->actividad["flow"]["logonOk_php"]=array();
                                        $this->actividad["flow"]["logonOk_php"][]="La variable post se ha tenido que regenerar, Se carga el acceso al codigo del this->archivo logonOk_php en linea ".__LINE__;
                                    }
                                }else{
                                    $this->actividad["flow"]=array(array("logonOk_php"=>array()));
                                    $this->actividad["flow"]["logonOk_php"][]="La variable post se ha tenido que regenerar, Se carga el acceso al codigo del this->archivo logonOk_php en linea ".__LINE__;
                                }

                                $this->ejecuta=true;
                                $this->actividad["flow"]["logonOk_php"][]="Se invoca la carga del this->archivo logonOk_php";
                                require_once "logonOk.php";
                                break;
                            }else{
                                $this->ejecuta=false;
                                break;
                            }
                        }
                        if(!$this->ejecuta){
                            $this->actividad['error']['login']="Login fallido";
                            //require_once "inLogin.php";
                            require_once "inLoginObj.php";
                            //require_once "C:/XAMPP/htdocs/practicas/inLogin.php";
                            //require_once "C:/XAMPP/htdocs/index.php";
                        }else{
                            $this->actividad["flow"]["logonOk_php"][]="El proceso de validacion con base de datos ha sido todo un exito. La sesion se recuerda, en formato json";
                        }

                    //session_destroy();
                    }else{
                        if(!$PrimeraCarga){
                            $this->actividad["error"]= $Login;
                        }
                        $this->actividad["flow"]["inLogin_php"][]="Se carga el acceso a inLogin_php en codigo de linea ".__LINE__;
                        //require_once "C:/XAMPP/htdocs/practicas/inLogin.php"; //carga el sitio web
                        //require_once "C:/XAMPP/htdocs/index.php"; //carga el sitio web
                        require_once "inLoginObj.php"; //carga el sitio web
                        //require_once "inLogin.php"; //carga el sitio web
                    }
                    $this->actividad["flow"]["inLogin_php"][]="Se invoca la carga del this->archivo inLogin_php, desde accion_php, en codigo de linea ".__LINE__;
                    require_once "inLoginObj.php"; //carga el sitio web
                    //require_once "inLogin.php"; //carga el sitio web
                    //require_once "C:/XAMPP/htdocs/practicas/inLogin.php"; //carga el sitio web
                    //require_once "C:/XAMPP/htdocs/index.php"; //carga el sitio web
                    /*
                    echo "<pre>";
                    echo "Visualizando desde accion<br>";
                    echo "ixBDConexion<br>";
                    print_r($ixBDConexion);
                    echo "ixDbAccess<br>";
                    print_r($ixDbAccess);
                    echo "idsLogines<br>";
                    print_r($idsLogines);
                    echo "</pre>";
                    exit;
                    */
        
                    // Guarda el contenido en el this->archivo
    //------------------------------------------------------------------------------------
                }
            }
            $this->actividad["logonOK"][]="cerramos conexion a base de datos ".__LINE__;
            mysqli_close($conn);
        }


    }



    require_once "inLoginObj.php";
    //require_once "inLogin.php";
    if(isset($logger)&&$logger!==""){
        //header('Location: http://'.$_SERVER["SERVER_NAME"]);
        if(!file_exists("index.php")){
            require_once "../index.php";
        }else{
            require_once "index.php";
        }
    }else{
        echo "Error en los indices en linea: ".__LINE__." en el archivo ".__FILE__."<br>\n";
        exit;
    }
    require_once "../index.php";

?>