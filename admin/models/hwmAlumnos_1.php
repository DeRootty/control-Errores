<?php declare(strict_types=1);

class AlumnoController{
    private $alumnoModel;

    public function __construct($puntero){
        $this->alumnoModel=$puntero;
    }
    public function listarAlumnos(){
        $alumnos = $this->alumnoModel->obtenerAlumnos();
        require_once "views/alumnos/lista.php"; //Muestra la vista correspondiente
    }

}

