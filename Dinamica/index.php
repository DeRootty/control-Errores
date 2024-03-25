<?php declare(strict_types=1);

namespace dinamica;
    use Exception;
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
    //Nos aseguramos de que tenemos acceso a la ejecucion del flujo logico del controlador
    try{
        if(count(CONST_USR) < 1 ){
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

    class dinamicaAPP{
        public array $dinamica;

        public function __construct(){
            $dinamica=array(
                "entorno"=>array(
                    "INF_1XX"=>array(),
                    "RED_3XX"=>array(),
                    "SUC_2XX"=>array()
                ),
                "fallos"=>array(
                    "EC_4XX"=>array(),
                    "ES_5XX"=>array(),
                    "EF_6XX"=>array(),
                    "ET_7XX"=>array()
                )
            );
            $temp=array();
            array_push($temp, "EC_400");
            array_push($temp, "EC_401");
            array_push($temp, "EC_402");
            array_push($temp, "EC_403");
            array_push($temp, "EC_404");
            array_push($temp, "EC_405");
            array_push($temp, "EC_406");
            array_push($temp, "EC_407");
            array_push($temp, "EC_408");
            array_push($temp, "EC_409");
            array_push($temp, "EC_410");
            array_push($temp, "EC_411");
            array_push($temp, "EC_412");
            array_push($temp, "EC_413");
            array_push($temp, "EC_414");
            array_push($temp, "EC_415");
            array_push($temp, "EC_416");
            array_push($temp, "EC_417");
            array_push($temp, "EC_421");
            array_push($temp, "EC_422");
            array_push($temp, "EC_423");
            array_push($temp, "EC_424");
            array_push($temp, "EC_425");
            array_push($temp, "EC_426");
            array_push($temp, "EC_428");
            array_push($temp, "EC_429");
            array_push($temp, "EC_431");
            array_push($temp, "EC_451");
            $this->dinamica["fallos"]["EC_4XX"]=array_flip($temp);
            unset($temp);
            $temp=array(
                "La peticion no ha devuelto resultados",
                "No autorizado",
                "Pago requerido",
                "Prohibido",
                "No se ha encontrado",
                "Método no permitido",
                "No aceptable",
                "Se requiere autenticación proxy",
                "Tiempo de espera de la solicitud",
                "Conflicto",
                "Gone",
                "Longitud requerida",
                "Condición previa fallida",
                "Contenido demasiado grande",
                "URI demasiado largo",
                "Tipo de soporte no compatible",
                "Alcance no satisfactorio",
                "Expectativa fallida",
                "Petición mal dirigida",
                "Contenido no procesable",
                "Bloqueado",
                "Dependencia fallida",
                "Demasiado pronto",
                "Actualización necesaria",
                "Condición previa requerida",
                "Demasiadas peticiones",
                "Los campos de la cabecera de la solicitud son demasiado grandes",
                "No disponible por motivos legales"
            );
            $EC_4XX = &$this->dinamica["fallos"]["EC_4XX"];
            foreach($EC_4XX as $idVal => $valEnd){
                $valEnd=$temp[$valEnd];
            }

            unset($temp);
            $temp=array();
            array_push($temp, "ES_500");
            array_push($temp, "ES_501");
            array_push($temp, "ES_502");
            array_push($temp, "ES_503");
            array_push($temp, "ES_504");
            array_push($temp, "ES_505");
            array_push($temp, "ES_506");
            array_push($temp, "ES_507");
            array_push($temp, "ES_508");
            array_push($temp, "ES_511");

            $this->dinamica["fallos"]["ES_5XX"]=array_flip($temp);
            unset($temp);
            $temp=array(
                "Error interno del servidor",
                "No aplicado",
                "Puerta de enlace no disponible",
                "Servicio no disponible",
                "Tiempo de espera de la puerta de enlace",
                "Versión HTTP no admitida",
                "Variante también negociada",
                "Almacenamiento insuficiente",
                "Bucle detectado",
                "Autenticación de red necesaria"
            );
            $ES_5XX = &$this->dinamica["fallos"]["ES_5XX"];
            foreach($ES_5XX as $idVal => $valEnd){
                $valEnd=$temp[$valEnd];
            }
            unset($temp);
            $temp=array();
            array_push($temp, "EF_600");
            array_push($temp, "EF_610");
            array_push($temp, "EF_620");
            array_push($temp, "EF_630");
            array_push($temp, "EF_640");
            array_push($temp, "EF_650");
            array_push($temp, "EF_660");
            array_push($temp, "EF_670");
            array_push($temp, "EF_680");
            $this->dinamica["fallos"]["EF_6XX"]=array_flip($temp);
            unset($temp);
            $temp=array(
                "Error inesperado",
                "Error en iteracion",
                "Error en el valor esperado",
                "Error en la toma de datos",
                "Error de coherencia",
                "Error de indices",
                "Error en constructor",
                "Error en metodo",
                "Error en la salida esperada"
            );
            $EF_6XX = &$this->dinamica["fallos"]["EF_6XX"];

            foreach($EF_6XX as $idVal => $valEnd){
                $valEnd=$temp[$valEnd];
            }
            unset($temp);
            $temp=array();
            array_push($temp, "ET_700");
            array_push($temp, "ET_710");
            array_push($temp, "ET_720");
            array_push($temp, "ET_730");
            $this->dinamica["fallos"]["ET_7XX"]=array_flip($temp);
            unset($temp);
            $temp=array(
                "violacion de la integridad",
                "violacion de la coherencia",
                "violacion de comprovacion por pares",
                "violacion de la fuente de confianza"
            );
            $ET_7XX = &$this->dinamica["fallos"]["ET_7XX"];
            foreach($ET_7XX as $idVal => $valEnd){
                $valEnd=$temp[$valEnd];
            }
            unset($temp);
        }
/**
 * detectamos el fallo de haberlo
 */
        public function dinamica($ixEvalua){
            try{
                if(empty($ixEvalua) || !is_array($ixEvalua)){
                    throw new Exception("");
                }
            }catch(Exception $e){
                /*
                trigger_error();
                debug_​backtrace();
                debug_​print_​backtrace();
                error_​clear_​last();
                error_​get_​last();
                error_​log();
                error_​reporting();
                restore_​error_​handler();
                restore_​exception_​handler();
                set_​error_​handler();
                set_​exception_​handler();
                trigger_​error();
                user_​error();
                 * 
                 */
            }
            $analisis=array();
            if(!$ixEvalua[0]){
                foreach($this->dinamica["fallos"] as $idVal => $valEnd){
                    unset($analisis);
                    $analisis=array();
                    $analisis[]=explode("_",$idVal);
                    $analisis[]=explode("_",$ixEvalua[2]);
                    if($analisis[0][0]==$analisis[1][0]){
                        $ruta="/Dinamica/fallos/".$idVal."/".$ixEvalua[2]."/index.php";
                    }
                }
                //$this->dinamica["fallos"][$ixEvalua];
            }else{
                foreach($this->dinamica["entorno"] as $idVal => $valEnd){
                    unset($analisis);
                    $analisis=array();
                    $analisis[]=explode("_",$idVal);
                    $analisis[]=explode("_",$ixEvalua[1]);
                    if($analisis[0][0]==$analisis[1][0]){
                        $ruta="/Dinamica/entorno/".$idVal."/".$ixEvalua[1]."/index.php";
                    }
                }
                //$this->dinamica["entorno"][$ixEvalua];
            }
            return $ruta;
        }

    }
    if(!defined("FAIL_PATH")){

    }