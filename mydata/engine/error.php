<?php
    header('HTTP/1.0 404 Not Found', true, 404);
    
    $datoUri = "El tip solicitado es" . $_GET['tip'] ?? "Se redirecciona a: ". $_SERVER['REQUEST_URI'];
    echo "Esta pagina es de error: ".$datoUri."\n";