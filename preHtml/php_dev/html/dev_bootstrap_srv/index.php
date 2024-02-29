<?php
    if(file_exists("engineLoadAMZ.php")){
        require_once "engineLoadAMZ.php";
    }else{
        echo "error: Ruta de archivo no existe<br>\n";
    }

    //require_once "conexion.php";
    $rutaArchivo="index.amz";
    if(!file_exists($rutaArchivo)){
        echo "";
    }
    $conn = NULL;
    //$rutaArchivo="";
    $sesionIniciada=array(false);
    function muestraAMZ(&$rutaArchivo, &$Data): string{
        $salida="";
        $datosMatriz = new extraeHTML($rutaArchivo);
        $salida= $datosMatriz->outputShowHTML($Data);
        return $salida;
    }
    if( isset($_POST) && is_array($_POST) && count($_POST)>0 ){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        exit;
        if(isset($_POST["disabled"]) && !empty($_POST["disabled"])){
            $rutaArchivo=$_POST["disabled"];
        }else{
            $rutaArchivo="sample.amz";            
        }
    }else{

    }
    echo muestraAMZ($rutaArchivo, $resulTabla);
    echo $resulTabla;
?>