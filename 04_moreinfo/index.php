<?php
    header('Location: /error/index.html');
    exit;
    if(!defined('PAGE_NAME')){
        define('PAGE_NAME', 'index');
    }
    define('SM_PATH','../');
    try{    
        if(require_once(SM_PATH . "admin/controller/whoami.php")){
            if(file_exists(SM_PATH . "admin/controller/whoami.php")){
                header('Location: /error/index.html');
            }
        }else{
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);            
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    //echo "Estas en la pagina en construccion de mas informacion ";
    exit;
    try{
        $miNombre=new queScript(__FILE__);
        if(!$miNombre->status){
            throw new Exception('No se admiten argumentos vacios');
        }else{
            $miNombre->iknowiam=$miNombre->nombreScript($miNombre);
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    try{
        if($miNombre->iknowiam!==$_POST["formType"]){
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
        }else{
            try{
                if(file_exists(SM_PATH . "admin/stamp.php")){
                    require_once(SM_PATH . "admin/stamp.php");
                }else{
                    throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
                }
            }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                exit;
            }
        }
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        exit;
    }
    if( ! file_exists ( 'config/config.php' ) ) {
        $branch="error";
        //exit;
    }else{
        $branch="ok";
    }


    try{
        if(isset($_POST)){
            header('Location: src/login.php?'.$branch."=".$randomStr[0]["val"][0]."&".$branch."=".$randomStr[1]["val"][0]);
        }else{
            throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
        }
    }catch(Exception $e){
        echo "Archivo en construccion<br>\n";
        exit;
    }

