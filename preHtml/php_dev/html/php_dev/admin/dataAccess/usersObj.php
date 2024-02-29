<?php
//Puede ser perfectamente un array obtenido de una consulta a base de datos o de un archivo json
    $ixIdRefAccess="referencias";
    $ixvalEndAcceso="acceso";
    class adminControl{
        public array $idsLogines=array();
        public array $ixers_Login = array();
        public int $userGrant =-1;
        public array $estadoAdmin = array();
        public array $referencias = array();
        public array $acceso = array();
        /**
         * $baseConn - contiene array con las referencias significativas de los campos asociativos 
         *              necesarios para la asignacion de los valores y su correcta instanciacion,
         *              proveyendo un id valido en el acceso con fines administrativos, del usuario
         *              con privilegios de nivel, que dara fundamento al acceso de los datos necesarios
         *              para automatizar y dotar de coherencia, al sitio web programado.
         */
        public function __construct(&$dataLogin, &$leyendaLogin){
            $usrDataBD="dataBD.json";
            $usrHash="crtusradmin.rfy";
            $pathRel="";
            //$usrDataBD="dataBD.php";
            //$usrHash="crtusradmin.php";
            $desarmaRuta=explode("/",__FILE__);
            foreach($desarmaRuta as $idVal => $valEnd){
                $tempFile=explode(".", $valEnd);
                if(count($tempFile)>1){
                    $this->estadoAdmin[]=true;
                    $this->estadoAdmin[]="Ruta rearmada<br>\n";
                }else{
                    if(!empty($tempFile[count($tempFile)-1])){
                        if($tempFile[count($tempFile)-1] == "admin"){
                            $pathRel.="  ".$tempFile[0];
                        }else if($tempFile[count($tempFile)-1] == "dataAccess"){
                            $pathRel.="  ".$tempFile[0];
                        }
                    }else{
                        if(file_exists(__FILE__)){
                            $this->estadoAdmin[]=false;
                            $this->estadoAdmin[]="Credenciales ofuscadas por denegacion de lectura: Denegacion de servicio <br>\n";
                        }else{
                            $this->estadoAdmin[]=false;
                            $this->estadoAdmin[]="Credenciales inaccesibles por violacion de puntero: Denegacion de servicio por parte del host <br>\n";
                        }
                    }
                }
            }
            $pathRel=trim($pathRel);
            $newPath=str_replace("  ", "/",$pathRel);
            define("ABSPATH", $newPath);
            //header("Location: http://dev.admin.loc/admin/dataAccess/");
            $ruta1=ABSPATH."/".$usrDataBD;
            $ruta2=ABSPATH."/".$usrHash;
            if ((file_exists($ruta1) && file_exists($ruta2)) || (file_exists($usrDataBD) && file_exists($usrHash))) {
                if((file_exists($ruta1) && file_exists($ruta2))){
                    $rutaReal1=$ruta1;
                    $rutaReal2=$ruta2;
                }
                if((file_exists($usrDataBD) && file_exists($usrHash))){
                    $rutaReal1=$ruta1;
                    $rutaReal2=$ruta2;
                }
                $calculaAmz = array(); // Inicializa el array 'calculaAmz' con valores vacíos
                $gestor = file_get_contents($rutaReal1); // Abre el archivo para lectura
                $dataArray = json_decode($gestor, true);
                $gestor = fopen($rutaReal2, "r"); // Abre el archivo para lectura
                while (!feof($gestor)) { // Recorre el archivo hasta el final
                    $calculaAmz[] = trim(fgets($gestor)); // Lee una línea del archivo y la agrega al array
                }
                fclose($gestor); // Cierra el archivo
                $idsLogines=array("username","password","servername","dbName");
                if(password_verify($dataArray[$idsLogines[1]],$calculaAmz[0])){
                    $this->estadoAdmin[]=true;
                    $this->estadoAdmin[]="Administracion del sitio garantizxada";
                }else{
                    $this->estadoAdmin[]=false;
                    $this->estadoAdmin[]="Administracion del sitio denegada";
                }
                $this->{$leyendaLogin}=array("username","password","servername","dbName");
                $this->{$dataLogin}=array();
                foreach($this->{$leyendaLogin} as $idVal => $valEnd){
                    $this->{$dataLogin}["permission"][$valEnd]=$dataArray[$valEnd];
                }
            }else{
                if (file_exists($ruta1)) {
                    echo "El archivo en ruta: ".$ruta1." Si existe. Tenga la referencia de este archivo: ".__FILE__."<br>\n";
                }else{
                    if(file_exists(__FILE__)){
                        $this->estadoAdmin[]=false;
                        $this->estadoAdmin[]="Credenciales ofuscadas: Denegacion de servicio <br>\n";
                    }else{
                        $this->estadoAdmin[]=false;
                        $this->estadoAdmin[]="Credenciales inaccesibles: Denegacion de servicio por parte del host <br>\n";
                    }
                }
                if (file_exists($ruta2)) {
                    echo "El archivo en ruta: ".$ruta2." Si existe. Tenga la referencia de este archivo: ".__FILE__."<br>\n";
                }else{
                    if(file_exists(__FILE__)){
                        $this->estadoAdmin[]=false;
                        $this->estadoAdmin[]="Credenciales ofuscadas: Denegacion de servicio <br>\n";
                    }else{
                        $this->estadoAdmin[]=false;
                        $this->estadoAdmin[]="Credenciales inaccesibles: Denegacion de servicio por parte del host <br>\n";
                    }
                }
            }

            //if(is_array($baseConn) && is_array($dataConn)){
            if(is_array($this->{$leyendaLogin}) && $this->{$dataLogin}){
                foreach($this->{$leyendaLogin} as $idVal => $valEnd){
                    $this->idsLogines[]=$valEnd;
                }
                foreach($this->{$dataLogin} as $idVal => $valEnd){
                    $this->userGrant++;
                    foreach($this->idsLogines as $idVal1 => $valEnd1){
                        $this->ixers_Login["granted"][$this->userGrant][$valEnd1]=$valEnd[$valEnd1];
                    }
                }
            }else{
                $this->estadoAdmin[]=false;
                $this->estadoAdmin[]="No se puede montar la matriz de conexion: Denegacion de conexion a la base de datos <br>\n";
            }
        }
        public function salidaAdminLogin($idAdmin){

            if(isset($idAdmin) && $idAdmin>-1){
                $this->userGrant=$idAdmin;
                if(is_array($this->ixers_Login["granted"][$this->userGrant])){
                    //return $this->ixers_Login["granted"][$idAdmin];
                    return $this->ixers_Login["granted"][$this->userGrant];
                }
            }else if($this->userGrant==-1){
                if(is_array($this->ixers_Login["granted"])){
                    //return $this->ixers_Login["granted"][$idAdmin];
                    return $this->ixers_Login["granted"];
                }
            }else if($this->userGrant==-2){
                if(is_array($this->ixers_Login)){
                    //return $this->ixers_Login["granted"][$idAdmin];
                    return $this->ixers_Login;
                }
            }
        }
        public function salidaIdsLogin(){
            if(is_array($this->idsLogines)){
                //return $this->ixers_Login["granted"][$idAdmin];
                return $this->idsLogines;
            }
        }
    }
    $createUserAdmin=new adminControl($ixIdRefAccess, $ixvalEndAcceso);
    $ixers_Login=$createUserAdmin->salidaAdminLogin(0);
    $idsLogines=$createUserAdmin->salidaIdsLogin();