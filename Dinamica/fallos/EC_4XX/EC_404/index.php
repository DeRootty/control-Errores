<?php declare(strict_types=1);

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

if(!isset($_GET)){
    header('Location: /Dinamica/fallos/EC_4XX/EC_403/index.php?setData=directo');
    exit;
}
foreach($_GET as $idVal => $valEnd){
    echo $idVal." => ".$valEnd."<br>\n";
}
//$renderVista->