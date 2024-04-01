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
    use Exception;
    use box_00;
    use rootsysBD;
    use box_01;
    use mydata\engine;
    //use mydata\engine;
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        if(!isset($_SERVER["SERVER_NAME"])){
            throw new Exception("Problemas con las variables superglobales <br>\n" . "Superglobales disponibles: <br>\n");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";

    }
    /**
     * Clase destinada a la declaracion de constantes
     */
    class constante{
        private array $constantes;
        public string $rootPath;
        public string $bypass;
        
        public function __construct(string $rootIndex, object $permisso){
            /**
             * 00.- Se deja constancia del estado del servicio dentro del flujo del entorno.
             * 01.- Se deja constancia del estado del servicio dentro del tratamiento de las excepciones.
             * 02.- Se firman todos los archivos que entran dentro de la solicitud.
             * 03.- Se discrimina si el flujo deriva para el entorno, para el fallo y/o seguridad.
             * 04.- Condiciones de respuesta al cleinte, si se cumplen, el flujo trazara hacia el Entorno, sino, hacia el fallo
             * 05.- Se cargan los elementos externos y las dependencias de terceros.
             * 06.- Se accede a los modulos de carga para el arranque de index.php
             * 07.-
             * 08.- Privilegios con los que se marca el flujo.
             * 09.-
             * 10.- Base para la obtencion de datos en la gestion del dominio y los privilegios de carga
             * 11.- 
             */
            $salida="";
            /*
            echo "Salida de permisson";
            echo "<pre>";
            print_r($permisso);
            echo "</pre>";
            exit;
             * 
             * 
             */
            $this->constantes= $permisso->accionRun(false);
            foreach ($this->constantes[0] as $idVal => &$valEnd){
                if($valEnd =="ROOT_INDEX"){
                    $this->constantes[1][$idVal] = $permisso->salidaRootFile();
                    echo "root index actualizado";
                }
                if($valEnd =="EOIX"){
                    array_push($this->constantes[2], "EOIX");
                    break;
                }
                array_push($this->constantes[2], "BOIX" . $idVal);
            }
        }//__construct

        public function salidaValor(int $qConst, int $opc ,bool $check){
            $salida = $this->constantes[$opc][$qConst];
            return $salida;            
        }//salidaValor
        
        public function salidaCheck(int $qConst, bool $check){
            $salida = $this->constantes[2][$qConst];
            return $salida;            
        }//salidaCheck
        
    }//class
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        $rutaBoot="/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php";
        if(!file_exists($rutaBoot)){
            throw new Exception("No se ha cargado el indexador de accesos||" . $rutaBoot . "<br>\n");
        }
    }catch(Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        require_once("/srv/vhost/derootty.xyz/home/html/mydata/engine/index.php");
        //$queryCURL=new getCURL(array("destino"=>"constante", "variable"=>"inicio", "carga"=>"datosEntorno.php"), false);
        $queryCURL=new mydata\engine\getCURL(array("destino" => "constante", "variable" => "inicio", "carga" => "datosEntorno.php"), array($_SERVER["SERVER_NAME"], "mydata/engine", __FILE__), false);
        $queryCURL->setFLow(false, false);
        //getCURL es usado para obtener los datos de entorno: las constantes
        $defcon = new constante(__FILE__ , $queryCURL);
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    }
    //$queryCURL=new getCURL();
    //$defcon = new constante(__FILE__, $queryCURL);    
    $ii=-1;
    $bypass="";
    while ($bypass!=="EOIX"){
        $ii++;
        $bypass=$defcon->salidaCheck($ii, false);
        //echo $bypass . " => define(".$defcon->salidaValor($ii, 0, false) . ", " . $defcon->salidaValor($ii, 1, false).")<br>\n";
        if($bypass!=="EOIX"){
            define($defcon->salidaValor($ii, 0, false), $defcon->salidaValor($ii, 1, false));
        }
    }
    

/**
 * Iniciamos la app web instanciando el archivo app root, con privilegios absolutos
 *
 */
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        $describeException="";
        if(ROOT_INDEX != "/srv/vhost/derootty.xyz/home/html/index.php"){
          echo ROOT_INDEX . " se esperaba " . "/srv/vhost/derootty.xyz/home/html/index.php";
          exit;
          //define("FLOW_PATH","./Dinamica");
          try{
              
            if(!file_exists(BASE_PATH . FAIL_PATH . "/index.php")){
                $describeException = "Se deberia generar un archivo de reporte log: " . "Origen: " . __NAMESPACE__ . " => " . __LINE__ . "Error en ruta: " . BASE_PATH . FAIL_PATH . "/index.php";
                throw new Exception($describeException);
            }
            if(!file_exists(ROOT_INDEX)){
                $describeException = "Se deberia generar un archivo de reporte log: " . "Origen: " . __NAMESPACE__ . " => " . __LINE__ . "Error en ruta: " . ROOT_INDEX . "/index.php";
                throw new Exception($describeException);
            }
          }catch(Exception $Ex){
            print $Ex->getMessage();
            //header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
            exit;
          }
          require_once BASE_PATH . FAIL_PATH . "/index.php";
          exit;
        }
    }catch (Exception $Ex){
        $describeException = "";
        echo $Ex->getMessage();
        exit;
    }finally{
        $con_St=get_defined_constants(true);
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    }
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    //Definimos el indice general de constantes definidas para la gestion de la app general
    try{
      if(empty($con_St["user"])){
          $describeException = "Este archivo " . __NAMESPACE__ . " >> " . __LINE__ . " No se reconocen las variables de entorno";
          throw new Exception($describeException);
      }
    }catch (Exception $Ex){
        $describeException="";
        echo $Ex->getMessage();
        exit;
    }finally{
        define("CONST_USR", $con_St["user"]);
        unset($con_St);
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    }
    echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
    try{
        if(CONST_USR < 1){
            $describeException="Violacion de acceso a entorno ";
            throw new Exception($describeException);
        }
        /**
         * Resolutor de rutas absolutas
         * 
         * @param array $ixUsr conteneedor de la matriz constante CONST_USR
         * @param string $match1 BASE_PATH o la localizacion en ruta absoluta del archivo en el servidor.
         * @param string $match2 ruta relativa o URI del arcuivo
         * @param string $catalogo nombre final del archivo
         * @return string salida de la ruta absoluta
         */
        function montaRuta(array $ixUsr,string $match1,string $match2,string $catalogo): string{
            $ruta1="";
            $ruta2="";
            $rutaRequerida="";
            foreach($ixUsr as $idVal => $valEnd){
                if($idVal == $match2){
                    $ruta2=$valEnd;
                }
                if($idVal == $match1){
                    $ruta1=$valEnd;
                }
            }    
            $rutaRequerida=$ruta1.$ruta2.$catalogo;
            if(!file_exists($rutaRequerida)){
                throw new Exception("<br>Error en localizacion del archivo en funcio montaRuta()".__NAMESPACE__." ".__LINE__."<br>\n"." verifica: ".$rutaRequerida."<br>\n");
            }
            echo "Ruta ok ".__FILE__ . " => " .__LINE__ . "<br>\n";
            return $rutaRequerida;
        }
    
    }catch (Exception $ex){
        echo $ex->getMessage();
        $describeException="";
        exit;
    }finally{
        //Evaluacion de modulos indice para la carga de la web
        $requerido = montaRuta(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_00.php");
        //echo $requerido . "<br>\n";
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        try{
            $describeException="";
            if(!file_exists($requerido)){
                $describeException="No se ha instanciado el archivo " . $requerido;
                throw new Exception($describeException);
            }
        } catch (Exception $ex) {
            $describeException="";
            echo $Ex->getMessage();
            exit;
        }finally{
            echo "accediendo a " . $requerido . "<br>\n";
            require_once($requerido);
            echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        }
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        //Evaluacion de modulos de identidad para la carga de la web
        try{
            $requerido = montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/rootsysBD.php");
            $describeException = "";
            if(!file_exists($requerido)){
                $describeException="No se ha instanciado el archivo " . $requerido;
                throw new Exception($describeException);
            }
        } catch (Exception $ex) {
            $describeException="";
            echo $Ex->getMessage();
            exit;
        } finally {
            echo __LINE__ . " finalmente: " . $requerido . "<br>\n";
            require_once($requerido);
            echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        }
        //$queryCURL;
        //$conn = mysqli_init();
        $incluir = montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/conexion.php");
        echo "Incluyendo 2 " . $incluir . "<br>\n";
        require_once($incluir);
        echo "Incluido 2 " . $incluir . "<br>\n";
        echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        
        
        
        //Evaluacion de modulos indice para la carga de la web
        try{
            $requerido= montaRuta(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_01.php");
            $describeException="";
            if(!file_exists($requerido)){
                $describeException="No se ha instanciado el archivo " . $requerido;
                throw new Exception($describeException);
            }
        } catch (Exception $ex) {
            $describeException="";
            echo $Ex->getMessage();
            exit;
        }finally{
            echo "finalmente: ";
            require_once ($requerido);
            echo "hola mundo en " . __FILE__ . " => " . __LINE__ . "<br>\n";
        }
    }   

//    use practicasAPP\salidaFinVista;
    $renderVista = new box_01\salidaFinVista(false);
    $SalidaHTML=array();    
    $SalidaHTML=$renderVista->salida_HTML_final($booConn, false);
    
    //echo "registros integrados de la pagina: ".count($SalidaHTML)."<br>\n";
    //echo $SalidaHTML."<br>\n";
    if(!file_exists(BASE_PATH . $ruta)){
        echo $ruta;
        exit;
    }
    $normalRender=true;

    flush();
    if($normalRender){
        if(is_array($SalidaHTML)){
            if(isset($SalidaHTML["A"][0])){
                if(is_bool($SalidaHTML["A"][0])){
                    if(($SalidaHTML["A"][0] && $SalidaHTML["D"][0]) || $SalidaHTML["E"][0]){
                        //echo "Modo depuracion <br>\n";
                        foreach($SalidaHTML["C"] as $idVal => $valEnd){
                            echo $valEnd . "<br>\n";
                        } 
                    }
                }else {
                    //echo "Modo render <br>\n";
                    foreach($SalidaHTML["C"] as $idVal => $valEnd){
                        echo $valEnd;
                    } 
                }
            }else{
                foreach($SalidaHTML as $idVal => $valEnd){
                    echo $valEnd;
                } 
            }
        }else{
            echo "Error de erroes <br>\n";
        }
    }else{

    }