<?php declare(strict_types=1);

//use superglobals;
if(!isset($_GET["inicio"]) || empty($_GET)){
    $salida= json_encode(array(
        "name" => "Transmision denegada"
    ));
}else if($_GET["inicio"] == "transmite"){
    $salida= json_encode(array(
        "name" => "egomismoooo"
    ));
}else{
    $salida= json_encode(array(
        "name" => "no definido"
    ));
}

echo $salida;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

