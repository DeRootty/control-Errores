<?php
    class extraeHTML{
        private $rutaFileArz="";
        public array $matrizHTML;
        public array $matrizSQL;
        public array $estadoObj;
        public array $resultIntegral;
        public array $queSQL;
        public int $estado;
        private bool $statusSession;
        private int $iContIntegraHTML;
        private int $pregunta;
        public function __construct($queRutaToFileArz){
            if(isset($queRutaToFileArz) && file_exists($queRutaToFileArz)){
                $this->rutaFileArz=$queRutaToFileArz;
                $this->estado=0;
                $this->cargarArchivoEnMatriz(NULL);
            }else{

                $this->estado=-2;
            }
        }
        public function cargarArchivoEnMatriz($archivo) {
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
            $this->iContIntegraHTML=-1;
            if($archivo==NULL){
                //Ruta definida desde el constructor
                $archivo=$this->rutaFileArz;
            }
            if(isset($archivo) && file_exists($archivo)){
                $delimitador="";
                $qVoyHaIntegrar="";
                $this->matrizHTML = array();
                $gestor = fopen($archivo, 'r');
                if ($gestor !== false) {
                    while (($linea = fgets($gestor)) !== false) {
                        //$datos = explode($delimitador, $linea);
                        $this->matrizHTML[] = $linea;
                    }
                    fclose($gestor);
                } else {
                $this->estadoObj[0]=false;          
                $this->estadoObj[]="No se pudo abrir el archivo.";
                }
                $SQLSet=NULL;
                //$this->matrizSQL($qVoyHaIntegrar, $SQLSet);
            }else{
                $this->estado=-3;
                return array(false, $this->estado, "Error en la ruta del archivo a cargar.");
            }
        }
        public function cargarSQLEnMatriz(&$conn, &$QuerySQL, &$pregunta): string{
            $salida="";
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }else{
                if(isset($QuerySQL) && is_array($QuerySQL) && count($QuerySQL)>0){
                    $this->pregunta=$pregunta;
                    unset($this->queSQL);
                    $this->queSQL=array();
                    $this->queSQL=array_merge($QuerySQL, $this->queSQL);

                    $result = mysqli_query($conn, $this->queSQL["select"][$this->pregunta]);
                    if (mysqli_num_rows($result) > 0) {
                        $this->statusShowHtml[]=true;
                        $this->statusShowHtml[]="<p>Se han encontrado ".mysqli_num_rows($result)." resultados</p><br>\n";
                        $this->matrizSQL[]=array_merge($this->statusShowHtml, $this->matrizSQL);
                        $this->matrizSQL[]= "<table id='tabla' class='table  table-hover'>\n";
                        $this->matrizSQL[count($this->matrizSQL)-1].= "<tr><th  class='titulo'>NIF</th><th class='titulo'>NOMBRE</th><th  class='titulo'>PRIMER APELLIDO</th><th class='titulo'>SEGUNDO APELLIDO</th><th class='titulo'>ELIMINAR</th><th class='titulo'>EDITAR</th><th class='titulo'>DUPLICAR</th></tr>\n";
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            // FILA A FILA
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<tr>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td id='".$row["id"] . "'>". "<input type='hidden' name='id' value='".$row["id"] . "'>"."<input type='text' name='nif' value='".$row["nif"]. "'></td><td><input type='text' name='nombre'  value='" . $row["nombre"] . "'></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td><input type='text' name='apellido1'  value='" . $row["apellido1"]. "'></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td><input type='text' name='apellido2' value='" . $row["apellido2"] ."'></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'uno' value='" .  $row["id"] . "'><input type='submit' value='Eliminar' onclick='return confirmacion();'></form></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'dos' value='" .  $row["id"] . "'><input type='submit' value='Editar' onclick='return confirmacion();'></form></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "<td><form action ='empl_accion.php' method='post'><input type='hidden' name = 'tres' value='" .  $row["id"] . "'><input type='submit' value='Duplicar' onclick='return confirmacion();'></form></td>";
                            $this->matrizSQL[count($this->matrizSQL)-1].= "</tr>\n";
                        }
                        $this->matrizSQL[count($this->matrizSQL)-1].="</table>\n";
                        $salida=$this->matrizSQL[count($this->matrizSQL)-1]."__true";
                    }else{
                        unset($this->statusShowHtml);
                        $this->statusShowHtml[]=false;
                        $this->statusShowHtml[]="No hay resultados: ";
                        $this->matrizSQL[]=$this->statusShowHtml;
                        $this->matrizSQL[]= mysqli_num_rows($result)."coincidencias";
                        $salida=$this->matrizSQL[1].$this->matrizSQL[count($this->matrizSQL)-1]."__true";
                    }
                } else {
                    $salida="false";
                }
            }
            return $salida;
        }
        //Salida del armazon
        public function matrizSQL($aIntegrarEnArz, $arraySQLSet){
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
            if(isset($this->matrizHTML) && is_array($this->matrizHTML) && count($this->matrizHTML)>0){
                $this->estadoObj[0]=true;
                $this->estadoObj[]="Se ha mostrado correctamente el resultado solicitado";
                $this->integracion_HTML_SQL($aIntegrarEnArz, $arraySQLSet);
                return $this->matrizHTML;
            }else{
                $this->estadoObj[0]=false;
                $this->estadoObj[]="No se ha establecido la matrizHTML de resultados";
            }

        }
        //Salida de la condicion
        /**
         * $aIntegrarEnArz - contiene el objetivo, valor de cadena.
         *      - tablaSQL: enruta a una consulta a la base de datos, que retornara un set de resultados integrados en HTML
         *      - redireccion: Enruta el codigo para redireccionar la pagina. Script en javaScrip. No se recomienda su uso.
         *      - idUser: Enruta el codigo para mostrar los datos del usuario que ha iniciado sesion.
         *      - login: Enruta para mostrar la pagina de inicio de login.
         * $arraySQLSet - contiene un array de cadenas SQL
        */
        private function integracion_HTML_SQL($aIntegrarEnArz, $arraySQLSet){
            /*
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
            */
            if (!empty($this->matrizHTML)) {
                $continua=true;
                $estado=false;
                foreach ($this->matrizHTML as $idVal => $valEnd) {
                //echo $valEnd;
                    if($this->statusSession){
                        if(trim($valEnd)=="<php>"){
                            if($aIntegrarEnArz=="tablaSQL"){
                                $this->resultIntegral[] = "hemos entrado en tabla<br>";
                                $continua=false;
                                if(!$estado){
                                    $this->resultIntegral[] = $this->tablaShowHTML($pregunta, $conn, $arraySQLSet["select"], $estado);
                                }else{
                                    $this->resultIntegral[] = "<form action ='empl_accion.php' method='post'><input type='hidden' name = 'cuatro' value='*'><input type='submit' value='Nuevo' onclick='return confirmacion();'></form>";
                                }
                            }else if($aIntegrarEnArz=="redireccion"){
                                $this->resultIntegral[] = $this->redireccionHTML();
                            }else if($aIntegrarEnArz=="idUser"){
                                $this->resultIntegral[] = $this->idUserShowHTML();
                            }else{

                            }
                        }else if(trim($valEnd)=="</php>"){
                            $continua=true;
                        }else{
                            if($continua){
                                $this->resultIntegral[] = $valEnd;
                            }
                        }
                    }else{

                    }
                }
            } else {
                $this->resultIntegral[] = "La matrizHTML está vacía.";
            }
        }
        /**
         * $pregunta - variable que define el indice de consulta SQL a lanzar a la base de datos.
         * $conn - objeto MySqli
         * $arraySQLSet - Matriz de consultas SQL disponibles con las que atacar a la base de datos.
         * $status - Array, cuyo valor cero, es un valor bool que establece la secuencia de accion de la funcion
         */
        private function tablaShowHTML(&$pregunta, &$conn, &$arraySQLSet, &$status){
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
            $salida=array();
            if(isset($pregunta)){
                $muestraTablaHtml=new datosHtml($pregunta, $arraySQLSet);
                //retorna una matrizHTML, cuyo valor cero hace referencia al estado del resto de valores contenidos
                $salidaTablaHtml[]=$muestraTablaHtml->lanzaconsulta($conn);
                if($salidaTablaHtml[0]){
                    $salida = $salidaTablaHtml[count($salidaTablaHtml)-1];
                    $status=true;
                }else{
                    $salidaTablaHtml[]="<script>\n";
                    $salidaTablaHtml[count($salidaTablaHtml)-1].="location.href='login.php';\n";
                    $salidaTablaHtml[count($salidaTablaHtml)-1].="</script>\n";
                }
            }else{
                $salidaTablaHtml[]="<script>\n";
                $salidaTablaHtml[count($salidaTablaHtml)-1].="location.href='login.php';\n";
                $salidaTablaHtml[count($salidaTablaHtml)-1].="</script>\n";
                if(isset($statusFlow)){
                    $salida = $statusFlow;
                    $salida = $salidaTablaHtml[1];
                    $salida = $salidaTablaHtml[count($salidaTablaHtml)-1];          
                }else{
                    $salida = $salidaTablaHtml[1];
                    $salida = $salidaTablaHtml[count($salidaTablaHtml)-1];
                }
            }
            return $salida;
        }
        /**
         * $____000 por establecer
         */
        private function redireccionHTML($____000){
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
            $salida=array();
            $salidaTablaHtml[]="<script>\n";
            $salidaTablaHtml[count($salidaTablaHtml)-1].="location.href='login.php';\n";
            $salidaTablaHtml[count($salidaTablaHtml)-1].="</script>\n";
            $salida = array_merge($salidaTablaHtml, $salida);
            return $salida;
        }
        /**
         * $____000 por establecer
         */
        private function idUserShowHTML($____000){
            if($this->estado!==0){
                return array(false, $this->estado, "Error en datos establecidos en constructor. Hay que reinstanciar el objeto con datos libres de error");
            }
        }
        public function outputShowHTML(&$Data): string{
            $salida="";
            $iCont=-1;
            $salidaON=true;
            foreach($this->matrizHTML as $idVal => $valEnd){
                if($valEnd=="<PHP>"){
                    $salidaON=false;
                    $iCont++;
                }else if($valEnd=="</PHP>"){
                    $salidaON=true;
                }
                if(!$salidaON){
                    $salida.=$Data;
                }else{
                    $salida.=$valEnd;
                }
            }
            return $salida;
        }
        private function integrando(&$ixData, &$iCont): string{
            $salida="";
            $integraData = explode("__",$ixData[$iCont]);
            foreach($integraData as $idVal1 => $valEnd1){
                if($idVal1 == 1 ){
                    if(is_bool($valEnd1) && $valEnd1){
                        $salida.= $datoCondicion;
                    }else{
                        $salida.="<!--Dato omitido--><br>\n";
                    }
                }else if($idVal1 > 1 ){
                    $salida.=$valEnd1;
                }else{
                    $datoCondicion=$valEnd1;
                }
            }
            return $salida;
        }
    }//class extraeHTML
?>