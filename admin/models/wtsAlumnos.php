<?php declare(strict_types=1);
    class AlumnoModel{
        private $db;

        public function __construct($db){
            $this->db = $db;
        }
        public function obtenerAlumnos(){
            $query="SELECT * FROM alumnos";
            $result = $this->db->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }