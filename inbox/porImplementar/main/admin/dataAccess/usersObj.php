<?php
//Puede ser perfectamente un array obtenido de una consulta a base de datos o de un archivo json
    $leyendaLogin="ixRefAdminUser";
    $dataLogin="ixAdminAccess";
    $ixCurrentPreSesion+array("idVal" => &$leyendaLogin, "valEnd" => &$dataLogin);
    $usrDataBD="dataBD.json";
    $usrHash="crtusradmin.rfy";

    if (file_exists($usrDataBD)) {
        $calculaAmz = array(); // Inicializa el array 'calculaAmz' con valores vacíos
        $gestor = file_get_contents($usrDataBD); // Abre el archivo para lectura
        $dataArray = json_decode($contenido, true);
    }
    if(file_exists($usrHash)){
        $calculaAmz = []; // Inicializa el array 'calculaAmz' con valores vacíos
    
        $gestor = fopen($usrHash, "r"); // Abre el archivo para lectura
    
        while (!feof($gestor)) { // Recorre el archivo hasta el final
            $calculaAmz[] = trim(fgets($gestor)); // Lee una línea del archivo y la agrega al array
        }
    
        fclose($gestor); // Cierra el archivo
    }
    $idsLogines=array("username","password","servername","dbName");
    $cons=['cost'=>12];

    define("PWDHASH", $calculaAmz[0]);

    if(password_verify($dataArray[$idsLogines[1]],PWDHASH)){
        echo "password correcto<br>\n";
    }else{
        echo "Password no coincide<br>\n";
        exit;
    }

    ${$leyendaLogin}=array("username","password","servername","dbName");
    ${$dataLogin}=array(
        "permission" => array(
            array(
                $idsLogines[0] => $dataArray[$idsLogines[0]],
                $idsLogines[1] => $dataArray[$idsLogines[1]],
                $idsLogines[2] => $dataArray[$idsLogines[2]],
                $idsLogines[3] => $dataArray[$idsLogines[3]]
            ),
            array(
                $idsLogines[0] => "otroUserAdmin",
                $idsLogines[1] => "nopassword",
                $idsLogines[2] => "localhost",
                $idsLogines[3] => "elnombrequequiero"
            )
        )
    );







    class adminControl{
        public array $idsLogines=array();
        public array $ixers_Login = array();
        public int $userGrant;
        /**
         * $baseConn - contiene array con las referencias significativas de los campos asociativos 
         *              necesarios para la asignacion de los valores y su correcta instanciacion,
         *              proveyendo un id valido en el acceso con fines administrativos, del usuario
         *              con privilegios de nivel, que dara fundamento al acceso de los datos necesarios
         *              para automatizar y dotar de coherencia, al sitio web programado.
         */
        public function __construct($baseConn, $dataConn){
            $ixers_Login = array("granted"=>array());
            if(is_array($baseConn) && is_array($dataConn)){
                foreach($baseConn as $idVal => $valEnd){
                    $this->idsLogines[]=$valEnd;
                }
                foreach($dataConn as $idVal => $valEnd){
                    foreach($this->idsLogines as $idVal1 => $valEnd1){
                        $this->ixers_Login["granted"][$idVal][$valEnd1]=$valEnd[$idVal1];
                    }
                }
            }
        }

        public function salidaAdminLogin($idAdmin){
            if(isset($idAdmin)&&$idAdmin>-1){
                $this->userGrant=$idAdmin;
                if(is_array($this->ixers_Login["granted"][$idAdmin])){
                    //return $this->ixers_Login["granted"][$idAdmin];
                    return $this->ixers_Login["granted"][$idAdmin];
                }
            }else if($idAdmin==-1){
                if(is_array($this->ixers_Login["granted"])){
                    //return $this->ixers_Login["granted"][$idAdmin];
                    return $this->ixers_Login["granted"];
                }
            }else if($idAdmin==-2){
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
    $createUserAdmin=new adminControl($referencias, $acceso);
    $ixers_Login=$createUserAdmin->salidaAdminLogin(0);
    $idsLogines=$createUserAdmin->salidaIdsLogin();

    //CREATE USER 'trichindows'@'%localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'trichindows'@'%localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `trichindows`;GRANT ALL PRIVILEGES ON `trichindows`.* TO 'trichindows'@'%localhost';GRANT ALL PRIVILEGES ON `trichindows\_%`.* TO 'trichindows'@'%localhost';
?>