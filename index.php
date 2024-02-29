<?php declare(strict_types=1);
  
  namespace practicasAPP;
  define("FLOW_PATH", "/Dinamica");
  define("ADMIN_PATH", "/admin");
  define("ASSET_PATH", "/assets");
  define("SECURITY_PATH", "/");
/*
  use Google\Cloud\Monitoring\V3\MonitoringClient;

$projectId = 'YOUR_PROJECT_ID';
$client = new MonitoringClient([
  'projectId' => $projectId,
]);

$metricQuery = 'gce_instance/network/bytes_received';
$filter = "resource.type=\"gce_instance\" AND resource.labels.instance_name=\"YOUR_INSTANCE_NAME\"";

$response = $client->queryTimeSeries($metricQuery, [
  'filter' => $filter,
  'interval' => ['startTime' => '1h', 'endTime' => 'now'],
]);

foreach ($response->getTimeSeries() as $timeSeries) {
  foreach ($timeSeries->getPoints() as $point) {
    echo "Tiempo: " . $point->getInterval()->getStartTime()->getDateTime() . PHP_EOL;
    echo "Valor: " . $point->getValue() . PHP_EOL;
  }
}
*/

//="([(A-z;\d;\s;\-;:|/;.;,;s|/)]*)"
//='"."$1"."'
//="(\w.*?)"

/**
 * Iniciamos la app web instanciando el archivo app root, con privilegios absolutos
 * 
 */
define("ROOT_INDEX", __FILE__);
if(ROOT_INDEX != "/srv/vhost/derootty.xyz/home/html/index.php"){
  define("FLOW_PATH","./Dinamica");
  try{
    if(!file_exists(FAIL_PATH . "/index.php")){
        throw new Exception("Error en ruta: " . FAIL_PATH . "/index.php");
    }
  }catch(Exception $e){
    print "Se deberia generar un archivo de reporte log: " . "Origen: " . __FILE__ . " => " . __LINE__ . $e->getMessage();
    header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
    exit;
  }
  require_once FAIL_PATH . "/index.php";
  exit;
}else if(file_exists(ROOT_INDEX)){
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
        $this->indexARCH = array(
          "binario"=>array(
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array(),
            $this->LyIndexARCH[$ii++] => array()
          ),
          "hash"=>array(
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array(),
            $this->LyIndexARCH[$ii--] => array()
          ));
          $ii=-1;

        //echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $opciones)."\n";
      }

    }

    private function instanciaPagina(string $instanciaFirma): int{
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(filectime($rootFile))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileatime($rootFile))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(getmyinode()));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileinode($rootFile))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(filegroup($rootFile))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode(dechex(fileowner($rootFile))));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii++]], base64_encode("David Salado Rodriguez"));
      array_push($this->indexARCH["binario"][$this->LyIndexARCH[$ii--]], base64_encode(implode("", $this->indexARCH["hash"])));

      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(filectime($rootFile)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileatime($rootFile)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(getmyinode())));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileinode($rootFile)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(filegroup($rootFile)), PASSWORD_BCRYPT, $opciones)));
      array_push($this->indexARCH["hash"][$this->LyIndexARCH[$ii--]], base64_encode(password_hash(dechex(fileowner($rootFile)), PASSWORD_BCRYPT, $opciones)));
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
}



define("BACK", "admin");
require_once(BACK . "/rootsysBD.php");

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
  private function estructuraHTML(){
    if(!file_exists("/mydata/app/esqueleto.php")){
      echo "Error en ".__FILE__." Linea: ".__LINE__;
      exit;
    }
    require_once("/mydata/app/esqueleto.php");

  }

  private function errorHTML(){
    if(!file_exists("/mydata/app/error.php")){
      echo "Error en ".__FILE__." Linea: ".__LINE__;
      exit;
    }
    require_once("/mydata/app/error.php");

  }

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
        foreach($this->error as $ivVal1 => $valEnd1){
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