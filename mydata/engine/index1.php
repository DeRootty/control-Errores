<?php
$sock = socket_create_listen(0);

socket_getsockname($sock, $addr, $port);

print "Server Listening on $addr:$port\n";

$port_file = $addr."_".$port.".sck";

$fp = fopen($port_file, 'w');

fwrite($fp, $port);

fclose($fp);

while($c = socket_accept($sock)) {

   /* do something useful */

   socket_getpeername($c, $raddr, $rport);

   print "Received Connection from $raddr:$rport\n";

}

socket_close($sock);

$incluido = require_once("/admin/rootsysBD.php");

if(!$incluido){
    exit;
}




 $ejercicioALanzar="_0"; //logica a cargar
 $queEjercicio=0; //conector base de datos
//$ejercicioALanzar="_1";
$analizaGet=array();
if(!empty($_SERVER["REQUEST_URI"])){
    if(file_exists($_SERVER["REQUEST_URI"])){
        echo "No se ha especificado una ruta adecuada: ".$_SERVER['REQUEST_URI'];
        exit;
        require_once $_SERVER['REQUEST_URI'];
    }else{
        $checkGet=explode("/",$_SERVER['REQUEST_URI']);
        if(is_array($checkGet) && isset($checkGet) && count($checkGet)>1){
            if($checkGet[2]=="main.php"){
                $uriFinal=explode(".", $checkGet[2]);
                if($ejercicioALanzar=="_1"){
                    $_GET["tip1"]="ldMdl";
                    $_GET["tip2"]="ldCtrl";
                    foreach($checkGet as $idVal => $valEnd){
                        $analizaGet=explode("=", $valEnd);
                        if(isset($analizaGet) && is_array($analizaGet) && count($analizaGet)>0 ){

                            echo "<pre>";
                            print_r($analizaGet);
                            echo "</pre>";
                            exit;
                        }
                    }
                }else if($ejercicioALanzar=="_0"){
                    require_once "admin/rootsysBD.php";
                }
                require_once $uriFinal[0].$ejercicioALanzar.".".$uriFinal[1];
            }else{
                if(isset($_GET) && is_array($_GET) && count($_GET)>0){
                    
                }else{
                    header("Location: http://profesor/wordpress2/error.php?tip=".$_SERVER['REQUEST_URI']);
                }
            }
        }
    }
}else{
    /**
     * Front to the WordPress application. This file doesn't do anything, but loads
     * wp-blog-header.php which does and tells WordPress to load the theme.
     *
     * @package WordPress
     */

    /**
     * Tells WordPress to load the WordPress theme and output it.
     *
     * @var bool
     */
    define( 'WP_USE_THEMES', true );

    /** 
     * Loads the WordPress Environment and Template 
     * */
    require __DIR__ . '/wp-blog-header.php';
}

