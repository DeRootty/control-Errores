<?php
$ejercicioALanzar="_0";
echo "cargando el sitio";
if(!empty($_SERVER["REQUEST_URI"])){
    require_once "admin/conexion.php";
    if(file_exists($_SERVER["REQUEST_URI"])){
        echo "No se ha especificado una ruta adecuada: ".$_SERVER['REQUEST_URI'];
        exit;
        require_once $_SERVER['REQUEST_URI'];
    }else{
        $checkGet=explode("/",$_SERVER['REQUEST_URI']);
        if(is_array($checkGet) && isset($checkGet) && count($checkGet)>1){
            if($checkGet[2]=="main.php"){
                $uriFinal=explode(".", $checkGet[2]);
                require_once $uriFinal[0].$ejercicioALanzar.".".$uriFinal[1];
            }else{
                if(isset($_GET) && is_array($_GET) && count($_GET)>0){
                    
                }else{
                    header("Location: http://www.derootty.xyz/error.php?tip=".$_SERVER['REQUEST_URI']);
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

