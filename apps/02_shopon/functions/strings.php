<?php
    if(file_exists(SM_PATH . '05_mail/functions/strings.php')){
        require_once(SM_PATH . '05_mail/functions/strings.php');
    }else{
        throw new Exception(SM_PATH . $miNombre->iknowiam ."/functions/strings.php"."|".__FILE__."|".__LINE__);        
    }