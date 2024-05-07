<?php declare(strict_types=1);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Cabeceras de arranque
    namespace practicasAPP\mydata\engine\index;
    use Exception;
    try{
        if(!isset($modoRtm)){
            throw new Exception("Adios mundo cruel ". __FILE__ . " => " . __LINE__ . "<br>\n");
        }
    } catch (Exception $ex) {
        exit($ex->getMessage());
    }finally{
        
    }

    $modoRtm->registroMod("hola mundo a la entrada, calentando motores " . __FILE__ . " => " . __LINE__);
    $modoRtm->registroMod('carga de motor aprovada ok: ' . __FILE__ . "=>" . __LINE__);

   // $modoRtm->salidaModo();