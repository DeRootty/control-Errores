<?php declare(strict_types=1);

    if(!isset($this->error) && empty($montar)){
        echo "Error fatal, si el error tuviese un error, este es el siguiente nivel<br>\n";
        exit;
        header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
    }
    