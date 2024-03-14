<?php
    if(is_array($referencias)&&is_array($acceso)){
        $sqlInfo="SHOW TABLES";
        $camposTablaDatos=array();
        $createUserAdmin=new adminControl($referencias, $acceso);
        $ixers_Login=$createUserAdmin->salidaAdminLogin(0);
        $idsLogines=$createUserAdmin->salidaIdsLogin();
    
    }else{
        echo "error";
        exit;
    }
/**
 * Esta clase hace disponible el entorno de ejecucion
 */
    class enviromentDef{
        public array $ixDbAccess;
        public array $camposTablaDatos;
        public object $conn; //habilitamos un objeto que contendra la conexion a la base de datos
        public object $usuarioAdmin; //habilitamos otro objeto que, contendra los datos de los usuarios administrativos reconocidos para habilitar un entorno de ejecucion
        public array $ixBDConexion;
        public array $idsLogines;
        public array $ixers_Login;
        public array $pasoAFuncion;
        public array $ixIdBDLayer;
        public array $errrOres=array("okeys"=>array(),"fallo"=>array());    
        private array $accionRegistro;
        // Create connection
        /**
         * $encabezadosAdmin es un array que contiene los datos de localizacion y acceso del usuario administrativo
         *      - $idsLogines: datos de localizacion: 
         *      - $ixers_Login: datos de acceso a usuario administrativo: 
         * 
         * $setBDAdmin es un array que contiene el entorno de la base de datos administrada por el usuario admin asignado
         * $pasoAFuncion provee un array de arrays, en donde se suministra las siguientes relaciones:
         *      - sqlAdHoc: cadena string con la consulta administrativa de declaracion de entorno.
         *      - ixBDAccess: Los permisos online accesibles en el entorno de acceso.
         *      - ixIdsBDAccess: Matriz que relaciona el usuario admin con el permiso y el estado: Granted, Ok.
         *      - ixIdBDLayer: Matriz reflejo por referencia a su origen: idsLogines
         */
        public function __construct($encabezadosAdmin, $setBDAdmin, $pasoAFuncion){
            $this->conn = new mysqli();
            $this->usuarioAdmin = new adminControl($encabezadosAdmin[0],$encabezadosAdmin[1]);
            $this->ixers_Login=$this->usuarioAdmin->salidaAdminLogin(0);
            $this->idsLogines=$this->usuarioAdmin->salidaIdsLogin();
            array_push($this->ixDbAccess["OnLine"][$this->idsLogines[0]], $ixIdsDbAccess[$this->idsLogines[0]]);
            array_push($this->ixDbAccess["OnLine"][$this->idsLogines[1]], $ixIdsDbAccess[$this->idsLogines[1]]);
            array_push($this->ixDbAccess["OnLine"][$this->idsLogines[2]], $ixIdsDbAccess[$this->idsLogines[2]]);
            array_push($this->ixDbAccess["OnLine"][$this->idsLogines[3]], $ixIdsDbAccess[$this->idsLogines[3]]);
            /**
                 * $sqlAdHoc - Cadena SQL que debiera retornar un valor en las filas obtenidas de la base de datos, como resultado.
                 * $ixBDAccess - Contiene una matriz, donde asigna los usuarios administradores online
                 * $ixIdsBDAccess - Contiene una matriz, donde asigna los usuarios administradores con permisos para este sitio
                 * $idsLogin - Matriz con los datos del usuario administrador
            */
            $this->pasoAFuncion=array(
                "sqlAdHoc"=>$sqlInfo,
                "ixBDAccess"=>$this->ixDbAccess["OnLine"],
                "ixIdsBDAccess"=>$ixIdsDbAccess,
                "idsLogin"=>$ixIdBDLayer
            );

            if(is_array($encabezadosAdmin)&&is_array($setBDAdmin)){
                $this->idsLogines=$this->encabezadosAdmin[0];
                $this->ixers_Login=$this->$encabezadosAdmin[1];
            }
            $this->ixIdBDLayer=&$this->idsLogines;
            if(!((isset($this->idsLogines)&&count($this->idsLogines)>0)&&(isset($this->ixers_Login)&&count($this->ixers_Login)>0))){
                $this->accionRegistro["BD"]["Activities"]["fails"][]=  "Error en la conexion de tipo 1<br>";
                exit;
            }else{
                $this->camposTablaDatos=$this->entorname($pasoAFuncion, );

            }
            $this->ixDbAccess["OnLine"] = array(
                $this->idsLogines[0] => array(),
                $this->idsLogines[1] => array(),
                $this->idsLogines[2] => array(),
                $this->idsLogines[3] => array()
            );
            $this->creaConn();
            if(isset($this->accionRegistro["formulario"])){

            }
        }
        private function reportLogFile(){
            $logger="post.json";
            $temp["conexionObj.php"][]=$this->accionRegistro;
            $jsonData=json_encode($temp);
            if(!file_exists($logger)){
                echo "Archivo de registro log guardado por primera vez<br>";
                if (file_put_contents($logger, $jsonData) !== false) {
                    return true;
                }
            }else{
                $jsonString = file_get_contents($logger); // Lee el contenido del archivo JSON en una cadena
                $temp=json_decode($jsonString,true);
                $temp["conexionObj.php"][]=$this->accionRegistro;
                $jsonData=json_encode($temp);
                unset($this->accionRegistro);
                if (file_put_contents($logger, $jsonData) !== false) {
                    return true;
                    //echo "Archivo de registro log guardado de forma incremental<br>";
                }
            }
            //echo "fin conexionObj.php<br>";
        }
        public function creaConn(){
            if(!isset($this->conn)){
                $this->conn->real_connect(
                    $this->ixDbAccess["OnLine"][$this->idsLogines[2]][count($this->ixDbAccess["OnLine"][$this->idsLogines[2]]) - 1],
                    $this->ixDbAccess["OnLine"][$this->idsLogines[0]][count($this->ixDbAccess["OnLine"][$this->idsLogines[0]]) - 1],
                    $this->ixDbAccess["OnLine"][$this->idsLogines[1]][count($this->ixDbAccess["OnLine"][$this->idsLogines[1]]) - 1],
                    $this->ixDbAccess["OnLine"][$this->idsLogines[3]][count($this->ixDbAccess["OnLine"][$this->idsLogines[3]]) - 1]
                );
                //$notificaciones.="<br>se crea nueva instancia de conexion<br>";
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= "<font color='red'>Fallo: 4 ------ conn</font><br>";
                }else{
                    $this->accionRegistro["BD"]["Activities"]["okeys"][]= "<font color='green'>4 --- Conexion establecida</font><br>";
                    //$this->accionRegistro["BD"]["Activities"]["okeys"][]= "Conexion establecida<br>";
                    //$notificaciones.= "Conexion establecida<br>";
                }
            }else{
                //echo "La conexion ya existe<br>";
                //$notificaciones.= "La conexion ya existe<br>";
            }

        }
        public function testBDConn(){
            if (!($conn->ping())) {
                //$notificaciones.= "Se ha perdido la conexion<br>";
            }else{
                //$notificaciones.= "La conexion esta establecida<br>";
            }
        }
        function entorname(&$pasoAFuncion){
            //$ixBDConexion[$ixDbAccess["OnLine"][$idsLogines[3]][count($ixDbAccess["OnLine"][$idsLogines[3]])-1]]=obtenNombresTabla($sqlInfo,$ixDbAccess["OnLine"],$ixIdsDbAccess,$conn);
            $salida=array();
            foreach($this->ixBDConexion["des_Tablas"] as $idVal => $valEnd){
                if(is_array($valEnd)){
                    foreach($valEnd as $idVal1 => $valEnd1){
                        if($idVal1=="usuarios"){
                            if(is_array($valEnd1)){
                                foreach($valEnd1 as $idVal2 => $valEnd2){
                                    if(is_array($valEnd2)){
                                        foreach($valEnd2 as $idVal3 => $valEnd3){
                                            $valTest=substr($valEnd3,0,1);
                                            if($valTest=="l"){
                                                $salida[]=$valEnd3;
                                            }
                                        }
                                    }
                                }
                                if(!(count($salida)>0)){
                                    $this->accionRegistro["BD"]["Activities"]["fails"][]= "error en asignacion de nombres en formulario<br>";
                                    $this->accionRegistro["BD"]["Activities"]["fails"][]= $valEnd1;
                                    //exit;
                                }
                            }
                        }
                    }
                }
            }
            return $salida;
        }
        function obtenNombresTabla($analisis){
            //$this->conn
            if ($this->conn->connect_error) {
                die("Error de conexión: " . $this->conn->connect_error);
            }else{
                $this->accionRegistro["BD"]["Activities"]["okeys"][]=  gettype($analisis)." tipo de paso de valor, dentro de la funcion<br>";
                $contador=-1;
                if(is_array($analisis)){
                    foreach($analisis as $idVal => $valEnd){
                        $contador++;
                        //echo $idVal." => ".gettype($valEnd)."<br>";
                        if($idVal=="sqlAdHoc"){
                            //$sqlAdHoc=$valEnd;
                            ${$idVal}=$valEnd;
                        }
                        if($idVal=="ixBDAccess"){
                            //$ixBDAccess=$valEnd;
                            ${$idVal}=$valEnd;
                        }
                        if($idVal=="ixIdsBDAccess"){
                            //$ixIdsBDAccess=$valEnd;
                            ${$idVal}=$valEnd;
                        }
                        if($idVal=="idsLogin"){
                            //$idsLogin=$valEnd;
                            ${$idVal}=$valEnd;
                        }
                    }
                }else{
                    $this->accionRegistro["BD"]["Activities"]["fails"][]=  "dentro de la funcion, error en controlador de error de paso by function<br>";
                    foreach($analisis as $idVal => $valEnd){
                        if($idVal=="sqlAdHoc"){
                            //$sqlAdHoc=$valEnd;
                            $this->accionRegistro["BD"]["Activities"]["okeys"][]=  $idVal." => ".gettype($valEnd)."<br>";
                            $paso1=$idVal;
                            ${$paso1}=$valEnd;
                        }
                        if($idVal=="ixBDAccess"){
                            $this->accionRegistro["BD"]["Activities"]["okeys"][]=  $idVal." => ".gettype($valEnd)."<br>";
                            //$ixBDAccess=$valEnd;
                            $paso1=$idVal;
                            ${$paso1}=$valEnd;
                        }
                        if($idVal=="ixIdsBDAccess"){
                            $this->accionRegistro["BD"]["Activities"]["okeys"][]=  $idVal." => ".gettype($valEnd)."<br>";
                            //$ixIdsBDAccess=$valEnd;
                            $paso1=$idVal;
                            ${$paso1}=$valEnd;
                        }
                        if($idVal=="idsLogin"){
                            $this->accionRegistro["BD"]["Activities"]["okeys"][]=  $idVal." => ".gettype($valEnd)."<br>";                        
                            //$idsLogin=$valEnd;
                            $paso1=$idVal;
                            ${$paso1}=$valEnd;
                        }
                    }
                }
                if(($sqlAdHoc !== "")&&
                    (isset($ixBDAccess)&&is_array($ixBDAccess))&&
                    (isset($ixIdsBDAccess)&&is_array($ixIdsBDAccess))&&
                    (isset($idsLogin)&&is_array($idsLogin))
                ){
                    $this->accionRegistro["BD"]["Activities"]["okeys"][]= "Todo ok<br>";
                }else{
                    $this->accionRegistro["BD"]["Activities"]["fails"][]=  "<br>finalizando funcion<br>";
                    $this->accionRegistro["BD"]["Activities"]["fails"][]=  "<br>ixBDAccess<br>";
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= $ixBDAccess;
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= "<br>ixIdsBDAccess<br>";
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= $ixIdsBDAccess;
                    $this->accionRegistro["BD"]["Activities"]["fails"][]=  "<br>this->conn<br>";
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= $this->conn;
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= "<br>idsLogin<br>";
                    $this->accionRegistro["BD"]["Activities"]["fails"][]= $idsLogin;
                    exit;
                }
                //global $idsLogines;
                $ixExitPart1=array();
                $ixNameTup=array();
                $nameAdHoc=array();
                // Consulta SQL para obtener el total de tablas
                if ($this->conn->connect_error) {
                    die("Error de conexión::".$sqlAdHoc.":: " . $mysqli->connect_error);
                }
                $result = $this->conn->query($sqlAdHoc);
                // Verifica si la consulta fue exitosa
                if ($result->num_rows > 0) {
                    $totalTablas = $result->num_rows;
                    //echo "DEPURACION: ".__FILE__.": =>".__LINE__.": Total de tablas en la base de datos: " . $totalTablas."<br>";
        
                    $ixNameRow=array("des_Tablas"=>array());
                    $sqlSubInfo="";
                    $ixExitPart1=array("des_Columnas"=>array());
                    while ($row = $result->fetch_assoc()) {
                        $nameAdHoc[]=$row["Tables_in_".$ixIdsBDAccess[$idsLogin[3]]];
                        $verifica=explode("_",$nameAdHoc[count($nameAdHoc)-1]);
                        if(count($verifica)>1){
                            if(strtolower($verifica[0])=="ex"){
                                $sqlSubInfo="DESCRIBE ".$nameAdHoc[count($nameAdHoc)-1];
                                $ixExitPart1["des_Columnas"]=$this->obtenColumnasTabla($sqlSubInfo,$nameAdHoc[count($nameAdHoc)-1],$this->conn);
                                $ixNameRow["des_Tablas"]["sub_examen"][][$nameAdHoc[count($nameAdHoc)-1]] = $ixExitPart1;                               
                                //$nombreTabla=$tuplaName;
                            }
                        }else{
                            unset($sqlSubInfo);
                            $sqlSubInfo="DESCRIBE ".$nameAdHoc[count($nameAdHoc)-1];
                            $ixExitPart1["des_Columnas"]=$this->obtenColumnasTabla($sqlSubInfo,$nameAdHoc[count($nameAdHoc)-1],$this->conn);
                            $ixNameRow["des_Tablas"][][$nameAdHoc[count($nameAdHoc)-1]] = $ixExitPart1;
                        }
                    }
                    $salida=$ixNameRow;
                } else {
                    $this->accionRegistro["BD"]["Activities"]["fails"][]=  "No se encontraron tablas en la base de datos.";
                    $salida="error<br>";
                }
                return $salida;
            }
            /*
            if(!$this->conn->ping()){
                return "error conexion base de datos desde funcion obtenerNombresTabla";
            }
            */
        }

        public function obtenColumnasTabla($sqlAdHoc, &$tuplaName){
            $ixExitPart2=array();
            // Nombre de la tabla de la que deseas obtener los nombres de las columnas
            $nombreTabla = $tuplaName;
    
            // Consulta SQL para obtener los nombres de las columnas
            // Ejecutar la consulta SQL
            $resultado = $this->conn->query($sqlAdHoc);
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    array_push($ixExitPart2, $fila["Field"]);
                    //echo "Nombre de columna: " . $fila["Field"] . "<br>";
                }
            } else {
                $this->accionRegistro["BD"]["Activities"]["fails"][]= "No se encontraron columnas en la tabla.";
            }
            return $ixExitPart2;
        }
        public function salidaIxDbAccess(&$estado,&$entorno,&$permiso){
            if(isset($this->ixDbAccess)&&is_array($this->ixDbAccess)&&count($this->ixDbAccess)>0){
                if($estado!==""&&$entorno){
                    return $this->ixDbAccess[$estado][$entorno][$permiso];
                }

            }else{
                return "error";
            }
        }
    }

    /**
     * Funcion en desarrollo
     */
    class attackBDFormSQL{
        public $IxLeyendaCapaForm=array();
        public $ixLeyendaTSql=array();
        public $ixIdCapaForm=array();
        public $ixIdTSql=array();

    //indice de matriz donde apuntamos al usuario administrador activo
        public $userOK=0;
        public $ixIdsDbAccess=array();


        //capa de abstraccion entre la base de datos y la aplicacion
        function __construct(){
            $this->ixIdsDbAccess=array_merge($ixers_Login["granted"][$userOK],$this->ixIdsDbAccess);
            $notificaciones="";
            //capa de abstraccion entre la base de datos y la aplicacion
            $this->IxLeyendaCapaForm=array("new","edit","del","sel");
            $this->ixLeyendaTSql=array("DELETE","INSERT INTO","SELECT","UPDATE");
            $this->ixIdCapaForm=array(
                $this->IxLeyendaCapaForm[0]=>1,
                $this->IxLeyendaCapaForm[1]=>3,
                $this->IxLeyendaCapaForm[2]=>0,
                $this->IxLeyendaCapaForm[3]=>2
            );
            $this->ixIdTSql=array(
                "flip"=>array(
                    $this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[2]]]=>$this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[2]]],
                    $this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[0]]]=>$this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[0]]],
                    $this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[3]]]=>$this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[3]]],
                    $this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[1]]]=>$this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[1]]]
                ),
                "flop"=>array(
                    $this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[2]]]=>$this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[2]]],
                    $this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[0]]]=>$this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[0]]],
                    $this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[3]]]=>$this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[3]]],
                    $this->IxLeyendaCapaForm[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[1]]]=>$this->ixLeyendaTSql[$this->ixIdCapaForm[$this->IxLeyendaCapaForm[1]]]
                )
            );
        }

        function salidaSQLAbstraida($flipFlop){
            return $this->ixIdTSql[$flipFlop];
        }

    }


?>