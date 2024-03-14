<?php
    class renderHTML{
        /**
         * Esta clase solo procesa dos matrices de resultados, en referencia al html a mostrar.
         * Por un lado, procesa la matriz this->armazon, o el esquema comun corporativo. Por otro lado
         * procesa una matriza de resultados, que da como visualizacion campos de formulario.
         * Esta clase se encarga de integrar los formulaios en el this->armazon.
         * 
         * Se ha definido un protocolo de cohesion, pues cabe la posibilidad de integrar una tercera matriz, o una cuarta o n integraciones.
         * Al ser la version mas basica, integra this->armazon html, siendo que las pruebas se han realizado con formularios de login.
         * 
         * $this->armazon - set de resultado en forma de matriz, la cual contiene las partes comunes al sitio gestionado.
         * $entrada - set de resultados en forma de matriz, que contiene el o los formulario/s a integrar y los puntos de integracion.
         * $cliente - nombre de la maquina que solicita la integracion.
         * $modalidad - variable que marca el comportamiento, en tres formas esperadas de interaccion:
         *      0 - Modalidad predeterminada.
         *      1 - Modalidad ante una respuesta de error.
         *      2 - Modalidad ante una respuesta de fallo.
         *      3 - Modalidad ante un acceso permitido.
         *      4 - Modalidad ante un acceso general o visita consentida
         * 
         * Para gestionar cada una de las modalidades, se ha definido un protocolo de integracion y una logica de condicion.
         */
        public const START_IN ="X__V__jK";          //Parte de la logica del flujo de integracion, actualmente en desuso, pero contemplada en la integracion de publicidad, o en el proceso de enlaces a terceros
        public const START_OUT = "K__V__jX";        //Parte de la logica del flujo de integracion, actualmente en desuso, forma parte del balanceo en la logica de la constante START_IN, ambas contrapesan el flujo de integracion de terceros
        public const IN ="Xj__V__K";                //Parte de la logica del flujo de integracion, actualmente en uso, contampla la integracion de formularios en armazones html de imagen corporativa
        public const OUT = "Kj__V__X";              //Parte de la logica del flujo de integracion, actualmente en uso, 
        public const END_IN ="X__j__K";             //Parte de la logica del flujo de integracion, actualmente en desuso, pensada para cerrar las entradas iniciadas con START_IN
        public const END_OUT = "K__j__X";           //Parte de la logica del flujo de integracion, actualmente en desuso, pensada para cerrar las salidas y ceder el control, indicando que, la linea de ingracion ppal, es la que tiene el peso de concluir.
        public const ARMazon="entradaArmazonHTML";
        public const INformularioHTML="entradaFormularioHTML";
        public const INtercerosHTML="entradaTercerosHTML";
        public const Ruta="practicas/inLogin.php";

        public const LeyendaInOutTT="InOutTT";
        public const LeyendaCount="Count";
        static int $X__V__jK=0;                         // Forma parte de la unidad de dato tipo
        static int $K__V__jX=1;
        static int $Xj__V__K=2;
        static int $Kj__V__X=3;
        static int $X__j__K=4;
        static int $K__j__X=5;
        private static string $refIN;                   // = IN;
        private static string $refOUT;                  // = OUT;
        private static string $refEND_IN;               // = END_IN;
        private static string $refEND_OUT;              // = END_OUT;
        private static string $refSTART_IN;             // = START_IN;
        private static string $refSTART_OUT;            // = START_OUT;
        private static string $refARMazon;              // = ARMazon;
        private static string $refINformularioHTML;     // = INformularioHTML;
        private static string $refINtercerosHTML;       // = INtercerosHTML;
        private static array $leyendaHTMLsalidaFin;
        private static string $refLeyendaInOutTT;       // = LeyendaInOutTT;
        private static string $refLeyendaCount;         // = LeyendaCount;
        private static array $leyendaGral;

        static array $leyendaFlow;
        static array $leyendaRender;
        public string $montajeFinal;                            //Salsa lista para servir
        static array $idIitTT;
        private static int $iItIN=-1;                           //suministro o inicio en mezcla, por la parte del 'aceite'
        private static int $iItOUT=-1;                          //corte o final en mezcla, por la parte del 'aceite'
        private static int $iItGRAL=-1;                         //volucion gral en mezcla, por la parte del 'aceite'
        private static int $iiItIN=-1;                          //suministro o inicio en mezcla por parte del 'agua'
        private static int $iiItOUT=-1;                         //corte o final en mezcla por parte del 'agua'
        private static int $iiItGRAL=-1;                        //volucion gral en mezcla por parte del 'agua'
        private static array $iItTT;
        public array $mainStream;                         //volucion del preparado a renderizar
        private static array $checkFlow;                              //Control de la mezcla general
        private static int $iiiIt=-1;                                       //volucion paso a paso de la mezcla de la salsa en general
        private static int $idConstruct=-1;                                 //Identificador del 'preparado' (instancia)
        static string $idServicioGral;
        private static int $lineasTT=-1;

        public function __construct($armazon, $entrada,&$cliente, &$modal){
            //echo "Iniciando constructor<br>\n";
            $iIntegra=-1;
            $valEnding=-1;

            self::$refIN = self::IN;//---------------0
            self::$refOUT = self::OUT;//-------------1
            self::$refEND_IN=self::END_IN;//---------2
            self::$refEND_OUT=self::END_OUT;//-------3
            self::$refSTART_IN=self::START_IN;//-----4
            self::$refSTART_OUT=self::START_OUT;//---5
            self::$refARMazon = self::ARMazon;//-----id de enrutado al arreglo de entrada html del this->armazon
            self::$refINformularioHTML = self::INformularioHTML;//-id de enrutado para el arreglo de entrada html del formulario
            self::$refINtercerosHTML = self::INtercerosHTML;//-id de enrutado para el arreglo de entrada html de terceros
            self::$leyendaHTMLsalidaFin = array(self::$refARMazon, self::$refINformularioHTML, self::$refINtercerosHTML);
            self::$refLeyendaInOutTT = self::LeyendaInOutTT;
            self::$refLeyendaCount = self::LeyendaCount;
            //----------------------------0-------------1--------------2-----------------3-----------------4-------------------5
            self::$leyendaFlow=array(self::$refIN, self::$refOUT, self::$refEND_IN, self::$refEND_OUT,self::$refSTART_IN, self::$refSTART_OUT);
            self::$leyendaRender=array(self::$refARMazon, self::$refINfrmHTML);
            self::$leyendaGral=array(
                self::$refLeyendaCount,
                self::$refLeyendaInOutTT
            );

            //tope total de entradas a 'emulsionar' del lado del 'aceite'
            self::$iItTT=array(
                self::$leyendaRender[0]=>array( 
                    self::$leyendaGral[0]=>-1,
                    self::$leyendaGral[1]=>&self::$iItGRAL,
                    self::$leyendaFlow[0]=>&self::$iItIN,
                    self::$leyendaFlow[1]=>&self::$iItOUT,
                    self::$leyendaFlow[2]=>false,
                    self::$leyendaFlow[3]=>false,
                    self::$leyendaFlow[4]=>false,
                    self::$leyendaFlow[5]=>false

                ),
                self::$leyendaRender[1]=>array(
                    self::$leyendaGral[0]=>-1,
                    self::$leyendaGral[1]=>&self::$iiItGRAL,
                    self::$leyendaFlow[0]=>&self::$iiItIN,
                    self::$leyendaFlow[1]=>&self::$iiItOUT,
                    self::$leyendaFlow[2]=>false,
                    self::$leyendaFlow[3]=>false,
                    self::$leyendaFlow[4]=>false,
                    self::$leyendaFlow[5]=>false
                )
            );
            self::$idServicioGral=$cliente;//definicion de la instancia
            self::$idConstruct++;//numero de instaciancia
            $emulsion=array($this->armazon,$entrada); //contenedor local para disposicion de los ingredientes
            $discrimina="";//
            self::$lineasTT=(count($this->armazon)-1)+(count($entrada)-1);
            $iIntegra=0;
            if($iIntegra<0||self::$idConstruct<0){
                echo "Error en los indices<br>\n";
                exit;
            }
            $valEnding=0;
            $iLoc=-1;
            //echo "Constructor llama a armazonHTML<br>\n";
            $valEnding= $this->armazonHTML($emulsion, $iIntegra, $valEnding);//Solicitud a 'cocina', para el preparado
        }//end function __construct
        private function cargaMain(){
            self::$leyendaHTMLsalidaFin;
        }//end function cargaMain

        private function entradaArmazonHTML($entradaZonHtml,$flipFlop,&$idClass): int{        

        }//end function entradaArmazonHTML
        private function entradaFormularioHTML($entradaZonHtml,$flipFlop,&$idClass): int{        

        }//end function entradaFormularioHTML
        private function entradaTercerosHTML($entradaZonHtml,$flipFlop,&$idClass): int{        

        }//end function entradaTercerosHTML

        private function cargaCabeceras(){

        }//end function cargaCabeceras
        private function cargaArchivo(){
            if (file_exists($rutaTextoHTML)) {
                // Cargar el archivo XML
                //$xml = simplexml_load_file($archivo);
                $this->salida[$qCargo]=file($rutaTextoHTML, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                if ($salida) {
                    return $this->salida[$qCargo];
                } else {
                    echo "No se pudo cargar el archivo.";
                }

            } else {
                echo "El archivo AHML no existe.";
            }
        }//end function cargaArchivo
        private function salidaArmazonHTML($entradaZonHtml,$flipFlop,&$idClass): int{
            $valEnding=array("comment"=>array(),"html"=>array(),"checkFlow"=>array(),"contadores"=>array());
            $valEnding["comment"][]= "<p>Tienes que abrir codigo fuente de esta pagina, para leer el reporte de depuracion</p><br>";
            $valEnding["comment"][]= "<!-- Inicio armazonHTML --> <br>";
            $contOkHtml=-1;
            //foreach();
            flush();
            $flow=false;
            $idLinea= $idClass;
            foreach($entradaZonHtml[$flipFlop] as $idVal => &$valEnd){
                if($idClass==0){
                    if($valEnd==self::$refIN){
                        //echo "<!-- Ref. A - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                    }else if($valEnd==self::$refOUT){
                        //echo "<!-- Ref. OUT A - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                        if($flipFlop==1){
                            return 0;
                            //$flipFlop=0;
                        }else{
                            $idFlop=1;
                            $criterio=explode("__",$idVal);
                            $idFlipFloping=max($criterio);
                            //echo "<!-- Ref. OUT B - flipFlop: ".$idFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                            $valEnding["retorno"]=$this->salidaArmazonHTML($entradaZonHtml,$idFlop,$idFlipFloping);
                            if($valEnding["retorno"]==-1){
                                return -1;
                            }
                            //echo "<!-- Ref. OUTING B - flipFlop: ".$idFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                        }
                    }else if(
                        ($valEnd!==self::$refEND_OUT)&&
                        ($valEnd!==self::$refEND_IN)&&
                        ($valEnd!==self::$refSTART_OUT)&&
                        ($valEnd!==self::$refSTART_IN)
                    ) {
                        $flow=true;
                    }

                    if($flow){
                        if(
                            ($valEnd!==self::$refIN)&&
                            ($valEnd!==self::$refOUT)&&
                            ($valEnd!==self::$refEND_OUT)&&
                            ($valEnd!==self::$refEND_IN)&&
                            ($valEnd!==self::$refSTART_OUT)&&
                            ($valEnd!==self::$refSTART_IN)){
                            //echo "<!-- Ref. C - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                            //$this->mainStream[]="<!-- Ref. C - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                            $this->mainStream[]=$valEnd;
                        }
                    }
                }else{
                    //$buscaLin=$idLinea+1;
                    $frmLinea="__".($idLinea)."__";
                    //echo "<!-- Ref. IN A : LINEA: ".$frmLinea." - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                    if($idVal==$frmLinea){
                        if(isset($entradaZonHtml[$flipFlop][$frmLinea])){
                            //echo "<!-- Ref. IN B : LINEA: ".$frmLinea." - flipFlop: ".$flipFlop." - ".$idVal." --> <!-- valEnd: ".$valEnd." --> <br>\n";
                            $idClass=0;
                        }
                    }else{
                        reset($entradaZonHtml[$flipFlop]);
                        array_shift($entradaZonHtml[$flipFlop]);
                    }
                }
            }
            return -1;            
        }
        private function formularioHTML(&$entradaZonHtml){

        }
        private function tercerosHTML(&$entradaZonHtml){

        }
        public function muestraHTML(): string{
            if($this->mainStream==""){
                return "error";
            }else{
                $this->formulario=implode("\n", $this->mainStream);
                return $this->formulario;
            }

        }
    }//End Class renderHTML

    public class inLoginHTML{
        private array $actividad;
        public array $armazon;
        public array $formulario;
        public array $terceros;
        private array $salidas;

        public function __construct(){
            $this->salidas=array("armazon" =>array());
            $this->salidas=array("formulario" =>array());
            $this->salidas=array("terceros" =>array());
        }

        public function cargaArmazon($rutaTextoHTML){
            $this->armazon=$this->rutinaCarga($rutaTextoHTML,"armazon");
        }

        public function cargaFormulario($rutaTextoHTML){
            $this->formulario=$this->rutinaCarga($rutaTextoHTML,"formulario");
        }

        public function cargaTerceros($rutaTextoHTML){
            $this->terceros=$this->rutinaCarga($rutaTextoHTML,"terceros");
        }

        private function rutinaCarga($rutaTextoHTML, $qCargo){
            if (file_exists($rutaTextoHTML)) {
                // Cargar el archivo XML
                //$xml = simplexml_load_file($archivo);
                $this->salida[$qCargo]=file($rutaTextoHTML, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                if ($salida) {
                /*
                    // Convertir los datos en una matriz
                    foreach ($xml->registro as $registro) {
                        $registro_array = [
                            'id' => (string) $registro->id,
                            'nombre' => (string) $registro->nombre,
                            // Puedes añadir más elementos aquí si es necesario
                        ];
            
                        $salida[] = $registro_array;
                    }
            
                    // Mostrar la matriz resultante
                    print_r($salida);
                */
                    return $this->salida[$qCargo];
                } else {
                    echo "No se pudo cargar el archivo.";
                }

            } else {
                echo "El archivo AHML no existe.";
            }
        }
    }

$this->armazon=array();
$this->formulario=array();
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="K__V__jX";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
$tempLinea=explode("__",$calLinea); $frmLinea = max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "X__V__jK";        
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";

    $ejecuta=1;
    $antesPost=false;
    if(!isset($uriNow)){
        $uriNow=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    function privateInfo(){
        $actividad["control"]['inicio'] = "Arrancamos con la practica de loguin";
        $PrimeraCarga=true;
        // No hay una sesión activa.
        $this->actividad["control"]["caption"]["itinere"] = "'black'>Sesión no iniciada.</font></strong></p>"."\n";
        $this->actividad["control"]["sesion"][] = "primeraCarga es true";        
        foreach($_SERVER as $idVal => $valEnd){
            $echoIT=false;
            switch($idVal){
                case "SERVER_NAME":
                    $echoIT=true;
                    break;
                case "REQUEST_URI":
                    $echoIT=true;
                    break;
                case "PATH_INFO":
                    $echoIT=true;
                    break;
                case "ORIG_PATH_INFO":
                    $echoIT=true;
                    break;
                case 'HTTP_HOST':
                    $echoIT=true;
                    break;
                case "SERVER_NAME":
                    $echoIT=true;
                    break;
            }
            if($echoIT){
                $this->actividad["flow"]["info"][] =$idVal." => ".$valEnd."<br>"."\n";
            }
        }
        exit;

        if(((!isset($this->actividad))||(count($this->actividad)==0))&&$uriNow==$_SERVER["SERVER_NAME"]."/"){

        }else{
            //header('Location: '.$_SERVER["SERVER_NAME"]);
            //$this->actividad["flow"]["info"][] =$_SERVER["SERVER_NAME"];
        }
        //flush();
    }
    if(isset($cabecerasOriginales)){
        if($cabecerasOriginales==12){
            //echo "Metodo post confirmado en linea: ".__LINE__." y ruta: ".$uriNow."<br>";
            //exit;
            header('Location: http://'.$_SERVER["SERVER_NAME"]);
            $uriNow=$_SERVER["SERVER_NAME"]."/";
        }
    }

    if($ejecuta==0){
        $this->actividad["flow"]["info"][] ="referencia hacia index<br>"."\n";
        require_once "index.html";
    }else{

        if(((!isset($this->actividad))||(count($this->actividad)==0))&&$uriNow==$_SERVER["SERVER_NAME"]."/"){

            $this->actividad["control"]['inicio'] = "Arrancamos con la practica de loguin";
            $PrimeraCarga=true;
            // No hay una sesión activa.
            $this->actividad["control"]["caption"]["itinere"] = "'black'>Sesión no iniciada.</font></strong></p>"."\n";
            $this->actividad["control"]["sesion"][] = "primeraCarga es true";
            if(!headers_sent() ){

                //header('Location: '.$_SERVER["SERVER_NAME"]);
            }else{
                $this->actividad["control"]['inicio']="El cliente ya ha recibido flujo desde esta app";
            }

        }else{
            if ((session_status() == PHP_SESSION_ACTIVE)||isset($this->actividad["logonOK"])) {
                // La sesión está iniciada y activa.
                if(isset($this->actividad["logonOK"])){
                    $this->actividad["control"]["caption"]["itinere"] = "'brown'><p><strong>Sesión en proceso de validacion.</font></strong></p>"."\n";
                    $PrimeraCarga=true;
                }
                if ((session_status() == PHP_SESSION_ACTIVE)){
                    $this->actividad["control"]["caption"]["itinere"] ="'green'><p><strong>Sesión iniciada.</font></strong></p>"."\n";
                    $PrimeraCarga=false;
                }
                $this->actividad["control"]["caption"]["itinere"] = "'orange'><p><strong>Evaluando login</font></strong></p>"."\n";
                $this->actividad["control"]["sesion"][] ="primeraCarga es false";
            }
            if($uriNow!==$_SERVER["SERVER_NAME"]."/"){
                //$this->actividad["flow"]["info"][] ="actual: ".header()."<br>"."\n";
                //header('Location: '.$_SERVER["HTTP_HOST"]);
            }
            foreach($_SERVER as $idVal => $valEnd){
                $echoIT=false;
                switch($idVal){
                    case "SERVER_NAME":
                        $echoIT=true;
                        break;
                    case "REQUEST_URI":
                        $echoIT=true;
                        break;
                    case "PATH_INFO":
                        $echoIT=true;
                        break;
                    case "ORIG_PATH_INFO":
                        $echoIT=true;
                        break;
                    case 'HTTP_HOST':
                        $echoIT=true;
                        break;
                    case "PHP_SELF":
                        $echoIT=true;
                        break;
                }
                if($echoIT){
                    $this->actividad["flow"]["info"][] =$idVal." => ".$valEnd."<br>"."\n";
                }
            }
        }
        if(isset($this->actividad["control"])){
            $antesPost=true;
        }
        require_once "dataAccess/usersObj.php";
        //conexionObj.php contiene las cadenas de ataque a la base de datos.
        //require_once "conexion.php";
        require_once "conexionObj.php";
        //require_once "access.php";

        $ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]=obtenNombresTabla($pasoAFuncion,$conn);
        require_once "clases.php";
        $camposTablaDatos=entorname($pasoAFuncion,$conn,$ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]);

        if(!isset($this->actividad)){
            if($antesPost){
                $this->actividad["flush"]["entorno"][]="reiniciado de post. Los valores anteriores deben estar en conexion_php";
                $this->actividad["control"]["caption"]["itinere"] = "'black'>revisar los includes y la superglobal post</font></strong></p>"."\n";
            }
        }
        if($PrimeraCarga){
        }
    }
    //flush();

    $this->formulario["__".($frmLinea++)."__"] = "K__V__jX";
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="X__V__jK";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="<!DOCTYPE html>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="<html lang=\"es\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="    <head>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <meta charset=\"UTF-8\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\"></script>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <script src=\"./00script/jqueryClient/main.js\"></script>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <title>Inicio de sesion</title>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="    </head>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="    <body>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        <div class=\"container-fluid bg-primary text-black text-start\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="            <div class=\"container bg-light\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                <div class=\"row\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                    <div class=\"col-sm-12\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                        <div class=\"container mt-5\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                            <div class=\"container\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <h1>Curso WEB</h1>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <p>HTML, Bootstrap, JavaScript, JQuery, PHP y MySql </p>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                            </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";

                                function procesaEntorno(&$ixBDConexion,&$ixDbAccess,&$idsLogines){
                                    $this->formulario=array();
                                    if((!isset($ixBDConexion))||(!isset($ixDbAccess))||(!isset($idsLogines))){
                                        $this->actividad["flow"]["info"][] ="<pre>"."\n";
                                        $this->actividad["flow"]["info"][] ="ixBDConexion<br>"."\n";
                                        print_r($ixBDConexion);
                                        $this->actividad["flow"]["info"][] ="ixDbAccess<br>"."\n";
                                        print_r($ixDbAccess);
                                        $this->actividad["flow"]["info"][] ="idsLogines<br>"."\n";
                                        print_r($idsLogines);
                                        $this->actividad["flow"]["info"][] ="</pre>"."\n";
                                        return false;
                                    }
                                    foreach($ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]["des_Tablas"] as $idVal => $valEnd){
                                        if(is_array($valEnd)){
                                            foreach($valEnd as $idVal1 => $valEnd1){
                                                if($idVal1=="usuarios"){
                                                    if(is_array($valEnd1)){
                                                        foreach($valEnd1 as $idVal2 => $valEnd2){
                                                            if(is_array($valEnd2)){
                                                                foreach($valEnd2 as $idVal3 => $valEnd3){
                                                                    $valTest=substr($valEnd3,0,1);
                                                                    if($valTest=="l"){
                                                                        $this->formulario[]=$valEnd3;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if(!(count($this->formulario)>0)){
                                                            $notificaciones.= "error en asignacion de nombres en formulario<br>"."\n";
                                                            $this->actividad["flow"]["info"][] ="<pre>"."\n";
                                                            //print_erre($valEnd1);
                                                            $this->actividad["flow"]["info"][] ="</pre>"."\n";
                                                            //exit;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    return $this->formulario;
                                }
                                //$camposTablaDatos=array("luser","lontrasenia","logokey");
                                if(!isset($this->actividad["logonOK"])){
                                    if(file_exists("borrame.path")){
                                        //unlink("borrame.path");
                                        $this->actividad["session"]["control"]["ruta"][]="Se deberia haber borrado "."borrame.path"." por que primeraCarga es true";
                                    }
                                }
                                if($PrimeraCarga&&((isset($ixBDConexion))&&(isset($ixDbAccess))&&(isset($idsLogines)))){
                                    $localDir["scandir"]=scandir("./");
                                    if(in_array("practicas",$localDir["scandir"])){

                                        $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                        $localDir["ruta"]="practicas/accionObj.php";
                                    }else if(in_array("accionObj.php",$localDir["scandir"])){
                                        //bindtextdomain("localhost","..");
                                        $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                        $localDir["ruta"]="accionObj.php";
                                    }
                                    $nuevoForm->salidaRandomField($camposTablaDatos,true,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
                                    $Validate="Validate";
                                }else{

                                    //$ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]=obtenNombresTabla($pasoAFuncion,$conn);
                                    //$camposTablaDatos=entorname($pasoAFuncion,$conn,$ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]);
                                    // ------------------------------------
                                    if(!isset($this->actividad["error"])){
                                        $localDir["scandir"]=scandir("./");
                                        if(in_array("practicas",$localDir["scandir"])){
                                            $localDir["ruta"]="practicas/sesionStart.php";
                                        }else if(in_array("sesionStart.php",$localDir["scandir"])){
                                            $localDir["ruta"]="sesionStart.php";
                                        }
                                        $camposTablaDatos=procesaEntorno($ixBDConexion,$ixDbAccess,$idsLogines);//array();
                                        $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                        $nuevoForm->salidaRandomField($camposTablaDatos,true,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
                                        $Validate="Cerrar sesion";
                                    }else{
                                        if((isset($ixBDConexion))&&(isset($ixDbAccess))&&(isset($idsLogines))){
                                            $ixBDConexion=$Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["ixBDConexion"];
                                            $ixDbAccess=$Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["ixDbAccess"];
                                            $idsLogines=$Login["UserTupName"]["inicio"]["flup"]["enviroment"]["admin"]["idsLogines"];
                                        }
                                    }
                                    /*
                                    public $alphanumeric="";
                                    public $valMax="";
                                    public $iniVal=array();
                                    public $dasphalmeneric="";
                                    public $repeat=true;
                                    public $TTvalEnd=-1;
                                    public $iiValEnd=-1;
                                    public $cabezaFrm="";
                                    public $inputsFields=array();
                                    public $idAlta="";
                                    */
                                }
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <!-- Email input -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <div class=\"form-outline mb-4\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <label class=\"form-label\" for=\"luser\">usuario</label>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][0]);
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="<!-- Linea html comentada, porque aqui debe ir una linea calculada en php, en la variable \$this->formulario -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <!-- Password input -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <div class=\"form-outline mb-4\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <label class=\"form-label\" for=\"pass\">contraseña</label>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][1]);
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="<!-- Linea html comentada, porque aqui debe ir una linea calculada en php, en la variable \$this->formulario -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <!-- 2 column grid layout for inline styling -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <div class=\"row mb-4\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <div class=\"col d-flex justify-content-center\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <!-- Checkbox -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <div class=\"form-check\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";

                                                if(isset($nuevoForm->campo["login"][2])){
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][2]);
                                                }else{
                                                    $this->actividad["error"]["fallo"][]= "error no controlado: Analiza el array<br>"."\n";
                                                    $this->actividad["error"]["fallo"][]= $nuevoForm->campo;
                                                }
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                            <label class=\"form-check-label\" for=\"form2Example31\"> Recuerdame </label>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="<!-- Linea html comentada, porque aqui debe ir una linea calculada en php, en la variable \$this->formulario -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <div class=\"col\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <!-- Simple link -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <a href=\"#!\">Olvidaste tu contrasenia?</a>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <!-- Submit button -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
                                    if(isset($this->actividad["logonOK"])&&is_array($this->actividad["logonOK"])){
    $this->formulario["__".($frmLinea++)."__"] = "<p>".$this->actividad['logonOK'][0]."</p>"."\n";
                                    }else{
                                        if($Validate=="Validate"){
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomSubmit($Validate);
                                            //$this->formulario["__".($frmLinea++)."__"] = "<button type='submit' class='btn btn-primary btn-block mb-4'>".$Validate."</button>"."\n";
                                        }else{
                                            $localDir["scandir"]=scandir("./");
                                            if(in_array("practicas",$localDir["scandir"])){
                                                $localDir["ruta"]="practicas/sesionDestroy.php";
                                            }else if(in_array("sesionDestroy.php",$localDir["scandir"])){
                                                $localDir["ruta"]="sesionDestroy.php";
                                            }
    $this->formulario["__".($frmLinea++)."__"] = "</form>"."\n";
                                            $camposTablaDatos=procesaEntorno($ixBDConexion,$ixDbAccess,$idsLogines);//array();
                                            $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                            $nuevoForm->salidaRandomField($camposTablaDatos,true,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomSubmit($Validate);
                                            //$this->formulario["__".($frmLinea++)."__"] = "<button type='submit' class='btn btn-primary btn-block mb-4'>".$Validate."</button>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "</form>"."\n";
                                        }


                                    }
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <!-- Register buttons -->"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
                            if($PrimeraCarga){
    $this->formulario["__".($frmLinea++)."__"] = "</form>\n";
                            }
                                //require_once "frmNameField.php";
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                <div class=\"text-center\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
                                        function camposLogOn(&$temError,&$iiErr,$idVal1){
                                            $salidaFnc="";
                                            if($temError=="luser"){
                                                $iiErr++;
                                                $showError[$idVal1]= "<p><strong>El campo usuario: ".$temError."</strong></p>"."\n";
                                                $salidaFnc.=$showError[$idVal1];
                                            }else if($temError=="lontrasenia"){
                                                $iiErr++;
                                                $showError[$idVal1]= "<p><strong>El campo contrasenia: ".$temError."</strong></p>"."\n";
                                                $salidaFnc.=$showError[$idVal1];
                                            }else{
                                                $iiErr++;
                                                $showError[$idVal1]= "<p><strong>Incoherencia en el formulario: ".$temError."</strong></p>"."\n";
                                                $salidaFnc.=$showError[$idVal1];
                                            }
                                            return $salidaFnc;
                                        }
                                        if(isset($this->actividad['logonOK'])){
                                            if(is_array($this->actividad['logonOK'])){
                                                if(count($this->actividad['logonOK'])>0){
                                                    $shError="<p><strong>Bienvenido</strong></p>"."\n";
                                                }                                                
                                            }
                                        }                                    
                                        if(isset($this->actividad['error'])){
                                            require_once "procesoError.php";

                                        }else{
                                            if(isset($this->actividad["logonOK"])&&is_array($this->actividad["logonOK"])){
                                                if($PrimeraCarga){
                                                    unset($localDir);
                                                    $localDir["scandir"]=scandir("./");
                                                    if(in_array("practicas",$localDir["scandir"])){
                                                        $localDir["ruta"]="practicas/sesionStart.php";
                                                    }else if(in_array("sesionStart.php",$localDir["scandir"])){
                                                        $localDir["ruta"]="sesionStart.php";
                                                    }
                                                    $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                                    $nuevoForm->salidaRandomField($camposTablaDatos,false,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
    $this->formulario["__".($frmLinea++)."__"] = $this->actividad["logonOK"][0];
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomSubmit("Accede");
                                                    //$this->formulario["__".($frmLinea++)."__"] = "<button type='submit' class='btn btn-primary btn-block mb-4'>Accede</button>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p>Deseas cambiar/actualizar tus datos? <a href='/examenData/admin/iFazNav/nuevousuario.php?'>Registrate</a></p>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p>o date de alta:</p>"."\n";
                                                    $this->actividad["control"]["caption"]["itinere"] = "'blue'>Sesión en proceso.</font></strong></p>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p><strong><font color=".$this->actividad["control"]["caption"]["itinere"];
                                                    //$this->formulario["__".($frmLinea++)."__"] = $this->actividad["control"]["caption"]["itinere"];
                                                }else{
                                                    $this->actividad["control"]["caption"]["itinere"]="'green'>Sesión iniciada con exito.</font></strong></p>"."\n";
                                                }
                                            }else{
                                                unset($localDir);
                                                $localDir["scandir"]=scandir("./");
                                                if(in_array("practicas",$localDir["scandir"])){
                                                    $localDir["ruta"]="practicas/sesionStart.php";
                                                }else if(in_array("sesionStart.php",$localDir["scandir"])){
                                                    $localDir["ruta"]="sesionStart.php";
                                                }
                                                $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                                $nuevoForm->salidaRandomField($camposTablaDatos,false,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomSubmit("Acceso usuario");
                                                //$this->formulario["__".($frmLinea++)."__"] = "<button type='submit' class='btn btn-primary btn-block mb-4'>Acceso usuario</button>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p>Su inicio de sesion es completo <a href='/examenData/admin/iFazNav/nuevousuario.php?'>Cerrar sesion</a></p>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p>Modifica tus datos:</p>"."\n";
                                                if(!isset($this->actividad["control"])||count($this->actividad["control"])==0){
                                                    $this->actividad["control"]=array("caption"=>array("itinere"=>array())); //["caption"]["itinere"]="";
                                                    $this->actividad["control"]["caption"]["itinere"]="'red'><p><strong>valor por definir.</font></strong></p>"."\n";
                                                }else{
    $this->formulario["__".($frmLinea++)."__"] = "<p><strong><font color=".$this->actividad["control"]["caption"]["itinere"];
                                                }

                                            }
                                        }
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][0]);
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <button type=\"button\" class=\"btn btn-link btn-floating mx-1\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <i class=\"fab fa-facebook-f\"></i>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </button>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <button type=\"button\" class=\"btn btn-link btn-floating mx-1\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <i class=\"fab fa-google\"></i>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][1]);
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </button>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <button type=\"button\" class=\"btn btn-link btn-floating mx-1\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <i class=\"fab fa-twitter\"></i>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
                                            if(isset($nuevoForm->campo["login"][2])){
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][2]);
                                            }else{
    $this->formulario["__".($frmLinea++)."__"] = "error no controlado<br>"."\n";
                                            }
                                            //$this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][2]); 
                                        
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </button>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    <button type=\"button\" class=\"btn btn-link btn-floating mx-1\">"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                        <i class=\"fab fa-github\"></i>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                                    </button>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Kj__V__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "Xj__V__K";
                                    //$this->formulario["__".($frmLinea++)."__"] = "<pre>"."\n";
                                    //print_r($localDir);
                                    //$this->formulario["__".($frmLinea++)."__"] = "</pre>"."\n";
                                    //exit;
                                    /*
                                    $this->formulario["__".($frmLinea++)."__"] = "<pre>"."\n";
                                    print_r($this->actividad);
                                    $this->formulario["__".($frmLinea++)."__"] = "</pre>"."\n";
                                    exit;
                                    */
                                    if(isset($this->actividad["error"]["fallo"])){
                                        if(count($this->actividad["error"]["fallo"])>0){
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
    $this->formulario["__".($frmLinea++)."__"] = "</form>"."\n";
                                            $nuevoForm=new cabeceraForm(8,count($camposTablaDatos));
                                            $nuevoForm->salidaRandomField($camposTablaDatos,false,$localDir["ruta"]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->cabezaFrm;
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomInputFields($nuevoForm->campo["login"][3]);
    $this->formulario["__".($frmLinea++)."__"] = $nuevoForm->salidaRandomSubmit("nuevo usuario");
                                            //$this->formulario["__".($frmLinea++)."__"] = "<button type='submit' class='btn btn-primary btn-block mb-4'>nuevo usuario</button>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p><strong>No estas registrado</strong> <a href='/examenData/admin/iFazNav/nuevousuario.php?'>Registrate</a></p>"."\n";
    $this->formulario["__".($frmLinea++)."__"] = "<p><strong>o date de alta:</strong></p>"."\n";
                                        }else{
                                            if(isset($this->actividad["user"])){
    $this->formulario["__".($frmLinea++)."__"] = $this->actividad["user"];
                                            }else{

                                            }
                                        }
                                    }else{
    $this->formulario["__".($frmLinea++)."__"] = "</form>"."\n";
                                    }
                                    $logger="post.json";
                                    $temp["inLogin.php"][]=$this->actividad;
                                    $jsonData=json_encode($temp);
                                    if(!file_exists($logger)){
                                        if (file_put_contents($logger, $jsonData) !== false) {
    $this->formulario["__".($frmLinea++)."__"] = "Archivo de registro log guardado por primera vez<br>"."\n";
                                        }
                                    }else{
                                        $jsonString = file_get_contents($logger); // Lee el contenido del archivo JSON en una cadena
                                        $temp=json_decode($jsonString,true);
                                        $temp["inLogin.php"][]=$this->actividad;
                                        $jsonData=json_encode($temp);
                                        unset($this->actividad);
                                        if (file_put_contents($logger, $jsonData) !== false) {
                                            //$this->formulario["__".($frmLinea++)."__"] = "Archivo de registro log guardado de forma incremental<br>"."\n";
                                        }
                                    }

                                    //$this->formulario["__".($frmLinea++)."__"] = "fin accionObj.php";
    $this->formulario["__".($frmLinea++)."__"] = "Kj__V__X";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="Xj__V__K";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                            </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                        </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                    </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="                </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="            </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="        </div>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="    </body>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="</html>"."\n";
$calLinea="__".__LINE__."__"; $this->armazon[$calLinea]="K__j__X";
    $tempLinea=explode("__",$calLinea); $frmLinea=max($tempLinea);
    $this->formulario["__".($frmLinea++)."__"] = "X__j__K";
?>