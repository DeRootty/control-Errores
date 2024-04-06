<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    namespace practicasAPP;
      use Exception;

    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }
      
    define("LOOPS_PATH", "/loops");                             //
    define("LOAD_LP_FILE", "/sub_box_01_Ix01A.php");            //
    define("ERROR_LP_FILE", "/sub_box_01_Ex01A.php");           //
    define("COMMON_LP_FILE", "/sub_box_01_Px00A.php");          //
    define("LOOP_APP_00", "/00_sendme");                        //
    define("LOOP_APP_01", "/01_logit");                         //
    define("LOOP_APP_02", "/02_shopon");                        //
    define("LOOP_APP_03", "/03_payme");                         //
    define("LOOP_APP_04", "/04_moreinfo");                      //
    define("LOOP_APP_05", "/05_mail");                          //
    define("APP_INDEX", __FILE__);                              //Privilegios con los que se marca el flujo.