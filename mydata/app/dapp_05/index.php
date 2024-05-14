<?php declare(strict_types=1);
    namespace practicasAPP\myData\app\dapp_05;
    use Exception;
    $nameHead = '';
    if(empty($_GET) && empty($_POST)){
        echo 'iniciando ' . $nameHead . '<br>' . "\n";
        goto iniciando;
    }
    header("Content-Type: application/json");
    $dirMe = explode("/", __DIR__);
    $iid = 7224;
    if((isset($_GET["var"]) && $_GET["var"]==$dirMe[count($dirMe)-1]) && (!isset($_GET["exec"]) && empty($_GET["exec"]))){
        $salida= json_encode(array(
            array(
                "respuesta",
                'nivel',
                'ruta',
                'base_cURL',
                "launchLoad",
                "localServer",
                'base_URI',
                'exec',
                'var',
                'EOIX'
            ),
            array(
                "ok_conectado",
                 $iid . ':_1ero',
                __DIR__,
                '/mydata/app/' . $_GET["var"],
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'var=' . $_GET["var"] . '&exec='.$_POST["exec"],
                'hash',
                $_GET["var"],
                'EOIX'
            ),
            array(),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }else if(isset($_GET["exec"]) && $_GET["exec"]=="hash"){
        $dirMe = explode('_', $_GET["var"]);
        $salida= json_encode(array(
            array(
                'respuesta',
                'nivel',
                'ruta',
                'base_cURL',
                "launchLoad",
                "localServer",
                'base_URI',
                "exec",
                'idAdmin',
                'EOIX'
            ),
            array(
                "ok_conectado",
                 $iid . ':_2do',
                __DIR__,
                '/apps',
                '/index.php',
                $_SERVER['SERVER_NAME'],
                'app=' . $dirMe[count($dirMe)-1],
                '/admin' . '/' . $dirMe[0] . '/' . $dirMe[1] . '/' . 'main.php',
                '/admin' . '/' . $dirMe[0] . '/' . $dirMe[1] . '/' . 'login.php',
                'EOIX'
            ),
            array(),
            'POST' => $_POST
        ));
        echo $salida;
        exit;
    }
        $salida= json_encode(array(
            array(
                "respuesta",
                'ruta',
                'EOIX'
                ),
            array(
                "error",
                'redirije pagina error',
                'EOIX'
                ),
            array(),
            'POST' => $_POST
        ));
    echo $salida;
    exit;
iniciando:
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