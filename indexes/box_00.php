<?php declare(strict_types=1);
    namespace box_00;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace practicasAPP\box_00;
    
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        require_once ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
        //include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
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
 