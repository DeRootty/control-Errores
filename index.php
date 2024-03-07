<?php declare(strict_types=1);

/**
 * @copyright 2024 Control de flujo del mapa web
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: index.php 14084 2024-01-06 02:44:03Z pdontthink $
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

  namespace practicasAPP;
  define("BASE_PATH", "/srv/vhost/derootty.xyz/home/html");
  define("ENV_PATH", "/Dinamica/Entorno");          //Se deja constancia del estado del servicio dentro del flujo del entorno.
  define("FAIL_PATH", "/Dinamica/fallos");          //Se deja constancia del estado del servicio dentro del tratamiento de las excepciones.
  define("SECURITY_PATH", "/Dinamica/seguridad");   //Se firman todos los archivos que entran dentro de la solicitud.
  define("FLOW_PATH", "/Dinamica");                 //Se discrimina si el flujo deriva para el entorno, para el fallo y/o seguridad.
  define("ADMIN_PATH", "/admin");                   //Condiciones de respuesta al cleinte, si se cumplen, el flujo trazara hacia el Entorno, sino, hacia el fallo
  define("ASSET_PATH", "/assets");                  //Se cargan los elementos externos y las dependencias de terceros.
  define("ROOT_INDEX", __FILE__);                   //Privilegios con los que se marca el flujo.


/**
 * Iniciamos la app web instanciando el archivo app root, con privilegios absolutos
 *
 */

    if(ROOT_INDEX != "/srv/vhost/derootty.xyz/home/html/index.php"){
      define("FLOW_PATH","./Dinamica");
      try{
        if(!file_exists(BASE_PATH . FAIL_PATH . "/index.php")){
            throw new Exception("Error en ruta: " . BASE_PATH . FAIL_PATH . "/index.php");
        }
        if(!file_exists(ROOT_INDEX)){
            throw new Exception("Error en ruta: " . ROOT_INDEX . "/index.php");
        }
      }catch(Exception $e){
        print "Se deberia generar un archivo de reporte log: " . "Origen: " . __NAMESPACE__ . " => " . __LINE__ . $e->getMessage();
        header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
        exit;
      }
      require_once FAIL_PATH . "/index.php";
      exit;
    }


  class indexesARCH{

    public array $indexARCH;
    private array $idIndexARCH;
    private array $LyIndexARCH;
    private string $enProceso;

    public function __construct(string $rootFile){

      $this->enProceso = $rootFile;
      $phh=0;
      $ordtohex=array(
        "str"=>array(),
        "ord"=>array(),
        "hex"=>array()
      );
      $prorratt=array();
      $ordtohex["str"] = explode("", $rootFile);
      foreach($ordtohex["str"] as $idVal => $valEnd){
        $phh++;
        array_push($ordtohex["ord"], ord($valEnd));
        array_push($ordtohex["hex"], dechex(ord($valEnd)));
      }
      array_push($prorratt, $phh/8);
      array_push($prorratt, $phh%8);

      if (getmyinode() == fileinode($rootFile)) {
        $this->idIndexARCH = array(
          dechex($ii++)."x" => 0,
          dechex($ii++)."x" => 1,
          dechex($ii++)."x" => 2,
          dechex($ii++)."x" => 3,
          dechex($ii++)."x" => 4,
          dechex($ii++)."x" => 5,
          dechex($ii++)."x" => 6,
          dechex($ii++)."x" => 7,
          dechex($ii++)."x" => 8
        );
        $opciones = [
          'cost' => 12,
        ];

        $this->LyIndexARCH = array_flip($this->idIndexARCH);
        $ii=-1;
        $this->indexARCH = array("binario"=>array());
        $this->indexARCH = array("hash"=>array());
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["binario"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        $this->indexARCH["hash"][$this->LyIndexARCH[$ii++]] = array();
        //echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $opciones)."\n";
      }
    }

    /**
     * Firma de la pagina para instancia de carga
     *
     */

    private function instanciaPagina(string $instanciaFirma): int{
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(filectime($instanciaFirma))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileatime($instanciaFirma))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(getmyinode()));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileinode($instanciaFirma))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(filegroup($instanciaFirma))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileowner($instanciaFirma))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode("David Salado Rodriguez"));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii--]], base64_encode(implode("", $this->indexARCH["hash"])));

      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(filectime($instanciaFirma)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileatime($instanciaFirma)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(getmyinode())));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileinode($instanciaFirma)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(filegroup($instanciaFirma)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileowner($instanciaFirma)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash("David Salado Rodriguez", PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hshOne"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(implode("", $this->indexARCH["hash"]), PASSWORD_BCRYPT, $opciones)));

      return -1;
    }

    public function establecePagina(string $ruta): bool{
      if(in_array($ruta, $this->indexARCH)){
        return true;
      }
      echo "<pre>";
      print_r($this->indexARCH);
      echo "</pre>";
      //array_push($this->indexARCH, $ruta);
    }
  }


require_once(BASE_PATH . ADMIN_PATH . "/rootsysBD.php");

class salidaFinVista{

  public array $salidaFinHTML;
  private array $esqueletoHTML;
  private array $index;
  private array $error;
  private array $salidaSQL;

  function __construct(){
    $this->salidaFinHTML=array();
    $this->esqueletoHTML=array();
    $this->index=array();
    $this->error=array();
    $this->salidaSQL=array();
  }

  /**
   * Pantalla de inicio o error
   *
   * $opcion - string
   *
   * Valores admitidos:
   *  1.- "index"
   *  2.- "error"
   */

  public function salidaVista($opcion): array{
    try{
      if($opcion==""){
        throw new Exception();
      }
    }catch(Exception $e){
      $salida=array();
      array_push($salida, false);
      array_push($salida, "abortar");
      return $salida;
    }
    define("INDEX", 0);
    define("ERROR", 1);
    estructuraHTML();
    try{
      if($opcion=="index"){
        indexHTML();
      }else if($opcion=="error"){
        errorHTML();
      }
    }catch(Exception $e){

    }
    array_push($salida, true);
    array_push($salida, implode("", $this->salidaFinHTML));
    return $salida;
  }


  /**
   * Carga datos del esqueleto html
   *
   */

  private function estructuraHTML(){
    if(!file_exists("/mydata/app/esqueleto.php")){
      echo "Error en ".__FILE__." Linea: ".__LINE__;
      exit;
    }
    require_once("/mydata/app/esqueleto.php");

  }

/**
 * Carga datos de la plantilla de error en html
 *
 */

  private function errorHTML(){
    if(!file_exists("/mydata/app/error.php")){
      echo "Error en ".__FILE__." Linea: ".__LINE__;
      exit;
    }
    require_once("/mydata/app/error.php");

  }

  /**
   * Carga datos de la plantilla de inicio en html
   *
   */
  private function indexHTML(){
    if(!file_exists("/mydata/app/inicio.php")){
      echo "Error en ".__FILE__." Linea: ".__LINE__;
      exit;
    }
    require_once("/mydata/app/inicio.php");

  }

  public function salidaSQL(){
    $salida="";
    $salida=implode("",$this->salidaSQL);
    return $salida;
  }
  public function salidaError(array $tipoError): array{
    $salida = array();
    $backToMain = array();
    $idStart = array();
    $addArray=false;
    if(!$tipoError[0]){
      array_push($salida, false);
      array_push($salida, "EF_600");
      array_push($salida, "Entrada de dato no coherente con lo esperado: ");
      array_push($salida, "Ruta: ".__FILE__." linea: ".__LINE__);
      return $salida;
    }
    foreach($this->esqueletoHTML as $ivVal => $valEnd){
      if(substr($valEnd,0,9)=="<flowCode"){
        if(count($backToMain)>0){
          $idStart=explode("=>",$backToMain[count($backToMain)-1]);
        }
        foreach($this->error as $idVal1 => $valEnd1){
          if(isset($idStart) && is_array($idStart)){
            $idStartUp=$idStart[1];
          }else if(empty($idStartUp)){
            $idStartUp=0;
          }
          if($idStartUp==$idVal1){
            $addArray=true;
          }
          if($addArray){
            if(substr($valEnd,0,9)=="<flowCode"){
              array_push($backToMain, $valEnd1);
            }
            array_push($salida, $valEnd1);
          }
        }
      }else{
        array_push($salida, $valEnd);
      }
      array_push($salida, $valEnd);
    }
  }
  public function salidaInicio(){

  }
  public function salidaNavegacion(array $paginaDestino): array{
    $salida = array();
    $backToMain = array();
    $idStart = array();
    $addArray=false;
    foreach($paginaDestino as $idVal => $valEnd){
      if(substr($valEnd,0,9)=="<flowCode"){

      }
        array_push($salida, $valEnd);
    }
    return $salida;
  }
}

$renderVista = new salidaFinVista();

if(!file_exists("insert.sql")){
  try{
    $archivo=$renderVista->salidaSQL();
    $archivar=$archivo;
    $vuelca=file_put_contents("insert.sql", $archivar, LOCK_EX);
    if(!$vuelca){
      throw new Exception("Error al escribir sql");
    }
  }catch(Exception $e){
    print "Excepcion capturada: " . $e->getMessage();
  }
}else{
  $borrar = unlink("insert.sql");
  if($borrar){
    try{
      $archivo=$renderVista->salidaSQL();
      $vuelca=file_put_contents("insert.sql", $archivo, LOCK_EX);
      if(!$vuelca){
        throw new Exception("Error al escribir sql");
      }
    }catch(Exception $e){
      print "Excepcion capturada: " . $e->getMessage();
    }
    print "El archivo se ha borrado y se ha creado de nuevas <br>\n";
  }
}