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

  
  define("BASE_PATH", "/srv/vhost/derootty.xyz/home/html");     //
  define("ENV_PATH", "/Dinamica/Entorno");                      //Se deja constancia del estado del servicio dentro del flujo del entorno.
  define("FAIL_PATH", "/Dinamica/fallos");                      //Se deja constancia del estado del servicio dentro del tratamiento de las excepciones.
  define("SECURITY_PATH", "/Dinamica/seguridad");               //Se firman todos los archivos que entran dentro de la solicitud.
  define("FLOW_PATH", "/Dinamica");                             //Se discrimina si el flujo deriva para el entorno, para el fallo y/o seguridad.
  define("ADMIN_PATH", "/admin");                               //Condiciones de respuesta al cleinte, si se cumplen, el flujo trazara hacia el Entorno, sino, hacia el fallo
  define("ASSET_PATH", "/assets");                              //Se cargan los elementos externos y las dependencias de terceros.
  define("INDEX_PATH", "/indexes");                             //Se accede a los modulos de carga para el arranque de index.php
  define("ROOT_INDEX", __FILE__);                               //Privilegios con los que se marca el flujo.


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
    
    //Definimos el indice general de variables de entorno de usuario
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
         * @param string $match1 BASE_PATH o la localizacion en ruta absoluta del archico en el servidor.
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
                throw new Exception("Error en localizacion del archivo en funcio montaRuta()".__NAMESPACE__." ".__LINE__);
            }
            return $rutaRequerida;
        }
    
    }catch (Exception $ex){
        echo $ex->getMessage();
        $describeException="";
        exit;
    }finally{
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
    
$renderVista = new box_01\salidaFinVista();

echo "El ciclo de chequeo de errores esta casi acabado. Actualmente el sistema me reporta un error 500. Me uqeda el renderizado del resultado";
