<?php
    //echo "Acceso al sistema de desarrollo y formacion en php, symfony, drupal, magento, wordpress y prestashop\n";
    $usrDataBD="dataAccess/dataBD.json";
    $usrHash="dataAccess/crtusradmin.rfy";
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
    if(password_verify("S3nr3+C1c0r-Ll0d8r!D3",PWDHASH)){
        echo "password correcto<br>\n";
    }else{
        echo "Password no coincide<br>\n";
    }

    exit;
