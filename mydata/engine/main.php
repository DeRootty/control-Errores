<?php
    function postVerify(&$ixCheck){
        if(empty($ixCheck)){
            return false;            
        }else{
            return true;
        }
    }
//Se define el indice de la navegacion. En el mapa, toda entrada tendra el nombre con el que se defina PAGE_NAME
//Se define la raiz administrativa, osea, el lugar donde el back end hace su trabajo y el front end depende de ello para asegurar la logica coherente.
    if(!defined('PAGE_NAME') && !defined('PATH_ADM')){
        define('PAGE_NAME', 'index');
        define('PATH_ADM','admin');

        try{    
            if(file_exists(PATH_ADM . "/controller/itsme.php")){
                require_once(PATH_ADM . "/controller/itsme.php");
            }else{
                throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);            
            }
        }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            echo "Esta ruta es inexistente: ". PATH_ADM . "/controller/itsme.php";
            exit;
        }       

        try{
            if(!postVerify($_POST)){
                throw new Exception(__LINE__.",".__FILE__);
            }else{
                $branch=array();
                $idBranch=-1;
            }
        }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            exit;
        }//try
    }//if

    try{
        if(file_exists(PATH_ADM . "/controller/whoami.php")){
            require_once(PATH_ADM . "/controller/whoami.php");
        }else{
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);            
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }        

    // Are we configured yet?
    if( ! file_exists (PATH_ADM . 'config/config.php' ) ) {
        $branch[]="error";
        $branch[]="ok";
        //exit;
    }else{
        $branch[]="ok";
        $branch[]="error";
    }//if

    try{
        $miNombre = new queScript(__FILE__);
        if(!$miNombre->status){
            throw new Exception('No se admiten argumentos vacios');
        }else{
            try{
                if(!empty($_POST["rdnVal"])){
                    $qApp = array();
                    $qselect = array();
                    $qApp=explode("_",$_POST["rdnVal"]);
                }else{
                    throw new Exception("Problemas con Post: Linea ".__LINE__." Fallo en la ruta ".__FILE__);    
                }
                foreach($_POST as $idVal => $valEnd){
                    $qselect=explode("_", $idVal);
                    if(in_array($qApp[1],$qselect)){
                        if(!defined('APP_PATH')){
                            define('APP_PATH', $valEnd);
                        }
                        require_once(APP_PATH . "/" . PAGE_NAME.".php");
                    }
                }
                throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
            }catch(Exception $e){
                echo "Archivo en construccion ". $e->getMessage() ."<br>". "\n";
                exit;
            }//try
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }//try





