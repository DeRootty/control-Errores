<?php declare(strict_types=1);

if(empty($_POST) || (!isset($_POST["dinamica"]) && !isset($_POST["leyenda"]))){
    header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
}
if(!isset($_GET)){
    header('Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setData=directo');
}