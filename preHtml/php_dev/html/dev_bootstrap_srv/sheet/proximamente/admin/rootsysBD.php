<?php
    $ejercicio=array("fer","wordpress2");

    $servername = "profesor";
    $username = "root";
    $password = "";
    $dbname = "fer";
    $adminBD=array();
    $adminBD["fer"][]=$servername;
    $adminBD["fer"][]=$username;
    $adminBD["fer"][]=$password;
    $adminBD["fer"][]=$dbname;
    $servername = "profesor";
    $username = "root";
    $password = "";
    $dbname = "wordpress2";
    $adminBD["wordpress2"][]=$servername;
    $adminBD["wordpress2"][]=$username;
    $adminBD["wordpress2"][]=$password;
    $adminBD["wordpress2"][]=$dbname;

    require_once "conexion.php";