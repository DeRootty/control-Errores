<?php declare(strict_types=1);
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
define("FAIL_PATH","./Dinamica/fallo");
try{
    if(!file_exists(FAIL_PATH . "/index.php")){
        throw new Exception("Error en ruta: " . FAIL_PATH . "/index.php");
    }
}catch(Exception $e){
    print "Se deberia generar un archivo de reporte log: " . $e->getMessage();
    exit;
}
require_once FAIL_PATH . "/index.php";

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
            "remoto" => ""
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
            "remoto" => ""
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
                throw new Exception("Datos de conexion en mal estado ".__FILE__." Linea: ".__LINE__);
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
    require_once "admin/conexion.php";
