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
    try{
        if(!isset($_SERVER["SERVER_NAME"])){
            throw new Exception("Problemas con las variables superglobales <br>\n" . "Superglobales disponibles: <br>\n");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{

    }
    /**
     * Clase destinada a la declaracion de constantes
     */
    class constante{
        private array $constantes;
        public string $bypass;
        public function __construct(){
            /**
             * 1.- Se deja constancia del estado del servicio dentro del flujo del entorno.
             * 2.- Se deja constancia del estado del servicio dentro del tratamiento de las excepciones.
             * 3.- Se firman todos los archivos que entran dentro de la solicitud.
             * 4.- Se discrimina si el flujo deriva para el entorno, para el fallo y/o seguridad.
             * 5.- Condiciones de respuesta al cleinte, si se cumplen, el flujo trazara hacia el Entorno, sino, hacia el fallo
             * 6.- Se cargan los elementos externos y las dependencias de terceros.
             * 7.- Se accede a los modulos de carga para el arranque de index.php
             * 8.-
             * 9.- Privilegios con los que se marca el flujo.
             * 
             */
            $salida="";
            $this->constantes=array(
                array(
                    "BASE_PATH",
                    "ENV_PATH",
                    "FAIL_PATH",
                    "SECURITY_PATH",
                    "FLOW_PATH",
                    "ADMIN_PATH",
                    "ASSET_PATH",
                    "INDEX_PATH",
                    "RENDER_PATH",
                    "ROOT_INDEX",
                    "CURL_PATH",
                    "EOIX"
                ),
                array(
                    "/srv/vhost/derootty.xyz/home/html",
                    "/Dinamica/Entorno",
                    "/Dinamica/fallos",
                    "/Dinamica/seguridad",
                    "/Dinamica",
                    "/admin",
                    "/assets/app_com",
                    "/indexes",
                    "/mydata/entorno",
                    __FILE__,
                    $_SERVER["SERVER_NAME"],
                    "EOIX"
                ),
                array()
            );
            foreach ($this->constantes[0] as $idVal => $valEnd){
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
    $defcon = new constante();
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
    try{
        $describeException="";
        if(ROOT_INDEX != "/srv/vhost/derootty.xyz/home/html/index.php"){
          define("FLOW_PATH","./Dinamica");
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
    }
    
    //Definimos el indice general de constantes definidas para la gestion de la app general
    try{
      if(empty($con_St["user"])){
          $describeException = "Este archivo ".__NAMESPACE__." >> ".__LINE__." No se reconocen las variables de entorno";
          throw new Exception($describeException);
      }
    }catch (Exception $Ex){
        $describeException="";
        echo $Ex->getMessage();
        exit;
    }finally{
        define("CONST_USR", $con_St["user"]);
        unset($con_St);
    }
            
    try{
        if(CONST_USR < 1){
            $describeException="";
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
            return $rutaRequerida;
        }
    
    }catch (Exception $ex){
        echo $ex->getMessage();
        $describeException="";
        exit;
    }finally{
        
        //Evaluacion de modulos indice para la carga de la web
        $requerido= montaRuta(CONST_USR, "BASE_PATH", "INDEX_PATH", "/box_00.php");
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
            require_once($requerido);

        }
        
        //Evaluacion de modulos de identidad para la carga de la web
        try{
            $requerido= montaRuta(CONST_USR, "BASE_PATH", "ADMIN_PATH", "/rootsysBD.php");
            $describeException="";
            if(!file_exists($requerido)){
                $describeException="No se ha instanciado el archivo " . $requerido;
                throw new Exception($describeException);
            }
        } catch (Exception $ex) {
            $describeException="";
            echo $Ex->getMessage();
            exit;
        } finally {
            require_once($requerido);
        }
        
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
            require_once ($requerido);
        }
    }    
    use box_00;
    use rootsysBD;
    use box_01;
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