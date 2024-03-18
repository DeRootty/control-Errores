<?php declare(strict_types=1);

    if(!isset($this->error) && empty($montar)){
        echo "Error fatal, si el error tuviese un error, este es el siguiente nivel<br>\n";
        exit;
        header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
    }

    array_push($this->error, "                <div class='"."text-center"."'>\n");
    array_push($this->error, "                  <h2 class='"."d-flex justify-content-center align-items-center gap-2 mb-4"."'>\n");
    array_push($this->error, "                    <span class='"."display-1 fw-bold"."'>".$montar[1]."</span>\n");
    array_push($this->error, "                    <i class='bi bi-exclamation-circle-fill text-danger display-4'></i>\n");
    array_push($this->error, "                    <span class='"."display-1 fw-bold bsb-flip-h"."'>".$montar[2]."</span>\n");
    array_push($this->error, "                  </h2>\n");
    array_push($this->error, "                  <h3 class='"."h2 mb-2'".">".$montar[4]."</h3>\n");
    array_push($this->error, "                  <p class='"."mb-5"."'>"."La pagina que has solicitado esta en desarrollo desde el backend, aun le queda tiempo hasta llegar al frontend. Pero si quieres que esto vaya rapido, necesito ayuda en el frontend"."</p>\n");
    array_push($this->error, "                  <a class='"."btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0"."' href='"."#!"."' role='"."button"."'>"."Mas info aqui"."</a>\n");
    array_push($this->error, "                </div>\n");