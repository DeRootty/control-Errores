<?php
/**
 * Archivo responsable de generar la salida prerenderizada, en la solicitud inicial
 */
header('Content-Type: text/plain');
header('X-Test: foo');

function foo() {
 foreach (headers_list() as $header) {
   if (strpos($header, 'X-Powered-By:') !== false) {
     header_remove('X-Powered-By');
   }
   header_remove('X-Test');
 }
}

$result = header_register_callback('foo');
header('Location: http://www.example.com/');
echo "a";
headers_list — Devuelve una lista de encabezados de respuesta enviados (o listos para enviar)
http_response_code — Obtener o establecer el código de respuesta HTTP
long2ip() - Convierte una dirección de red (IPv4) en una cadena de texto en formato con puntos estándar de internet
ip2long() - Convierte una cadena que contiene una dirección con puntos del Protocolo de Internet (IPv4) en una dirección apropiada
inet_pton() - Convertir una dirección IP legible por humanos a su representación in_addr empaquetada

// Obtener el código de la respuesta actual y establecer uno nuevo
var_dump(http_response_code(404));

// Obtener el nuevo código de respuesta
var_dump(http_response_code());

/* setcookie() agrega una cabecera de respuesta propia */
setcookie('foo', 'bar');

/* Definir un encabezado de respuesta personalizado
   Este será ignorado por la mayoría de los clientes */
header("X-Sample-Test: foo");

/* Especificar el contenido de texto plano en nuestra respuesta */
header('Content-type: text/plain');

/* ¿Qué encabezados se van a enviar? */
var_dump(headers_list());


headers_sent() - Comprueba si o donde han enviado cabeceras
header() - Enviar encabezado sin formato HTTP
setcookie() - Enviar una cookie
apache_response_headers() - Obtiene todas las cabeceras HTTP de respuesta
http_response_code() - Obtener o establecer el código de respuesta HTTP


// Si no se han enviado encabezados, enviar uno
if (!headers_sent()) {
    header('Location: http://www.example.com/');
    exit;
}

// Un ejemplo usando los parámetros opcionales file y line
// Tenga en cuenta que $filename y $linenum se pasan para su posterior uso.
// No asigne los valores de antemano.
if (!headers_sent($filename, $linenum)) {
    header('Location: http://www.example.com/');
    exit;

// Lo más probable es generar un error aquí.
} else {

    echo "Headers already sent in $filename on line $linenum\n" .
          "Cannot redirect, for now please click this <a " .
          "href=\"http://www.example.com\">link</a> instead\n";
    exit;
}