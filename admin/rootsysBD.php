<?php declare(strict_types=1);
   
    namespace practicasAPP\admin\rootsysBD;

    //use practicasAPP;
    
    //namespace practicasAPP\admin;
    use practicasAPP;
    use Exception;
    //use Exception;
    /*
        header("Content-type: text/css");
        header("Location:http://www.example.com/");
        header("Content-type: image/svg+xml");
        $dominioPermitido = "http://localhost:3000";
        header("Access-Control-Allow-Origin: $dominioPermitido");
        header("Access-Control-Allow-Headers: content-type");
        header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");
        header('WWW-Authenticate: Negotiate');
        header('WWW-Authenticate: NTLM', false);
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Digest realm="'.$dominio.'",qop="auth",nonce="'.uniqid().'",opaque="'.md5($dominio).'"');
        header('WWW-Authenticate: Basic realm="Sistema de autenticación de prueba"');
        header('HTTP/1.0 401 Unauthorized');
    */
    //namespace practicasAPP\hhhhh;

    //Nos aseguramos de que tenemos acceso a la ejecucion del flujo logico del controlador
    
    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }
    $modoRtm->registroMod("Hola mundo Entrando en permisos en " . __FILE__ . " => " . __LINE__);

    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod("Adios mundo cruel error en ". __FILE__ . " => " . __LINE__);
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        //include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");
    $modoRtm->registroMod("Hola mundo finalmente en permisos ". __FILE__ . " => " . __LINE__);
    
//Cargamos los fundamentos del flujo: Evaluamos error no error

class cargaAdmin{
    public array $adminBD = array();
    private bool $depuracion;

    /**
     * 
     * @param array $tipoCarga: 
     * @param bool $depuracion
     */
    public function __construct(array $tipoCarga, bool $depuracion){
        $ejercicio=array("back","front","deep");
        //$servername = "https://sldn296.piensasolutions.com/";
        $this->depuracion=$depuracion;
        $servername = $_SERVER["SERVER_NAME"];
        $username = "";
        $password = "";
        $dbname = "";
        $this->adminBD[$ejercicio[0]][]=array(
            "local" => $servername,
            "remoto" => "%*%"
        );
        $this->adminBD[$ejercicio[0]][]=$username;
        $this->adminBD[$ejercicio[0]][]=$password;
        $this->adminBD[$ejercicio[0]][]=$dbname;
        
        //$servername = "https://sldn296.piensasolutions.com/";
        $servername = $_SERVER["SERVER_NAME"];
        $username = "";
        $password = "";
        $dbname = "";
        $this->adminBD[$ejercicio[1]][]=array(
            "local" => $servername,
            "remoto" => "%*%"
        );
        $this->adminBD[$ejercicio[1]][]=$username;
        $this->adminBD[$ejercicio[1]][]=$password;
        $this->adminBD[$ejercicio[1]][]=$dbname;

    }

    /**
     * En desarrollo
     * @param object $permisso
     * @param bool $check
     * @return array
     * @throws Exception
     */
    private function cargaCredenciales(object $permisso, bool $check): array{
        $salida=array(
            "A" => array(),
            "B" => array(),
            "C" => array(),
            "D" => array(),
            "E" => array(),
        );
        try {
            //echo "iniciando peticion<br>\n";
            
            $url = CURL_PATH . CURI_PATH . "/datosAcceso.php?inicio=".$permisso->destino;
            //$url = 'http://localhost/mydata/engine/datosAcceso.php?inicio=transmite';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = json_decode(curl_exec($curl),true);
            if(!is_array($data)){
                array_push($salida["A"], $this->depuracion);
                array_push($salida["B"], "cargaCredenciales: rootysysBD.php");
                array_push($salida["C"], $url);
                array_push($salida["D"], $check);
                array_push($salida["E"], true);
                curl_close($curl);
                echo "<pre>";
                print_r($data);
                echo "</pre>";
                throw new Exception($salida);
            }
            if (!curl_errno($curl)) {
              $info = curl_getinfo($curl);
              echo curl_error($curl);
            }

        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            exit;
        }
        return $salida;
    }
    public function dameDatos(object $lanzador, bool $check): array{
        $salida=array(
            "A" => array(),
            "B" => array(),
            "C" => array(),
            "D" => array(),
            "E" => array(),
            "F" => array()
        );
        if($check){
            array_push($salida["A"], $this->adminBD);
            array_push($salida["B"], "La funcion dameDatos() se ha invocado con exito<br>\n");
            array_push($salida["C"], "Archivo hubicado en " . __FILE__ . " en linea: " . __LINE__);
            array_push($salida["D"], $check);
            array_push($salida["E"], true);
            return $salida;
        }
        try{
            if(is_array($this->adminBD && empty($this->adminBD)) ){
                array_push($salida["A"], $this->adminBD);
                array_push($salida["B"], "Error en gestion de la consulta");
                array_push($salida["C"], "Capturada excepcion en " . $e->getMessage());
                array_push($salida["D"], $check);
                array_push($salida["E"], true);
                throw new Exception(json_encode($salida));
            }
        }catch(Exception $ex){
            $modoRtm->registroMod("Adios mundo cruel error en " . __FILE__ . " => " . __LINE__);
            $modoRtm->registroMod($e->getMessage());
            $modoRtm->salidaModo();
            exit;
            //return $ex->getMessage();
            
        }finally{

        }
        array_push($salida["A"], $this->adminBD);
        array_push($salida["B"], "Los datos de conexion estan preparados para ser lanzados");
        array_push($salida["C"], "Volcado de verificacion");
        array_push($salida["D"], $check);
        array_push($salida["E"], false);
        array_push($salida["F"], $lanzador->accionRun(array("read", "legacy", __FILE__ . " => " . __LINE__), false));
        return $salida;
    }
}   



    //require_once BASE_PATH . ADMIN_PATH . "/conexion.php";