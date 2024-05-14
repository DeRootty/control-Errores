<?php declare(strict_types=1);
    namespace stamp;
    try{
        if(!file_exists(BASE_PATH . "/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        
    }
    require_once (BASE_PATH . "/Dinamica/seguridad/ahead.php");


    $randomStr=array(
        array(
            "val"=>array()
        ),
        array(
            "val"=>array()
        )
    );
    try{
        //if(file_exists(SM_PATH . $miNombre->iknowiam."/controller/whoami.php")){
        if(file_exists(SM_PATH . $miNombre->iknowiam."/functions/strings.php")){
            require_once(SM_PATH . $miNombre->iknowiam ."/functions/strings.php");
        }else{
            throw new Exception(SM_PATH . $miNombre->iknowiam ."/functions/strings.php");
        }
    }catch(Exception $e){
        echo 'Revisa la ruta: ',  $e->getMessage(), "\n";
        exit;
    }
    $htmlOut=array();
    $branch="";
    //use src/login as Login;
    
    $randomStr[]=$_SERVER['REMOTE_ADDR'];                                                                                       //2
    $randomStr[]=$_SERVER['REQUEST_URI'];                                                                                       //3
    $randomStr[]=str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ");                                                                     //4
    $randomStr[]=str_shuffle("abcdefghijklmnopqrstuvwxyz");                                                                     //5
    $randomStr[]=str_shuffle("0123456789");                                                                                     //6
    $randomStr[]=str_shuffle("_@!+-*();~");                                                                                     //7
    $randomStr[]=substr($randomStr[4],1,5).substr($randomStr[5],1,5).substr($randomStr[6],1,5).substr($randomStr[7],1,5);       //8
    $randomStr[0]["val"][]=GenerateRandomString(8,$randomStr[8]);
    $randomStr[1]["val"][]=GenerateRandomString(8,$randomStr[8]);
    $inequal=false;
    //echo "<br>".$randomStr[0]["val"][count($randomStr[0]["val"])-1]."<br>\n";
    //echo $randomStr[1]["val"][count($randomStr[0]["val"])-1]."<br>\n";
    //echo $randomStr[8]."<br>\n";
    //exit;
    if($randomStr[0]["val"][count($randomStr[0]["val"])-1]==$randomStr[1]["val"][count($randomStr[1]["val"])-1]){
        do{
            if($randomStr[0]["val"][count($randomStr[0]["val"])-1]!==$randomStr[0]["val"][count($randomStr[0]["val"])-2]){
                $inequal=true;
            }else{
                $randomStr[0]["val"][]=GenerateRandomString(8,$randomStr[6]);
                $randomStr[1]["val"][]=GenerateRandomString(8,$randomStr[6]);
            }
        }while($inequal);
    }

    //$randomStr[]=GenerateRandomString(8,$randomStr[1]);
    //echo $_SERVER['REQUEST_URI'].$randomStr;