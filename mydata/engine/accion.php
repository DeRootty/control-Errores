<?php declare(strict_types=1);
/**
 * Archivo responsable de generar la salida prerenderizada, en la solicitud inicial
 */

    namespace practicasAPP\mydata\engine;

    
    
    class getCURL{
        private string $getDataPath;
        private string $getDataAction;
        private array $estado;
        private array $showEstado;
        private string $getCurlPass;
        private bool $depura = false;
        private string $rootPath;
        
        /**
         * 
         * @param array $destino Solicitud curl
         * @param array $baseCURL 0.- Sercer name, 1.- path engine, 2.- root path
         * @param bool $check
         * @return int
         */
        public function __construct(array $destino, array $baseCURL, bool $check){
            $this->rootPath = $baseCURL[2];
            $this->showEstado = array(
                "A" => array(),
                "B" => array(),
                "C" => array(),
                "D" => array(),
                "E" => array(),
                "F" => array()
            );
            $this->estado = array(
                "A" => array(),
                "B" => array(),
                "C" => array(),
                "D" => array(),
                "E" => array()
            );
            $ii=array( -1, -1);
            $ii[1]=count($destino)-1;
            foreach($destino as $idVal => $valEnd){
                if(($idVal == "destino" || $idVal == "variable" || $idVal == "carga") && !empty($valEnd)){
                    $ii[0]++;
                }
            }
            
            if($ii[0]!==$ii[1]){
                array_push($this->estado["A"], $this->depura);
                array_push($this->estado["B"], "constructor de getCurl");
                array_push($this->estado["C"], "Los parametros pasados no son los correcctos: " . $ii[0] . " vs " . $ii[1]);
                array_push($this->estado["D"], $check);
                array_push($this->estado["E"], true);
                if(!$this->estado["E"][count($this->estado["E"])-1]){
                    $this->estado["C"][count($this->estado["C"])-1].=" Es false y por lo tanto no hay fallo";
                }else{
                    $this->estado["C"][count($this->estado["C"])-1].=" Es true y por lo tanto no hay fallo";
                }
                return -1;
            }else if($ii[0]==$ii[1]){
                $this->getDataPath = $baseCURL[0] . "/" . $baseCURL[1] . "/" . $destino["carga"];
                $this->getDataAction = "?" . $destino["variable"] . "=".$destino["destino"];
                $verifica="/srv/vhost/derootty.xyz/home/html" . "/" . $baseCURL[1] . "/" . $destino["carga"];
                if(!file_exists($verifica)){
                    array_push($this->estado["A"], $this->depura);
                    array_push($this->estado["B"], "constructor de getCurl en: " . $verifica);
                    array_push($this->estado["C"], "La ruta es inexistente: " . $this->getDataPath . $this->getDataAction);
                    array_push($this->estado["D"], $check);
                    array_push($this->estado["E"], true);
                    if(!$this->estado["E"][count($this->estado["E"])-1]){
                        $this->estado["C"][count($this->estado["C"])-1].=" Es false y por lo tanto no hay fallo";
                    }else{
                        $this->estado["C"][count($this->estado["C"])-1].=" Es true y por lo tanto no hay fallo";
                    }
                    return -1;
                }else{
                    array_push($this->estado["A"], $this->depura);
                    array_push($this->estado["B"], "constructor de getCurl");
                    array_push($this->estado["C"], "Los parametros pasados son los adecuados");
                    array_push($this->estado["D"], $check);
                    array_push($this->estado["E"], false);
                    if(!$this->estado["E"][count($this->estado["E"])-1]){
                        $this->estado["C"][count($this->estado["C"])-1].=" Es false y por lo tanto no hay fallo";
                    }else{
                        $this->estado["C"][count($this->estado["C"])-1].=" Es true y por lo tanto no hay fallo";
                    }
                    return 0;
                }
            }


        }//__construct
        /**
         * 
         * @param array $tipoRun: 
         *      0.- Read, Write, Create.
         *      1.- Ruta CURL
         * @param bool $check true: activa descripcion de la traza, false ejecuta accion
         * 
         * 
         * @return array
         */
        Public function accionRun(bool $check): array{
            // $destino["carga"]= "/datosAcceso.php" || $destino["carga"]= "/datosEntorno.php"
            // $destino["variable"]= "inicio" || $destino["variable"]= "inicio"
            // $destino["destino"]= "acceso" || $destino["destino"]= "acceso" 
            $url = $this->getDataPath . $this->getDataAction;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = json_decode(curl_exec($curl), true);
            if(!is_array($data)){
                array_push($this->estado["A"], $this->depura);
                array_push($this->estado["B"], "getCurl: accionRun");
                array_push($this->estado["C"], $url);
                array_push($this->estado["D"], $check);
                array_push($this->estado["E"], true);
                curl_close($curl);
                echo "Salida en fallo"."<br>\n";
                echo $url."<br>\n";
                echo "<pre>";
                print_r($data);
                print_r($this->estado);
                //print_r($this->estado);
                echo "</pre>";
                exit;
                //throw new Exception($salida);
            }
            if (curl_errno($curl)) {
                echo "algo rwaro pasa 2<br>\n";
                $info = curl_getinfo($curl);
                echo "<pre>";
                print_r($info);
                echo "</pre>";
                //echo curl_error($info);
                //echo curl_error($curl);
                //echo $info . "<br>\n";
                //exit;
            }
            return $data;
        }
        
        public function setFLow(bool $depura, bool $check): array{
            $salida=array(
                "A" => array(),
                "B" => array(),
                "C" => array(),
                "D" => array(),
                "E" => array(),
                "F" => array()
            );
            if(!is_array($this->estado) || count($this->estado) < 1 || empty($this->estado)){
                echo "Instancia mal iniciada";
                exit;
            }
            $ii=array();
            array_push($ii, -1);
            array_push($ii, -1);
            $ii[0]=count($this->estado);
            $ii[1]=count($salida) - 1;
            if($ii[0] !== $ii[1]){
                echo "Error en inicio de instancia ". $ii[0] . " vs " . $ii[1] . "<br>\n";
                exit;
            }
            $this->depura = $depura;
            foreach($this->estado as $idVal => $valEnd){
                if($idVal == "A" || $idVal == "D" || $idVal == "E"){
                    switch ($idVal){
                        case "A":
                            if($valEnd[count($valEnd)-1]){
                                array_push($salida[$idVal], "El proceso setFlow en getCURL esta en modo depuracion");
                                array_push($this->showEstado[$idVal], "El proceso setFlow en getCURL esta en modo depuracion");
                            }else{
                                array_push($salida[$idVal], "El proceso setFlow en getCURL esta en modo produccion");
                                array_push($this->showEstado[$idVal], "El proceso setFlow en getCURL esta en modo produccion");
                            }
                            break;
                        case "D":
                            if($valEnd[count($valEnd)-1]){
                                array_push($salida[$idVal], "La funcion setFlow en getCURL se esta ejecutando en modo check");
                                array_push($this->showEstado[$idVal], "La funcion setFlow en getCURL se esta ejecutando en modo check");
                            }else{
                                array_push($salida[$idVal], "La funcion setFlow en getCURL se esta ejecutando en modo runtime");
                                array_push($this->showEstado[$idVal], "La funcion setFlow en getCURL se esta ejecutando en modo runtime");
                            }
                            break;
                        case "E":
                            if($valEnd[count($valEnd)-1]){
                                array_push($salida[$idVal], "Se ha detectado un fallo");
                                array_push($this->showEstado[$idVal], "Se ha detectado un fallo");
                            }else{
                                array_push($salida[$idVal], "La ejecucion esta libre de fallos");
                                array_push($this->showEstado[$idVal], "La ejecucion esta libre de fallos");
                            }
                            array_push($salida["F"], $valEnd[count($valEnd)-1]);
                            array_push($this->showEstado["F"], $valEnd[count($valEnd)-1]);
                            break;
                    }
                            //array_push($salida[$idVal], $valEnd[count($valEnd)-1]);
                            //array_push($salida[$idVal], $valEnd[count($valEnd)-1]);
                            //array_push($salida[$idVal], $valEnd[count($valEnd)-1]);
                }else{
                    //echo $idVal . "<br>\n";
                    switch ($idVal){
                        case "B":
                            array_push($salida[$idVal], $valEnd[count($valEnd)-1]);
                            array_push($this->showEstado[$idVal], $valEnd[count($valEnd)-1]);
                            break;
                        case "C":
                            array_push($salida[$idVal], $valEnd[count($valEnd)-1]);
                            array_push($this->showEstado[$idVal], $valEnd[count($valEnd)-1]);
                            break;
                    }
                }
            }
            if($this->estado["E"][count($this->estado["E"])-1]){
                array_push($this->estado["A"], $this->depura);
                array_push($this->estado["B"], "getCurl funcion setFlow");
                array_push($this->estado["C"], "El objeto no ha sido correctamente instanciado");
                array_push($this->estado["D"], $check);
                array_push($this->estado["E"], true);
                return $this->estado;
            }
            array_push($this->estado["A"], $this->depura);
            array_push($this->estado["B"], "getCurl funcion setFlow");
            array_push($this->estado["C"], "asignacion adecuada de valores");
            array_push($this->estado["D"], $check);
            array_push($this->estado["E"], false);

            if($salida["F"][0] && $this->estado["E"][count($this->estado["E"])-1] ){
                echo "Concordancia en el error<br>\n";
                echo "<pre>";
                print_r($salida);
                echo "</pre>";
                exit;
            }else if(!$salida["F"][0] && !$this->estado["E"][count($this->estado["E"])-1] ){
                return $this->estado;
            }else{
                echo "Adios mundo cruel en " . __FILE__ . " => " . __LINE__ . "<br>\n";
                exit;
            }

        }
        public function salidaRootFile(){
            return $this->rootPath;
        }
    }
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
/*
header('Content-Type: text/plain');
header('X-Test: foo');

function foo() {
 foreach (headers_list() as $header) {
   if (strpos($header, 'X-Powered-By:') !== false) {
     header_remove('X-Powered-By');
   }
   header_remove('X-Test');
 }
}

$result = header_register_callback('foo');
header('Location: http://www.example.com/');
echo "a";
headers_list — Devuelve una lista de encabezados de respuesta enviados (o listos para enviar)
http_response_code — Obtener o establecer el código de respuesta HTTP
long2ip() - Convierte una dirección de red (IPv4) en una cadena de texto en formato con puntos estándar de internet
ip2long() - Convierte una cadena que contiene una dirección con puntos del Protocolo de Internet (IPv4) en una dirección apropiada
inet_pton() - Convertir una dirección IP legible por humanos a su representación in_addr empaquetada

// Obtener el código de la respuesta actual y establecer uno nuevo
var_dump(http_response_code(404));

// Obtener el nuevo código de respuesta
var_dump(http_response_code());
*/
/* setcookie() agrega una cabecera de respuesta propia */
//setcookie('foo', 'bar');

/* Definir un encabezado de respuesta personalizado
   Este será ignorado por la mayoría de los clientes */
//header("X-Sample-Test: foo");

/* Especificar el contenido de texto plano en nuestra respuesta */
//header('Content-type: text/plain');

/* ¿Qué encabezados se van a enviar? */
//var_dump(headers_list());


//headers_sent() - Comprueba si o donde han enviado cabeceras
//header() - Enviar encabezado sin formato HTTP
//setcookie() - Enviar una cookie
//apache_response_headers() - Obtiene todas las cabeceras HTTP de respuesta
//http_response_code() - Obtener o establecer el código de respuesta HTTP

/*
// Si no se han enviado encabezados, enviar uno
if (!headers_sent()) {
    header('Location: http://www.example.com/');
    exit;
}

// Un ejemplo usando los parámetros opcionales file y line
// Tenga en cuenta que $filename y $linenum se pasan para su posterior uso.
// No asigne los valores de antemano.
if (!headers_sent($filename, $linenum)) {
    header('Location: http://www.example.com/');
    exit;

// Lo más probable es generar un error aquí.
} else {

    echo "Headers already sent in $filename on line $linenum\n" .
          "Cannot redirect, for now please click this <a " .
          "href=\"http://www.example.com\">link</a> instead\n";
    exit;
}
 * 
 */