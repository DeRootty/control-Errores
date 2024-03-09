<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    try{
        if(count(CONST_USR) == 0 ){
            throw new Exception("El archivo al que estas invocabdo, ".__NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion en 8");
        }
        foreach(CONST_USR as $idVal => $valEnd){
            if((BASE_PATH != $valEnd) && (ROOT_INDEX != $valEnd) ){
                if(!file_exists(BASE_PATH . $valEnd."/index.php")){
                    throw new Exception("Este archivo ". BASE_PATH . $valEnd."/index.php || ".  __NAMESPACE__." >> ".__LINE__." no hereda los permisos de ejecucion");
                }
            }
            //echo $idVal." => ".$valEnd."<br>\n";
        }
        //verificamos que el entorno es el adecuado
    } catch (Exception $e){
        echo $e->getMessage();
        exit;
    } 
    
    
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
    if(!file_exists("/mydata/app/esqueleto.php")){
        echo "Ruta inexistente: ".__FILE__.__LINE__;
        
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
    if(!file_exists("/mydata/app/error.php")){
        echo "Ruta inexistente: ".__FILE__.__LINE__;
        
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
    if(!file_exists("/mydata/app/inicio.php")){
        echo "Ruta inexistente: ".__FILE__.__LINE__;
        
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

  /**
   * 
   * @param array $flujoDin- 0.- boolean
   * @example $flujoDin = array ( 
   *                                0 => boolean, //True: no hay error. False: Contiene la descripcion de un error
   *                                1 => Generico del flijo, //Relativo a la dinamica
   *                                2 => Especifico del flujo, //Relativo al proceso de lo especifico de la dinamica, el flujo.
   *                                3 => Descripcion general. //Cadena de texto que describe el ciclo de paso
   *                            );
   * @return string
   */
  
  public function salida_HTML_final(array $flujoDin): string{
      
      return $salida;
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