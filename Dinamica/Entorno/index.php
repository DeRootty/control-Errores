<?php declare(strict_types=1);
            //[9] => www.derootty.xyz/Dinamica/Entorno/index.php?var=
    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    if(isset($_GET["var"]) && $_GET["var"]=="hash_FNT"){
        $salida= json_encode(array(
            "respuesta" => "ok, conectado"
        ));
        echo $salida;
        exit;
    }
    $salida= json_encode(array(
        "respuesta" => "error"
    ));
    echo $salida;
    exit;
