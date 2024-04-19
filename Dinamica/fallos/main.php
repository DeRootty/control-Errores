<?php declare(strict_types=1);

    try{
        if(count($_GET)<1 || !isset($_SERVER['SERVER_NAME'])){
            throw new Exception('Adios mundo cruel: Error en ' . __FILE__ . " => " . __LINE__);
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
        exit;
    }
    if(isset($_GET["var"]) && $_GET["var"]=="valor"){
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

    //namespace excepciones;

    define("ERRORES_PATH", "../");

    require_once ERRORES_PATH . "EC_4XX/index.php";
    require_once ERRORES_PATH . "ES_5XX/index.php";
    require_once ERRORES_PATH . "EF_6XX/index.php";
    require_once ERRORES_PATH . "ET_7XX/index.php";