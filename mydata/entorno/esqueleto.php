<?php declare(strict_types=1);
    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }
    if(!isset($this->esqueletoHTML) && empty($montar)){
        echo "Error fatal en carga general<br>\n";
        exit;
        header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
    }
    
    array_push($this->esqueletoHTML, "<!DOCTYPE html>\n");
    array_push($this->esqueletoHTML, "<html lang='"."es"."'>\n");
    array_push($this->esqueletoHTML, "  <head>\n");
    array_push($this->esqueletoHTML, "    <meta charset='"."utf-8"."'>\n");
    array_push($this->esqueletoHTML, "    <meta content='"."width=device-width, initial-scale=1.0"."' name='"."viewport"."'>\n");
    array_push($this->esqueletoHTML, "    <title>"."Proyecto de formacion y estudio"."</title>\n");
    array_push($this->esqueletoHTML, "    <meta content='' name='"."description"."'>\n");
    array_push($this->esqueletoHTML, "    <meta content='' name='"."keywords"."'>\n");
    array_push($this->esqueletoHTML, "    <!-- Favicons -->\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/img/favicon.png"."' rel='"."icon"."'>\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/img/apple-touch-icon.png"."' rel='"."apple-touch-icon"."'>\n");
    array_push($this->esqueletoHTML, "    <!-- Google Fonts -->\n");
    array_push($this->esqueletoHTML, "    <link href='"."https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"."' rel='"."stylesheet"."'>\n");
    array_push($this->esqueletoHTML, "    <!-- Vendor CSS Files -->\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/vendor/bootstrap/css/bootstrap.min.css"."' rel='"."stylesheet"."'>\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/vendor/bootstrap-icons/bootstrap-icons.css"."' rel='"."stylesheet"."'>\n");
    array_push($this->esqueletoHTML, "    <!-- Template Main CSS File -->\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/css/style.css"."' rel='"."stylesheet"."'>\n");
    array_push($this->esqueletoHTML, "    <link href='" . ASSET_PATH . "/css/cropImg.css"."' rel='"."stylesheet"."'>\n");
    array_push($this->esqueletoHTML, "    <!-- <script src='"."https://platform.linkedin.com/badges/js/profile.js"."' async defer type='"."text/javascript"."'></script> -->\n");
    array_push($this->esqueletoHTML, "    <!-- =======================================================\n");
    array_push($this->esqueletoHTML, "    * Template Name: ComingSoon\n");
    array_push($this->esqueletoHTML, "    * Updated: Sep 28 2023 with Bootstrap v5.3.2\n");
    array_push($this->esqueletoHTML, "    * Template URL: https://bootstrapmade.com/comingsoon-free-html-bootstrap-template/\n");
    array_push($this->esqueletoHTML, "    * Author: BootstrapMade.com\n");
    array_push($this->esqueletoHTML, "    * License: https://bootstrapmade.com/license/\n");
    array_push($this->esqueletoHTML, "    ======================================================== -->\n");
    array_push($this->esqueletoHTML, "  </head>\n");
    array_push($this->esqueletoHTML, "<!-- Insertar comentario -->\n");
    array_push($this->esqueletoHTML, "  <body>\n");
    array_push($this->esqueletoHTML, "    <!-- ======= Header ======= -->\n");
    array_push($this->esqueletoHTML, "    <header id='"."header"."' class='"."d-flex align-items-center"."'>\n");
    array_push($this->esqueletoHTML, "      <div class='"."container d-flex flex-column align-items-center"."'>\n");
    array_push($this->esqueletoHTML,"<flowCode||value=>>'index|error'||position=>".count($this->salidaFinHTML).">");
    array_push($this->esqueletoHTML, "      </div>\n");
    array_push($this->esqueletoHTML, "    </header><!-- End #header -->\n");
    array_push($this->esqueletoHTML, "    <main id='"."main"."'>\n");
    array_push($this->esqueletoHTML, "      <!-- ======= About Us Section ======= -->\n");
    array_push($this->esqueletoHTML, "      <section id='"."about"."' class='"."about"."'>\n");
    array_push($this->esqueletoHTML, "        <div class='"."container"."'>\n");
    array_push($this->esqueletoHTML,"<flowCode||value=>>'index|error'||position=>".count($this->salidaFinHTML).">");
    array_push($this->esqueletoHTML, "        </div>\n");
    array_push($this->esqueletoHTML, "      </section><!-- End About Us Section -->\n");
    array_push($this->esqueletoHTML, "      <!-- ======= Contact Us Section ======= -->\n");
    array_push($this->esqueletoHTML, "      <section id='"."contact"."' class='"."contact"."'>\n");
    array_push($this->esqueletoHTML, "        <div class='"."container"."'>\n");
    array_push($this->esqueletoHTML,"<flowCode||value=>>'index|error'||position=>".count($this->salidaFinHTML).">");
    array_push($this->esqueletoHTML, "        </div>\n");
    array_push($this->esqueletoHTML, "      </section><!-- End Contact Us Section -->\n");
    array_push($this->esqueletoHTML, "    </main><!-- End #main -->\n");
    array_push($this->esqueletoHTML, "    <!-- ======= Footer ======= -->\n");
    array_push($this->esqueletoHTML, "    <footer id='"."footer"."'>\n");
    array_push($this->esqueletoHTML, "      <div class='"."container"."'>\n");
    array_push($this->esqueletoHTML, "        <div class='"."copyright"."'>\n");
    array_push($this->esqueletoHTML, "          &copy; Copyright <strong><span>Próximamente</span></strong>. Todos los derechos reservados\n");
    array_push($this->esqueletoHTML, "        </div>\n");
    array_push($this->esqueletoHTML, "        <div class='"."credits"."'>\n");
    array_push($this->esqueletoHTML, "          <!-- All the links in the footer should remain intact. -->\n");
    array_push($this->esqueletoHTML, "          <!-- You can delete the links only if you purchased the pro version. -->\n");
    array_push($this->esqueletoHTML, "          <!-- Licensing information: https://bootstrapmade.com/license/ -->\n");
    array_push($this->esqueletoHTML, "          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/comingsoon-free-html-bootstrap-template/ -->\n");
    array_push($this->esqueletoHTML, "          Plantilla diseñada por <a href='"."https://bootstrapmade.com/"."'>BootstrapMade</a>\n");
    array_push($this->esqueletoHTML, "        </div>\n");
    array_push($this->esqueletoHTML, "      </div>\n");
    array_push($this->esqueletoHTML, "    </footer><!-- End #footer -->\n");
    array_push($this->esqueletoHTML, "    <a href='"."#"."' class='"."back-to-top d-flex align-items-center justify-content-center"."'><i class='"."bi bi-arrow-up-short"."'></i></a>\n");
    array_push($this->esqueletoHTML, "    <!-- Vendor JS Files -->\n");
    array_push($this->esqueletoHTML, "    <script src='" . ASSET_PATH . "/vendor/bootstrap/js/bootstrap.bundle.max.js"."'></script>\n");
    array_push($this->esqueletoHTML, "    <script src='" . ASSET_PATH . "/vendor/php-email-form/validate.js"."'></script>\n");
    array_push($this->esqueletoHTML, "    <!-- Template Main JS File -->\n");
    array_push($this->esqueletoHTML, "    <script src='" . ASSET_PATH . "/js/main.js"."'></script>\n");
    array_push($this->esqueletoHTML, "  </body>\n");
    array_push($this->esqueletoHTML, "</html>\n");