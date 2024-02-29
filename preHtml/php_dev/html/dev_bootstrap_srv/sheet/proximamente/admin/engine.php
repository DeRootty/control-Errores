<?php
$calculaAmz=array();
$calculaAmz=explode(".",$esteArchivo);
$amzResult=$calculaAmz[0].".amz";
$crudShowOn=array();
//$calculaAmz = array();
if (file_exists($amzResult)) {
    $calculaAmz = []; // Inicializa el array 'calculaAmz' con valores vacíos
    $gestor = fopen($amzResult, "r"); // Abre el archivo para lectura
    while (!feof($gestor)) { // Recorre el archivo hasta el final
        $calculaAmz[] = fgets($gestor); // Lee una línea del archivo y la agrega al array
    }
    fclose($gestor); // Cierra el archivo
}

$insertaPhp=false;
$llamadaFuncion=-1;
$crudAddOn=array();

foreach($calculaAmz as $idVal => $valEnd){
    //Semaforo de control addOn
    if(trim($valEnd)=="<php>"){
        $insertaPhp=true;
        $llamadaFuncion++;
    }else if(trim($valEnd)=="</php>"){
        $insertaPhp=false;
    }else{
        $crudShowOn[]=trim($valEnd);
    }
    if($insertaPhp){
        if($llamadaFuncion==0){
            $crudAddOn=primeraFuncion($sql, $conn, $leyendas, $ixIdCampos);
        }else if($llamadaFuncion==1){
            $crudAddOn=array();
            $tempy=segundaFuncion($leyendas);
            $crudAddOn=array($tempy["action"]);
        }else if($llamadaFuncion==2){
            $crudAddOn=array();
            $tempy=terceraFuncion($leyendas);
            $crudAddOn=array($tempy["numRegTotal"]);
        }else if($llamadaFuncion==3){
            $crudAddOn=array();
            $tempy=cuartaFuncion($leyendas);
            $crudAddOn=array($tempy["botonActive"]);
        }else if($llamadaFuncion==4){
            $crudAddOn=array();
            $crudAddOn=quintaFuncion($leyendas);
        }
        $crudShowOn=array_merge($crudShowOn, $crudAddOn);
        unset($crudAddOn);
    }
}
$arrayTemp="";
$arrayTemp=implode($crudShowOn);
unset($crudShowOn);
$crudShowOn=explode("|",$arrayTemp);
foreach($crudShowOn as $idVal => $valEnd){
    echo trim($valEnd)."\n";
}