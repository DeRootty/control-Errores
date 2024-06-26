<?php declare(strict_types=1);
/**
 * @copyright 2024 Control de flujo del mapa web
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: test.php 14084 2024-05-04 17:28:03Z pdontthink $
 * @author David Salado Rodriguez
 * @package practicasAPP
 * @link http://www.derootty.xyz
 * @todo Se contemplan seis facetas comunes a toda dinamica de app web:
 * 00.- Envio de comunicaciones por escrito.
 * 01.- Inicio de sesion 'perfecto'.
 * 02.- Una muestra de tienda online.
 * 03.- Una pasarela de pagos.
 * 04.- Solicitud de mas informacion (gestion por email).
 * 05.- Un cliente de correo electronico (SquierrerMail).
 *
 * PD: para futuras versiones se contempla la posibilidad de conexion a bases de datos, incluyendo la integracion de phpmyadmin
 */
    namespace practicasAPP\test;
    use Exception;
    use JsonException;
    if(empty($_GET) && empty($_POST)){
        goto iniciando;
    }
    header("Content-Type: application/json");
    $iid=3867;
    function firmaThis($iid){
        try{
            if(!file_exists(__DIR__ . '/test.php') || !file_exists(__DIR__ . '/iosubsys.php')){
                $test = json_encode(array(
                    array(
                        'Respuesta'
                    ),
                    array(
                        'Error',
                    )
                ));
                throw new Exception();
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        require_once(__DIR__ . '/test.php');
        $dataConn = json_encode(array(
            array(
                'ruta' => '/iosubsys.php',
                "localServer" => $_SERVER['SERVER_NAME'],
                "base_cURL" => '/init',
                "launchLoad" => '/iosubsys.php',
                "base_URI" => 'getIni=' . $iid . '&basePath=' . __DIR__
            )
        ));
        $testingConn = new test\testVal($dataConn);
        //$modoRtm = new modos(1, false);
        //$testingConn->getDataConn();
        $passTo = $testingConn->pruebas($testingConn->getDataConn());
        //require_once(__DIR__ . 'init/iosubsys.php');
        if($passTo['respuesta']=='ok'){
            return $passTo['data'];
        }else{
            return 'fail';
        }
    }
    if(isset($_GET["init__"]) && $_GET["init__"]==firmaThis($iid)){
        $salida= json_encode(array(
            array(
                "respuesta",
                "accion",
                "ambito",
                "runtime",
                'rutaBase',
                "EOIX"
            ),
            array(
                'ok_conectado',
                'require',
                'test.php',
                'enabled',
                $_GET["basePath"],
                "EOIX"
            ),
            array(
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else{
        $salida= json_encode(array(
            array(
                "respuesta",
                "accion",
                "ambito",
                "runtime",
                'basePath',
                "EOIX"
            ),
            array(
                'error',
                'redirige',
                'ruta_pagina_error',
                'disabled',
                $_GET["basePath"],
                "EOIX"
            ),
            array(
            ),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }
    exit;

iniciando:    
    trait lanzador{
        /**
         * 
         * @param string $valIn recibe la cadena completa: Dominio + URL + URI
         * @return string
         * @throws Exception
         */
        private function testando(string $valIn): string{
            try{
                #Analizando si la entrada es una URL completa con URI incorporada
                $testa = explode("?", $valIn);
                if(count($testa)==1){
                    $error=json_encode(array(
                        'Estado' => 'Error',
                        'Function' => 'testando()',
                        'Clase' => 'testVal',
                        'Especial' => 'traits_lanzador',
                        'Variable' => '$valIn',
                        'IX_count' => 'Modulo_unidimensional_(?)',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__,
                        'dump' => $valIn
                    ));
                    throw new Exception($error);
                }
                #Si la matriz resultante posee dos modulos, significa que la entrada es una URL con URI
                if(count($testa)==2){
                    #Se procede a desensamblar el resto de la cadena
                    $testa1 = explode("/", $testa[0]);
                    #Se busca que los modulos queden definidos para extraer el primero y el ultimo
                    if(count($testa1)>1){
                        array_shift($testa1);
                        $archivo= array_pop($testa1);
                    }
                    #Se reensambla el arreglo resultante, sin el primero ni el ultimo
                    $testa2 = implode('/', $testa1);
                    #Se traduce la direccion URL a un path de sistema BASE_PATH
                    $testa2 = __DIR__ . "/".$testa2 . '/' . $archivo;
                    #Se consulta la existencia del archivo que contiene la carga solicitada
                    if(!file_exists($testa2)){
                        $error = json_encode(array(
                            'Estado' => 'Error',
                            'Function' => 'testando()',
                            'Clase' => 'testVal',
                            'Especial' => 'traits_lanzador',
                            'Variable' => '$valIn',
                            'dump' => $testa2,
                            'FileLoad' => __FILE__,
                            'Linea' => __LINE__,
                            'Leyenda' => 'No se ha podidido verificar la existencia del archivo'
                        ));
                        throw new Exception($error);
                    }
                }
                #Se da por buena la direccion pasada a la conexion, y se carga en la variable de lanzamiento
                unset($testa);
                unset($testa1);
                unset($testa2);
                unset($archivo);                
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
            return json_encode(array('ok', $valIn));
        }//function testando
        
        /**
         * 
         * @param array $passProof
         * @return string
         * @throws Exception
         */
        private function subtest(array &$passProof): string{
            
            settype($url, 'string');
            try{
                //Se puede admitir una matriz de montaje o una matriz con peticiones ya realizadas
                if(
                        !isset($passProof["localServer"]) || 
                        !isset($passProof["base_cURL"]) || 
                        !isset($passProof["launchLoad"]) || 
                        !isset($passProof["base_URI"]) || 
                        !isset($passProof["ruta"]
                )){
                    try{
                        if(empty($passProof[count($passProof)-1]) || !isset($passProof[count($passProof)-1])){
                            $error = json_encode(array(
                                'Respuesta' => 'Error',
                                'Function' => 'subtest()',
                                'Clase' => 'testVal',
                                'Especial' => 'traits',
                                'Variable' => '$passProof',
                                'passProof' => $passProof,
                                'IX_count' => count($passProof),
                                'Leyenda' => array(
                                    'Arreglo mal formado, fuera de indice, y sin asociacion posible con:',
                                    'localServer',
                                    'base_cURL',
                                    'launchLoad',
                                    'base_URI',
                                    'ruta'
                                )
                            ));
                            throw new Exception($error);
                        }
                    } catch (Exception $ex) {
                        return $ex->getMessage();
                    }

                    $passProof['ruta'] = $passProof['localServer'].$passProof['base_cURL'].$passProof['launchLoad'].'?'.$passProof['base_URI'];
                    $test = json_decode($this->testando($passProof['ruta']), true);
                    echo $test;
                    exit;
                    if(in_array('Error', $test)){
                        $error = json_encode(array(
                            'Respuesta' => 'Error',
                            'Function' => 'subtest()',
                            'Clase' => 'testVal',
                            'Especial' => 'traits',
                            'Variable' => '$passProof',
                            'ID_en_conflicto:_' => (count($passProof)-1),
                            'IX_en_conflicto:_' => $passProof,
                            'MSG_Origen' => $test,
                            'Load_Origen' =>__FILE__ . " => " . __LINE__,
                            'Load_Content_Query' => $testa2,
                            'File_Query_EmptyLoad' => $archivo
                        ));                        
                        throw new Exception($error);
                    }
                    $url = array('Estado' => $test[0], 'data' => $test[1]);
                }else{
                    $comparador = array();
                    $comparador = array_diff($passProof, $this->fieldConn[count($this->fieldConn)-1]);
                    if(!empty($comparador)){
                        if(count($comparador)>0){
                            array_push($this->dataConn, $passProof);
                        }
                    }
                    $test = json_decode($this->salidaBase($this->fieldConn[count($this->fieldConn)-1]["localServer"] . $this->fieldConn[count($this->fieldConn)-1]["base_cURL"] . $this->fieldConn[count($this->fieldConn)-1]["launchLoad"] . "?" . $this->fieldConn[count($this->fieldConn)-1]["base_URI"]), true);
                    if(in_array('error', $test)){
                        $error = json_encode(array(
                            'ID_en_conflicto:_' => (count($passProof)-1),
                            'IX_en_conflicto:_' => $passProof,
                            'MSG_Origen' => $test,
                            'Load_Origen' =>__FILE__ . " => " . __LINE__,
                            'Load_Content_Query' => $testa2,
                            'File_Query_EmptyLoad' => $archivo
                        ));
                        throw new Exception($error);
                    }
                    $url = array('Estado' => $test[0], 'data' => $test[1]);
                    //$url = json_decode($test, true);
                }
            }catch(Exception $ex) {
                return $ex->getMessage();
            }finally{

            }
            return json_encode($url);
        }//function subtest
        /**
         * 
         * @param array $passProof Arreglo que dispone los valores a organizar para crear una cadena de conexion
         * @return array
         * @throws Exception
         * @throws JsonException
         */
        function pruebas(string $entrada): string{
            $passProof = json_decode($entrada, true);
            $url = json_decode($this->subtest($passProof[0]), true);
            try{
                if(in_array('Error', $url)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'Arreglo' => $url,
                        'Emtrada' => $passProof,
                        'Leyenda' => 'Fallo_en_la_entrada_de_datos'
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                return $error;
            }
            //__DIR__ . "/mydata/engine/datosTest.php" . $this->getDataPass;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url['data']);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $fields_string = http_build_query($passProof[0]);
            //curl_setopt($curl, CURLOPT_URL, $url[1]);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
            //curl_setopt($curl, CURLOPT_URL, $url);
            //curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            //Recibimos datos en mmatriz temporal
            $temp = curl_exec($curl);
            try{
                if (curl_errno($curl)) {
                    $test = json_encode(array(
                        'Respuesta' => 'Error',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'Error cURL' => curl_error($curl),
                        'Fuente' => $url
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                curl_close($curl);
                return $error; 
            }
            $data = array();
            try{
                if(!$temp){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'Error cURL' => curl_error($curl),
                        'Fuente' => $url
                    ));
                    throw new JsonException($test);
                }
                $data = json_decode($temp, true);
                if(!$data){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'temp' => $temp,
                        'data' => $data
                    ));
                    curl_close($curl);
                    throw new JsonException($test);
                }                
                if(!is_array($data) || empty($data)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'data' => 'empty or not array',
                        'from' => __FILE__ . ' => ' . __LINE__
                    ));
                    curl_close($curl);
                    throw new JsonException($test);
                    //throw new Exception($salida);
                }
                
                if (curl_errno($curl)) {
                    $info = curl_getinfo($curl);
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => $info,
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new JsonException($test);
                }
                if(in_array('Error', $data)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => 'Respuesta_en_fallo',
                        'IX_deploid' => $data,
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new JsonException($test);
                }
                curl_close($curl);
                if(!in_array($url, $this->rowConn)){
                    array_push($this->rowConn, $url);
                }else{
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => 'URL ya registrada',
                        'Funcion' => 'pruebas()',
                        'Clase' => 'testVal()',
                        'Archivo' => __FILE__,
                        'Linea' => __LINE__,
                        'Valor_duplicado' => $url,
                        'IX_Ref' => $this->rowConn
                    ));
                    throw new JsonException($test);
                }
            } catch (JsonException $ex) {
                $error = $ex->getMessage();
                curl_close($curl);
                return $error;
            }
            return json_encode($data);
        }//function pruebas
    }//traits
    
    final class testVal{
        private string $localServer;
        private string $base_cURL;
        private string $launchLoad;
        private string $base_URI;
        private array $rowConn;
        private array $fieldConn;
        public array $dataConn;
        private array $rutasInit__;
        use lanzador;
        
        public function __construct(array $dataConn) {
            $this->rutasInit__ = array();
            $this->fieldConn = array($dataConn);
            $this->dataConn = array();
            $this->rowConn = array();
            array_push($this->dataConn, $this->fieldConn[count($this->fieldConn)-1]);
        }
        public function setPathInit__(array $passPaths): bool{
            $ii = 0;
            try{
                $chkError=false;
                if(empty($passPaths)){
                    $chkError = true;
                }
                if($chkError){
                    $test= json_encode(array(
                        'Estado' => 'Error',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                $error = json_decode($ex->getMessage());
                return $error;
                //exit($ex->getMessage());
            }
            if(!is_string($passPaths[$ii])){
                if(is_array($passPaths[$ii])){
                    foreach($passPaths[0] as $idVal => $valEnd){
                        if(count($this->rutasInit__)==0){
                            array_push($this->rutasInit__, array($idVal => array($valEnd, $passPaths[1][$idVal])));
                            array_push($this->rutasInit__, array('ID' =>array($idVal)));// => array($valEnd, $this->rutasInit__[1][$idVal])));
                        }else{
                            $this->rutasInit__[count($this->rutasInit__)-2][$idVal]=array($valEnd, $passPaths[1][$idVal]);
                            $this->rutasInit__[count($this->rutasInit__)-1]['ID'][] = $idVal;// => array($valEnd, $this->rutasInit__[1][$idVal])));
                        }
                    }
                }
            }
            //$this->rutasInit__ = $passPaths;
            $salida=true;
            return $salida;
        }
        public function getPathInit__(int $ii): string{
            if($ii < 0){
                echo 'Solicitud de extraccion de rutas de inicio<br>'."\n";
                echo '<pre>';
                print_r($this->rutasInit__);
                echo '</pre>';
                goto saliendo;
            }
            if(empty($this->rutasInit__[$ii]) || !isset($this->rutasInit__[$ii]) ){
                throw new Exception('Error en indice ' . $ii . ' base: ' . __FILE__ . ' => ' . __LINE__);
            }
            $salida = json_encode($this->rutasInit__[count($this->rutasInit__)-2][$this->rutasInit__[count($this->rutasInit__)-1]['ID'][$ii]]);
            //$salida = $this->rutasInit__[count($this->rutasInit__)-2][$this->rutasInit__[count($this->rutasInit__)-1]['ID'][$ii]][0];
            return $salida;
            saliendo:
            return 'Volcado completado';
        }
        /**
         * 
         * @param array $dataConn
         * @param int $mode
         * @return bool
         */
        public function setDataConn(array $dataConn, int $mode): bool{
            $this->fieldConn = array($dataConn);
            array_push($this->dataConn, $this->fieldConn[count($this->fieldConn)-1]);
            return true;
        }
        
        /**
         * 
         * @return string json
         */
        public function getDataConn(): string{
            $salida='';
            $salida = json_encode($this->fieldConn);
            return $salida;
        }
        
        /**
         * 
         * @return string json
         */
        public function getFieldConn(): string{
            $salida='';
            $salida = json_encode($this->fieldConn);
            return $salida;
        }
        /**
         * 
         * @return string json
         */
        public function getRowConn(): string{
            try{
                $chkError=false;
                if(empty($this->rowConn)){
                    $chkError = true;
                }
                if($chkError){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => 'rowConn Matriz vacia',
                        'Funcion' => 'getRowConn()',
                        'Clase' => 'testVal',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex){
                return $ex->getMessage();
            }
            $salida='';
            $salida = json_encode($this->rowConn);
            return $salida;
        }
        public function setRowConn(array $setterVal): bool{
            try{
                if(empty($setterVal)){
                    $test = json_encode(array(
                        'Estado' => 'Error',
                        'Leyenda' => 'rowConn Matriz vacia',
                        'Funcion' => 'getRowConn()',
                        'Clase' => 'testVal',
                        'FileLoad' => __FILE__,
                        'Linea' => __LINE__
                    ));
                    throw new Exception($test);
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }
        
        public function salidaBase(string $basePath): string{
            $salida =__DIR__ . $this->dataConn[count($this->dataConn)-1]['base_cURL'] . $this->dataConn[count($this->dataConn)-1]['launchLoad'];
            try{
                if(!file_exists($salida)){
                    $error = array();
                    $origen = array();
                    array_push($origen, 'Error');
                    array_push($origen, 'Error salida');
                    array_push($origen, 'Procesado de la cadena $basePAth en la funcion salidaBase, en la clase testVal');
                    array_push($origen, 'Error en la ejecucion de carga procedente del archivo: ' . __FILE__ . ' => ' . __LINE__);
                    array_push($origen, 'Carga a destino ' . $basePath);
                    array_push($origen, $this->dataConn[count($this->dataConn)-1]);
                    array_push($origen, $salida);
                    $error = json_encode($origen);
                    throw new Exception($error);
                }
            }catch(Exception $ex) {
                return $ex->getMessage();
            }finally{

            }
            $salida =json_encode(array(
                'ok',
                $this->dataConn[count($this->dataConn)-1]['localServer'] . $this->dataConn[count($this->dataConn)-1]['base_cURL'] . $this->dataConn[count($this->dataConn)-1]['launchLoad'] . "?" . $this->dataConn[count($this->dataConn)-1]['base_URI']
            ));
            return $salida;
        }
        
        public function pidConn(int $pid): string{
            $salida='';
            try{
                if(empty($this->rowConn[$pid]) && $pid >=0){
                    throw new Exception('Enlace a pagina de error en: ' . __FILE__ . " => " . __LINE__);
                }
                if($pid < 0 && $pid ==-1){
                    $salida = json_encode($this->rowConn);
                }else{
                    $salida = json_encode(array_slice($this->rowConn, $pid, 1));
                }
            } catch (Exception $ex) {
                exit($ex->getMessage());
            }
            return $salida;
        }
        
        public function closeConn(int $activo): bool{
            $salida = '';
            unset($this->dataConn[$activo]);
            return $salida;
        }
        public function montaBoton(){
            
        }
    }
