<?php
    if(file_exists(SM_PATH . '05_mail/functions/global.php')){
        require_once(SM_PATH . '05_mail/functions/global.php');
    }else{
        throw new Exception(SM_PATH . $miNombre->iknowiam ."/functions/global.php"."|".__FILE__."|".__LINE__);        
    }