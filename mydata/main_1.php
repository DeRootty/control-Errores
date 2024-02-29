<?php
    if(isset($_GET) && is_array($_GET) && count($_GET)>0){
        $db = new PDO('mysql:host=192.168.1.2;dbname=wordpress2', 'root', '');

        $alumnoModel=new AlumnoModel($db);
        $alumnoController= new AlumnoController($alumnoModel);

        if(!empty($_GET["tip1"]) && isset($_GET["tip1"])){
            if($_GET["tip1"]=="ldMdl")[
                require_once "admin/models/wtsAlumnos.php";
            ]
        }
        if(!empty($_GET["tip2"]) && isset($_GET["tip2"])){
            if($_GET["tip2"]=="ldCtrl")[
                require_once "admin/models/hwmAlumnos.php";
            ]
        }
        //Manejo de rutas y solicitudes
        if(isset($_GET['action'])){
            $alumnoController->listarAlumnos();
        }
    }
    $esteArchivo=__FILE__;
    require_once "admin/engine.php";