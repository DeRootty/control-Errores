<?php
/**
 * index.php
 *
 * Redirects to the login page.
 *
 * @copyright 1999-2011 The SquirrelMail Project Team
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: index.php 14084 2011-01-06 02:44:03Z pdontthink $
 * @package squirrelmail
 */
header('Location: /error/index.html');
exit;
 echo "Estas en la pagina en construccion de squirrelMail ";
 exit;

if(!defined(PAGE_NAME)){

}else{
    if(!defined(SM_PATH)){
        define('SM_PATH',$_POST["formType"]."/");
    }else{
    
    }
}

try{
    if(file_exists(SM_PATH . "/stamp.php")){
        require_once(SM_PATH . "/stamp.php");
    }else{
        throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
    }
}catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    echo SM_PATH . "admin/stamp.php<br>\n";
    exit;
}//try

if(isset($htmlOut) && is_array($htmlOut) && !empty($htmlOut)){
    foreach($htmlOut as $idVal => $valEnd){
        echo $valEnd;
    }
}else{


    // If we are, go ahead to the login page.

}
header('Location: src/login.php?'.$branch[0]."=".$randomStr[0]["val"][0]."&".$branch[1]."=".$randomStr[1]["val"][0]);

//DD_API_KEY=323d474ba3727a7b5fe07358fc19ff9d DD_SITE="datadoghq.eu" bash -c "$(curl -L https://s3.amazonaws.com/dd-agent/scripts/install_script_agent7.sh)"

?>