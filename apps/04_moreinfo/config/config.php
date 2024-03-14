<?php
    if(file_exists(SM_PATH . '05_mail/config/config.php')){
        require_once(SM_PATH . '05_mail/config/config.php');
    }else{
        throw new Exception(SM_PATH . $miNombre->iknowiam ."/config/config.php"."|".__FILE__."|".__LINE__);        
    }