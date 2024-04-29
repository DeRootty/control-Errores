<?php
// Protección contra ejecución directa
    global $wpdb, $conn, $idTabla;
    $idTabla=1;
    $fncExist=function_exists("sanitize_text_field");
    require_once "admin/conexion.php";
    function implementacionWP(){
        defined('ABSPATH') or die('Acceso denegado'); //Evitamos que se ejecuten scripts fuera de la ruta
        $ixSalida=array(
            "nonce" => NULL,
            "nombre" => NULL,
            "apellido" => NULL,
            "edad" => NULL
        );
        $nonce = wp_create_nonce('guardar_alumno_nonce');
        $nonceEsc= esc_attr($nonce);
        $ixSalida["nonce"] = $nonceEsc;
        $ixSalida["nombre"] = sanitize_text_field($_POST['nombre']) ?? NULL;
        $ixSalida["apellido"] = sanitize_text_field($_POST['apellido']) ?? NULL;
        $ixSalida["edad"] = intval($_POST['edad']) ?? NULL;
        return $ixSalida;
    }
    function crudObtain($conn, $idValTup): string{
        $crudHtml = $conn->query("SELECT * FROM frm_alumno_html WHERE idTabla = " . $idValTup . ";");
        // Guardamos el set SQL en una variable
        $setHtml = array();
        while ($fila = $crudHtml->fetch_assoc()) {
            $setHtml[] = $fila;
        }
        $ixFncArgs=array();
        $ixFncArgs=explode("__", $setHtml[0]["idGrupo"]);
        call_user_func_array($ixFncArgs[0], $ixFncArgs[1]);
        return $setHtml[0]['contenido'];
    }

    function mostrar_formulario_alumnos(): string{
        global $conn, $idTabla;

        $setShowHtml = crudObtain($conn, $idTabla);
        $salidaPrev=array();
        $salidaPrev=explode("|",$setShowHtml);
        $salida="";
        $phpAdding=false;
        foreach ($salidaPrev as $idVal => $valEnd) {
            if($valEnd=="<php>"){
                $phpAdding=true;
            }else if($valEnd=="</php>"){
                //Se cierra el calculo de los campos dependientes de la algoritmia PHP
                $phpAdding=false;
                //Se cierra el ultimo elemento modificado. En caso que el algoritmo no tenga una implemetancion legitima, aseguramos un error de documento mal formado
                $salida.="'>\n";
            }
            if($phpAdding){
                //Se añaden los modificadores de tag que competan, en este caso solo es value.
                $salida.= "<input type='hidden' name='guardar_alumno_nonce' value='".$nonceEsc;
                //Resto del codigo que, se justifica en este espacio como la parte donde se añaden tags htmls dependientes de php
            }else{
                $salida.=$valEnd;
            }
        }
        return $salida;
    }
    if($fncExist){
        $valoresFrm=implementacionWP();
        if (!is_null($valoresFrm["nombre"]) && !is_null($valoresFrm["apellido"]) && !is_null($valoresFrm["nombre"])){        
            $wpdb->insert(
                $wpdb->prefix . 'alumnos',
                array(
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'edad' => $edad,
                )
            );
            echo '<p>Alumno agregado correctamente.</p>';
        }
    }else{

    }
// Acción para agregar el formulario a la página
    // Ejecutamos la consulta SQL
    // Imprimimos el set SQL
    /*
        echo "<pre>";
        print_r($setHtml);
        echo "</pre>";
        exit;
    */
    if(isset($_POST)){
        if(!$fncExist){
            $nombre = $_POST['nombre'] ?? NULL;
            $apellido = $_POST['apellido'] ?? NULL;
            $edad = $_POST['edad'] ?? NULL;
        }
        if (!is_null($nombre) && !is_null($apellido) && !is_null($nombre)){
            //lanza funcion de insercion en base de datos
        }else{
            echo "Los valores introducidos no son validos<br>\n";
        }
    }
    // Hook para agregar el formulario al contenido de la página
    function agregar_formulario_alumnos($content) {
        if (is_single()) {
            ob_start();
            mostrar_formulario_alumnos();
            $formulario = ob_get_clean();
            $content .= $formulario;
        }
        return $content;
    }
    //add_filter('the_content', 'agregar_formulario_alumnos');
    // Función para el shortcode
    function formulario_alumnos_shortcode() {
        ob_start();
        mostrar_formulario_alumnos();
        $formulario = ob_get_clean();
        return $formulario;
    }
    // Registro del shortcode
    //add_shortcode('formulario_alumnos', 'formulario_alumnos_shortcode');
    echo "Aqui ira la consulta";








//----------------------------------------------------------------------------------------------------------------------
/*
Plugin Name: Alumnos Plugin
Description: Un plugin para gestionar alumnos.
Version: 1.0
Author: Tu Nombre
*/
// Acción para agregar el formulario a la página
/*
function mostrar_formulario_alumnos() {
        global $wpdb;
        // Mejora: Validación de Nonce y capacidad de usuario
        if (isset($_POST['submit']) && check_admin_referer('guardar_alumno_nonce', 'guardar_alumno_nonce') && current_user_can('manage_options')) {
            $nombre = sanitize_text_field($_POST['nombre']); //Sanea los datos y previenen
            $apellido = sanitize_text_field($_POST['apellido']);
            $edad = intval($_POST['edad']);

            // Mejora: Consulta preparada para evitar SQL Injection
            $wpdb->insert(
                $wpdb->prefix . 'alumnos',
                array(
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'edad' => $edad,
                )
                );
            return '<p>Alumno agregado correctamente.</p>';
        }
}
*/
// Hook para agregar el formulario al contenido de la página
/*
function agregar_formulario_alumnos($content) {
    if (is_single()) {
        ob_start();
        mostrar_formulario_alumnos();
        $formulario = ob_get_clean();
        $content .= $formulario;
    }
    return $content;
}
*/
//add_filter('the_content', 'agregar_formulario_alumnos');
// Función para el shortcode
/*
function formulario_alumnos_shortcode() {
    ob_start();
    mostrar_formulario_alumnos();
    $formulario = ob_get_clean();
    return $formulario;
}
*/
// Registro del shortcode
//add_shortcode('formulario_alumnos', 'formulario_alumnos_shortcode');