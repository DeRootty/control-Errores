<?php declare(strict_types=1);

    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    if(!isset($this->error) && empty($montar)){
        echo "Error fatal, si el error tuviese un error, este es el siguiente nivel<br>\n";
        exit;
        header("Location: /Dinamica/fallos/EC_4XX/EC_404/index.php?setdata=Pagina_no_Encontrada");
    }

    array_push($this->error, "        <div class='d-flex justify-content-center'>\n");
    array_push($this->error, "          <div>\n");
    array_push($this->error, "            <img class='derootty' alt='Logo' src='assets/img/logoDerootty.svg' height='300'/>\n");
    array_push($this->error, "          </div>\n");
    array_push($this->error, "          <div>\n");
    array_push($this->error, "            <h2>_______________________________</h2>\n");
    array_push($this->error, "            <h1>"."Proyecto de formación y estudio"."</h1>\n");
    array_push($this->error, "            <h1>"."error en tu navegacion"."</h1>\n");
    array_push($this->error, "            <h2>"."_______________________________"."</h2>\n");
    array_push($this->error, "          </div>\n");
    array_push($this->error, "          <div>\n");
    array_push($this->error, "            <img class='derootty' alt='Logo' src='assets/img/rootty.png' height='300'/>\n");
    array_push($this->error, "          </div>\n");
    array_push($this->error, "        </div>\n");
    array_push($this->error, "<flowCode||value=>>'main'||position=>".count($this->error).">");
    array_push($this->error, "          <div class='row'>\n");
    array_push($this->error, "              <div class='"."col-12"."'>\n");
    try{
        if(!file_exists(BASE_PATH . FAIL_PATH . "/" . $montar[1] .  "/" . $montar[2] .  "/" . $montar[3])){
            throw new Exception("Ruta inexistente: ".BASE_PATH . FAIL_PATH . "/" . $montar[1] .  "/" . $montar[2] .  "/" . $montar[3]);
        }
    } catch(Exception $ex){
        echo $ex->getMessage();
        exit;
    }finally{
        require_once (BASE_PATH . FAIL_PATH . "/" . $montar[1] .  "/" . $montar[2] .  "/" . $montar[3]);
    }
    
    array_push($this->error, "              </div>\n");
    array_push($this->error, "          </div>\n");
    array_push($this->error, "<flowCode||value=>>'main'||position=>".count($this->error).">");
    array_push($this->error, "          <div class='"."section-title"."'>\n");
    array_push($this->error, "            <h2>"."Cuando tenga el apartado de librerias de contacto hablitado, deberias probarlo, en serio, tú hazlo... aún no se para qué, pero seguro me hará ilusión"."</h2>\n");
    array_push($this->error, "          </div>\n");
    array_push($this->error, "          <div class='"."row justify-content-center"."'>\n");
    array_push($this->error, "           <div class='"."col-lg-10"."'>\n");
    array_push($this->error, "                <div class='"."info-wrap"."'>\n");
    array_push($this->error, "                  <div class='"."row"."'>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "                    <div class='"."col-lg-4 info"."'>\n");
    array_push($this->error, "                      <i class='"."bi bi-geo-alt"."'></i>\n");
    array_push($this->error, "                      <h4>Localizacion:</h4>\n");
    array_push($this->error, "                      <p>Luis Barrón Street<br>New Logroñok, LR 26005</p>\n");
    array_push($this->error, "                    </div>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "                    <div class='"."col-lg-4 info mt-4 mt-lg-0"."'>\n");
    array_push($this->error, "                      <i class='"."bi bi-envelope"."'></i>\n");
    array_push($this->error, "                      <h4>Email:</h4>\n");
    array_push($this->error, "                      <p>aunpor@configu.rar<br>otra@configurac.ion</p>\n");
    array_push($this->error, "                    </div>\n");
    array_push($this->error, "                    <div class='"."col-lg-4 info mt-4 mt-lg-0"."'>\n");
    array_push($this->error, "                      <i class='"."bi bi-phone"."'></i>\n");
    array_push($this->error, "                      <h4>Llamame, aun no se para qué, pero seguro me hará ilusión:</h4>\n");
    array_push($this->error, "                      <div class='"."contenedor-imagen col-lg-6 info mt-6 mt-lg-0"."'>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."numero"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropZ"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropY"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropX"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropW"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropV"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'/>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropU"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropT"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                        <div>\n");
    array_push($this->error, "                          <img class='"."img-cropS"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        </div>\n");
    array_push($this->error, "                      </div>\n");
    array_push($this->error, "                      <div class='"."contenedor-imagen col-lg-6 info mt-6 mt-lg-0"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropR"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropQ"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                      </div>\n");
    array_push($this->error, "                      <div class='"."contenedor-imagen col-lg-6 info mt-6 mt-lg-0"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropX"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropW"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                      </div>\n");
    array_push($this->error, "                      <div class='"."contenedor-imagen col-lg-6 info mt-6 mt-lg-0"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                        <img class='"."img-cropP"."' src='"."assets/img/alfabeto3.png"."' alt='"."Tu imagen"."'>\n");
    array_push($this->error, "                      </div>\n");
    array_push($this->error, "                        <div class='"."dataLapse2"."' data-tac1='"."uno"."'>\n");
    array_push($this->error, "                        <p>\n");
    array_push($this->error, "                          <span id='"."campo1"."'>%dl2a</span><br><span id='"."campo2"."'>%dl2b</span>\n");
    array_push($this->error, "                        </p>\n");
    array_push($this->error, "                      </div>\n");
    array_push($this->error, "                    </div>\n");
    array_push($this->error, "                  </div>\n");
    array_push($this->error, "                </div>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "              </div>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "            </div>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "            <div class='"."row justify-content-center"."'>\n");
    array_push($this->error, "              <div class='"."col-lg-10"."'>\n");
    array_push($this->error, "                <form action='"."forms/contact.php"."' method='"."post"."' role='"."form"."' class='"."php-email-form"."'>\n");
    array_push($this->error, "                  <div class='"."row"."'>\n");
    array_push($this->error, "                    <div class='"."col-md-6 form-group"."'>\n");
    array_push($this->error, "                      <input type='"."text"."' name='"."name"."' class='"."form-control"."' id='"."name"."' placeholder='"."Your Name"."' required>\n");
    array_push($this->error, "                    </div>\n");
    array_push($this->error, "                    <div class='"."col-md-6 form-group mt-3 mt-md-0"."'>\n");
    array_push($this->error, "                      <input type='"."email"."' class='"."form-control"."' name='"."email"."' id='"."email"."' placeholder='"."Your Email"."' required>\n");
    array_push($this->error, "                    </div>\n");
    array_push($this->error, "                  </div>\n");
    array_push($this->error, "                  <div class='"."form-group mt-3"."'>\n");
    array_push($this->error, "                    <input type='"."text"."' class='"."form-control"."' name='"."subject"."' id='"."subject"."' placeholder='"."Subject"."' required>\n");
    array_push($this->error, "                  </div>\n");
    array_push($this->error, "                  <div class='"."form-group mt-3"."'>\n");
    array_push($this->error, "                    <textarea class='"."form-control"."' name='"."message"."' rows='"."5"."' placeholder='"."Message"."' required></textarea>\n");
    array_push($this->error, "                  </div>\n");
    array_push($this->error, "                  <div class='"."my-3"."'>\n");
    array_push($this->error, "                    <div class='"."loading"."'>Cargando...</div>\n");
    array_push($this->error, "                    <div class='"."error-message"."'></div>\n");
    array_push($this->error, "                    <div class='"."sent-message"."'>Su mensaje fue enviado. ¡Gracias!</div>\n");
    array_push($this->error, "                  </div>\n");
    array_push($this->error, "                  <div class='"."text-center"."'><button type='"."submit"."'>Enviar mensaje</button></div>\n");
    array_push($this->error, "                </form>\n");
    array_push($this->error, "              </div>\n");
    array_push($this->error, "          \n");
    array_push($this->error, "            </div>\n");

//    header('HTTP/1.0 404 Not Found', true, 404);
    
//    $datoUri = "El tip solicitado es" . $_GET['tip'] ?? "Se redirecciona a: ". $_SERVER['REQUEST_URI'];
//    echo "Esta pagina es de error: ".$datoUri."\n";