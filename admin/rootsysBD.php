<?php declare(strict_types=1);
    namespace rootsysBD;
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
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }

/*
echo "<pre>";
print_r(CON_ST);
echo "</pre>";
exit;
 * 
 */
    use practicasAPP;
    $incluir = practicasAPP\montaRuta(CONST_USR, "BASE_PATH", "FLOW_PATH", "/index.php");
    require_once($incluir);
    
//Cargamos los fundamentos del flujo: Evaluamos error no error

class cargaAdmin{
    public array $adminBD = array();

    public function __construct(){
        $ejercicio=array("back","front","deep");
        //$servername = "https://sldn296.piensasolutions.com/";
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

    private function cargaCredenciales(){
        try {
            if(file_exists("data/products.json")){

            }
            $data = file_get_contents("data/products.json");
            $products = json_decode($data, true);

        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }

    }
    public function dameDatos(){
        $salida=array();
        try{
            if(is_array($this->adminBD && empty($this->adminBD)) ){
                throw new Exception("Datos de conexion en mal estado ".__NAMESPACE__." Linea: ".__LINE__);
            }else{
                array_push($salida, true);
                array_push($salida, "Los datos de conexion estan preparados para ser lanzados<br>\n");
                array_push($salida, $this->adminBD);
            }
        }catch(Exception $e){
            array_push($salida, true);
            array_push($salida, "Capturada excepcion en " . $e->getMessage() . "<br>\n");
        }
        return $salida;
    }
}
    $conn = mysqli_init();
    $incluir = practicasAPP\montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/conexion.php");
    require_once($incluir);
    //require_once BASE_PATH . ADMIN_PATH . "/conexion.php";