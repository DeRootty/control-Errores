<?php
    //Se incluye el archico con la clase que mezcla el armazon con el formulario
    require_once "indexObj.php";

    if(isset($redirect)&&is_array($redirect)&&count($redirect)>0){
        $ejecuta=0;
        $index = new index($ejecuta, $_SERVER, $redirect);
        if($index->contructOK){
            require_once $index->salidaArmazon();
            if( ( (isset($armazon)) && (isset($formulario)) && (isset($terceros)) ) && ( (count($armazon) > 0) && (count($formulario) > 0) && (count($terceros) > 0)) ){
                $index->cargaArmazon($armazon);
                $index->cargaArmazon($armazon);
            }
        }
        $index->redireccion($_GET,array($armazon, $salida, NULL));
    }else{
        $ejecuta=-1;
    }
    //Las variables $armazon y $salida se defienen en el archivo inLogin

    switch($ejecuta){
        case 0:
            $uriNow= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            if(isset($cabecerasOriginales)){
                if($cabecerasOriginales<0){
                    unset($_GET);
                    unset($armazon);
                    unset($salida);
                    $cabecerasOriginales=12;
                }
            }
            if( ( (isset($armazon)) && (isset($salida)) ) && ( (count($armazon) > 0) && (count($salida) > 0) ) ){
                $index->redireccion($_GET,array($armazon, $salida, NULL));
                $salidaHTML = new renderHTML($armazon, $salida, $_SERVER["SERVER_NAME"], $modal);
                echo $salidaHTML->muestraHTML();
            }else{
                require_once "practicas/inLoginObj.php";
                if( ( (isset($armazon)) && (isset($salida)) ) && ( (count($armazon) > 0) && (count($salida) > 0) ) ){
                    
                    $salidaHTML = new renderHTML($armazon, $salida, $_SERVER["SERVER_NAME"], $modal);
                    echo $salidaHTML->muestraHTML();
                }
            }
            exit;
            if(isset($PrimeraCarga)){
                header('Location: '.$_SERVER["PHP_SELF"]);
                //echo "tato ".$_SERVER["SERVER_NAME"]."<br>";
                flush();
                exit;
            }else{
                //echo $_SERVER["SERVER_NAME"]."<br>";
                header('Location: '.$_SERVER["PHP_SELF"]);
                $salidaHTML = new renderHTML($armazon,$salida,$_SERVER["SERVER_NAME"]);          
            }
            break;
        case 1:
            //require_once "examenData/admin/iFazNav/index.php";
        case 2:
            require_once "wordpress/index.php";
            break;
        case 3:
            require_once "wordpress/wp-login.php";
            break;
        case 4:
            require_once "practicas/ejercicio1.php";
            break;
        case -1:
            echo "redirige a plantilla error";
            break;
    }




















    switch($this->ejecuta){
        case 0:

            if(isset($cabecerasOriginales)){
                if($cabecerasOriginales<0){
                    unset($superGlobGet);
                    unset($armazon);
                    unset($salida);
                    $cabecerasOriginales=12;
                }
            }
            if( ( (isset($armazon)) && (isset($salida)) ) && ( (count($armazon) > 0) && (count($salida) > 0) ) ){
                $this->salidaHTML = new renderHTML($integracionHTML[0], $integracionHTML[1], $superGlobSrv["SERVER_NAME"], $modal);
                echo $this->salidaHTML->muestraHTML();
            }else{

                if( ( (isset($armazon)) && (isset($salida)) ) && ( (count($armazon) > 0) && (count($salida) > 0) ) ){
                    $this->salidaHTML = new renderHTML($integracionHTML[0], $integracionHTML[1], $superGlobSrv["SERVER_NAME"], $modal);
                    echo $this->salidaHTML->muestraHTML();
                }
            }
            exit;
            if(isset($PrimeraCarga)){
                header('Location: '.$superGlobSrv["PHP_SELF"]);
                //echo "tato ".$_SERVER["SERVER_NAME"]."<br>";
                flush();
                exit;
            }else{
                //echo $_SERVER["SERVER_NAME"]."<br>";
                header('Location: '.$superGlobSrv["PHP_SELF"]);
                $this->salidaHTML = new renderHTML($integracionHTML[0], $integracionHTML[1], $superGlobSrv["SERVER_NAME"]);          
            }
            break;
        case 1:

        case 2:
            require_once "wordpress/index.php";
            break;
        case 3:
            require_once "wordpress/wp-login.php";
            break;
        case 4:
            require_once "practicas/ejercicio1.php";
            break;
    }

?>