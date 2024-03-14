<?php
    echo "<h2>Lista de alumnos</h2>";
    echo "<ul>";
    foreach($alumnos as $idVal => $valEnd){
        if(is_array($valEnd)){
            $rescatado[]="<li>";
            foreach($valEnd as $idVal1 => $valEnd1){
                $rescatado[]=$valEnd1;
            }
            $rescatado[]="</li>";
        }
        foreach($rescatado as = $idVal => $valEnd){
            $fila."\n"= $valEnd;
        }        
    }
    echo $fila;
    echo "</ul>";