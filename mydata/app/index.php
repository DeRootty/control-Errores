<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    try{
        if(!file_exists("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php")){
            throw new Exception("Fallo en el fundamento inherente a la seguridad. El archivo ".__FILE__." Viola el acceso al recurso");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        exit;
    }finally{
        include ("/srv/vhost/derootty.xyz/home/html/Dinamica/seguridad/ahead.php");
    }

//enviar -----------------------------------------------------------
$ch = curl_init();

// Establece la URL y otras opciones apropiadas
curl_setopt($ch, CURLOPT_URL, "http://www.example.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);

// Captura la URL y la envía al navegador
curl_exec($ch);

// Cierrar el recurso cURL y libera recursos del sistema
curl_close($ch);

//publicar -------------------------------------------------------------
$url = '{POST_REST_ENDPOINT}';
$curl = curl_init();
$fields = array(
    'field_name_1' => 'Value 1',
    'field_name_2' => 'Value 2',
    'field_name_3' => 'Value 3'
);
$fields_string = http_build_query($fields);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
$data = curl_exec($curl);
curl_close($curl);