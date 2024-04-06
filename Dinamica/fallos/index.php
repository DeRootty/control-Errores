<?php declare(strict_types=1);

    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    $modoRtm->registroMod("hola mundo para la indexacion del fallo " . __FILE__ . " => " . __LINE__);
    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        $modoRtm->registroMod($ex->getMessage());
        $modoRtm->salidaModo();
        exit;
    }finally{
        //include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
        require_once ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }


if(!isset($_GET)){
    header('Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setData=directo');
    exit;
}
foreach($_GET as $idVal => $valEnd){
    echo $idVal." => ".$valEnd."<br>\n";
}