<?php
    /**
     * login.php -- simple login screen
     *
     * This a simple login screen. Some housekeeping is done to clean
     * cookies and find language.
     *
     * @copyright 1999-2011 The SquirrelMail Project Team
     * @license http://opensource.org/licenses/gpl-license.php GNU Public License
     * @version $Id: login.php 14084 2011-01-06 02:44:03Z pdontthink $
     * @package squirrelmail
     */

    /**
     * login.php -- adaptacion a php 8
     * @version $subId: login.php 10000 2024-01-29 22:08
     * @package squirrelmail
     */


    /** This is the login page */
    define('PAGE_NAME', 'login');

    /**
     * Path for SquirrelMail required files.
     * @ignore
     */
    define('SM_PATH','../');

    if(isset($_GET) && !empty($_GET)){
        foreach($_GET as $idVal => $valEnd){
            if($idVal=="ok"){
                define('TOKEN_ID',$valEnd);
                try{
                    if(file_exists(SM_PATH . "../admin/main/mail.php")){
                        require_once(SM_PATH . "../admin/main/mail.php");
                    }else{
                        throw new Exception("Linea ".__LINE__." Fallo en la ruta ".__FILE__);
                    }
                }catch(Exception $e){
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                }
            }else if($idVal=="error"){
                define('TOKEN_ERR',$valEnd);
                $lang=array(
                    "eng"=>array("ERROR: ".TOKEN_ERR,"Config file","not found. You need to ","configure SquirrelMail before you can use it."),
                    "es"=>array("ERROR: ".TOKEN_ERR,"Archivo de configuracion","no encontrado. Necesita ","configurar SquirrelMail antes de poderlo usar."),
                );
                $htmlOut[]= '<html><body><p><strong>'.$lang["eng"][0].'</strong> '.$lang["eng"][1].'&quot;<tt>config/config.php</tt>&quot; '.$lang["eng"][2].$lang["eng"][3].'</p></body></html>';
            }
        }

    }

    try{
        //if(file_exists(SM_PATH . $miNombre->iknowiam."/controller/whoami.php")){
        if(file_exists(SM_PATH . "index.php")){
            require_once(SM_PATH ."index.php");
        }else{
            throw new Exception(SM_PATH . "index.php");
        }
    }catch(Exception $e){
        echo 'Revisa la ruta: ',  $e->getMessage(), "\n";
        exit;
    }
    //echo "llamando a index<br>\n";
