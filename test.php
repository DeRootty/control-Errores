<?php declare(strict_types=1);
    namespace practicasAPP\test;
    use Exception;
    if(empty($_GET) && empty($_POST)){
        goto iniciando;
    }
    if(isset($_GET["init__"]) && $_GET["init__"]=="ok"){
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
                'ok',
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
    }
    header("Content-Type: application/json");
    echo $salida;
    exit;
iniciando:    
    trait lanzador{
        public function testando(string $valIn): string{
            #Analizando si la netrada es una URL completa con URI incorporada
            $testa = explode("?", $valIn);

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
                $testa2=implode('/', $testa1);
                #Se traduce la direccion URL a un path de sistema
                $testa2 = BASE_PATH . "/".$testa2 . '/' . $archivo;
                #Se consulta la existencia del archivo que contiene la carga solicitada
                if(!file_exists($testa2)){
                    return 'Error';
                    //throw new Exception('Error en conexion: ' . __FILE__ . " => " . __LINE__);
                }
            }
            #Se da por buena la direccion pasada a la conexion, y se carga en la variable de lanzamiento
            unset($testa);
            unset($testa1);
            unset($testa2);
            unset($archivo);

            return $valIn;
        }//function testando
        function pruebas(array $passProof): array{
            try{
                //Se puede admitir una matriz de montaje o una matriz con peticiones ya realizadas
                if(
                        !isset($passProof["localServer"]) || 
                        !isset($passProof["base_cURL"]) || 
                        !isset($passProof["launchLoad"]) || 
                        !isset($passProof["base_URI"]) || 
                        !isset($passProof["ruta"]
                )){
                    $url = $this->testando($passProof[count($passProof)-1]);
                    if($url=='Error'){
                        throw new Exception('Error en conexion: ' . __FILE__ . " => " . __LINE__);
                    }
                }else{

                    $comparador = array();
                    $comparador = array_diff($passProof, $this->fieldConn[count($this->fieldConn)-1]);
                    if(!empty($comparador)){
                        if(count($comparador)>0){
                            array_push($this->dataConn, $passProof);
                        }
                    }

                    $url = $this->salidaBase($this->fieldConn[count($this->fieldConn)-1]["localServer"] . $this->fieldConn[count($this->fieldConn)-1]["base_cURL"] . $this->fieldConn[count($this->fieldConn)-1]["launchLoad"] . "?" . $this->fieldConn[count($this->fieldConn)-1]["base_URI"]);

                }
            }catch(Exception $ex) {
                echo "Fuente origen de consulta: " . $passProof[count($passProof)-1] . "<br>\n";
                echo "Este archivo no existe: ".$testa2."<br>\n";
                echo "Posiblemente falte este: " . $archivo . "<br>\n";
                echo "procedende de array pass proof<br>\n";
                echo "<pre>";
                print_r($passProof);
                echo "</pre>";
                exit($ex->getMessage());
            }finally{
                
            }
            //__DIR__ . "/mydata/engine/datosTest.php" . $this->getDataPass;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $fields_string = http_build_query($passProof);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
            //curl_setopt($curl, CURLOPT_URL, $url);
            //curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            $temp = curl_exec($curl);
            if (curl_errno($curl)) {
                echo "Error cURL: " . curl_error($curl);
                curl_close($curl);
                exit;
            }
            $data = array();
            try{
                if(!$temp){
                    throw new JsonException($url);
                }
                $data = json_decode($temp, true);
            } catch (JsonException $ex) {
                echo "Error controlado <br>\n";
                echo $ex->getMessage();
                curl_close($curl);
                exit;
            }
            if(!$data){
                echo 'temp<br>\n';
                echo "<pre>";
                print_r($temp);
                echo "</pre>";
                echo 'data<br>\n';
                echo "<pre>";
                print_r($data);
                echo "</pre>";
                curl_close($curl);
                exit;
            }
            if(!is_array($data) || empty($data)){
                curl_close($curl);
                exit;
                //throw new Exception($salida);
            }
            if (curl_errno($curl)) {
                $info = curl_getinfo($curl);
            }
            curl_close($curl);
            if(!in_array($url, $this->rowConn)){
                array_push($this->rowConn, $url);
            }
            return $data;
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
            try{
                if(empty($passPaths)){
                    throw new Exception('Error ' . __FILE__ . ' => ' . __LINE__);
                }
            } catch (Exception $ex) {
                return $salida;
                //exit($ex->getMessage());
            }
            $this->rutasInit__ = $passPaths;
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
            try{
                if(empty($this->rutasInit__[$ii]) || !isset($this->rutasInit__[$ii]) ){
                    throw new Exception('Error en indice ' . $ii . ' base: ' . __FILE__ . ' => ' . __LINE__);
                }
            }catch(Exception $ex) {
                echo 'Error en localizacion de registro: '. $ii .' No se pudo extraer de ruta de inicio<br>'."\n";
                echo '<pre>';
                print_r($this->rutasInit__);
                echo '</pre>';
                exit($ex->getMessage());
            }finally{
                
            }
            return $this->rutasInit__[$ii];
            saliendo:
            return 'Volcado completado';
        }
        public function setConn(array $getDataConn): bool{
            foreach($getDataConn as $idVal => $valEnd){
                $this->fieldConn[$idVal] = $valEnd;
            }
            return true;
        }
        
        public function salidaDatosConn(){
            echo 'salidaDatosConn<br>'."\n";
            echo "<pre>";
            print_r($this->dataConn);
            echo "</pre>";
        }
        
        public function salidaBase(string $basePath): string{
            $salida = '';
            //Linea de didpsa cpdificacion. __DIR__ puede que no sea lo adecuado
            $salida=__DIR__ . $this->dataConn[count($this->dataConn)-1]['base_cURL'] . $this->dataConn[count($this->dataConn)-1]['launchLoad'];
            try{
                if(!file_exists($salida)){
                    throw new Exception('Error en ruta comprovacion de archivo fallida ' . __FILE__ . " => " . __LINE__ . '<br>');
                }
            }catch(Exception $ex) {
                
                echo $salida . "<br>\n";
                echo $ex->getMessage()."\n";
                exit;
            }finally{

            }
            $salida = $this->dataConn[count($this->dataConn)-1]['localServer'] . $this->dataConn[count($this->dataConn)-1]['base_cURL'] . $this->dataConn[count($this->dataConn)-1]['launchLoad'] . "?" . $this->dataConn[count($this->dataConn)-1]['base_URI'];
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
