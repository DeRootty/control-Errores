<?php declare(strict_types=1);
if(!isset($_GET)){
    header('Location: /Dinamica/fallos/EC_4XX/EC_403/index.php?setData=directo');
    exit;
}
foreach($_GET as $idVal => $valEnd){
    echo $idVal." => ".$valEnd."<br>\n";
}
//$renderVista->