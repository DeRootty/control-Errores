<?php
    //$cadenaIns = "<thead><tr>"; 
    //array_push($ixTrTable, $cadenaIns);
    $tabDiv=1; //Salida en modo div - 0

    if(
        (!isset($conn))||
        (!isset($sql))||
        (!isset($leit))||
        (!isset($idShowOn))||
        (!isset($tabDiv))
    ){

    }else{
        if(
            (is_null($conn))||
            (is_null($sql))||
            (is_null($leit))||
            (is_null($idShowOn))||
            (is_null($tabDiv))
        ){
            $notificaciones.= "hay valores nulos<br>";
            exit;
        }else{
            $notificaciones.= "Los valores estan bien<br>";
        }
    }


    /**
     * Variables pasadas a traves del constructor
     * 
     * $conn - pasamos valor por referencia de la conexion con la base de datos
     * $sql - pasamos valor por referencia de la cadena en modo texto que contiene una solicitud sql tipo select
     * $setOn - pasamos por referencia en modo texto como se establece el modo de consulta, puede ser para borrado, modificacion, etc.
     * $idShowOn - pasamos por referencia el valor del nombre de la tabla que hace la funcion de id
     * $tabDiv - regula la visualizacion de la tabla, en modo div (0) o en modo table (1)
     */
    class resultadosSQL{
        public $iTerAction = -1;
        public $ixClassOrden = array();
        public $ixIdColores = array();
        public $ixColores = array();
        public $ixTdTable =array("encabezado"=>array(),"cuerpo"=>array());

    /**
     * descomentar y comentar para depuracion de salida
     * salida con renderizado html
     * public $apertura = array("<", "</");
     * public $cierre = array(">", "><br>");
     * //public $apertura = array("[", "[/");
     * //public $cierre = array("]", "]<br>");
     * 
     * salida sin renderizado html
     * //public $apertura = array("<", "</");
     * //public $cierre = array(">", "><br>");
     * public $apertura = array("[", "[/");
     * public $cierre = array("]", "]<br>");
     * 
     */
        //actualmente, la salida es con renderizado html
        public $apertura = array("<", "</");
        public $cierre = array(">", "><br>");
        //public $apertura = array("[", "[/");
        //public $cierre = array("]", "]<br>");

        public $realConn=false;
        static $WhDraw=array();
        public $queTablaSQL=array();
        public $queFormato=array("dives","tables");
        public $ixTablasFormat=array();

        public $celdaIniCabecera="";
        public $celdaConcCabecera="";
        public $celdaIniCuerpo="";
        public $celdaConcCuerpo="";

        public $columnStartCabecera="";
        public $columnIniCabecera="";
        public $columnConcCabecera="";
        public $columnEndCabecera="";
        public $columnStartCuerpo="";
        public $columnIniCuerpo="";
        public $columnConcCuerpo="";
        public $columnEndCuerpo="";

        function __construct(&$conn,&$sql,&$setOn,&$idShowOn,&$tabDiv){
            $this->ixTablasFormat=array(
                "celdas"=>array(
                    "dives"=>array(
                        "head"=>array(
                            "tagStart"=>$this->apertura[0] . "div class='col ",
                            "tagIni"=> "blue-cell",
                            "tagConclusion"=>"'" . $this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "div" . $this->cierre[0]
                        ),
                        "body"=>array(
                            "tagStart"=>$this->apertura[0] . "div class='col ",
                            "tagIni"=>"gray-cell",
                            "tagConclusion"=>"'" . $this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "div" . $this->cierre[0]
                        )
                    ),
                    "tables"=>array(
                        "head"=>array(
                            "tagStart"=>$this->apertura[0] . "th",
                            "tagIni"=> " class='" . "blue-cell" . "'",
                            "tagConclusion"=>$this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "th" . $this->cierre[0]
                        ),
                        "body"=>array(
                            "tagStart"=>$this->apertura[0] . "td",
                            "tagIni"=>" class='" . "blue-cell" . "'",
                            "tagConclusion"=>$this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "td" . $this->cierre[0]
                        )
                    )
                ),
                "columnas"=>array(
                    "dives"=>array(
                        "head"=>array(
                            "tagStart"=>$this->apertura[0] . "div class='table-responsive'".$this->cierre[0] . $this->apertura[0] . "div class='table'".$this->cierre[0] . $this->apertura[0] . "div class='thead'".$this->cierre[0],
                            "tagIni"=>$this->apertura[0] . "div class='row'".$this->cierre[0],
                            "tagConclusion"=>$this->apertura[1] . "div" . $this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "div" . $this->cierre[0] . $this->apertura[1] . "div" . $this->cierre[0]
                        ),
                        "body"=>array(
                            "tagStart"=>$this->apertura[0] . "div class='tbody'" . $this->cierre[0],
                            "tagIni"=>$this->apertura[0] . "div class='row'".$this->cierre[0],
                            "tagConclusion"=>$this->apertura[1] . "div" . $this->cierre[0],
                            "tagEnd"=>$this->apertura[1] . "div" . $this->cierre[0] . $this->apertura[1] . "div" . $this->cierre[0]
                        )
                    ),
                    "tables"=>array(
                        "head"=>array(
                            "tagStart"=>$this->apertura[0] . "table class='table'".$this->cierre[0].$this->apertura[0] . "thead".$this->cierre[0].$this->apertura[0] . "tr".$this->cierre[0],
                            "tagIni"=>$this->apertura[0] . "tr".$this->cierre[0],
                            "tagConclusion"=>$this->apertura[1]."tr".$this->cierre[0],
                            "tagEnd"=>$this->apertura[1]."tr".$this->cierre[0].$this->apertura[1]."thead".$this->cierre[0]
                        ),
                        "body"=>array(
                            "tagStart"=>$this->apertura[0]."tbody".$this->cierre[0].$this->apertura[0]."tr".$this->cierre[0],
                            "tagIni"=>$this->apertura[0]."tr".$this->cierre[0],
                            "tagConclusion"=>$this->apertura[1]."tr".$this->cierre[0],
                            "tagEnd"=>$this->apertura[1]."tr".$this->cierre[0].$this->apertura[1]."tbody".$this->cierre[0]
                        )
                    )
                )
            );

            if($tabDiv==0){
                $this->celdaIniCabecera= $this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagStart"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagIni"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagConclusion"];
                $this->celdaConcCabecera=$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagEnd"];
                $this->celdaIniCuerpo= $this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagStart"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagIni"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagConclusion"];
                $this->celdaConcCuerpo=$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagEnd"];

                $this->columnStartCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagStart"];
                $this->columnIniCabecera= $this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagIni"];
                $this->columnConcCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagConclusion"];
                $this->columnEndCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagEnd"];            

                $this->columnStartCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagStart"];
                $this->columnIniCuerpo= $this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagIni"];
                $this->columnConcCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagConclusion"];
                $this->columnEndCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagEnd"];            
            }else if($tabDiv==1){
                $this->celdaIniCabecera= $this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagStart"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagIni"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagConclusion"];
                $this->celdaConcCabecera=$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["head"]["tagEnd"];                
                $this->celdaIniCuerpo= $this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagStart"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagIni"].$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagConclusion"];
                $this->celdaConcCuerpo=$this->ixTablasFormat["celdas"][$this->queFormato[$tabDiv]]["body"]["tagEnd"];
                
                $this->columnStartCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagStart"];
                $this->columnIniCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagIni"];
                $this->columnConcCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagConclusion"];
                $this->columnEndCabecera=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["head"]["tagEnd"];

                $this->columnStartCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagStart"];
                $this->columnIniCuerpo= $this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagIni"];
                $this->columnConcCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagConclusion"];
                $this->columnEndCuerpo=$this->ixTablasFormat["columnas"][$this->queFormato[$tabDiv]]["body"]["tagEnd"];            
            }
            unset($this->ixTablasFormat);
            if(
                (is_null($conn))&&
                (is_null($sql))&&
                (is_null($setOn))&&
                (is_null($idShowOn))&&
                (is_null($tabDiv))
            ){
                $this->$realConn=true;
                $this->instanciaTabla($conn,$sql,$setOn,$idShowOn,$tabDiv);
            }else{
                array_push(self::$WhDraw,$conn);
                array_push(self::$WhDraw,$sql);
                array_push(self::$WhDraw,$setOn);
                array_push(self::$WhDraw,$idShowOn);
                array_push(self::$WhDraw,$tabDiv);
                $this->instanciaTabla($conn,$sql,$setOn,$idShowOn,$tabDiv);
                return -1;
            }
        }
        public function realDrawing(&$conn,&$sql,&$setOn,&$idShowOn,&$tabDiv){
            if(
                (!is_null($conn))&&
                (!is_null($sql))&&
                (!is_null($setOn))&&
                (!is_null($idShowOn))&&
                (!is_null($tabDiv))
            ){
                self::$WhDraw[0]=$conn;
                self::$WhDraw[1]=$sql;
                self::$WhDraw[2]=$setOn;
                self::$WhDraw[3]=$idShowOn;
                self::$WhDraw[4]=$tabDiv;
            }else{
                $notificaciones.= "retorno en vacio dos";
                return -1;
            }
        }
        public function instanciaTabla(&$conn,&$sql,&$setOn,&$idShowOn,&$tabDiv){
            if(
                (!is_null($conn))&&
                (!is_null($sql))&&
                (!is_null($setOn))&&
                (!is_null($idShowOn))&&
                (!is_null($tabDiv))
            ){
                if(
                    (isset(self::$WhDraw[0]))&&
                    (isset(self::$WhDraw[1]))&&
                    (isset(self::$WhDraw[2]))&&
                    (isset(self::$WhDraw[3]))&&
                    (isset(self::$WhDraw[4]))
                ){
                    if(self::$WhDraw[0]){

                    }
                    $conn=self::$WhDraw[0];
                    $sql=self::$WhDraw[1];
                    $setOn=self::$WhDraw[2];
                    $idShowOn=self::$WhDraw[3];
                    $tabDiv==self::$WhDraw[4];
                }else{
                    $notificaciones.= "retorno en vacio tres";
                    return -1;
                }
            }
            global $ixers_Login, $idsLogines, $ixBDConexion;
            $txTdCompleta="";
            $txThCompleta="";
            $idThII=-1;
            /**
             * Id 1 = encabezado 1
             * Id 2 = encabezado 2
             * Id n = encabezado n
             * ...
             */
            //------------------
            //-----------------idCelda => array(Id,Id,Id),array(Id,Id,Id),array(Id,Id,Id)-----------------------
            $contador=-1;
            //$notificaciones.= "DEPURACION: ".__FILE__.": =>".__LINE__.": <br>";
            // ------------------------------- $this->ixColores
            $iCont=-1;
            //$result = $conn->query($sql);
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error en la consulta de verificación: " . mysqli_error($conexion));
            }
            // Comprueba si se encontraron resultados
            if (mysqli_num_rows($result) > 0) {
                if($setOn=="borrar"){
                    $notificaciones.= "Puedes borrar los registros seleccionados a continuacion:";
                }else if($setOn=="consulta"){
                    $notificaciones.= "Este es el resultado de tu consulta<br>";
                }
                $insertInto=array();
                $extraerTab=array();
                $extraerTab=explode(" ",$sql);
                $this->queTablaSQL="";
                $idTdPos=array();
                $this->ixColores=array();
                while($row = mysqli_fetch_assoc($result)) {
                    $idTdPos=array();
                    $iCont++;
                    $this->ixClassOrden=array();
                    //extraemos de la consulta origen, el nombre de las tablas y los valores que contienen por cada row
                    foreach($row as $idVal => &$valEnd){
                        //Recopilamos los nombres de tabla
                        if(!(in_array($idVal,$this->ixIdColores))){
                            //Iniciamos los contadores por nombre de tabla diferentes. El maximo sera el mismo que el maximo numero de columnas en la tabla
                            //encabezados de columna
                            array_push($this->ixIdColores,$idVal); //Asociacion de orden de columna. Registros finitos al set de consulta
                            //cada columna, tiene sus registros
                            array_push($this->ixClassOrden,array($idVal=>array($valEnd)));
                            $idTdPos[$this->ixIdColores[count($this->ixIdColores)-1]]=count($this->ixIdColores)-1;
                            $this->ixColores[$this->ixIdColores[count($this->ixIdColores)-1]][]=$valEnd;
                            $idTdPos[$idVal]=count($this->ixIdColores)-1;
                        }else{
                            $this->ixColores[$this->ixIdColores[array_search($idVal,$this->ixIdColores)]][]=$valEnd;
                        }
                    }
                    //Montamos la fila
                    foreach($this->ixColores as $idVal2 => $valEnd2){
                        if(!isset($this->ixTdTable["encabezado"][count($this->ixTdTable["encabezado"])-1])){
                            if($idShowOn==$idVal2){
                                $txTdCompleta.=$this->celdaIniCuerpo . $this->apertura[0] . "input type='checkbox' name='".$idVal2.$iCont."' value='_=".$valEnd2[$iCont]."'" . $this->cierre[0] . $iCont . $this->celdaConcCuerpo;
                                $txThCompleta.=$this->celdaIniCabecera . $this->apertura[0] . "input type='hidden' name='".$idVal2."' value='-1'".$this->cierre[0]."Orden". $this->celdaConcCabecera;                
                            }else{
                                $txTdCompleta.=$this->celdaIniCuerpo . $this->apertura[0] ."input type='text' style='width: 100px;' id='miInput' value='".$valEnd2[$iCont]."' "."readonly" . $this->cierre[0] . $this->celdaConcCuerpo;
                                $txThCompleta.=$this->celdaIniCabecera . $this->apertura[0] . "input type='hidden' name='".$idVal2."' value='-1'".$this->cierre[0].$idVal2.$this->celdaConcCabecera;
                            }
                        }else{
                            if($idShowOn==$idVal2){
                                $txTdCompleta.=$this->celdaIniCuerpo . $this->apertura[0] . "input type='checkbox' name='".$idVal2.$iCont."' value='_=".$valEnd2[$iCont]."'" . $this->cierre[0] . $iCont . $this->celdaConcCuerpo;
                            }else{
                                $txTdCompleta.=$this->celdaIniCuerpo . $this->apertura[0] ."input type='text' style='width: 100px;' id='miInput' value='".$valEnd2[$iCont]."' "."readonly" . $this->cierre[0] . $this->celdaConcCuerpo;
                            }
                        }
                    }
                    //Montamos cuerpo y cabeza de tabla
                    if(!isset($this->ixTdTable["encabezado"][count($this->ixTdTable["encabezado"])-1])){
                        array_push($this->ixTdTable["encabezado"],$this->columnStartCabecera.$this->columnIniCabecera . $txThCompleta.$this->columnEndCabecera. $this->columnStartCuerpo);
                        array_push($this->ixTdTable["cuerpo"], $this->columnIniCuerpo . $txTdCompleta.$this->columnConcCuerpo);
                    }else{
                        array_push($this->ixTdTable["cuerpo"], $this->columnIniCuerpo . $txTdCompleta.$this->columnConcCuerpo);
                    }
                    $txTdCompleta="";
                    $txThCompleta="";
                }
                $iCont=-1;

            } else {
                $notificaciones.= "No puedes borrar el registro con ID ".$id_a_verificar;          
            }
        }
        public function salidaTabla(){
            global $ixers_Login, $idsLogines, $ixBDConexion, $userOK;
            $cadenaIns="";
            //Encabezados de tabla
            // Realiza la operación de eliminación si es necesario
            foreach ($this->ixTdTable["cuerpo"] as $idVal => $valEnd) {
                if($idVal==0){
                    $cadenaIns = $this->ixTdTable["encabezado"][$idVal].$valEnd;
                }else{
                    $cadenaIns=$cadenaIns.$valEnd;
                }
            }
            $cadenaIns.=$this->celdaConcCuerpo; //$this->apertura[1] . "div" . $this->cierre[0]."";
            $this->queTablaSQL=array();
            $extraerTab=explode(" ",self::$WhDraw[1]);
            if(!isset($this->queTablaSQL[0])){
                foreach($ixBDConexion[$ixers_Login["permission"][$userOK][$idsLogines[3]]]["Tablas"] as $idValZ => $valEndZ){
                    foreach($extraerTab as $idValY => $valEndY){
                        if(trim($valEndY) == "FROM"){
                            $this->queTablaSQL = explode(";",$extraerTab[$idValY+1]);
                            if(trim($idValZ)==trim($this->queTablaSQL[0])){
                                $this->queTablaSQL[0]=$idValZ;
                                break;
                            }
                        }
                    }
                    if((isset($this->queTablaSQL))){
                        break;
                    }else{
                        $notificaciones.= "no se ha establecido una tabla de consulta<br>";
                        exit;
                    }

                }
            }
            $idGetOn=array();
            return $cadenaIns.$this->celdaConcCuerpo." ".$this->apertura[0]."input type='hidden' value='".$this->queTablaSQL[0]."' name='TransactSQL'".$this->cierre[0]."";
        }
    }

    class selectNav{
        public $ixListadosTemasSQL=array("ordinal"=>array(),"ids"=>array(),"Leyendas"=>array());
        public $htmlSalidaOption=array();
        public $salidaSeletFin=array("inicio"=>NULL,"final"=>NULL);
        public $htmlSelect=NULL;
        /**
         * $array -> matriz base
         * $nivel -> iteracion en la que se deben mostrar resultados
         * $tagSetOn -> clave en la que se esta generando el 00_select option
         */
        function __construct($array, $nivel, $tagSetOn) {
            $insertaValSig="";
            $nivelInt=explode("_",$nivel);
            $nivelInt[0]=intval($nivelInt[0]);
            foreach ($array as $clave => $valor) {
                //Montamos la matriz $ixListadosTemasSQL
                if (is_array($valor)) {
                    //$registrosActivos.= "En ".$clave." esta en el nivel ".$nivel.", y hay " . count($valor) . " elementos con la clave ".$clave."<br>";
                    if(isset($valor)){
                        $this->ixListadosTemasSQL["Leyendas"][$clave]="Hay_".count($valor)."_registros";
                        $valEndLeyenda=explode("=",$clave);
                        $this->ixListadosTemasSQL["ids"][$valEndLeyenda[count($valEndLeyenda)-1]]=$clave;
                        $this->ixListadosTemasSQL["ordinal"][]=$valEndLeyenda[count($valEndLeyenda)-1];
                        //return $valor;
                    }else{
                        $this->ixListadosTemasSQL["Leyendas"][$clave]="No_hay_registros";
                        //$registrosActivos.="Para la clave ".$clave." que reside en el nivel ".$nivel." hay ".count($valor)." registros valorados en otros niveles dados de alta <br>";                    
                    }
                }else{
                    if (is_null($valor)) {
                        $this->ixListadosTemasSQL["Leyendas"][$clave]= "En el nivel $nivel, la clave $clave aún no se ha registrado<br>";
                    }else{
                        $this->ixListadosTemasSQL["Leyendas"][$clave]= "En el nivel ".$nivel.", la clave ".$clave." contiene el valor ".$valor."<br>";
                    }
                }
                //Montamos la matriz $htmlSelect
                $insertaValSig=(count($this->ixListadosTemasSQL["ids"])-1);
                if(isset($this->htmlSelect)){
                    if(isset($insertaValSig)){
                        if(isset($this->htmlSelect[$clave])){
                            //$valEndLeyenda
                            array_push($this->htmlSelect[$clave]["value"],$clave);
                            //array_push($htmlSelect[$clave]["value"],$insertaValSig);
                            array_push($this->htmlSelect[$clave]["name"],$this->ixListadosTemasSQL["Leyendas"][$clave]);
                        }else{
                            $this->htmlSelect[$clave]["value"]=array($insertaValSig);
                            $this->htmlSelect[$clave]["name"]=array($this->ixListadosTemasSQL["Leyendas"][$clave]);
                        }
                    }else{
                        array_push($this->htmlSelect[$clave]["value"],"-1");
                        array_push($this->htmlSelect[$clave]["name"],$this->ixListadosTemasSQL["Leyendas"][$clave]);
        
                    }
        
                }else{
                    $this->htmlSelect=array(
                        $clave=>array(
                            "value"=>array($insertaValSig),
                            "name"=>array($this->ixListadosTemasSQL["Leyendas"][$clave])
                        )
                    );
                    if($nivel<0){
                        array_push($this->htmlSalidaOption,"<option value='cursoAtesco'>Listado de temario: Curso de apps con tecnologia web</option>");
                    }else{
                        array_push($this->htmlSalidaOption,"<option value='cursoAtesco'>Indice de contenidos para el tema ".$tagSetOn[0]."</option>");
                    }

                }
                //$htmlSelect
                //array_push($this->htmlSalidaOption,"<option value='".$this->htmlSelect[$clave]["value"][count($this->htmlSelect[$clave]["value"])-1]."_".$this->ixListadosTemasSQL["ordinal"][count($this->ixListadosTemasSQL["ordinal"])-1]."'>".$this->ixListadosTemasSQL["ordinal"][count($this->ixListadosTemasSQL["ordinal"])-1].": ".$this->ixListadosTemasSQL["Leyendas"][$clave]."</option>");
                if(count($this->ixListadosTemasSQL["ordinal"])>0){
                    if(isset($this->ixListadosTemasSQL["ids"][$this->ixListadosTemasSQL["ordinal"][count($this->ixListadosTemasSQL["ordinal"])-1]])){
                        array_push($this->htmlSalidaOption,"<option value='".$this->ixListadosTemasSQL["ids"][$this->ixListadosTemasSQL["ordinal"][count($this->ixListadosTemasSQL["ordinal"])-1]]."'>".$this->ixListadosTemasSQL["ordinal"][count($this->ixListadosTemasSQL["ordinal"])-1].": ".$this->ixListadosTemasSQL["Leyendas"][$clave]."</option>");
                    }
                }else{

                    array_push($this->htmlSalidaOption,"<option value='".$valor."'>".$valor."</option>");
                }

            }
            $notificaciones.= "se ha construido el objeto<br>";
        }

        public function volcarSelectOption(){
            $salida="";
            $this->salidaSeletFin["inicio"]="<select class='form-select' aria-label='Default select example' name='Temario_General'>";
            $this->salidaSeletFin["final"]="</select>";
            $salida= $this->salidaSeletFin["inicio"];
            foreach($this->htmlSalidaOption as &$valEnd){
                $salida.=$valEnd;
            }
            $salida.= $this->salidaSeletFin["final"];
            return $salida;
        }
    }



    class cabeceraForm{
        public $alphanumeric="";
        public $valMax="";
        public $iniVal=array();
        public $dasphalmeneric="";
        public $repeat=true;
        public $TTvalEnd=-1;
        public $iiValEnd=-1;
        public $cabezaFrm="";
        public $inputsFields=array();
        public $idAlta="";
        //asignamos los nombres de los campos del formulario, para asociarlos a la base de datos
        public $campo=array("login"=>array());
        /**
         * $checkFieldLong - longitud de las variables del formulario
         * $camposFrmTT - campos que asignaran aleatoriedad
         * 
         */
        function __construct($checkFieldLong, $camposFrmTT){
            $iiFrmToTT=-1;
            $this->alphanumeric="abcdefghijklmnopqrstuvwxyz";
            $this->alphanumeric=str_shuffle($this->alphanumeric);
            $this->alphanumeric.=strtoupper($this->alphanumeric);
            $this->alphanumeric=str_shuffle($this->alphanumeric);
            $this->alphanumeric.="0123456789";
            $this->alphanumeric=str_shuffle($this->alphanumeric);
            $this->dasphalmeneric=str_shuffle($this->alphanumeric);
            $this->valMax=(strlen($this->dasphalmeneric)-$checkFieldLong);
            $repeat=true;
            for($iiFrmToTT=0;$iiFrmToTT<=($camposFrmTT-1);$iiFrmToTT++){
                do{
                    $proofRand=random_int(0,$this->valMax);
                    if(!(in_array($proofRand,$this->iniVal,true))){
                        //$this->inputsFields[$this->iniVal[count($this->iniVal)-1]]=array();
                        if(!(count($this->iniVal)==$camposFrmTT)){                        
                            $this->iniVal[]=random_int(0,$this->valMax);
                            $repeat==true;
                        }else{
                            $repeat=false;
                        }
                    }else{
                        $repeat==true;
                    }
                }while($repeat==true);
            }

            foreach($this->iniVal as $idVal => &$valEnd){
                $this->alphanumeric=str_shuffle($this->alphanumeric);
                $this->dasphalmeneric=str_shuffle($this->alphanumeric);
                $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                do{
                    $test=substr($this->valorRand,0,1);
                    if(is_numeric($test)){
                        $valEnd=random_int(0,$this->valMax);
                        $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                        $this->idAlta.=$this->valorRand."  ";
                        $repeat=true;
                    }else{
                        if(!(in_array($this->valorRand,$this->campo["login"],true))){
                            array_push($this->campo["login"],$this->valorRand);
                            if(count($this->campo["login"])<3){
                                $repeat=false;
                            }else{
                                $repeat=false;
                            }
                        }else{
                            $this->valorRand=substr($this->dasphalmeneric,$valEnd,$checkFieldLong);
                            $this->idAlta.=$this->valorRand."  ";
                            $repeat=false;
                        }
                    }
                }while($repeat);
            }
            if(!(count($this->campo["login"])==$camposFrmTT)){
                echo "reporte de fallo desde el constructor<br>";
                echo "se esperaban ".$camposFrmTT." pero se han generado ".count($this->campo["login"])."<br>";
                echo "<pre>";
                print_r($this->campo["login"]);
                print_r($this->iniVal);
                echo "</pre>";
                return "error";
            }
            //$this->idAlta=trim($this->idAlta);
            //$this->idAlta=str_replace("  ","_",$this->idAlta);
        }

        /**
         * $tagFieldFrm - nombre de las tablas de la base de datos
         */
        function salidaRandomField($tagFieldFrm,$visible){
            $salida="";
            $ii=-1;
            if(!(count($this->campo["login"])==count($tagFieldFrm))){
                echo "reporte de fallo desde el montador<br>";
                echo "<pre>";
                print_r($this->campo["login"]);
                print_r($tagFieldFrm);
                echo "</pre>";
                return "error";
            }
            foreach($this->campo["login"] as $idVal => $valEnd){
                $ii++;
                $salida.=$valEnd."=".$tagFieldFrm[$ii]."  ";
                if($tagFieldFrm[$ii]=="logokey"){
                    if($visible){
                        $oculto=chr(34)."checkbox".chr(34)." value=".chr(34)."logokey".chr(34);
                    }else{
                        $oculto=chr(34)."hidden".chr(34)." value=".chr(34)."logokey".chr(34);
                    }
                    $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(34).$this->campo["login"][$ii].chr(34)." id=".chr(34).$tagFieldFrm[$ii].chr(34)." class=".chr(34)."form-check-input".chr(34)." checked>";
                }else if($tagFieldFrm[$ii]=="lontrasenia"){
                    if($visible){
                        $oculto=chr(34)."password".chr(34);
                    }else{
                        $oculto=chr(34)."hidden".chr(34)." value=".chr(34).$this->dasphalmeneric.chr(34);
                    }
                    $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(39).$this->campo["login"][$ii].chr(39)." id=".chr(39).$tagFieldFrm[$ii].chr(39)." class=".chr(39)."form-control".chr(39).$oculto.">";
                }else{
                    if($visible){
                        $oculto=chr(34)."text".chr(34);
                    }else{
                        $oculto=chr(34)."hidden".chr(34)." value=".chr(34)."logokey".chr(34);
                    }
                    $this->inputsFields[$valEnd]="<input type=".$oculto." name=".chr(34).$this->campo["login"][$ii].chr(34)." id=".chr(34).$tagFieldFrm[$ii].chr(34)." class=".chr(34)."form-control".chr(34).$oculto.">";
                }
                
            }
            $salida=trim($salida);
            $salida=str_replace("  ","&",$salida);
            // /examenData/admin/iFazNav/
            $this->cabezaFrm ="<form action=".chr(34)."accion.php?".$salida.chr(34)."&".$this->idAlta."='nuevoAlta' method=".chr(39)."post".chr(39).chr(34).">";
            return 1;
        }
        function salidaRandomInputFields($idExitInput){
            if(isset($this->inputsFields[$idExitInput])){
                return $this->inputsFields[$idExitInput];
            }else{
                echo "reporte de fallo desde el visualizador<br>";
                echo "<pre>";
                print_r($this->inputsFields);
                print_r($this->iniVal);
                echo $idExitInput;
                echo "</pre>";
                exit;
            }
        }
    }





?>