<?php
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
    echo PWDHASH."<br>\n";
    if(password_verify($dataArray[$idsLogines[1]],PWDHASH)){
        echo "password correcto<br>\n";
    }else{
        echo "Password no coincide<br>\n";
        exit;
    }
    $ixers_Login = array(
        "permission" => array(
            array(
                $idsLogines[0] => $dataArray[$idsLogines[0]],
                $idsLogines[1] => $dataArray[$idsLogines[1]],
                $idsLogines[2] => $dataArray[$idsLogines[2]],
                $idsLogines[3] => $dataArray[$idsLogines[3]]
            ),
            array(
                $idsLogines[0] => "%*%",
                $idsLogines[1] => "%*%",
                $idsLogines[2] => "%*%",
                $idsLogines[3] => "%*%"
            )
        )
    );
    //CREATE USER 'trichindows'@'%localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'trichindows'@'%localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `trichindows`;GRANT ALL PRIVILEGES ON `trichindows`.* TO 'trichindows'@'%localhost';GRANT ALL PRIVILEGES ON `trichindows\_%`.* TO 'trichindows'@'%localhost';
