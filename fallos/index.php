<?php
    class errorHTML{
        public array $cliente;
        public array $servidor;
        public array $flujo;
        public array $integridad;

        public function __construct($errorTipo){
            $this->estado+array();
            try{
                if(empty($errorTipo)){
                    throw new Exception("Es necesario especificar el valor de entrada. ");
                }
            }catch(Exception $e){
                array_push();
                return;
            }finally{
                $this->cliente+array();
                $this->servidor+array();
                $this->flujo+array();
                $this->integridad=array();
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
                $this->cliente=array_flip($temp);
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
                foreach($this->cliente as $idVal => $valEnd){
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
                $this->servidor=array_flip($temp);
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
                foreach($this->servidor as $idVal => $valEnd){
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
                $this->flujo=array_flip($temp);
                unset($temp);
                $temp=array(
                    "Error inesperado",
                    "Error en iteracion",
                    "Error en el valor esperado",
                    "Error en la toma de datos",
                    "Error de coherencia",
                    "Error de indices",
                    "Error en constructor",
                    "Error en metodo"
                );
                foreach($this->flujo as $idVal => $valEnd){
                    $valEnd=$temp[$valEnd];
                }

                unset($temp);
                $temp=array();
                array_push($temp, "ET_700");
                array_push($temp, "ET_710");
                array_push($temp, "ET_720");
                array_push($temp, "ET_730");
                $this->flujo=array_flip($temp);
                unset($temp);

                $temp=array(
                    "violacion de la integridad",
                    "violacion de la coherencia",
                    "violacion de comprovacion por pares",
                    "violacion de la fuente de confianza"
                );
                foreach($this->integridad as $idVal => $valEnd){
                    $valEnd=$temp[$valEnd];
                }
                unset($temp);

            }
        }
/**
 * detectamos el fallo de haberlo
 */
        public function detectaFallo($ixEvalua){

        }

    }













